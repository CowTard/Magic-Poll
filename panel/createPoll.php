<?php require 'dashboard_header.php'; ?>

<div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
		<div class="panel panel-default ">
			<div class="panel-heading">
				<h3 class="panel-title text-center">Creating new poll</h3>
			</div>
		  
		  <div class="panel-body">
		  		
			<div id="pollBox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
				<?php if( isset($_SESSION['errorImage'])) {
					echo '<div id="error" class="alert alert-danger" role="alert"> ' . $_SESSION['errorImage'] . '</div>'; 
					unset($_SESSION['errorImage']);
					}
				?>
				<form class="form-horizontal" role="form" action="insertPoll.php" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label class="sr-only col-sm-2 control-label" for="Title">Title: </label>
						<input type="text" class="form-control" name="title" id="title" placeholder="Title" required />
					</div>
					<div class="form-group">
						<label class="sr-only col-sm-2 control-label" for="Option1">Option 1: </label>
						<input type="text" class="form-control" name="Option1" id="Option1" placeholder="Option 1" required />
					</div>
					<div class="form-group">
						<label class="sr-only col-sm-2 control-label" for="Option2">Option 2: </label>
						<input type="text" class="form-control" name="Option2" id="Option2" placeholder="Option 2" required />
					</div>
					<div id="inputImage" class="form-group">
						<label class="sr-only col-sm-2 control-label" for="image">Image: </label>
						<input type="file" name="image" class="form-control" />
					</div>
					<div class="checkbox">
						<label class="sr-only col-sm-2 control-label" for="private"></label>
					    <input type="checkbox" id="private" name="private" value="private" />Private
					 </div>
					<div id="creatingPollButtons" class="center-block pull-right">
						<button type="submit" class="btn btn-primary btn-sm btn-success">Submit</button>
						<button id="NewOption" type="button" class="btn btn-primary btn-sm btn-danger">New option</button>
					</div>
				</form>
			</div>
		</div>
		<div class="panel-footer"><h6>As a side note, if you really want to make your poll exclusive, why not make it private?</h6></div>
	</div>
	</div>

<?php require 'dashboard_footer.php'; ?>
