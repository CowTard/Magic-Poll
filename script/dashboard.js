window.numberNewOption = 3;

function search() {
    var query= $('input#search').val();
    $('b#search-string').html(query);
    if(query !== ''){
        $.ajax({
            type: "POST",
            url: "retrieveData.php",
            data: { query: query },
            cache: false,
            success: function(html){
                $("ul#results").html(html);
            }
        });
    }return false;
}

$(document).ready( function() {

	$('div.icon').click(function(){
    	$('input#search').focus();
	});

	$("input#search").on("keyup", function(e) {
    // Set Timeout
	    clearTimeout($.data(this, 'timer'));

	    // Set Search String
	    var search_string = $(this).val();

	    // Do Search
	    if (search_string == '') {
	        $("ul#results").fadeOut();
	        $('h4#results-text').fadeOut();
	    }else{
	        $("ul#results").fadeIn();
	        $('h4#results-text').fadeIn();
	        $(this).data('timer', setTimeout(search, 50));
	    };
	});

	$( "#NewOption" ).click(function() {
		var line1 = '<div class="form-group"> <label class="sr-only col-sm-2 control-label" for="Option ' + numberNewOption + ' "> Option ' + numberNewOption + ' : </label>';
		var line2 = '<input type="text" class="form-control" name="Option' + numberNewOption + '" id="Option' + numberNewOption + '" placeholder="Option ' + numberNewOption + '" required>';
		var finalLine = line1 + line2;
		$(finalLine).insertBefore('#inputImage');
		numberNewOption += 1;
	});

	$( "#resetButton" ).click(function() {
		$('input:radio').removeAttr('checked');
	});

	$( "#showHideImage" ).click(function() {
		if ($(this).text() == 'Hide Image'){
			$(this).text('Show Image');
			$('#imagemParaVotacao').fadeOut(2000);
		}
		else {
			$(this).text('Hide Image');
			$('#imagemParaVotacao').hide().fadeIn(2000);
		}
	});

	$('.pages').click( function(event) {
		event.preventDefault();
		var id = $(this).attr('id');
		var link = 'search.php?page=' + id;
		$(location).attr('href',link);
	});

	$('#removePoll').click(function() {
		swal({   
    	title: "Are you sure?",
    	text: "You will lose all data related to this poll!",   
    	type: "warning",   
    	showCancelButton: true,   
    	confirmButtonColor: "#DD6B55",   
    	confirmButtonText: "Yes, delete it!",   
    	closeOnConfirm: false }, 
    	function(){
    		$.ajax({
    			url: 'removePoll.php',
    			type: "get",
    			data: 'id=' + $('#removePoll').val(),
    			success:function(data){
    				swal("Deleted!", "Your imaginary file has been deleted.", "success");
    				$(location).attr('href','viewAllPoll.php');
      			},
      			error:function(data){
	    			swal("Oops...", "Something went wrong :(", "error");
      			}
    		});
    	});
	});
});
