 var imageVal = $("#blog_image").change(function(){
        var $input = $(this);
        var files = $input[0].files;
        var filename = files[0].name;
        var extension = filename.substr(filename.lastIndexOf("."));
        var allowedExtensionsRegx = /(\.jpg|\.jpeg|\.png)$/i;
        var isAllowed = allowedExtensionsRegx.test(extension);
        if(!isAllowed){
            alert("Invalid File Type.");
        }else{
            return false;
        }
    });

 var imgFlag = ($("#txtpkey").val() != "") ? false : true;
    $("#blog_form").validate({
        ignore: ".note-editor *",
        debug: false,
        rules: {
            blog_name: {
                required: true,
               
            },
           
            blog_date: {
                required: true,
            },
            
            blog_by: {
                required: true,
            },

            blog_image: {
                required: imgFlag,
                accept: imageVal,
            },


            blog_description : {
                required: true,
            },
            
            

        },
        messages: {
            blog_name: {
                required: "* Please enter blog name.",
            },
        
            blog_date: {
                required: "* select blog date.",
            },

            blog_by: {
                required: "* Please enter blog by.",
            },
            
            blog_image: {
                 required: "* Please select blog image.",
            },

            blog_description : {
                required: "* Please enter blog description.",
            },
         
        },
        submitHandler: function(form) {
            $("#submit_sec").attr("disabled", true);
            form.submit();
        }
    });