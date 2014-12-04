<?php
	require 'generalFunctions.php';
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('UPDATE Poll SET Title = ? WHERE ID = ? ');
		$dbPrepared->execute(array($_POST['title'],$_POST['idPoll']));
		$dbPrepared->fetch();
	
		foreach($_POST as $key => $value) {
			$dbPrepared = $db->prepare('UPDATE Options SET OptionText = ? WHERE ID = ? ');
			$dbPrepared->execute(array($value,$key));
			$dbPrepared->fetch();
		}

		/*
			Create notifications
		*/

			// Search for the members that vote in this poll
		$message = '"' . $_POST['title'] . '" was changed.'; 
		notificationsToUsers($_POST['idPoll'],$message);
	
		header('Location: viewMyPolls.php');
	}
	else header('Location: ..');
?>
