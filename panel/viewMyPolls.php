<?php
	require 'dashboard_header.php';
  	$db = new PDO('sqlite:../db/polls.db');

	$dbPrepared = $db->prepare('SELECT COUNT(*) FROM Poll WHERE IDuser = ?');
	$dbPrepared->execute(array($_SESSION['ID']));
	$pollNum = $dbPrepared->fetchAll();

	$limit_per_page = 10;
	$number_of_pages = ceil( $pollNum[0][0] / $limit_per_page);

	if (isset($_GET['page'])) {
		$page = $_GET['page'];
		$indice = $page*$limit_per_page;
	}
	else {
		$page = 0;
		$indice = 1;
	}

	$offset = $page*$limit_per_page + $limit_per_page;

	$dbPrepared = $db->prepare('SELECT * FROM Poll WHERE IDuser == ? LIMIT ?,?');
	$dbPrepared->execute(array($_SESSION['ID'],$page*$limit_per_page,$offset));
	$item = $dbPrepared->fetchAll();


?>

	<div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
		<table class="table table-hover">
		  <thead>
		  	<tr>
		  	<th>Index</th>
		  	<th>Title</th>
		  	<th>Votes</th>
		  	<th>Vote</th>
		  	<th>Edit</th>
		  	</tr>
		  </thead>
		  <tbody>

	  		<?php foreach ($item as $row) { ?>
	  			<tr>
	  			<td><?= $indice ; ?></td>
	  			<td><?= $row['Title'] ?></td>
	  			<td><?= $row['Votes'] ?></td>
	  			<td>
					<form action="viewPoll.php" method="GET">
	  					<input type="hidden" name="id" value="<?= sha1($row['ID']) ?>"  >
	  					<button type="submit" class="btn btn-default btn-sm" aria-label="Left Align">
  							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						</button>
					</form>
				</td>
				<td>
					<form action="editPoll.php" method="GET">
	  					<input type="hidden" name="id" value="<?= sha1($row['ID']) ?>" >
	  					<button type="submit" class="btn btn-default btn-sm" aria-label="Left Align">
  							<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
						</button>
					</form>
				</td>
	  			</tr>
	  		<?php  $indice++;} ?>
		  </tbody>
		</table>
		<nav>
	  		<ul class="pagination pagination-sm">
			    <li><a class='pagbuttons' id="<?= 'retrocesso-' . $page .'-'. $number_of_pages ?>" href="#"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
			    <?php for ($i=0; $i < $number_of_pages; $i++) { ?>
			    	<?php if( !isset($_GET['page']) && $i==0) { ?>
			    			<li class="active"><a class="myPolls" id="<?= $i ?>" href="#"><?= $i ?></a></li>
			    	<?php } else {?>
			    	<?php if( isset($_GET['page']) && $i == $_GET['page']) { ?>
						<li class="active"><a class="myPolls" id="<?= $i ?>" href="#"><?= $i ?></a></li>
			    	<?php } else { ?>
						<li><a class="myPolls" id="<?= $i ?>" href="#"><?= $i ?></a></li>
			    	<?php } ?>
					<?php } ?>
				<?php } ?>
				<li><a class='pagbuttons' id="<?= 'adiantamento-' . $page .'-'. $number_of_pages ?>" href="#"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
	  		</ul>
		</nav>
	</div>
	
<?php require 'dashboard_footer.php'; ?>
