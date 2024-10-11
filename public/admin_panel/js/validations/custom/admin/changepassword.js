
$('#changePasswordForm').validate({
	rules: {
		old_password: {
			required: true,
		},
		new_password: {
			required: true,
			minlength: 8,
			maxlength: 20,
			notEqualTo: "#old_pass",
		},
		confirm_password: {
			required: true,
			minlength: 8,
			maxlength: 20,
			equalTo: "#new_pass"
		},
	},
	messages: {
		old_password: {
			required: '* Please enter old password.',
		},
		new_password: {
			required: '* Please enter new password.',
			minlength: "* Please enter atleast 8 characters.",
			maxlength: "* Password mustn't be loner than 20 characters.",
			notEqualTo: "* Old password and new password should be different.",
		},
		confirm_password: {
			required: '* Please confirm password.',
			minlength: "* Please enter atleast 8 characters.",
			maxlength: "* Password mustn't be loner than 20 characters.",
			equalTo: "* Confirm password and new password must be same."
		},
	},
	submitHandler: function (form) { // <- pass 'form' argument in
		$(".submit").attr("disabled", true);
		form.submit(); // <- use 'form' argument here.
	}
});

