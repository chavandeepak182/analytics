
	$('#loginForm').validate({
		rules:{
			email:{
				required:true,
                email:true
			},
			password:{
				required:true
			}
		},
		messages:{
			email:{
				required:'* Email is required',
				email:'* Please enter a valid email address.',
			},	
			password:{
				required:'* Password is required'
			}
		},
		submitHandler: function (form) { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
	});
	
	