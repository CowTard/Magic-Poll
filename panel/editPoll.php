<?php
	require 'dashboard_header.php';
  	$db = new PDO('sqlite:../db/polls.db');
	$dbPrepared = $db->prepare('SELECT * FROM Poll WHERE IDuser = ? AND EncodedID = ?');
	$dbPrepared->execute(array($_SESSION['ID'],$_GET['id']));
	$item = $dbPrepared->fetch();

	$realID = $item['ID'];
	$title = $item['Title'];

	$dbPrepared = $db->prepare('SELECT * FROM Options WHERE IDPoll = ?');
	$dbPrepared->execute(array($realID));
	$item = $dbPrepared->fetchAll();

	$option = 1;
?>

	<div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title text-center">Editing: '<?= $title; ?>'</h3>
			</div>
		  
			<div class="panel-body">
				<form method="POST" action="saveEditing.php">
					<div class="form-group">
						<label for="title">Title : </label>
						<input type="hidden" name="idPoll" value="<?= $realID ?>">
						<input type="text" class="form-control" id="title" name ="title" value="<?= $title ?>" required>
					</div>
					
					<?php foreach ($item as $row) { ?>
						<div class="form-group">
							<label for="<?= $row['ID'] ?>">Option <?= $option ?></label>
							<input type="text" class="form-control" id="title" name ="<?= $row['ID'] ?>" value="<?= $row['OptionText'] ?>" required>
						</div>
					<?php $option++ ;} ?>
	
					<div class="center-block pull-right">
						<button id="vote" type="submit" class="btn btn-primary btn-sm btn-success">Save</button>
						<button id="resetButton" type="button" class="btn btn-primary btn-sm btn-danger">Reset</button>
						<button id="removePoll" value="<?= $_GET['id'] ?>" type="button" class="btn btn-default btn-sm" aria-label="Left Align">
							<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						</button>
					</div>
				</form>
			</div>

			<div class="panel-footer">Note: We can't allow you to add more options. That would be unfair.</div>
		</div>
	</div>
	
<?php require 'dashboard_footer.php'; ?>
