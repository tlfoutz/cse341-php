<?php

$userName = $_POST['name'];
$userEmail = $_POST['email'];
$userMajor = $_POST['major'];
$userComments = $_POST['comments'];

echo "your info:".'<br><br>';
echo "$userName".'<br>';
echo '<a href="mailto:'.$userEmail.'">'.$userEmail.'</a>'.'<br>';
echo $userMajor."<br>";

 $aContinents = $_POST['continents'];
 
//     $N = count($aContinents);

//     echo("You selected $N continents(s): "."<br>");
//     for($i=0; $i < $N; $i++)
//     {
//       echo($aContinents[$i] . "<br>");
//     }
  
foreach ($aContinents as $place)
{
	$place_clean = htmlspecialchars($place);
	echo "<p>$place_clean</p>";
}

echo $userComments;


?>