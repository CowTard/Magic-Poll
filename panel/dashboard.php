<?php
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
	
	$dbPrepared = $userDb->prepare('SELECT Nickname FROM Users WHERE Id = ? limit 1');
	$dbPrepared->execute(array($_SESSION['ID']));
	$user = $dbPrepared->fetch();
	
	$dbPrepared = $pollDb->prepare('SELECT * FROM Poll WHERE IDuser = ?');
	$dbPrepared->execute(array($_SESSION['ID']));
	$numMyPolls = count($dbPrepared->fetchAll());
	
	$dbPrepared = $pollDb->prepare('SELECT * FROM Votes WHERE IDUser = ?');
	$dbPrepared->execute(array($_SESSION['ID']));
	$numMyVotes = count($dbPrepared->fetchAll());
	
	$numVotesMyPolls = 'UNOWN';
?>

	<div class="panel">
		<div class="row panel-body">
			<div class="col-md-8 col-md-offset-2">
				<h2>Dashboard <span class="glyphicon glyphicon-dashboard"></span><span class="pull-right"><small>Welcome back, <?= $user['Nickname'] ?>!</small></span></h2>
				<p class="text-justify">On <strong>MagicPoll</strong>, you can create beautiful and meaningful polls for when you're indecisive about what course of action to take next. Why not try and see what the other non-existent users will choose for you?</p>
				<p class="text-justify">You can create polls (with an optional image to beautify them) and add as many options as you like. Don't worry, you can always edit its options and illustration later! You can also list and search for both your and other users' polls, which are available for your voting pleasure.</p>
				<p class="text-justify">We hope you have a great time!</p>
				<p class="text-right"><em>&mdash; Your sweet devs ;)</em></p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-md-offset-3">
			<h3>Overall Statistics <span class="glyphicon glyphicon-stats"></span></h3>
			<p><?php echo $numPolls . ' poll'; if ($numPolls != 1) echo 's'; ?> created.</p>
			<p><?php echo $numVotes . ' vote'; if ($numVotes != 1) echo 's'; ?> cast.</p>
			<p><?php echo $numUsers . ' user'; if ($numUsers != 1) echo 's'; ?> registered.</p>
		</div>
		<div class="col-md-3 col-md-offset-1">
			<h3>Personal Statistics <span class="glyphicon glyphicon-user"></span></h3>
			<p><?php echo $numMyPolls . ' poll'; if ($numMyPolls != 1) echo 's'; ?> created by you.</p>
			<p><?php echo $numMyVotes . ' vote'; if ($numMyVotes != 1) echo 's'; ?> cast by you.</p>
			<p><?php echo $numVotesMyPolls . ' vote'; if ($numVotesMyPolls != 1) echo 's'; ?> cast on your polls.</p>
		</div>
	</div>

<?php require 'dashboard_footer.php'; ?>
