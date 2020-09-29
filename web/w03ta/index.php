<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- form -->
    <form action="formGuy.php" method="post">
    
        <!-- name -->
        <label for="name">Enter your name: </label>
        <input type="text" id="name" name="name" placeholder="name"><br><br>
        
        <!-- email -->
        <label for="email">Enter your email: </label>
        <input type="text" name="email" placeholder="email"><br><br>

        <!-- radio buttons -->
        <span>Pick a major:</span><br>
        <input type="radio" name="major" id="comScience" value="Computer Science">
        <label for="comScience">Computer Science</label><br>

        <input type="radio" name="major" id="webDev" value="Web Design and Developement">
        <label for="webDev">Web Design and Developement</label><br>

        <input type="radio" name="major" id="comInfo" value="Computer Information Technology">
        <label for="comInfo">Computer Information Technology</label><br>

        <input type="radio" name="major" id="comEngine" value="Computer Engineering">
        <label for="comEngine">Computer Engineering</label><br><br>

        <!-- checkboxes -->

        <h3>What Continents have you visited?</h3><br>
        <input type="checkbox" id="place-na" name="continents[]" value="North America">
        <label for="place-na"> North American</label><br>
        <input type="checkbox" id="place-sa" name="continents[]" value="South America">
        <label for="place-sa"> South America</label><br>
        <input type="checkbox" id="place-eu" name="continents[]" value="Europe">
        <label for="place-eu"> Europe</label><br>
        <input type="checkbox" id="place-as" name="continents[]" value="Asia">
        <label for="place-aa"> Asia</label><br>
        <input type="checkbox" id="place-au" name="continents[]" value="Austrulia">
        <label for="place-au"> Australia</label><br>
        <input type="checkbox" id="place-af" name="continents[]" value="Africa">
        <label for="place-af"> Africa</label><br>
        <input type="checkbox" id="place-an"name="continents[]" value="Antartica">
        <label for="place-an"> Antartica</label><br><br>

        <!-- comments -->
        <textarea name="comments" rows="5" cols="40" placeholder="comments..."></textarea><br><br>
    
        <!-- submit button -->
        <button type="submit">Submit</button>
    </form>
   
   <?php
        echo "<form action='formGuy.php' method='post'>";

        $majors = array('Computer Science', 'Web Design and Developement', 'Computer Information Technology', 'Computer Engineering');
        $ids = array('cs', 'wdd', 'cit', 'ce')
        for ($i = 0; $i < 4; $i++){
            echo '<input type="radio" name="major" id="'.$ids[$i].'" value="'.$majors[$i].'">
            <label for="'.$ids[$i].'">'.$majors[$i].'</label><br>';
        }
        echo '<br>';
        

        echo ' <h3>What Continents have you visited?</h3><br>
        <input type="checkbox" id="place-na" name="continents[]" value="North America">
        <label for="place-na"> North American</label><br>
        <input type="checkbox" id="place-sa" name="continents[]" value="South America">
        <label for="place-sa"> South America</label><br>
        <input type="checkbox" id="place-eu" name="continents[]" value="Europe">
        <label for="place-eu"> Europe</label><br>
        <input type="checkbox" id="place-as" name="continents[]" value="Asia">
        <label for="place-aa"> Asia</label><br>
        <input type="checkbox" id="place-au" name="continents[]" value="Austrulia">
        <label for="place-au"> Australia</label><br>
        <input type="checkbox" id="place-af" name="continents[]" value="Africa">
        <label for="place-af"> Africa</label><br>
        <input type="checkbox" id="place-an"name="continents[]" value="Antartica">
        <label for="place-an"> Antartica</label><br><br>';

        

        echo ' <button type="submit">Submit</button>';
        echo "</form>";
    ?>
</body>
</html>