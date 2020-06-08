  $(document).ready(function(){

    $(".datePicker").datepicker({ dateFormat: "dd/mm/yy" });

    jQuery.validator.addMethod("alphanumeric", function(value, element) {
    	return this.optional(element) || /^[a-zA-Z0-9]+$/i.test(value);
     }, "Letters only.");

	$.validator.addMethod("phonestartswith", function(value, element){
		return this.optional(element) || /^[2]+[5]+[4]/i.test(value);
	}, "Phone should start with '254'.");

	jQuery.validator.addClassRules('required', {
        required: true
    });

	jQuery.validator.addClassRules('form-number', {
        digits: true
    });

    jQuery.validator.addClassRules('form-email', {
        email: true
    });

    jQuery.validator.addClassRules('kenyan_id', {
        minlength: 8,
        maxlength: 10	
    });

    jQuery.validator.addClassRules('PIN', {
    	alphanumeric:true	
    });


$("#webform-client-form-1").validate({

	errorPlacement: function errorPlacement(error, element) {
            error.insertBefore(element);
        },
})

$("#webform-client-form-2").validate({

	errorPlacement: function errorPlacement(error, element) {
            error.insertBefore(element);
        },
})

$("#webform-client-form-3").validate({
	errorPlacement: function errorPlacement(error, element) {
            error.insertBefore(element);
        },
})

$("#webform-client-form-4").validate({
    errorPlacement: function errorPlacement(error, element) {
            error.insertBefore(element);
        },
})

$("#webform-client-form-5").validate({
    errorPlacement: function errorPlacement(error, element) {
            error.insertBefore(element);
        },
})
$("#webform-client-form-6").validate({
    errorPlacement: function errorPlacement(error, element) {
            error.insertBefore(element);
        },
})

$("body:has('#webform-client-form-7')").addClass('whiteBackground').css('background','#fff');

$("#webform-client-form-7").validate({
    errorPlacement: function errorPlacement(error, element) {
            error.insertBefore(element);
        },
})

$("#webform-client-form-20").validate({
    errorPlacement: function errorPlacement(error, element) {
            error.insertBefore(element);
        },
})

$("#webform-client-form-21").validate({
    errorPlacement: function errorPlacement(error, element) {
            error.insertBefore(element);
        },
})

$("#webform-client-form-22").validate({
    errorPlacement: function errorPlacement(error, element) {
            error.insertBefore(element);
        },
})
$("#webform-client-form-7").unwrap().addClass('form centerAligner');
$("form.webform-client-form").attr('autocomplete', 'off');
$("#webform-client-form-7 .webform-component-markup article").wrapInner("<h3></h3>");


});