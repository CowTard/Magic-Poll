<?php
	require 'generalFunctions.php';

	session_start();

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$title = security($_POST["title"]);

		// GENERATE THE FILENAME IN ORDER TO STORE IT IN DATABASE AND SAVE HIM IN A FOLDER CALLED 'UPLOADEDIMAGES'
		
		$sha1randomNameForImage = '-1';
		if ($_FILES['image']['size'] != 0 && $_FILES['image']['error'] == 0) {
			$sha1randomNameForImage = '';
			$name = $_FILES["image"]["name"];
			$extension = end((explode(".", $name))); # extra () to prevent notice
			$characters = "0123456789abcdefghijklmnopqrstuvwxyz";
	    	for ($p = 0; $p < 30; $p++)
	        	$sha1randomNameForImage .= $characters[mt_rand(0, strlen($characters) - 1)];
	    	$sha1randomNameForImage = sha1($sha1randomNameForImage) . '.' . $extension;

	    	$uploads_dir = '../uploadedImages/';
	    	if (move_uploaded_file($_FILES['image']['tmp_name'], $uploads_dir . $sha1randomNameForImage))
			    echo '';
			else
			    echo '';
		}

		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('INSERT INTO Poll(IDuser,Title,Votes,ImageName) values(?,?,?,?)');
		$dbPrepared->execute(array($_SESSION["ID"],$title,0,$sha1randomNameForImage));
		$last_id = intval($db->lastInsertId());
		$dbPrepared->fetchAll();

		$dbPrepared = $db->prepare('UPDATE Poll SET EncodedID = ? WHERE ID = ? ');
		$dbPrepared->execute(array(sha1($last_id),$last_id));
		$dbPrepared->fetch();

		/*
		 Inserting options in database 
		*/

		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('INSERT INTO Options(IDPoll,OptionText) values(?,?)');

		$tamanhoPost = count($_POST);
		$tamanhoPost = $tamanhoPost - 1;

		$i = 1;
		while($i <= $tamanhoPost){
			$id = "Option" . $i;
			$dbPrepared->execute(array($last_id,security($_POST[$id])));
			$dbPrepared->fetchAll();
			$i = $i + 1;
		}
		header("Location: viewpoll.php?id=" . sha1($last_id));

	}
	else {
		header("Location: ..");
	}
?>
