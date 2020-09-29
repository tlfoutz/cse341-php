<?php
$name = htmlspecialchars($_POST["name"]);
$email = htmlspecialchars($_POST["email"]);
$major = htmlspecialchars($_POST["major"]);
$continents = $_POST["continents"];
$comments = htmlspecialchars($_POST["comments"]);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Submission Results</title> 
    </head>
    <body>
    <h1>Submission Results</h1>

    <p>Welcome, <?=$name ?></p>
    <p>Your email address is: <a href="mailto:<?=$email ?>"><?=$email ?></a></p>
    <p>You major is: <?=$major ?></p>
    <p>Continents visited:</p>
	<ul>
        <?
            foreach ($continents as $continent)
            {
                $continent_clean = htmlspecialchars($continent);
                echo "<li><p>$continent_clean</p></li>";
            }
        ?>		
	</ul>
	<p>Comments: <?=$comments?></p>
    </body
</html>
