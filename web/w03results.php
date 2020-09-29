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
            // function toName($contintent)
            // {
            //     switch ($continent) {
            //         case "na":
            //             return "North America";
            //         case "sa":
            //             return "South America";
            //         case "asia":
            //             return "Asia";
            //         case "eu":
            //             return "Europe";
            //         case "af":
            //             return "Africa";
            //         case "aus":
            //             return "Australia";
            //         case "ant":
            //             return "Antarctica";
            //     }            
            // }



            $map = array("na" => "North America", "sa" => "South America", "asia" => "Asia",
                "eu" => "Europe", "af" => "Africa", "aus" => "Australia", "ant" => "Antarctica");

            //var_dump($map->get("a"));
            
            //$visited = array_map('toName', $continents);
            //foreach ($visited as $place)
            foreach($continents as $continent) {

                foreach ($map as $key => $value) {
                    if ($continent == $key) {
                        echo '<li><p>'.$value.'</p></li>';
                    }
                }
                    // $place = $map->get($continent);
                    // echo 'console.log('.$place.')';
                    // $continent_clean = htmlspecialchars($continent);
                    // echo '<li><p>'.$place.'</p></li>';
            }
        ?>		
	</ul>
	<p>Comments: <?=$comments?></p>
    </body
</html>
