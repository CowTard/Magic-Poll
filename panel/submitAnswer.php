<?php
	session_start();
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$db = new PDO('sqlite:../db/polls.db');


		/* ELIMINATING POSSIBLE USER'S ANSWERS */

		$dbPrepared = $db->prepare('SELECT *  FROM Votes WHERE IDPoll = ? AND IDUser = ?');
		$dbPrepared->execute(array($_POST['id'],$_SESSION['ID']));
		$item = $dbPrepared->fetch();
		$option_id_vote = $item['OptionID'];

		if(!empty($item)){
			$dbPrepared = $db->prepare('DELETE FROM Votes WHERE IDPoll = ? AND IDUser = ?');
			$dbPrepared->execute(array($_POST['id'],$_SESSION['ID']));
			$item = $dbPrepared->fetch();
			
				$dbPrepared = $db->prepare('SELECT * FROM Poll WHERE ID = ?');
				$dbPrepared->execute(array($_POST['id']));
				$poll = $dbPrepared->fetch();
				$votes = $poll['Votes'];

				if(!empty($poll)){
					$dbPrepared = $db->prepare('UPDATE Poll SET Votes = ? WHERE ID = ? ');
					$dbPrepared->execute(array($votes-1,$_POST['id']));
					$item = $dbPrepared->fetch();

					$dbPrepared = $db->prepare('SELECT * from Options WHERE IDPoll = ? ');
					$dbPrepared->execute(array($_POST['id']));
					$item = $dbPrepared->fetchAll();

					if(!empty($item)){
						foreach ($item as $row) {
								if($option_id_vote == 0){
									$option_to_update = $row['ID'];
									$numberOfVotes = $row['Votes'];
									$dbPrepared = $db->prepare('UPDATE Options SET Votes = ? WHERE ID = ? ');
									$dbPrepared->execute(array($numberOfVotes-1,$option_to_update));
									$dbPrepared->fetch();
								}
								$option_id_vote--;
							}
						} // ultimo mpty
					}
				}
			
		
		/*
			 Registering the user choice. 
		*/

		$dbPrepared = $db->prepare('INSERT INTO Votes(IDPoll,IDuser) values(?,?)');
		$dbPrepared->execute(array($_POST['id'],$_SESSION['ID']));
		$dbPrepared->fetch();

		/*
			 update votes in specific poll
		*/

		$dbPrepared = $db->prepare('SELECT * FROM Poll WHERE ID = ?');
		$dbPrepared->execute(array($_POST['id']));
		$poll = $dbPrepared->fetch();
		$votes = $poll['Votes'];
		$encodedID = $poll['EncodedID'];
		$dbPrepared = $db->prepare('UPDATE Poll SET Votes = ? WHERE ID = ? ');
		$dbPrepared->execute(array($votes+1,$_POST['id']));
		$dbPrepared->fetch();

		/*
			 update votes in a specific option
		*/

		$dbPrepared = $db->prepare('SELECT * FROM Options WHERE IDPoll = ?');
		$dbPrepared->execute(array($_POST['id']));
		$poll = $dbPrepared->fetchAll();

		/*
			 get the number of the chosen option
		*/
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

				$dbPrepared = $db->prepare('UPDATE Votes SET OptionID = ? WHERE IDPoll = ? AND IDUser = ?');
				$dbPrepared->execute(array($opcaoEscolhida,$_POST['id'],$_SESSION['ID']));
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
