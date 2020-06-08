// JavaScript Document

$(document).ready(function(){

	$(window).resize(function(event) {
    if($(window).width() > 960){

      $.sidr('close', 'sidr');

    }

    $(".description").css('min-height',$(window).height());
    
  });

	initializePage();

	/***** INTIIALIZE FUNCTION *******/
	
	function initializePage(){

	
	}

	/***** END INTIIALIZE FUNCTION *******/
	

	/***** MOBILE MENU FUNCTIONALITY *******/
  $('.menuOpener').sidr({

    side: 'right',
    speed:500,
    onOpen:function(){

      $(".menuOpener").toggleClass('closer');


    },onClose:function(){

      $(".menuOpener").toggleClass('closer');

    }

  });
  /***** END MOBILE MENU FUNCTIONALITY *******/

  $(".description .accordionTitle").removeClass('open');
  $(".description .accordion").slideUp();
  $(".description .accordionTitle:first").addClass('open');
  $(".description .accordionTitle:first").next('.accordion').slideDown();
  
  $(".description .accordionTitle").click(openServices);

  function openServices(){


    if($(this).hasClass('open')){

      $(".description .accordionTitle").removeClass('open');
      $(".description .accordion").slideUp();
      $(this).removeClass("open").next(".accordion").slideUp();

    }else{

      $(".description .accordionTitle").removeClass('open');
      $(".description .accordion").slideUp();
      $(this).addClass("open").next(".accordion").slideDown();

    }

  }

  //$(".description").scrollbar();
  $(".description").css('min-height',$(window).height());

});