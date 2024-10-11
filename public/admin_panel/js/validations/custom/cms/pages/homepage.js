
// var section_3_old_img1 = ($("#section_3_old_img1").val() !== "") ? false : true;
// var section_3_old_img2 = ($("#section_3_old_img2").val() !== "") ? false : true;
// var section_3_old_img3 = ($("#section_3_old_img3").val() !== "") ? false : true;
// var section_3_old_img4 = ($("#section_3_old_img4").val() !== "") ? false : true;

$("#homepage_form").validate({
  ignore: ".note-editor *",
  debug: false,
  rules: {
    video_url: {
      required: true,
      url: true
    },
    section_1_heading: {
      required: true,
    },
    section_1_description: {
      required: true,
    },
    section_2_accolade_1: {
      required: true,
      maxlength: 400
    },
    section_2_accolade_2: {
      required: true,
      maxlength: 400
    },
    section_2_accolade_3: {
      required: true,
      maxlength: 400
    },
    // section_3_image_1: {
    //   required: section_3_old_img1,
    //   accept: imageVal,
    // },
    // section_3_image_2: {
    //   required: section_3_old_img2,
    //   accept: imageVal,
    // },
    // section_3_image_3: {
    //   required: section_3_old_img3,
    //   accept: imageVal,
    // },
    // section_3_image_4: {
    //   required: section_3_old_img4,
    //   accept: imageVal,
    // },

    section_3_description_1: {
      required: true,
    },

    section_3_description_2: {
      required: true,
    },

    section_3_description_3: {
      required: true,
    },

    section_3_description_4: {
      required: true,
    },
  },
  messages: {
    video_url: {
      required: "* Please enter youtube url.",
      url: "* Please enter valid url.",
    },
    section_1_heading: {
      required: "* Please enter  section 1 heading.",
    },

    section_1_description: {
      required: "* Please enter section 1 description.",
    },
    section_2_accolade_1: {
      required: "* Please enter accolade 1.",
      maxlength: '* Please enter no more than 350 characters.'
    },
    section_2_accolade_2: {
      required: "* Please enter accolade 2.",
      maxlength: '* Please enter no more than 350 characters.'
    },
    section_2_accolade_3: {
      required: "* Please enter accolade 3.",
      maxlength: '* Please enter no more than 350 characters.'
    },
    // section_3_image_1: {
    //   required: "* Please select image 1.",
    //   accept: '* Not an image!'
    // },
    // section_3_image_2: {
    //   required: "* Please select image 2.",
    //   accept: '* Not an image!'
    // },
    // section_3_image_3: {
    //   required: "* Please select image 3.",
    //   accept: '* Not an image!'
    // },
    // section_3_image_4: {
    //   required: "* Please select image 4.",
    //   accept: '* Not an image!'
    // },
    section_3_description_1: {
      required: "* Please enter section 3 description 1.",
    },

    section_3_description_2: {
      required: "* Please enter section 3 description 2.",
    },

    section_3_description_3: {
      required: "* Please enter section 3 description 3.",
    },

    section_3_description_4: {
      required: "* Please enter section 3 description 4.",
    },
  },
  submitHandler: function (form) {
    $("#submit_sec").attr("disabled", true);
    form.submit();
  }
});




