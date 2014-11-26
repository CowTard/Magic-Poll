<?php require 'dashboard_header.php'; ?>

<div id="pollBox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
	<form class="form-horizontal" role="form" action="insertPoll.php" method="POST">
		<div class="form-group">
			<label class="sr-only col-sm-2 control-label" for="Title">Title : </label>
			<input type="text" class="form-control" name="title" id="title" placeholder="Title" required>
		</div>
		<div class="form-group">
			<label class="sr-only col-sm-2 control-label" for="Option1">Option 1 : </label>
			<input type="text" class="form-control" name="Option1" id="Option1" placeholder="Option 1" required>
		</div>
		<div class="form-group">
			<label class="sr-only col-sm-2 control-label" for="Option2">Option 2 : </label>
			<input type="text" class="form-control" name="Option2" id="Option2" placeholder="Option 2" required>
		</div>
		<div id="creatingPollButtons" class="col-md-4 center-block">
			<button type="submit" class="btn btn-default">Submit</button>
			<button id="NewOption" type="button" class="btn btn-default"> New option </button>
		</div>
	</form>
</div>

<?php require 'dashboard_footer.php'; ?>
