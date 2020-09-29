<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Week 03 Team Activity</title> 
    </head>
    <body>
        <h1>Week 03 Team Activity</h1><br>
        <!-- HTML form version -->

        <!-- <form action="w03results.php" method="post">
            <label for="name"> Name:</label>
            <input type="text" id="name" name="name"><br><br>
            <label for="email"> Email:</label>
            <input type="text" id="email" name="email"><br><br>
            
            <p>Please select your Major:</p>
            <input type="radio" id="cs" name="major" value="Computer Science">
            <label for="cs">Computer Science</label><br>
            <input type="radio" id="wdd" name="major" value="Web Design and Development">
            <label for="wdd">Web Design and Development</label><br>
            <input type="radio" id="cit" name="major" value="Computer information Technology">
            <label for="cit">Computer information Technology</label><br>
            <input type="radio" id="ce" name="major" value="Computer Engineering">
            <label for="ce">Computer Engineering</label><br><br>
            
            <p>Continents you've visited:</p>
			<input type="checkbox" name="continents[]" id="place-na" value="North America"><label for="place-na">North America</label><br />
			<input type="checkbox" name="continents[]" id="place-sa" value="South America"><label for="place-sa">South America</label><br />
			<input type="checkbox" name="continents[]" id="place-asia" value="Asia"><label for="place-asia">Asia America</label><br />
			<input type="checkbox" name="continents[]" id="place-eu" value="Europe"><label for="place-eu">Europe</label><br />
			<input type="checkbox" name="continents[]" id="place-af" value="Africa"><label for="place-af">Africa</label><br />
			<input type="checkbox" name="continents[]" id="place-aus" value="Australia"><label for="place-aus">Australia</label><br />
			<input type="checkbox" name="continents[]" id="place-ant" value="Antarctica"><label for="place-ant">Antarctica</label><br />
            <br />
            
            <label for="comments"> Comments:</label><br>
            <textarea id="comments" name="comments" placeholder="Write something.." style="height:200px;width: 600px;"></textarea><br>
            
            <input type="submit">
        </form> -->

        <!-- PHP form version -->
        <?php
            echo "<form action='w03results.php' method='post'>";

            $majors = array('Computer Science', 'Web Design and Developement', 'Computer Information Technology', 'Computer Engineering');
            // $ids = array('cs', 'wdd', 'cit', 'ce')
            
            // for ($i = 0; $i < 4; $i++){
            //     echo '<input type="radio" name="major" id="'.$ids[$i].'" value="'.$majors[$i].'">
            //     <label for="'.$ids[$i].'">'.$majors[$i].'</label><br>';
            // }
            // echo '<br>';
            
            // echo '<p>Continents you have visited:</p>
            //     <input type="checkbox" name="continents[]" id="place-na" value="North America"><label for="place-na">North America</label><br />
            //     <input type="checkbox" name="continents[]" id="place-sa" value="South America"><label for="place-sa">South America</label><br />
            //     <input type="checkbox" name="continents[]" id="place-asia" value="Asia"><label for="place-asia">Asia America</label><br />
            //     <input type="checkbox" name="continents[]" id="place-eu" value="Europe"><label for="place-eu">Europe</label><br />
            //     <input type="checkbox" name="continents[]" id="place-af" value="Africa"><label for="place-af">Africa</label><br />
            //     <input type="checkbox" name="continents[]" id="place-aus" value="Australia"><label for="place-aus">Australia</label><br />
            //     <input type="checkbox" name="continents[]" id="place-ant" value="Antarctica"><label for="place-ant">Antarctica</label><br />
            //     <br />';

            // echo '<label for="comments"> Comments:</label><br>
            //     <textarea id="comments" name="comments" placeholder="Write something.." style="height:200px;width: 600px;"></textarea><br>';

            // echo '<button type="submit">Submit</button>';
            // echo '</form>';
        ?>
    </body>
</html>
