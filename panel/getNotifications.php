<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$db = new PDO('sqlite:../db/users.db');
		$dbPrepared = $db->prepare('SELECT * FROM Users where Nickname = ?');
		$dbPrepared->execute(array($_POST['nickname']));
		$result = $dbPrepared->fetch();
		$id = $result['Id'];

		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('SELECT * FROM Notifications where IDUser = ?');
		$dbPrepared->execute(array($id));
		$result = $dbPrepared->fetchAll();
		
		$notificationIndice = 0;
		$html = '';

		foreach ($result as $row) {
			$dbPrepared = $db->prepare('SELECT * FROM Poll where ID = ?');
			$dbPrepared->execute(array($row['IDPoll']));
			$returned = $dbPrepared->fetch();
			$html .= '<li><a href="viewpoll.php?id=' . $returned['EncodedID'] .'&notification=' . $notificationIndice .'">'.$row['Message'].'</a></li>';
			$notificationIndice++;
		}

		if ( $html == ''){
			$html .= '<li><a href="#">There\'s nothing to show, sorry! :(</a></li>';
		}
		echo $html;
	} else echo 'There was an error';
?>
