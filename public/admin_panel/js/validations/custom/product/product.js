
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Only alphabetical characters");
    
    
    var productImgFlag = ($("#project_image_old").val() != "") ? false : true;
    var bannerImgFlag = ($("#project_banner_old").val() != "") ? false : true;

    $('#product_form').validate({
        ignore: ".note-editor *",
        debug: false,
        rules:{
            product_name:{
                required:true,	
                lettersonly: true,			
            },
            content:{
                required:true,
            },
            features:{
                required:true,
            },
            banner_image:{
                required:bannerImgFlag,
                accept:imageVal,
            },
            product_image:{
                required:productImgFlag,
                accept:imageVal,
            }
        },
        messages:{
            product_name:{
                required:'* Product name is required',
                lettersonly: "* Please Enter Valid Name",
            },
            content:{
                required:'* Content is required',
            },
            features:{
                required:'* Features is required',
            },
            banner_image:{
                required:'* Banner Image is required',
            },
            product_image:{
                required:'* Product Image is required',
            }
        },
        submitHandler: function (form) { // <- pass 'form' argument in
            $(".submit").attr("disabled", true);
            form.submit(); // <- use 'form' argument here.
            
        }
    });

    // $(".submit").click(function() {
        
    //     $("#team_image").rules('add', {
    //         required: true,
    //         accept: "png,jpeg,jpg",
    //         messages: {
    //             required: "* Please select banner image.",
    //             accept: "* Please upload png|jpeg|jpg image only.",
    //         }
    //     });
    // });






