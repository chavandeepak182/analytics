
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Only alphabetical characters");
    
    
    var productImgFlag = ($("#old_img").val() != "") ? false : true;

    $('#upcoming_product_form').validate({
        
        rules:{
            heading:{
                required:true,	
                lettersonly: true,			
            },
            content:{
                required:true,
                maxlength: 250
            },
            
            product_image:{
                required:productImgFlag,
                accept:imageVal,
            }
        },
        messages:{
            heading:{
                required:'* Product name is required',
                lettersonly: "* Please Enter Valid Name",
            },
            content:{
                required:'* Content is required',
                maxlength: '* Character lenght should be 100',
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

   






