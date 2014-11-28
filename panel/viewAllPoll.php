<?php
	session_start();
	require 'dashboard_header.php';
  	$db = new PDO('sqlite:../db/polls.db');
	$dbPrepared = $db->prepare('SELECT * FROM Poll WHERE IDuser = ?');
	$dbPrepared->execute(array($_SESSION['ID']));
	$item = $dbPrepared->fetchAll();
?>
	<div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
		<table class="table table-hover">
		  <thead>
		  	<tr>
		  	<th>ID</th>
		  	<th>Title</th>
		  	<th>Votes</th>
		  	<th>Voting</th>
		  	<th>Editing</th>
		  	</tr>
		  </thead>
		  <tbody>

	  		<?php foreach($item as $row) { ?>
	  			<tr>
	  			<td><?= $row['ID'] ?></td>
	  			<td><?= $row['Title'] ?></td>
	  			<td><?= $row['Votes'] ?></td>
	  			<td><form action="viewPoll.php" method="GET">
	  					<input type="hidden" name="id" value=<?= '"'.sha1($row['ID']) . '"'?>  >
	  					<button type="submit" class="btn btn-default btn-sm" aria-label="Left Align">
  							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						</button>
					</form>
				</td>
				<td><form action="editPoll.php" method="GET">
	  					<input type="hidden" name="id" value=<?= '"'.sha1($row['ID']) . '"'?> >
	  					<button type="submit" class="btn btn-default btn-sm" aria-label="Left Align">
  							<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
						</button>
					</form>
				</td>
	  			</tr>
	  		<?php } ?>
		  </tbody>
		</table>
	</div>
<?php require 'dashboard_footer.php'; ?>
