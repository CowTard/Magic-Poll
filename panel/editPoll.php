<?php
	require 'dashboard_header.php';
  	$db = new PDO('sqlite:../db/polls.db');
	$dbPrepared = $db->prepare('SELECT * FROM Poll WHERE IDuser = ? AND EncodedID = ?');
	$dbPrepared->execute(array($_SESSION['ID'],$_GET['id']));
	$item = $dbPrepared->fetch();

	$realID = $item['ID'];
	$title = $item['Title'];
	$closed = $item['Closed'];

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
			<?php if($closed == 1) { ?>
					<div class="alert alert-warning" role="alert"> We warned you and now you shall respect my authority! However if you really want .. send us a message or create a new one.</div>
					<button id="goBack" type="button" ctype="button" class="btn btn-info btn-sm center-block inlineButtons" aria-label="Left Align">
							<span class="glyphicon glyphicon-backward" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-backward" aria-hidden="true"></span>
					</button>
					<button id="removePoll" value="<?= $_GET['id'] ?>" type="button" class="btn btn-default btn-sm center-block inlineButtons" aria-label="Left Align">
							<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						</button>
				<?php } else { ?>
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
						<button id="closePoll" value="<?= $_GET['id'] ?>" type="button" class="btn btn-primary btn-sm btn-warning" aria-label="Left Align">
							<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
						</button>
						<button id="removePoll" value="<?= $_GET['id'] ?>" type="button" class="btn btn-default btn-sm" aria-label="Left Align">
							<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						</button>
					</div>
				</form>
				<?php } ?>
			</div>

			<div class="panel-footer"> <?php if(!$closed) { ?> <h6>Note: We can't allow you to add more options. That would be unfair.</h6> <?php } else { ?> <h6> The void is cold and dangerous. You shouldn't be here! For you safety, click the link above. </h6><?php } ?></div>
		</div>
	</div>
	
<?php require 'dashboard_footer.php'; ?>
