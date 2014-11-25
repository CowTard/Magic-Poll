window.numberNewOption = 3;

$(document).ready( function() {
	
	$( "#NewOption" ).click(function() {
		var line1 = '<div class="form-group"> <label class="sr-only col-sm-2 control-label" for="Option ' + numberNewOption + ' "> Option ' + numberNewOption + ' : </label>';
		var line2 = '<input type="text" class="form-control" name="Option' + numberNewOption + '" id="Option' + numberNewOption + '" placeholder="Option ' + numberNewOption + '" required>';
		var finalLine = line1 + line2;
		$(finalLine).insertBefore('#creatingPollButtons');
		numberNewOption += 1;
	});
});
