<?php
	require 'generalFunctions.php';
	require 'dashboard_header.php';
  	$db = new PDO('sqlite:../db/polls.db');
	$dbPrepared = $db->prepare('SELECT COUNT(*) FROM Poll WHERE IDuser != ?');
	$dbPrepared->execute(array($_SESSION['ID']));
	$pollNum = $dbPrepared->fetchAll();

	$limit_per_page = 10;
	$number_of_pages = ceil( $pollNum[0][0] / $limit_per_page);

	if (isset($_GET['page'])) {
		$page = $_GET['page'];
		$indice = $page*$limit_per_page + 1;
	}
	else {
		$page = 0;
		$indice = 1;
	}

	$dbPrepared = $db->prepare('SELECT * FROM Poll WHERE IDuser != ? LIMIT ?');
	$dbPrepared->execute(array($_SESSION['ID'],$limit_per_page));
	$item = $dbPrepared->fetchAll();

?>

<div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
		<table class="table table-hover">
		  <thead>
		  	<tr>
		  	<th>Index</th>
		  	<th>Creator</th>
		  	<th>Image</th>
		  	<th>Title</th>
			<th>Votes</th>
		  	<th>Vote</th>
		  	</tr>
		  </thead>
		  <tbody>

	  		<?php foreach($item as $row) {
				$dbPrepared = $db->prepare('SELECT * FROM Votes WHERE IDPoll = ? AND IDUser = ? LIMIT 1');
				$dbPrepared->execute(array($row['ID'], $_SESSION['ID']));
				$userVote = $dbPrepared->fetch();
				$alreadyVoted = !empty($userVote);
			?>
	  			<tr>
	  			<td><?= $indice ?></td>
	  			<td><?= getName($row['IDuser']) ?></td>
	  			<?php if ( $row['ImageName'] == '-1' ){ ?>
	  				<td><img class="img-thumbnail pollimage" src="../uploadedImages/default.png" alt="default" width="24" height="24" />
	  			<?php } else { ?>
	  				<td><img class="img-thumbnail pollimage" src="<?= '../uploadedImages/' . $row['ImageName'] ?>" alt="<?= $poll['Title'] ?>" width="24" height="24"/>
	  			<?php } ?>
	  			<td><?= $row['Title'] ?></td>
				<td><?= $row['Votes'] ?></td>
	  			<td><form action="viewPoll.php" method="GET">
	  					<input type="hidden" name="id" value="<?= sha1($row['ID']) ?>">
	  					<button type="submit" class="btn btn-default btn-sm" aria-label="Left Align" <?php if ($alreadyVoted) { ?> data-toggle="tooltip" data-placement="top" title="You have already voted in this poll." <?php } ?> >
  							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						</button>
					</form>
				</td>
	  			</tr>
	  		<?php $indice++;} ?>
		  </tbody>
		</table>
		<nav>
	  		<ul class="pagination pagination-sm">
			    <li><a class='searcbuttons' id="<?= 'retrocesso-' . $page .'-'. $number_of_pages ?>" href="#"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
			    <?php for ($i=0; $i < $number_of_pages; $i++) { ?>
			    	<?php if( !isset($_GET['page']) && $i==0) { ?>
			    			<li class="active"><a class="pages" id="<?= $i ?>" href="#"><?= $i ?></a></li>
			    	<?php } else {?>
			    	<?php if( isset($_GET['page']) && $i == $_GET['page']) { ?>
						<li class="active"><a class="pages" id="<?= $i ?>" href="#"><?= $i ?></a></li>
			    	<?php } else { ?>
						<li><a class="pages" id="<?= $i ?>" href="#"><?= $i ?></a></li>
			    	<?php } ?>
					<?php } ?>
				<?php } ?>
				<li><a class='searcbuttons' id="<?= 'adiantamento-' . $page .'-'. $number_of_pages ?>" href="#"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
	  		</ul>
		</nav>
	</div>

	<script type="text/javascript">
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});
	</script>

<?php require 'dashboard_footer.php'; ?>
