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
	$myPolls = $dbPrepared->fetchAll();
	$numMyPolls = count($myPolls);
	
	$dbPrepared = $pollDb->prepare('SELECT * FROM Votes WHERE IDUser = ?');
	$dbPrepared->execute(array($_SESSION['ID']));
	$numMyVotes = count($dbPrepared->fetchAll());
	
	$numVotesMyPolls = 0;
	foreach ($myPolls as $myPoll) {
		$dbPrepared = $pollDb->prepare('SELECT * FROM Votes WHERE IDPoll = ?');
		$dbPrepared->execute(array($myPoll['ID']));
		$numVotesMyPolls += count($dbPrepared->fetchAll());
	}
?>

		<div class="container-fluid">
			<div class="panel">
				<div class="panel-body">
					<div class="col-md-8 col-md-offset-2">
						<h2>Dashboard <span class="glyphicon glyphicon-dashboard"></span><span class="pull-right"><small>Welcome back, <?= $user['Nickname'] ?>!</small></span></h2>
						<p class="text-justify">On <strong>MagicPoll</strong>, you can create beautiful and meaningful polls for when you're indecisive about what course of action to take next. Why not try and see what the other non-existent users will choose for you?</p>
						<p class="text-justify">You can create polls (with an optional image to beautify them) and add as many options as you like. Don't worry, you can always edit its options and illustration later! You can also list and search for both your and other users' polls, which are available for your voting pleasure.</p>
						<p class="text-justify">We hope you have a great time!</p>
						<p class="text-right"><em>&mdash; Your sweet devs ;)</em></p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-md-offset-3">
				<h3>Global Statistics <span class="glyphicon glyphicon-stats"></span></h3>
				<p><?= $numPolls . ' poll' . ($numPolls != 1 ? 's' : '') ?> created.</p>
				<p><?= $numVotes . ' vote' . ($numVotes != 1 ? 's' : '') ?> cast.</p>
				<p><?= $numUsers . ' user' . ($numUsers != 1 ? 's' : '') ?> registered.</p>
			</div>
			<div class="col-md-3 col-md-offset-1">
				<h3>Personal Statistics <span class="glyphicon glyphicon-user"></span></h3>
				<p><?= $numMyPolls . ' poll' . ($numMyPolls != 1 ? 's' : '') ?> created by you.</p>
				<p><?= $numMyVotes . ' vote' . ($numMyVotes != 1 ? 's' : '') ?> cast by you.</p>
				<p><?= $numVotesMyPolls . ' vote' . ($numVotesMyPolls != 1 ? 's' : '') ?> cast on your polls.</p>
			</div>
		</div>

<?php require 'dashboard_footer.php'; ?>
