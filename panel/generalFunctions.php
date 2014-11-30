<?php
	function security($variavel){
		$variavel = trim($variavel);
		$variavel = stripslashes($variavel);
		$variavel = htmlspecialchars($variavel);

		return $variavel;
	}

	function getName($id){
		$db = new PDO('sqlite:../db/users.db');
		$dbPrepared = $db->prepare('SELECT Nickname FROM Users WHERE ID == ?');
		$dbPrepared->execute(array($id));
		$pollNum = $dbPrepared->fetchAll();
		return $pollNum[0][0];
	}
?>
