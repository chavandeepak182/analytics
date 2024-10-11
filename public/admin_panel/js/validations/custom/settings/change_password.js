
	$('#confirmpasswordForm').validate({
		rules:{
			new_password:{
				required:true
			},
			confirm_password:{
				required:true,
				equalTo: "#password"
			}
		},
		messages:{
			new_password:{
				required:'* Password is required'
			},
			confirm_password:{
				required:'* Confirm password is required',
				equalTo: "* Confirm password not matched"
			}
		},
		submitHandler: function (form) { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
	});
   