<?php

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$db = new PDO('sqlite:../db/polls.db');


		// update votes in specific poll
		$dbPrepared = $db->prepare('SELECT * FROM Poll WHERE ID = ?');
		$dbPrepared->execute(array($_POST['id']));
		$poll = $dbPrepared->fetch();
		$votes = $poll['Votes'];
		$encodedID = $poll['EncodedID'];
		$dbPrepared = $db->prepare('UPDATE Poll SET Votes = ? WHERE ID = ? ');
		$dbPrepared->execute(array($votes+1,$_POST['id']));
		$dbPrepared->fetch();

		// update votes in a specific option
		$dbPrepared = $db->prepare('SELECT * FROM Options WHERE IDPoll = ?');
		$dbPrepared->execute(array($_POST['id']));
		$poll = $dbPrepared->fetchAll();

		// get the number of the chosen option
		$matches = '123456789';
		$opcaoEscolhida = filter_var($_POST['radioOption'], FILTER_SANITIZE_NUMBER_INT);
		
		$contadorDeLinhas = 0;
		foreach ($poll as $row) {
			if ($contadorDeLinhas == $opcaoEscolhida){
				$numberOfVotes = $row['Votes'];
				$optionID = $row['ID'];
				$dbPrepared = $db->prepare('UPDATE Options SET Votes = ? WHERE ID = ? ');
				$dbPrepared->execute(array($numberOfVotes+1,$optionID));
				$dbPrepared->fetch();
				break;
			}
			else {
				$contadorDeLinhas++;
				continue;
			}
		}
		header('Location: ./viewPoll.php?id='. $encodedID . '');
	}
	else {
		header("Location: ..");
	}


?>