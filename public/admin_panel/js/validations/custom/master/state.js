		
	jQuery.validator.addMethod("statename", function(value, element) {
	  if (/^[a-zA-Z\s]+$/.test(value)) {
		return true;
	  } else {
		return false;
	  };
	}, 'Please enter valid state name.');
	
	$('#stateForm').validate({
		rules:{
			state_name:{
				required:true,
				statename:true,	
				minlength: 3,
				remote:base_url+ 'check-duplicate-state?state_id=' + $('#state_id').val()
			}
		},
		messages:{
			state_name:{
				required:'State name is required',
				minlength:'Minimum 3 characters is required',
				remote: "State name is already exists."
			}
		},
		submitHandler: function (form) { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
        }
	});