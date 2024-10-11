
var house_img_1 = ($("#house_img_1").val() != "") ? false : true;
var house_img_2 = ($("#house_img_1").val() != "") ? false : true;
var house_img_3 = ($("#house_img_1").val() != "") ? false : true;
var house_img_4 = ($("#house_img_1").val() != "") ? false : true;
$('#stepper_igcse_from').validate({
    ignore: ".note-editor *",
    debug: false,
    rules: {

        house_heading: {
            required: true,
        },

        house_description: {
            required: true,
        },

        accolade_1: {
            required: true,
            maxlength: 400,
        },
        accolade_2: {
            required: true,
            maxlength: 400,
        },
        accolade_3: {
            required: true,
            maxlength: 400,
        },
        accolade_4: {
            required: true,
            maxlength: 400,
        },
        house_name_1: {
            required: true
        },
        house_name_2: {
            required: true
        },
        house_name_3: {
            required: true
        },
        house_name_4: {
            required: true
        },
        prefects_heading: {
            required: true
        },
        prefects_description: {
            required: true
        },
        house_img_2: {
            required: house_img_2
        },
        house_img_3: {
            required: house_img_3
        },
        house_img_1: {
            required: house_img_1
        },
        house_img_4: {
            required: house_img_4
        },


    },
    messages: {
        house_heading: {
            required: '* House heading is required.',
        },
        house_description: {
            required: '* House description is required.',
        },
        accolade_1: {
            required: '* Accolade 1 is required.',
            maxlength: '* Please enter no more than 350 characters.'
        },
        accolade_2: {
            required: '* Accolade 2 is required.',
            maxlength: '* Please enter no more than 350 characters.'
        },
        accolade_3: {
            required: '* Accolade 3 is required.',
            maxlength: '* Please enter no more than 350 characters.'
        },
        accolade_4: {
            required: '* Accolade 4 is required.',
            maxlength: '* Please enter no more than 350 characters.'
        },
        house_name_1: {
            required: '* house name is required.',
        },
        house_name_2: {
            required: '* house name is required.',
        },
        house_name_3: {
            required: '* house name is required.',
        },
        house_name_4: {
            required: '* house name is required.',
        },
        prefects_heading: {
            required: '* prefects title is required.',
        },
        prefects_description: {
            required: '* prefects description is required.',
        },


    },
    submitHandler: function (form) { // <- pass 'form' argument in
        $(".submit").attr("disabled", true);
        form.submit(); // <- use 'form' argument here.

    }
});






