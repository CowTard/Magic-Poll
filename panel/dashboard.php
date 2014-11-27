<?php
	session_start();
	if (!isset($_SESSION["ID"]) && empty($_SESSION["ID"])){
		header("Location: ..");
		die;
	}

	require 'dashboard_header.php';
	
	$pollDb = new PDO('sqlite:../db/polls.db');
	$userDb = new PDO('sqlite:../db/users.db');
	
	$dbPrepared = $pollDb->prepare('SELECT * FROM Poll');
	$dbPrepared->execute();
	$polls = $dbPrepared->fetchAll();
	
	$numPolls = count($polls);
	$numVotes = 0;
	foreach ($polls as $poll)
		$numVotes += $poll['Votes'];
	
	$dbPrepared = $userDb->prepare('SELECT * FROM Users');
	$dbPrepared->execute();
	$numUsers = count($dbPrepared->fetchAll());
?>
<div class="row">
	<div class="col-md-3 col-md-offset-3">
		<h3>Statistics</h3>
		<p><?php echo $numPolls . ' poll'; if ($numPolls != 1) echo 's have'; else echo ' has'; ?> been created.</p>
		<p><?php echo $numVotes . ' vote'; if ($numVotes != 1) echo 's have'; else echo ' has'; ?> been cast.</p>
		<p><?php echo $numUsers . ' user'; if ($numUsers != 1) echo 's have'; else echo ' has'; ?> registered.</p>
	</div>
</div>	
<?php
	require 'dashboard_footer.php';
?>
