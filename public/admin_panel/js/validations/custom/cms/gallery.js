
    $("#gallery_form").validate({
        rules: {
            title: {
                required: true,
            },
           
            image: {
                 required: true,
            },
           
            
        },
        messages: {
            title: {
                required: "* Please enter title.",
            },
        
            image: {
                required: "* Please select image.",
            },
        },
        submitHandler: function(form) {
            $("#submit_sec").attr("disabled", true);
            form.submit();
        }
    });