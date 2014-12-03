<?php
	require 'dashboard_header.php';
  	$db = new PDO('sqlite:../db/polls.db');
	$dbPrepared = $db->prepare('SELECT * FROM Poll WHERE EncodedID = ?');
	$dbPrepared->execute(array($_GET['id']));
	$poll = $dbPrepared->fetch();
	$indice = $poll['ID'];
	$imageID = $poll['ImageName'];
	$creatorID = $poll['IDuser'];

	$dbPrepared = $db->prepare('SELECT * FROM Options WHERE IDPoll = ?');
	$dbPrepared->execute(array($indice));
	$options = $dbPrepared->fetchAll();
	$numberOfOption = 0;

	/*
		Verificar se o utilizador já votou nesta votação.
	*/
	$dbPrepared = $db->prepare('SELECT * FROM Votes WHERE IDPoll = ? AND IDUser = ?');
	$dbPrepared->execute(array($indice, $_SESSION['ID']));
	$votos = $dbPrepared->fetch();
	!empty($votos) ? $votacao = 'disabled' : $votacao = '';
	
	$canSeeResults = $creatorID == $_SESSION['ID'] || !empty($votos);
?>

	<div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
		<div class="panel panel-default ">
			<div class="panel-heading">
				<h3 class="panel-title text-center"><?= $poll['Title']; ?></h3>
			</div>
		  
		  	<div class="panel-body">	
		  		<?php if ($imageID != -1) { ?>
		  			<img id="imagemParaVotacao" class="center-block" src="<?= '../uploadedImages/' . $imageID ?>" alt="<?= $poll['Title'] ?>" width="100px" height="100px"/>
		  		<?php } ?>
				
		  		<form method="POST" action="submitAnswer.php">
		  		<input type="hidden" name="id" value= <?= '"' . $indice . '"'?> >
			  	<?php foreach($options as $row) { 
			  			$id = 'radioOption' . $numberOfOption;
						$value = 'option' . $numberOfOption;
						$numberOfOption += 1;
				?>
				    	<div class="radio">
							<label>
						    	<input type="radio" name="radioOption" id="<?= $id ?>" value="<?= $value ?>" <?= $votacao ?>> 
						    	<?= $row['OptionText'] ?>
						  	</label>
						</div>
				<?php } ?>
				<div class="center-block pull-right">
					<button id="vote" type="submit" class="btn btn-primary btn-sm btn-success" <?= $votacao ?>>Vote</button>
					<button id="resetButton" type="button" class="btn btn-primary btn-sm btn-danger" <?= $votacao ?>>Reset</button>
					<?php if ($imageID != -1) { ?>
					<button id="showHideImage" type="button" class="btn btn-default btn-sm" >Hide Image</button>
					<?php } ?>
				</div>
				</form>
		  	</div>
		  	<div class="panel-footer">
			<?php if ($canSeeResults) { ?>
				<div id="piechart" class="center-block" style="width: 900px; height: 200px;"></div>
			<?php } else { ?>
				<h4 class="text-center">You haven't voted yet! You'll have to do that before you can see the poll results.</h4>
			<?php } ?>
			</div>
		</div>
	</div>

<?php require 'dashboard_footer.php'; ?>
