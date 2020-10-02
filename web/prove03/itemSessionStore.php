<?php
    if(isset($_POST['button1'])) {
        $_SESSION["cartItem1"] =
        "<tr id=\"cartItem1\">
        <td>Item #1</td>
        <td>The first item</td>
        <td><input type=\"number\" name=\"num1\" value=\"" . $_POST['num1'] . "\"\>
        <td><input type=\"submit\" name=\"delete1\" id=\"1delete\" value=\"Remove from cart\"/>
        </tr>";
      } 
    if(isset($_POST['button2'])) { 
        $_SESSION["cartItem2"] =
            "<tr id=\"cartItem2\">
            <td>Item #2</td>
            <td>The second item</td>
            <td><input type=\"number\" name=\"num1\" value=\"" . $_POST['num2'] . "\"\>
            <td><input type=\"submit\" name=\"delete2\" id=\"2delete\" value=\"Remove from cart\"/>
            </tr>";          
        }
    if(isset($_POST['button3'])) { 
        $_SESSION["cartItem3"] =
            "<tr id=\"cartItem3\">
            <td>Item #3</td>
            <td>The third item</td>
            <td><input type=\"number\" name=\"num3\" value=\"" . $_POST['num3'] . "\"\>
            <td><input type=\"submit\" name=\"delete3\" id=\"3delete\" value=\"Remove from cart\"/>
            </tr>";           
        } 
    if(isset($_POST['button4'])) { 
        $_SESSION["cartItem4"] =
            "<tr id=\"cartItem4\">
            <td>Item #4</td>
            <td>The fourth item</td>
            <td><input type=\"number\" name=\"num4\" value=\"" . $_POST['num4'] . "\"\>
            <td><input type=\"submit\" name=\"delete4\" id=\"4delete\" value=\"Remove from cart\"/>
            </tr>";           
        } 
    if(isset($_POST['button5'])) { 
        $_SESSION["cartItem5"] =
            "<tr id=\"cartItem5\">
            <td>Item #5</td>
            <td>The fifth item</td>
            <td><input type=\"number\" name=\"num5\" value=\"" . $_POST['num5'] . "\"\>
            <td><input type=\"submit\" name=\"delete5\" id=\"5delete\" value=\"Remove from cart\"/>
            </tr>";           
        } 
    if(isset($_POST['button6'])) { 
        $_SESSION["cartItem6"] =
            "<tr id=\"cartItem6\">
            <td>Item #6</td>
            <td>The sixth item</td>
            <td><input type=\"number\" name=\"num6\" value=\"" . $_POST['num6'] . "\"\>
            <td><input type=\"submit\" name=\"delete6\" id=\"6delete\" value=\"Remove from cart\"/>
            </tr>";           
        }
        var_dump($_SESSION);
?>