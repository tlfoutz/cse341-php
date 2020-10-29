<?php
    session_start();
    if (!isset($_SESSION['userId'])) {
        header("Location: signIn.php");
        die();
    }
    require 'dbConnect.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Travis Foutz">
        <meta name="description" content="Project 01 - CSE 341">
        <link rel="icon" type="image/png" href="../images/moon.gif">
        <link rel="stylesheet" type="text/css" href="../css/project01.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>Food Inventory Application</title>
    </head>
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
                <h1>Food Inventory Application</h1>
        
                <h2>Welcome, <?php echo $_SESSION['userName'] ?></h2>
                <a href="addLocation.php">Click here</a><br>
                <a href="addFood.php">Click here</a><br>
                <a href="signOut.php">Click here</a>

                <form id="updateForm" method="post" action="updateChanges.php">
                    <select name="locations" id="locations"><option value="0" selected>All locations</option>
                    <?php
                        $statement = $db->prepare('SELECT id, location_name FROM locations WHERE added_by = :id ORDER BY location_name');
                        $statement->execute(array(':id' => $_SESSION['userId']));
                        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $row['id'] . '"';
                            if ($_SESSION['selectedLocation'] == $row['id']) { echo ' selected'; }
                            echo '>' . $row['location_name'] . '</option>';
                        }
                    ?>
                    </select><br>
                    
                    <label for="fname">Find food by name:</label><br><input type="search" id="fname" name="fname"
                        <?php if($_SESSION['foodSearch']) { echo ' value="' . $_SESSION['foodSearch'] . '"';} ?>><br><br>
                    
                    <table><tr><th>Food</th><th>Location</th><th>Details (Location)</th><th>Quantity</th><th>Details (Food)</th></tr>
                        <?php include 'renderFoodTable.php'; ?>
                    </table><br>
                    <input type="submit" name="update" value="Update">
                </form>
            </div>
        </header>
        <h3 class="feature-title">Get in Touch!</h3>

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