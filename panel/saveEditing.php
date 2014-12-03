<?php
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

			$dbPrepared = $db->prepare('SELECT * FROM Votes where IDPoll = ?'); 
			$dbPrepared->execute(array($_POST['idPoll']));
			$item = $dbPrepared->fetchAll();

			$ID_arrays = array();
			foreach ($item as $row) {
				$ID_arrays[] = $row['IDUser'];
			}

		$message = 'The poll "' . $_POST['title'] . '" was changed. ';
		$dbPrepared = $db->prepare('INSERT INTO Notifications(IDPoll,IDUser,Message) values(?,?,?)');
		foreach ($ID_arrays as $arrayOfuserID) {
			$dbPrepared->execute(array($_POST['idPoll'],$arrayOfuserID,$message));
			$dbPrepared->fetch();
		}
	
		header('Location: viewMyPolls.php');
	}
	else header('Location: ..');
?>
