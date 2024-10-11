	
	$('#verifyotpForm').validate({
		rules:{
			otp:{
				required:true,		
				minlength: 4,
				digits: true		
			},
		},
		messages:{
			otp:{
				required:'* OTP is required',
				minlength: "* This field must contain 4 Digit.",
				digits: "* This field can only contain numbers."
			},
		},
		submitHandler: function (form) { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
	});
   
 
   