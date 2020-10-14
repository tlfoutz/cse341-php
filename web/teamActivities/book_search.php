<!DOCTYPE html>
<html lang="en">

   <head>
      <title>Scripture Finder</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script type="text/javascript" src="homeJS.js"></script>
      <!-- jQuery Library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="team_prac_w05CSS.css">
   </head>

   <body>
      <div id="banner" class="container-fluid">
         <div id="bannerRow" class="row">
            <div id="bannerColumn" class="col-lg-12">
               <div class="hero-image">
                  <div class="hero-text"><h1>SCRIPTURE RESOURCES</h1></div>
               </div>
            </div>
         </div>
      </div>
      <div id="intro" class="container-fluid">
         <div id="introRow" class="row">
            <div id="introCol" class="col-lg-12">
               <?php
                  try
                  {
                    $dbUrl = getenv('DATABASE_URL');
                  
                    $dbOpts = parse_url($dbUrl);
                  
                    $dbHost = $dbOpts["host"];
                    $dbPort = $dbOpts["port"];
                    $dbUser = $dbOpts["user"];
                    $dbPassword = $dbOpts["pass"];
                    $dbName = ltrim($dbOpts["path"],'/');
                  
                    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
                  
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  }
                  catch (PDOException $ex)
                  {
                    echo 'Error!: ' . $ex->getMessage();
                    die();
                  }

                  // get book variable to search for
                  $book = $_POST['book'];

                  $scriptures = $db->prepare("SELECT id, book, chapter, verse, content FROM scriptures WHERE LOWER(book) = LOWER(:book)");
                  $scriptures->execute(array(':book' => $book));

                  while ($sRow = $scriptures->fetch(PDO::FETCH_ASSOC))
                  {
                     $book = $sRow["book"];
                     $chapter = $sRow["chapter"];
                     $verse = $sRow["verse"];
                     $content = $sRow["content"];
                     $id = $sRow['id'];

                     echo "<p>$book $chapter:$verse - <a href='scripture_details.php?id=$id'>Content</a></p>";
                  }


                  // $statement = $db->prepare("SELECT book, chapter, verse, content FROM scriptures WHERE LOWER(book) = LOWER(:book)");
                  // $statement->execute(array(':book' => $book));
                  // // $row = $statement->fetchAll(PDO::FETCH_ASSOC);

                  // $str = '';
                  
                  // while ($row = $statement->fetchAll(PDO::FETCH_ASSOC))
                  // {
                  //    $str .= "<b> $row[book] $row[chapter] : $row[verse] </b> - $row[content] <br><br>";
                  // }

                  // echo $str;

                  // foreach ($statement->execute() as $row)
                  // {
                  //    echo '<b>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</b>' . ' ' . '-' . ' ' . '"' . $row['content'] . '"' . '<br><br>';
                  // }

                  // foreach ($db->query('SELECT book, chapter, verse, content FROM scriptures') as $row)
                  // {
                  //    echo '<b>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</b>' . ' ' . '-' . ' ' . $row['content'] . '<br';
                  // }
               ?>
            </div>
         </div>
      </div>      
   </body>

</html>