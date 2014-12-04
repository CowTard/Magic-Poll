<?php
	
	function security($variavel){
		$variavel = trim($variavel);
		$variavel = stripslashes($variavel);
		$variavel = htmlspecialchars($variavel);

		return $variavel;
	}

	// return the nickname of a member who has as id $id
	function getName($id){
		$db = new PDO('sqlite:../db/users.db');
		$dbPrepared = $db->prepare('SELECT * FROM Users WHERE ID = ?');
		$dbPrepared->execute(array($id));
		$pollNum = $dbPrepared->fetch();
		return $pollNum['Nickname'];;
	}

	// return the number of notifications a member have.
	function getNotifications($id){
		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('SELECT COUNT(*) FROM Notifications WHERE IDUser = ?');
		$dbPrepared->execute(array($id));
		$notificNumber = $dbPrepared->fetch();
		return $notificNumber[0][0];
	}

	// return the encodedid of the poll with $idPoll as ID.
	function getPollEncodedID($idPoll){
		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('SELECT EncodedID FROM Poll WHERE ID = ?');
		$dbPrepared->execute(array($idPoll));
		$encID = $dbPrepared->fetch();
		return $encID[0][0];
	}

	// return the image of the poll with $idPoll as ID.
	function getImageName($idPoll){
		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('SELECT * FROM Poll WHERE ID = ?');
		$dbPrepared->execute(array($idPoll));
		$ImageID = $dbPrepared->fetch();
		return $ImageID['ImageName'];
	}

	// return the title of the poll with $idPoll as ID.
	function getTitle($idPoll){
		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('SELECT * FROM Poll WHERE ID = ?');
		$dbPrepared->execute(array($idPoll));
		$title = $dbPrepared->fetch();
		return $title['Title'];
	}

	//return the number of votes of the poll with $idPoll as ID.
	function getVotes($idPoll){
		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('SELECT * FROM Poll WHERE ID = ?');
		$dbPrepared->execute(array($idPoll));
		$title = $dbPrepared->fetch();
		return $title['Votes'];
	}

	// return the id of the creator of the poll.
	function getCreator($idPoll){
		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('SELECT * FROM Poll WHERE ID = ?');
		$dbPrepared->execute(array($idPoll));
		$result = $dbPrepared->fetch();
		$iduser = $result['IDuser'];
		return getName($iduser);
	}

	// return either the poll is closed or open.
	function getClosed($idPoll){
		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('SELECT * FROM Poll WHERE ID = ?');
		$dbPrepared->execute(array($idPoll));
		$result = $dbPrepared->fetch();
		return $result['Closed'];
	}

	// return either the poll is private or not.
	function getPrivate($idPoll){
		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('SELECT * FROM Poll WHERE ID = ?');
		$dbPrepared->execute(array($idPoll));
		$result = $dbPrepared->fetch();
		return $result['Private'];
	}

	// return the id of the poll. For that, the function receive an encodedid as parameter.
	function getPollIDbyEncodedID($idPoll){
		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('SELECT * FROM Poll WHERE EncodedID = ?');
		$dbPrepared->execute(array($idPoll));
		$result = $dbPrepared->fetch();
		return $result['ID'];
	}

	// function that inserts notifications on users.

	function notificationsToUsers($idPoll,$message){
		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('SELECT * FROM Votes where IDPoll = ?'); 
		$dbPrepared->execute(array($idPoll));
		$item = $dbPrepared->fetchAll();

		$ID_arrays = array();
		foreach ($item as $row) {
			$ID_arrays[] = $row['IDUser'];
		}

		$dbPrepared = $db->prepare('INSERT INTO Notifications(IDPoll,IDUser,Message) values(?,?,?)');
		foreach ($ID_arrays as $arrayOfuserID) {
			$dbPrepared->execute(array($idPoll,$arrayOfuserID,$message));
			$dbPrepared->fetch();
		}
	}

?>
