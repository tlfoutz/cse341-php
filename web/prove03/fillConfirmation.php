<?php
    if(isset($_SESSION["cartItem1"])) {
        echo "<tr><td>Item #1</td><td>" . $_SESSION["itemAmount1"] . "</td></tr>";
    }
    if(isset($_SESSION["cartItem2"])) {
        echo "<tr><td>Item #2</td><td>" . $_SESSION["itemAmount2"] . "</td></tr>";
    }
    if(isset($_SESSION["cartItem3"])) {
        echo "<tr><td>Item #3</td><td>" . $_SESSION["itemAmount3"] . "</td></tr>";
    }
    if(isset($_SESSION["cartItem4"])) {
        echo "<tr><td>Item #4</td><td>" . $_SESSION["itemAmount4"] . "</td></tr>";
    }
    if(isset($_SESSION["cartItem5"])) {
        echo "<tr><td>Item #5</td><td>" . $_SESSION["itemAmount5"] . "</td></tr>";
    }
    if(isset($_SESSION["cartItem6"])) {
        echo "<tr><td>Item #6</td><td>" . $_SESSION["itemAmount6"] . "</td></tr>";
    }

    echo "</table><br>";
    echo $_SESSION["fullname"];
    echo "<br>";
    echo $_SESSION["email"];
    echo "<br>";
    echo $_SESSION["address"];
    echo "<br>";
    echo $_SESSION["city"] . ", " . $_SESSION["state"];
    echo "<br>";
    echo $_SESSION["zip"];
    echo "<br>";
?>