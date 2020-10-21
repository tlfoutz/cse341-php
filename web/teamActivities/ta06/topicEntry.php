<?php
/**********************************************************
* File: topicEntry.php
* Author: Br. Burton
* 
* Description: This is the PHP file that the user starts with.
*   It has a form to enter a new scripture and topic.
*   It posts to the insertTopic.php page.
***********************************************************/

// The DB connection logic is in another file so it can be included
// in each of our different PHP files.
require("dbConnect.php");
$db = get_db();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Topic Entry</title>
</head>

<body>
<div>

<h1>Enter New Scriptures and Topics</h1>

<form id="mainForm" action="insertTopic.php" method="POST">

	<input type="text" id="txtBook" name="txtBook"></input>
	<label for="txtBooK">Book</label>
	<br /><br />

	<input type="text" id="txtChapter" name="txtChapter"></input>
	<label for="txtChapter">Chapter</label>
	<br /><br />

	<input type="text" id="txtVerse" name="txtVerse"></input>
	<label for="txtVerse">Verse</label>
	<br /><br />

	<label for="txtContent">Content:</label><br />
	<textarea id="txtContent" name="txtContent" rows="4" cols="50"></textarea>
	<br /><br />

	<label>Topics:</label><br />

<?php
// This section will now generate the available check boxes for topics
// based on what is in the database

// As before, it would be better to break this out into a separate function
// in a separate file, that handled the DB interaction, and returned
// a list of topics. But to keep things as clear as possible we can
// also query and loop through the results, right here.

try
{
	// Notice that we do not use "SELECT *" here. It is best practice
	// to only bring back the fields that you need.

	// prepare the statement
	$statement = $db->prepare('SELECT id, name FROM topics');
	$statement->execute();
	$counter = 1;
	// Go through each result
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
		$counter++;
		$id = $row['id'];
		$name = $row['name'];

		// Notice that we want the value of the checkbox to be the id of the label
		echo "<input type='checkbox' name='chkTopics[]' id='chkTopics$id' value='$id'>";

		// Also, so they can click on the label, and have it select the checkbox,
		// we need to use a label tag, and have it point to the id of the input element.
		// The trick here is that we need a unique id for each one. In this case,
		// we use "chkTopics" followed by the id, so that it becomes something like
		// "chkTopics1" and "chkTopics2", etc.
		echo "<label for='chkTopics$id'>$name</label><br />";

		// put a newline out there just to make our "view source" experience better
		echo "\n";
	}
	echo "<input type='checkbox' name='chkTopics[]' id='chkTopics$counter' value='$counter'>";
	echo "<input type='text' name='topic_name'><br>";
	echo "\n";


}
catch (PDOException $ex)
{
	// Please be aware that you don't want to output the Exception message in
	// a production environment
	echo "Error connecting to DB. Details: $ex";
	die();
}

?>

	<br />

	<input type="submit" value="Add to Database" />

</form>

</div>
<div>
<h1>Scripture and Topic List</h1>

<?php

try
{
	// For this example, we are going to make a call to the DB to get the scriptures
	// and then for each one, make a separate call to get its topics.
	// This could be done with a single query (and then more processing of the resultset
	// afterward) as follows:

	//	$statement = $db->prepare('SELECT book, chapter, verse, content, t.name FROM scripture s'
	//	. ' INNER JOIN scripture_topic st ON s.id = st.scriptureId'
	//	. ' INNER JOIN topic t ON st.topicId = t.id');


	// prepare the statement
	$statement = $db->prepare('SELECT id, book, chapter, verse, content FROM scriptures');
	$statement->execute();
	// Go through each result
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
		echo '<p>';
		echo '<strong>' . $row['book'] . ' ' . $row['chapter'] . ':';
		echo $row['verse'] . '</strong>' . ' - ' . $row['content'];
		echo '<br />';
		echo 'Topics: ';

		// get the topics now for this scripture
		$stmtTopics = $db->prepare('SELECT name FROM topics t'
			. ' INNER JOIN scriptures_topics st ON st.topicId = t.id'
			. ' WHERE st.scriptureId = :scriptureId');

		$stmtTopics->bindValue(':scriptureId', $row['id']);
		$stmtTopics->execute();

		// Go through each topic in the result
		while ($topicRow = $stmtTopics->fetch(PDO::FETCH_ASSOC))
		{
			echo $topicRow['name'] . ' ';
		}

		echo '</p>';
	}


}
catch (PDOException $ex)
{
	echo "Error with DB. Details: $ex";
	die();
}

?>
</div>
</body>
</html>