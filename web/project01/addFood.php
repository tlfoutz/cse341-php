<?php
    session_start();
    if (!isset($_SESSION['userId'])) {
        header("Location: signIn.php");
        die();
    }
    require 'dbConnect.php';

?>
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8">
        <link rel="icon" type="image/png" href="../images/moon.gif">
        <link rel="stylesheet" type="text/css" href="../css/project01.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Travis Foutz">
        <meta name="description" content="Project 01 - CSE 341">
        <title>Add new food to inventory</title>
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
        <form id="addFoodForm" method="post" action="insertFood.php">
        <header class="page-header header container-fluid">
            <div class="overlay"></div>
            <div class="description">
        <h1>Food Inventory Application</h1>
        <h2>Add new food item:</h2>
        <?php if(isset($_GET['error'])){ echo $_SESSION['errMsg'] . "<br>"; }?>
            <label for="fAddName">Name:</label><br>
            <input type="text" id="fAddName" name="fAddName" maxlength="64" required><br>
            <label for="fAddLocation">Location:</label><br>
            <select name="fAddLocation" id="fAddLocation">
                <option value="0" disabled selected> -- Select location -- </option>
                <?php
                    $statement = $db->prepare('SELECT id, location_name FROM locations WHERE added_by = :id ORDER BY location_name');
                    $statement->execute(array(':id' => $_SESSION['userId']));
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['location_name'] . '</option>';
                    }
                    echo '</select><br>';
                ?>
            <label for="fAddQuantity">Quantity:</label><br><input type="number" id="fAddQuantity" name="fAddQuantity" min="0" required><br>
            <label for="fAddDetails">Details:</label><br><input type="text" id="fAddDetails" name="fAddDetails" maxlength="255"><br><br>
            <input type="submit" name="addFood" value="Add Food">
            <p><a href="index.php">Back</a></p>

            </div>

</header>
        </form>
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
</htmll>