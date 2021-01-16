jQuery( function($){

	$(document).ready(function(){
		var typingTimer;               
		var doneTypingInterval = 1000; 
		var oldValue = '';

		$('#search').keyup(function(){
		    clearTimeout(typingTimer);
		    if ($('#search').val()) {
		    	oldValue = $('#search').val();
		        typingTimer = setTimeout(doneTyping, doneTypingInterval);
		    } else {
		    	console.log("here");
		    	console.log(oldValue);
		    	if(oldValue != '') {
		    		$.ajax({
				        url: "../search_result.php",
				        type: "post",
				        data: {
				        	search_term : ""
				        } ,
				        success: function (response) {
				        	$('.boxes').html(response);
				           // You will get response from your PHP page (what you echo or print)
				        },
				        error: function(jqXHR, textStatus, errorThrown) {
				           console.log(textStatus, errorThrown);
				        }
				    });
		    		oldValue = '';
		    	}
		    }
		});

		function doneTyping () {
			console.log('fired');
			var search_val = $("#search").val().toLowerCase();
			$.ajax({
		        url: "../search_result.php",
		        type: "post",
		        data: {
		        	search_term : search_val
		        } ,
		        success: function (response) {
		        	$('.boxes').html(response);
		           // You will get response from your PHP page (what you echo or print)
		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }
		    });
		}
	});
});