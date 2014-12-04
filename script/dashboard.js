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

	$('[data-toggle="tooltip"]').tooltip();

	$('.notification').hover( function(){  
		$(".notification").dropdown();
	});

	$('#contact-form').submit( function(){ 
		$.ajax({
           type: "POST",
           url: "sendEmail.php",
           data: $("#contact-form").serialize(), // serializes the form's elements.
           success: function(data)
           {	
           	    $('#confirmation_of_email_sent').removeAttr('style');
           		$('#confirmation_of_email_sent').html('');
           		$('#confirmation_of_email_sent').html('<div id="sucess" class="alert alert-success" role="alert"> <p class="text-center">Awesome! Your email was sent. We will see it as soon as possible</p></div>');
           		$("#contact-form").trigger("reset");
           		$('#modalform').modal('toggle');
           		$('#confirmation_of_email_sent').fadeOut(5000);
           },
           error: function(data)
           {	
           	    $('#confirmation_of_email_sent').removeAttr('style');
           		$('#confirmation_of_email_sent').html('');
           		$('#confirmation_of_email_sent').html('<div id="error" class="alert alert-danger" role="alert"> Oh no.. It can\' be. We fail again (?) . </div>');
           		$("#contact-form").trigger("reset");
           		$('#modalform').modal('toggle');
           		$('#confirmation_of_email_sent').fadeOut(5000);
           }
         });

    return false; // avoid to execute the actual submit of the form.
	});
	/*
	 SE APENAS CONTIVESSE .CLICK DAVA UM ERRO CONHECIDO DO BOOTSTRAP O QUE OBRIGARIA O UTILIZADOR A CLICAR DUAS VEZES.
	*/

	$('.notification').click(function(){
		var userNickname = $('.nickname').text();
		if (userNickname != ''){
			$.ajax({
				type: "POST",
				url: "getNotifications.php",
				data: { nickname : userNickname},
				cache: false,
				success: function(html){
					$(".notificationBox").html(html);
					$(".notification").dropdown();
				}
			});
		} return false;
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
		var line2 = '<input type="text" class="form-control" name="Option' + numberNewOption + '" id="Option' + numberNewOption + '" placeholder="Option ' + numberNewOption + '">';
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

	$('#goBack').click( function(event) {
		event.preventDefault();
		var link = 'viewMyPolls.php';
		$(location).attr('href',link);
	});

	$('.searcbuttons').click( function(event){
		event.preventDefault();
		var atributo = $(this).attr('id');
		var id = atributo.split('-');
		var objetivo = id[0];
		var pagina = id[1];
		var numeroDePaginas = id[2];

		if ( pagina > 0 && objetivo == 'retrocesso'){
			pagina = parseInt(pagina) - 1;;
			if (pagina == 0) var link = 'search.php';
			else var link = 'search.php?page=' + pagina;
			$(location).attr('href',link);
		}
		else if ( pagina < numeroDePaginas-1 && objetivo == 'adiantamento'){
			pagina = parseInt(pagina) + 1;
			var link = 'search.php?page=' + pagina;
			$(location).attr('href',link);
		}

	});

	$('.votedPag-pagination').click( function(event){
		event.preventDefault();
		var atributo = $(this).attr('id');
		var id = atributo.split('-');
		var objetivo = id[0];
		var pagina = id[1];
		var numeroDePaginas = id[2];

		if ( pagina > 0 && objetivo == 'retrocesso'){
			pagina = parseInt(pagina) - 1;;
			if (pagina == 0) var link = 'votedpolls.php';
			else var link = 'votedpolls.php?page=' + pagina;
			$(location).attr('href',link);
		}
		else if ( pagina < numeroDePaginas-1 && objetivo == 'adiantamento'){
			pagina = parseInt(pagina) + 1;
			var link = 'votedpolls.php?page=' + pagina;
			$(location).attr('href',link);
		}

	});

	$('.pagbuttons').click( function(event){
		event.preventDefault();
		var atributo = $(this).attr('id');
		var id = atributo.split('-');
		var objetivo = id[0];
		var pagina = id[1];
		var numeroDePaginas = id[2];

		if ( pagina > 0 && objetivo == 'retrocesso'){
			pagina = parseInt(pagina) - 1;;
			if (pagina == 0) var link = 'viewMyPolls.php';
			else var link = 'viewMyPolls.php?page=' + pagina;
			$(location).attr('href',link);
		}
		else if ( pagina < numeroDePaginas-1 && objetivo == 'adiantamento'){
			pagina = parseInt(pagina) + 1;
			var link = 'viewMyPolls.php?page=' + pagina;
			$(location).attr('href',link);
		}

	});

	$('.myPolls').click( function(event) {
		event.preventDefault();
		var id = $(this).attr('id');
		if (id == 0) var link = 'viewMyPolls.php';
		else var link = 'viewMyPolls.php?page=' + id;
		$(location).attr('href',link);
	});

	$('#closePoll').click(function() {
		swal({   
    	title: "Are you sure?",
    	text: "Once closed you can't open it again! It's da law.",   
    	type: "warning",   
    	showCancelButton: true,   
    	confirmButtonColor: "#DD6B55",   
    	confirmButtonText: "Yes, I will respect your authoritah!",   
    	closeOnConfirm: false }, 
    	function(){
    		var sid = $('#closePoll').val();
    	    var endereco = 'viewpoll.php?id=' + sid;
    		$.ajax({
    			url: 'closePoll.php',
    			type: "POST",
    			data: {secretID : sid},
    			success:function(html){
    				swal("Closed!", "Your poll is now closed.", "success");
    				$(location).attr('href',endereco);
      			},
      			error:function(html){
	    			swal("Oops...", "Something went wrong :(", "error");
      			}
    		});
    	});
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
    		var sid = $('#removePoll').val();
    		$.ajax({
    			url: 'removePoll.php',
    			type: "get",
    			data: 'id=' + sid,
    			success:function(data){
    				swal("Deleted!", "Your poll has been deleted.", "success");
    				$(location).attr('href','viewMyPolls.php');
      			},
      			error:function(data){
	    			swal("Oops...", "Something went wrong :(", "error");
      			}
    		});
    	});
	});
});
