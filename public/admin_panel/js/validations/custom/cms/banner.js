
var imgFlag = ($("#banner_id").val() != "") ? false : true;
    $("#banner_form").validate({
        // ignore: ".note-editor *",
    
        // debug: false,
        rules: {
            banner_heading: {
                required: true,
                // lettersonly : true,
            },
           
            banner_description: {
                required: true,
            },

            banner_image: {
                 required: imgFlag,
                 accept: imageVal,
                 
            },

            button_name: {
                required: true,
            },

            button_url: {
                required: true,
                url: true
            },

        },
        messages: {
            banner_heading: {
                required: "* Please enter banner heading.",
            },
        
            banner_description: {
                required: "* Please enter banner description.",
            },

            banner_image: {
                 required: "* Please select banner image.",
                 accept: 'Not an image!'
            },

            button_name: {
                required: "* Please enter button name.",
            },
            
            button_url: {
                required: "* Please enter button url.",
                 url: "* Please enter a valid URL."
            },
        },
        submitHandler: function(form) {
            $("#submit_sec").attr("disabled", true);
            form.submit();
        }
    });
    
    
    
      