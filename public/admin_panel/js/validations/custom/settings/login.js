
jQuery.validator.addMethod(
    "valid_email",
    function (value, element) {
      return this.optional(element) || EmailRegex.test(value);
    },
    "* Please enter valid email-id."
  );

	$('#loginForm').validate({
		rules:{
			email:{
				required:true,
				valid_email: true,
			},
            password: {
                required: true,
            }
		},
		messages:{
			email:{
				required:'* Email is required',
				valid_email: '* Please enter valid email-id.'
			},
            password: {
                required: "* Password is required."
            }
		},
		submitHandler: function (form) { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
	});
   
 
   