

var section_1_slider_old_img1 = ($("#section_1_slider_old_img1").val() != "") ? false : true;
var section_1_slider_old_img2 = ($("#section_1_slider_old_img2").val() != "") ? false : true;
var section_1_slider_old_img3 = ($("#section_1_slider_old_img3").val() != "") ? false : true;
var section_1_slider_old_img4 = ($("#section_1_slider_old_img4").val() != "") ? false : true;

$('#academics_cbse_from').validate({
    ignore: ".note-editor *",
    debug: false,
    rules: {
        section_1_slider_old_img1: {
            required: section_1_slider_old_img1,
            accept: imageVal,
        },
        section_1_slider_old_img2: {
            required: section_1_slider_old_img2,
            accept: imageVal,
        },
        section_1_slider_old_img3: {
            required: section_1_slider_old_img3,
            accept: imageVal,
        },
        section_1_slider_old_img4: {
            required: section_1_slider_old_img4,
            accept: imageVal,
        },
        section_2_heading_1: {
            required: true,
        },

        section_2_description_1: {
            required: true,
        },

        accolade_1: {
            required: true,
            maxlength: 400
        },
        accolade_2: {
            required: true,
            maxlength: 400
        },
        accolade_3: {
            required: true,
            maxlength: 400
        },
        result_heading: {
            required: true,
        },
        result_link: {
            required: true,
            url: true,
        }


    },
    messages: {
        section_1_slider_old_img1: {
            required: '* Image is required.',
            accept: '* Select valid image.',
        },
        section_1_slider_old_img2: {
            required: '* Image is required.',
            accept: '* Select valid image.',
        },
        section_1_slider_old_img3: {
            required: '* Image is required.',
            accept: '* Select valid image.',
        },
        section_1_slider_old_img4: {
            required: '* Image is required.',
            accept: '* Select valid image.',
        },
        section_2_heading_1: {
            required: '* Section 2 heading 1 is required.',
        },

        section_2_description_1: {
            required: '* Section 2 description 1 is required.',
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
        result_heading: {
            required: '* Result heading is required.',
        },
        result_link: {
            required: '* Result url is required.',
            url: '* Please valid enter url.',
        }

    },
    submitHandler: function (form) { // <- pass 'form' argument in
        $(".submit").attr("disabled", true);
        form.submit(); // <- use 'form' argument here.

    }
});






