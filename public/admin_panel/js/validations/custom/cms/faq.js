
$("#faq_form").validate({
    // ignore: ".note-editor *",

    // debug: false,
    rules: {
        question: {
            required: true,
            // lettersonly : true,
        },

        answer: {
            required: true,
        },



    },
    messages: {
        question: {
            required: "* Please enter question.",
        },

        answer: {
            required: "* Please enter answer.",
        },


    },
    submitHandler: function (form) {
        $("#submit_sec").attr("disabled", true);
        form.submit();
    }
});



