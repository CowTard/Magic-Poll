<?php

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$db = new PDO('sqlite:../db/polls.db');
			$dbPrepared = $db->prepare('UPDATE Poll SET Closed = ? WHERE EncodedID = ? ');
			$dbPrepared->execute(array('1',$_POST['secretID']));
			$dbPrepared->fetch();

			// get real id

			$dbPrepared = $db->prepare('SELECT * FROM Poll WHERE EncodedID = ?');
			$dbPrepared->execute(array($_POST['secretID']));
			$ID_temp = $dbPrepared->fetch();
			$ID = $ID_temp['ID'];
			$title = $ID_temp['Title'];

			$message = '"' . $title . '" was closed.';
			
			$dbPrepared = $db->prepare('SELECT * FROM Votes where IDPoll = ?'); 
			$dbPrepared->execute(array($ID));
			$item = $dbPrepared->fetchAll();

			$ID_arrays = array();
			foreach ($item as $row) {
				$ID_arrays[] = $row['IDUser'];
			}


			$dbPrepared = $db->prepare('INSERT INTO Notifications(IDPoll,IDUser,Message) values(?,?,?)');
			foreach ($ID_arrays as $arrayOfuserID) {
				$dbPrepared->execute(array($ID,$arrayOfuserID,$message));
				$dbPrepared->fetch();
			}
			
			echo 'sucess';
		}
?>