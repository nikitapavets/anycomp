$('document').ready(function(){

    /**
     * Default ajax headers
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /**
     * Masks for input form
     */
    $('.inp_phone').mask("+375 (99) 999-99-99");
    $('.inp_home_phone').mask("+375 (9999) 9-99-99");

    var FormBase = {
        checkBox: function() {
            $('.gui_checkbox').parent().click(function () {
               $(this).find('.checkbox').toggleClass('active');
            });
        }
    };
    FormBase.checkBox();

});