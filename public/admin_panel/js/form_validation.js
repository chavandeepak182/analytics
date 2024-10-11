//banner form validation
    var imgFlag = ($("#product_image_old").val() != "") ? false : true;
    $("#banner_form").validate({
        ignore: ".note-editor *",
        //ignore: [],
        debug: false,
        rules: {
            banner_heading: {
                required: true,
            },
            banner_image: {
                 required: imgFlag,
             //   accept: "jpg,jpeg,png,webp"
            },
        },
        messages: {
            banner_heading: {
                required: "* Please enter banner heading.",
            },
            banner_image: {
                 required: "* Please select banner image.",
               // accept: "* Please select jpg/jpeg/png file type only.",
            },
        },
        submitHandler: function(form) {
            $("#submit_sec").attr("disabled", true);
            form.submit();
        }
    });


    
