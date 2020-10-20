<?php
/**********************************************************
* File: insertTopic.php
* Author: Br. Burton
* 
* Description: Takes input posted from topicEntry.php
*   This file enters a new scripture into the database
*   along with its associated topics.
*
*   This file does NOT do any rendering at all,
*   instead it redirects the user to showTopics.php to see
*   the resulting list.
***********************************************************/

// get the data from the POST
$book = htmlspecialchars($_POST['txtBook']);
$chapter = htmlspecialchars($_POST['txtChapter']);
$verse = htmlspecialchars($_POST['txtVerse']);
$content = htmlspecialchars($_POST['txtContent']);
$topicIds = htmlspecialchars($_POST['chkTopics']);

// For debugging purposes, you might include some echo statements like this
// and then not automatically redirect until you have everything working.

// echo "book=$book\n";
// echo "chapter=$chapter\n";
// echo "verse=$verse\n";
// echo "content=$content\n";

// we could (and should!) put additional checks here to verify that all this data is actually provided


require("dbConnect.php");
$db = get_db();

try
{
	// Add the Scripture

	// We do this by preparing the query with placeholder values
	$query = 'INSERT INTO scriptures(book, chapter, verse, content) VALUES(:book, :chapter, :verse, :content)';
	$statement = $db->prepare($query);

	// Now we bind the values to the placeholders. This does some nice things
	// including sanitizing the input with regard to sql commands.
	$statement->bindValue(':book', $book);
	$statement->bindValue(':chapter', $chapter);
	$statement->bindValue(':verse', $verse);
	$statement->bindValue(':content', $content);

	$statement->execute();

	// get the new id
	$scriptureId = $db->lastInsertId("scriptures_id_seq");

	// Now go through each topic id in the list from the user's checkboxes
	foreach ($topicIds as $topicId)
	{
		echo "ScriptureId: $scriptureId, topicId: $topicId";

		// Again, first prepare the statement
		$statement = $db->prepare('INSERT INTO scriptures_topics(scriptureId, topicId) VALUES(:scriptureId, :topicId)');

		// Then, bind the values
		$statement->bindValue(':scriptureId', $scriptureId);
		$statement->bindValue(':topicId', $topicId);

		$statement->execute();
	}

	if (isset($_POST['add_topic'])) {
        $topicName = htmlspecialchars($_POST['topic_name']);
        $insertTopic = "INSERT INTO topics (name) VALUES(:name)";
        $stmtTopic = $db->prepare($insertTopic);
        $stmtTopic->bindParam(':name', $topicName, PDO::PARAM_STR);
        $stmtTopic->execute();
        $stmtTopicId = $db->lastInsertId('topics_id_seq');
        $insertScriptureTopic = "INSERT INTO scriptures_topics (scriptureId, topicId) VALUES(:scriptureId, :topicId)";
        $insertScriptureTopic = $db->prepare($insertScriptureTopic);
        $insertScriptureTopic->bindParam(':scriptureId', $scriptureId, PDO::PARAM_INT);
        $insertScriptureTopic->bindParam(':topicId', $stmtTopicId, PDO::PARAM_INT);
		$insertScriptureTopic->execute();
		$scriptureId = $db->lastInsertId("scriptures_id_seq");
	}

}
catch (Exception $ex)
{
	// Please be aware that you don't want to output the Exception message in
	// a production environment
	echo "Error with DB. Details: $ex";
	die();
}

// finally, redirect them to a new page to actually show the topics
header("Location: showTopics.php");

die(); // we always include a die after redirects. In this case, there would be no
       // harm if the user got the rest of the page, because there is nothing else
       // but in general, there could be things after here that we don't want them
       // to see.

?>