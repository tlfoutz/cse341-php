<?php
    session_start();
    if($_POST['logout']) { unset($_SESSION['userId']); }
    $_SESSION['selectedLocation'] = $_POST['locations'];
    // $_SESSION['foodSearch'] = htmlspecialchars($_POST['fname']);
    $_SESSION['errMsg'] = '';

    // Connect to Postgres
    try {
        $dbUrl = getenv('DATABASE_URL');

        $dbOpts = parse_url($dbUrl);

        $dbHost = $dbOpts["host"];
        $dbPort = $dbOpts["port"];
        $dbUser = $dbOpts["user"];
        $dbPassword = $dbOpts["pass"];
        $dbName = ltrim($dbOpts["path"],'/');

        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $ex) {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }

    //INSERT new user
    if ($_POST['nname']) {
        if($_POST['npsw'] != $_POST['cpsw']) {
            $_SESSION['errMsg'] = '<p class="errMsg">The new and confirmation passwords did not match. New user not created.</p>';
        } else {
            $statement = $db->prepare('INSERT INTO users(user_name, user_password) VALUES (:name, :password)');
            try {
                $statement->execute(array(':name' => htmlspecialchars($_POST['nname']), ':password' => htmlspecialchars($_POST['npsw'])));
                // SELECT as the current user as well
                $statement = $db->prepare('SELECT id, user_name FROM users WHERE user_name = :username');
                $statement->execute(array(':username' => htmlspecialchars($_POST['nname'])));
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $_SESSION['userId'] = $row['id'];
                    $_SESSION['userName'] = $row['user_name'];
                }
            }
            catch (PDOException $ex) {
                $_SESSION['errMsg'] = '<p class="errMsg">Username already exists.</p>';
            }
        }
    }

    //SELECT return user
    if ($_POST['rname']) {
        $statement = $db->prepare('SELECT id, user_name, user_password FROM users WHERE user_name = :username AND user_password = :password');
        try {$statement->execute(array(':username' => htmlspecialchars($_POST['rname']), ':password' => htmlspecialchars($_POST['rpsw'])));}
        catch (PDOException $ex) {
            $_SESSION['errMsg'] = '<p class="errMsg">Incorrect username and/or password.</p>';
        }
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['userId'] = $row['id'];
            $_SESSION['userName'] = $row['user_name'];
        }
    }

    // INSERT new location
    if ($_POST['lAddName']) {
        // with details
        if ($_POST['lAddDetails']) {
            $statement = $db->prepare('INSERT INTO locations(location_name, details, added_by) VALUES (:name, :details, :id)');
            $statement->execute(array(':name' => htmlspecialchars($_POST['lAddName']), ':details' => htmlspecialchars($_POST['lAddDetails']), ':id' => $_SESSION['userId']));
        } else {
            $statement = $db->prepare('INSERT INTO locations(location_name, added_by) VALUES (:name, :id)');
            $statement->execute(array(':name' => htmlspecialchars($_POST['lAddName']), ':id' => $_SESSION['userId']));
        }
    }

    // INSERT new food
    if ($_POST['fAddName']) {
        // check for missing/incorrect information
        if ((empty($_POST['fAddQuantity']) || $_POST['fAddQuantity'] <= 0) || $_POST['fAddLocation'] == 0) {
            $_SESSION['errMsg'] = '<p class="errMsg">Not all fields for new food item where filled out correctly. New food not added.</p>';
        } else {
            // with details
            if ($_POST['fAddDetails']) {
                $statement = $db->prepare('INSERT INTO foods(food_name, details, location_id, quantity, added_by) VALUES (:name, :details, :locationId, :amount, :id)');
                $statement->execute(array(':name' => htmlspecialchars($_POST['fAddName']), ':details' => htmlspecialchars($_POST['fAddDetails']), ':locationId' => $_POST['fAddLocation'], ':amount' => $_POST['fAddQuantity'], ':id' => $_SESSION['userId'])); 
            } else {
                $statement = $db->prepare('INSERT INTO foods(food_name, location_id, quantity, added_by) VALUES (:name, :locationId, :amount, :id)');
                $statement->execute(array(':name' => htmlspecialchars($_POST['fAddName']), ':locationId' => $_POST['fAddLocation'], ':amount' => $_POST['fAddQuantity'], ':id' => $_SESSION['userId']));              
            }
        }
    }

    // INSERT new food quantities
    foreach($_POST as $key => $val) {
        if (preg_match('/newAmount\d/m', $key)) {
            $foodId = trim($key,"newAmount");
            $statement = $db->prepare('UPDATE foods SET quantity = :quantity WHERE id = :id');
            $statement->execute(array(':quantity' => intval($val), ':id' => intval($foodId)));
        }
    }
?>
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Travis Foutz">
        <meta name="description" content="Project 01 - CSE 341">
        <link rel="icon" type="image/png" href="../images/moon.gif">
        <link rel="stylesheet" type="text/css" href="../css/prove02.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>Food Inventory - Travis Foutz - CSE 341</title>
    </head>
    <body>
        <body>
        <nav class="navbar navbar-expand-md">
            <a class="navbar-brand" href="../homepage.php"><img src="../images/moon.gif" alt="Logo" style="width:33%;height:33%;"></a>
            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main-navigation">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="../homepage.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../assignments.php">Assignments</a>
                </li>
              </ul>
            </div>
        </nav>
        <header class="page-header header container-fluid">
            <div class="overlay"></div>
                <div class="description">
                <h1>Food Inventory</h1>
                <?php
                echo $_SESSION['errMsg'];
                echo '<form method="post" action="';
                echo htmlspecialchars($_SERVER["PHP_SELF"]);
                echo '">';

                // Display login Info
                if (!isset($_SESSION['userId'])) {
                    echo '<h3>Return User Login</h3>';
                    echo '<label for="rname"><b>Username: </b></label>';
                    echo '<input type="text" placeholder="Enter Username" name="rname" minlength="8" maxlength="16"><br><br>';
                    echo '<label for="rpsw"><b>Password: </b></label>';
                    echo '<input type="password" placeholder="Enter Password" name="rpsw" minlength="8" maxlength="16">';

                    echo '<h3>New User Login</h3>';
                    echo '<label for="nname"><b>Username: </b></label>';
                    echo '<input type="text" placeholder="8 to 16 characters" name="nname" minlength="8" maxlength="16"><br><br>';
                    echo '<label for="npsw"><b>Password: </b></label>';
                    echo '<input type="password" placeholder="8 to 16 characters" name="npsw" minlength="8" maxlength="16"><br><br>';
                    echo '<label for="cpsw"><b>Confirm Password: </b></label>';
                    echo '<input type="password" placeholder="8 to 16 characters" name="cpsw" minlength="8" maxlength="16"><br><br>';
                }
                
                // Display user info
                else {
                    echo '<h2>Welcome, ' . $_SESSION['userName'] . '</h2>';
                    
                    // Food table
                    echo '<table><tr><th>Food</th><th>Location</th><th>Quantity</th><th>Details</th></tr>';
                    $counter = 0;
                    
                    if ($_SESSION['selectedLocation'] == 0 || empty($_SESSION['selectedLocation'])) {
                        // if ($_SESSION['foodSearch']) {
                        //     // TODO:
                        // } else {
                            $statement = $db->prepare('SELECT f.id, f.food_name, f.location_id, f.details, f.quantity, l.location_name FROM foods f INNER JOIN locations l ON f.location_id = l.id WHERE f.added_by = :id');
                            $statement->execute(array(':id' => $_SESSION['userId']));
                            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr><td>' . $row['food_name'] . '</td><td>' . $row['location_name'] . '</td><td><input type="number" value="' . $row['quantity'] . '" name="newAmount' .$row['id'] . '" min="0"></td><td>' . $row['details'] . '</td></tr>';
                                $counter++;
                            }
                        // }
                    } else {
                        // if ($_SESSION['foodSearch']) {
                        //     // TOD0:
                        // } else {
                            $statement = $db->prepare('SELECT f.id, f.food_name, f.location_id, f.details, f.quantity, l.location_name FROM foods f INNER JOIN locations l ON f.location_id = l.id WHERE f.added_by = :id AND f.location_id = :locationId');
                            $statement->execute(array(':id' => $_SESSION['userId'], ':locationId' => $_SESSION['selectedLocation']));
                            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr><td>' . $row['food_name'] . '</td><td>' . $row['location_name'] . '</td><td><input type="number" value="' . $row['quantity'] . '" name="newAmount' .$row['id'] . '" min="0"></td><td>' . $row['details'] . '</td></tr>';
                                $counter++;
                            }
                        // }
                    }
                    echo '</table>';
                    if ($counter == 0) { echo 'No food found.<br>'; }
                    echo '<br><br>';

                    // User's locations 
                    echo '<select name="locations" id="locations"><option value="0" selected>All locations</option>';
                    $statement = $db->prepare('SELECT id, location_name FROM locations WHERE added_by = :id');
                    $statement->execute(array(':id' => $_SESSION['userId']));
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '"';
                        if ($_SESSION['selectedLocation'] == $row['id']) { echo ' selected'; }
                        echo '>' . $row['location_name'] . '</option>';
                    }
                    echo '</select><br>';
                    
                    // Food name search * NOT READY * 
                    // echo '<label for="fname">Find food by name:</label><br><input type="search" id="fname" name="fname"';
                    // if($_SESSION['foodSearch']) { echo ' value="' . $_SESSION['foodSearch'] . '"';}
                    // echo '>';

                    // New food item input
                    echo '<br><h3>Add new food item:</h3><label for="fAddName">Name:</label><br><input type="text" id="fAddName" name="fAddName"><br>';
                    echo '<label for="fAddLocation">Location:</label><br>';
                    echo '<select name="fAddLocation" id="fAddLocation"><option value="0" disabled selected> -- Select location -- </option>';
                    $statement = $db->prepare('SELECT id, location_name FROM locations WHERE added_by = :id');
                    $statement->execute(array(':id' => $_SESSION['userId']));
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['location_name'] . '</option>';
                    }
                    echo '</select><br>';
                    echo '<label for="fAddQuantity">Quantity:</label><br><input type="number" id="fAddQuantity" name="fAddQuantity" min="0"><br>';
                    echo '<label for="fAddDetails">Details:</label><br><input type="textarea" id="fAddDetails" name="fAddDetails"><br><br>';
                    
                    // New location input
                    echo '<h3>Add new food location:</h3><label for="lAddName">Name:</label><br><input type="text" id="lAddName" name="lAddName"><br>';
                    echo '<label for="lAddDetails">Details:</label><br><input type="textarea" id="lAddDetails" name="lAddDetails"><br><br>';
                    echo '<input type="checkbox" id="logout" name="logout" value="1">';
                    echo '<label for="logout"> Check this box to logout after submitting.</label><br><br>';
                }

                echo '<input type="submit" name="submit" value="Submit"></form><br>';
                ?>
            </div>
        </header>
        <footer class="page-footer">
          <div class="col-lg-4 col-md-4 col-sm-12">
             <h6 class="text-uppercase font-weight-bold">Contact</h6>
             <p>Email:
             <br/>tfoutz@byui.edu
          </div>
          <div class="footer-copyright text-center">© 2020 Copyright <?php echo "" . date("m/d/Y") . "";?></div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="../js/prove02.js"></script>
    </body>
</html>
    </body>
</html>