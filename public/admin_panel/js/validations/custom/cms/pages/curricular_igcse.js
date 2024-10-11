


$('#curricular_igcse_from').validate({
    ignore: ".note-editor *",
    debug: false,
    rules: {

        section_2_heading_1: {
            required: true,
        },

        section_2_description_1: {
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
        sport_heading: {
            required: true
        },
        sport_description: {
            required: true
        },
        sport_title_1: {
            required: true
        },
        sport_description_1: {
            required: true
        },
        sport_title_2: {
            required: true
        },
        sport_description_2: {
            required: true
        },
    },
    messages: {
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
        sport_heading: {
            required: '* Sport heading is required.',
        },
        sport_description: {
            required: '* Sport description is required.',
        },
        sport_title_1: {
            required: '* Sport title 1 is required.',
        },
        sport_description_1: {
            required: '* Sport description 1 is required.',
        },
        sport_title_2: {
            required: '* Sport title 2 is required.',
        },
        sport_description_2: {
            required: '* Sport description 2 is required.',
        },
    },
    submitHandler: function (form) { // <- pass 'form' argument in
        $(".submit").attr("disabled", true);
        form.submit(); // <- use 'form' argument here.

    }
});






