
jQuery.validator.addMethod(
    "valid_email",
    function (value, element) {
      return this.optional(element) || EmailRegex.test(value);
    },
    "* Please enter valid email-id."
  );

	$('#forgetpasswordForm').validate({
		rules:{
			email:{
				required:true,
				valid_email: true,
			},
		},
		messages:{
			email:{
				required:'* Email is required',
				valid_email: '* Please enter valid email-id.'
			},
		},
		submitHandler: function (form) { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
	});
   
 
   