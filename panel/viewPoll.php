<?php
	session_start();
	require 'dashboard_header.php';
  	$db = new PDO('sqlite:../db/polls.db');
	$dbPrepared = $db->prepare('SELECT * FROM Poll WHERE EncodedID = ?');
	$dbPrepared->execute(array($_GET['id']));
	$item = $dbPrepared->fetchAll();
?>





<?php
	require 'dashboard_footer.php';
?>