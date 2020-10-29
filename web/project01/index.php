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
        <title>Food Inventory Application</title>
    </head>
    <body>
        <h1>Food Inventory Application</h1>
        
        <h2>Welcome, <?php echo $_SESSION['userName'] ?></h2>
        
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
        </form><br><br>

        <a href="addLocation.php">Add Location</a><br>
        <a href="addFood.php">Add Food</a><br>
        <a href="signOut.php">Sign Out</a>
    </body>
</html>