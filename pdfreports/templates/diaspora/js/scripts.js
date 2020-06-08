$( document ).ready(function() {
	
	if($(window).width() > 960) {
		$(window).scroll(function(){                          
	        if ($(this).scrollTop() > 20) {
	            $('.homecontrol header').slideDown(500);
	        } else {
	            $('.homecontrol header').slideUp(500);
	        }
	    });
	};

	$('.cart-toggle').on('click', function(){
		if($(this).hasClass('active')) {
			hideCart();
		} else {
			showCart();
		}
	});
	
	flashCart();
	
	$('.menu-toggle').on('click', function(){
		if($(this).hasClass('active')) {
			hideMenu();
		} else {
			showMenu();
		}
	});
	
	
	$('#select-all').click(function(event) {   
	   if(this.checked) {
		      // Iterate each checkbox
		      $(':checkbox').each(function() {
		          this.checked = true;
		      });
		  }
		  else {
		    $(':checkbox').each(function() {
		          this.checked = false;
		      });
		  }
	});
	
	$('#select-all-bottom').click(function(event) {   
	   if(this.checked) {
		      // Iterate each checkbox
		      $(':checkbox').each(function() {
		          this.checked = true;
		      });
		  }
		  else {
		    $(':checkbox').each(function() {
		          this.checked = false;
		      });
		  }
	});
    
	$(function() {
		$(".datepicker").datepicker({ 
			dateFormat: "d MM yy",
			changeMonth: true,
      		changeYear: true,
      		yearRange: '2000:'+(new Date).getFullYear()
  		});
	});

  $(function() {
    $( "#tabs" ).tabs();
  });
  
	
	
	//$('#row_1').hide();
	//master select
	$('.home_loading').hide();
	$('select.switch').on('change',function(){
		$('.home_loading').show();
		var input_name=$(this).attr('name');
		var input_val=$(this).val();
		 $('#row_0').html('');
		 $('#row_1').html('');
		 $('#row_1').hide();
		$.get(base_url+'ajax/home_nav.php',{'input_name':input_name,'input_val':input_val},function(data){
			//append to id returned
			var decodedData=$.parseJSON(data);
			$.each( decodedData, function( key, value ) {
			  $('#'+value.level).append(value.html);
			  $('#'+value.level).show();
			});
			$('.home_loading').hide();
			$(".datepicker").datepicker({
						dateFormat: "d MM yy",
						changeMonth: true,
			      		changeYear: true,
			      		yearRange: '2000:'+(new Date).getFullYear()
			  		});
			
			});
		});//end change function

	$('select.switch_cat').on('change',function(){
		var input_name=$(this).attr('name');
		var input_val=$(this).val();
		
		$.get(base_url+'ajax/load_company.php',{'input_name':input_name,'category_id':input_val},function(data){
			//append to id returned
			
			$('#company_id').html(data);
		});
	});//end change function
	
	
	//dashboard accordion
	$( ".purchased ul li" ).first().addClass('active');
	$( ".purchased ul li:nth-child(1) span" ).next().slideDown();

	$('.purchased ul li span').on('click', function(){
		
		if( $(this).parent().hasClass('active') ) {
			$(this).parent().removeClass('active');
			$(this).next().slideUp();
		} else {
			$('.purchased').find('.active').removeClass('active');
			$('.purchased ul ul').slideUp();
			$(this).next().slideDown();
			$(this).parent().addClass('active');
		}
		
	});//dashboard accordion end
	
	//logged in top toggle
	$('.top-username span').on('click', function(){
		hideCart();
		$(this).next().slideToggle();
	});
	
	// $('.home-def').equalizer({
	// 	columns: '.col5 .text',
	// 	resizeable: true,
	// 	breakpoint: 600
	// });
	
});
function showCart() {
	$('.cart-container').slideDown();
	$('.cart-toggle').addClass('active');
}
function hideCart() {
	$('.cart-container').slideUp();
	$('.cart-toggle').removeClass('active');
}
function flashCart() {
	showCart();
	setTimeout(function() { hideCart(); }, 2000);
}
function showMenu() {
	$('header nav').slideDown();
	$('.menu-toggle').addClass('active');
}
function hideMenu() {
	$('header nav').slideUp();
	$('.menu-toggle').removeClass('active');
}

function openExportPop(usetable){
	var popLink = base_url+'export/'+usetable
	MyWindow=window.open(popLink,'View',width=600,height=300); return false;
}

function checkStatusThankyou(pesapal_transaction_tracking_id,pesapal_merchant_reference){
	var linkUrl = base_url+'ajax/transaction_status.php';

		$.get(linkUrl,{'pesapal_transaction_tracking_id':pesapal_transaction_tracking_id,'pesapal_merchant_reference':pesapal_merchant_reference},function(data){
			
			if(data.trim() == "COMPLETED"){
				location.reload();
			}
		});
}