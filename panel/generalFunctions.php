<?php
	function security($variavel){
		$variavel = trim($variavel);
		$variavel = stripslashes($variavel);
		$variavel = htmlspecialchars($variavel);

		return $variavel;
	}

	function getName($id){
		$db = new PDO('sqlite:../db/users.db');
		$dbPrepared = $db->prepare('SELECT Nickname FROM Users WHERE ID == ? LIMIT 1');
		$dbPrepared->execute(array($id));
		$pollNum = $dbPrepared->fetchAll();
		return $pollNum[0][0];
	}

	function getNotifications($id){
		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('SELECT COUNT(*) FROM Notifications WHERE IDUser = ?');
		$dbPrepared->execute(array($id));
		$notificNumber = $dbPrepared->fetch();
		return $notificNumber[0][0];
	}
?>
