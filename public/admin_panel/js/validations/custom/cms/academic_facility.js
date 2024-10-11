
var imgFlag = ($("#old_img").val() != "") ? false : true;
$("#academic_facility_form").validate({
    rules: {

        facility_image: {
            required: imgFlag,
            accept: imageVal,

        },

        facility_title: {
            required: true,
        },

        facility_description: {
            required: true,
        },

    },
    messages: {
        facility_title: {
            required: "* Please enter facility title.",
        },

        facility_description: {
            required: "* Please enter facility description.",
        },

        facility_image: {
            required: "* Please select facility image.",
            accept: '8 Not an image!'
        },
    },
    submitHandler: function (form) {
        $("#submit_sec").attr("disabled", true);
        form.submit();
    }
});


$("#academic_heading_form").validate({
    rules: {



        facility_main_heading: {
            required: true,
        },

        facility_main_description: {
            required: true,
        },

    },
    messages: {
        facility_main_heading: {
            required: "* Please enter facility main heading.",
        },

        facility_main_description: {
            required: "* Please enter facility main description.",
        },

    },
    submitHandler: function (form) {
        $("#submit_sec1").attr("disabled", true);
        form.submit();
    }
});



