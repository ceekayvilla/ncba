// JavaScript Document

$(document).ready(function(){

	// TABS

	$(".tabNavigation li:first").addClass('current');
	$(".tabContent").hide();
	$(".tabContent:first").show();

	$(".tabNavigation li").click(changeTabs);

	var tabTarget = "";

	function changeTabs(){

		$(".tabNavigation li").removeClass('current');
		$(this).addClass('current');

		tabTarget = $(this).data('target');


		$(".tabContent").hide();
		$(".tabContent."+tabTarget).show();

	}

	// TIME PICKER

	$('.fromTime,.toTime').timepicker({
    'minTime': '9:00am',
    'maxTime': '5:00pm'
	});

	

});