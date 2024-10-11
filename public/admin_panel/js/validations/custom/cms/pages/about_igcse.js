

var section_1_slider_old_img1 = ($("#section_1_slider_old_img1").val() != "") ? false : true;
var section_1_slider_old_img2 = ($("#section_1_slider_old_img2").val() != "") ? false : true;
var section_1_slider_old_img3 = ($("#section_1_slider_old_img3").val() != "") ? false : true;
var section_1_slider_old_img4 = ($("#section_1_slider_old_img4").val() != "") ? false : true;

var principle_old_image_1 = ($("#principle_old_image_1").val() != "") ? false : true;

var section_1_management_old_img1 = ($("#section_1_management_old_img1").val() != "") ? false : true;
var section_1_management_old_img2 = ($("#section_1_management_old_img2").val() != "") ? false : true;
var section_1_management_old_img3 = ($("#section_1_management_old_img3").val() != "") ? false : true;



$('#about_cbse_from').validate({
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
        section_2_title_1: {
            required: true,
        },
        section_2_title_2: {
            required: true,
        },
        section_2_description_1: {
            required: true,
        },
        section_2_description_2: {
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
        accolade_4: {
            required: true,
            maxlength: 400
        },
        school_heading_1: {
            required: true,
        },
        school_description_1: {
            required: true,
        },
        principle_heading_1: {
            required: true,
        },
        principle_name: {
            required: true,
        },

        principle_description_1: {
            required: true,
        },
        principle_image_1: {
            required: principle_old_image_1,
            accept: imageVal,
        },
        management_heading_1: {
            required: true,
        },
        management_description_1: {
            required: true,
        },
        management_image_1: {
            required: section_1_management_old_img1,
            accept: imageVal,
        },
        management_name_1: {
            required: true,
        },
        management_designation_1: {
            required: true,
        },
        management_image_2: {
            required: section_1_management_old_img2,
            accept: imageVal,
        },
        management_name_2: {
            required: true,
        },
        management_designation_2: {
            required: true,
        },
        management_image_3: {
            required: section_1_management_old_img3,
            accept: imageVal,
        },
        management_name_3: {
            required: true,
        },
        management_designation_3: {
            required: true,
        },
        policy_heading: {
            required: true,
        },
        policy_description: {
            required: true,
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
        section_2_title_1: {
            required: '* Section 2 title 1 is required.',
        },
        section_2_title_2: {
            required: '* Section 2 title 2 is required.',
        },
        section_2_description_1: {
            required: '* Section 2 description 1 is required.',
        },
        section_2_description_2: {
            required: '* Section 2 description 2 is required.',
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
        school_heading_1: {
            required: '* School heading is required.',
        },
        school_description_1: {
            required: '* School description is required.',
        },
        principle_heading_1: {
            required: '* Principle heading 1 is required.',
        },
        principle_name: {
            required: '* Principle name is required.',
        },
        principle_description_1: {
            required: '* Principle description 1 is required.',
        },
        principle_image_1: {
            required: '* Please select principle image.',
            accept: '* Select valid image.',
        },
        management_heading_1: {
            required: '* Management heading is required.',
        },
        management_description_1: {
            required: '* Management description is required.',
        },
        management_image_1: {
            required: '* Please select management image 1.',
            accept: '* Select valid image.',
        },
        management_name_1: {
            required: '* Management name 1 is required.',
        },
        management_designation_1: {
            required: '* Management designation 1 is required.',
        },
        management_image_2: {
            required: '* Please select management image 2.',
            accept: '* Select valid image.',
        },
        management_name_2: {
            required: '* Management name 2 is required.',
        },
        management_designation_2: {
            required: '* Management designation 2 is required.',
        },
        management_image_3: {
            required: '* Please select management image 3.',
            accept: '* Select valid image.',
        },
        management_name_3: {
            required: '* Management name 3 is required.',
        },
        management_designation_3: {
            required: '* Management designation 3 is required.',
        },
        policy_heading: {
            required: '* Policy heading is required.',
        },
        policy_description: {
            required: '* Policy description is required.',
        }
    },
    submitHandler: function (form) { // <- pass 'form' argument in
        $(".submit").attr("disabled", true);
        form.submit(); // <- use 'form' argument here.

    }
});






