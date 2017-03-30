$('document').ready(function(){

    jQuery(window).trigger('resize').trigger('scroll');

    $('#fs_btn').click(function(event){

        var name = $('#fs_name').val();
        var phone = $('#fs_phone').val();
        var email = $('#fs_email').val();

        var name_error = $('#fs_name').data('invalid');
        var phone_error = $('#fs_phone').data('invalid');

        if(name.search(/^[А-Яа-я]+$/) == -1){
            alert(name_error);
        }else if(phone.search(/375[33|25|29][0-9]{7}/) == -1){
            alert(phone_error);
        }else{
            $.post("/feedback/from_specialist",
                {
                    'name': name,
                    'phone': phone,
                    'email': email
                },
                function(data){

                    if(data == 'ok'){
                        alert("Заявка успешно доставлена, скоро наш специалист свяжеться с Вами. Списабо, что выбрали нас!");
                    }else{
                        alert("При доставке заявки произошла ошибка. Приносим свои извинения. Пожалуйста, свяжитесь с нами по номеру +375297175804");
                    }

                    $('#fs_name').val('');
                    $('#fs_phone').val('');
                    $('#fs_email').val('');
                });

        }

        event.preventDefault();
    });

    $('.info-general__btn').click(function(event) {
        $("html, body").animate({scrollTop: $("#master-help__section").offset().top}, "slow");
        event.preventDefault();
        return false;
    });

    $("#btn-slide-menu").click(function(event){

        $(".left--menu").attr("style", "transition: 1s ease transform");
        $(".left--menu").toggleClass("slide-on");
        $(".left--menu").toggleClass("slide-off");

        $(".content").attr("style", "transition: 1s ease margin-left");
        $(".content").toggleClass("slide-on");
        $(".content").toggleClass("slide-off");

        event.preventDefault();
    });

    $("#btn-user-settings").click(function(event){

        $(".about_user--menu").slideToggle();
        $("#btn-user-settings i").toggleClass("fa-caret-down");
        $("#btn-user-settings i").toggleClass("fa-caret-up");

        event.preventDefault();
    });

    $('#showMenu').click(function(){
        $('.progress--header__top-menu').toggleClass('showme');
    });

    $("#to-contacts").click(function(){
        $("html, body").animate({scrollTop: $("#contacts").offset().top + 500}, "fast");
        return false;
    });

    $("#to-hotouse").click(function(){
        $("html, body").animate({scrollTop: $("#hotouse").offset().top}, "fast");
        return false;
    });


    /* Repair progress page /progress */

    // top menu
    $('.main-menu__icon').click(function(){
        $('.main-menu__list').toggleClass('show');
    });

    $(document).click(function(event){
        if ($(event.target).closest(".main-menu__list").length) return;
        if ($(event.target).closest(".main-menu__icon").length) return;
        $('.main-menu__list').removeClass('show');
    });

    // scroll to link
    $("#go-to-contacts").click(function(){
        $("html, body").animate({scrollTop: $(".section__contacts").offset().top}, "slow");
        return false;
    });
    $("#go-to-what-we-do").click(function(){
        $("html, body").animate({scrollTop: $(".section__what-we-do").offset().top}, "slow");
        return false;
    });
    $("#go-to-repair-progress").click(function(){
        $("html, body").animate({scrollTop: $(".section__progress-bar").offset().top}, "slow");
        return false;
    });

    /* Tech list page /admin/repair/tech_list */

    // open user info
    $('.about_repair_init').click(function(){
        $('.about_repair').removeClass('active');
        $(this).next().addClass('active');
    });

    $(document).click(function(event){
        if ($(event.target).closest(".about_repair_init").length) return;
        if ($(event.target).closest(".about_repair").length) return;
        $('.about_repair').removeClass('active');
    });

    // change repair status event
    $('.check_status').change(function(){

        var checked = $(this).is(':checked');
        var repair_status_id = $(this).attr('repair-statuses-id');

        $.post("/admin/repair/update_status",
            {
                'status': checked,
                'status_id': parseInt(repair_status_id)
            });
    });

    /* Add statuses page /admin/repair/add_statuses */

    // statuses drag and drop
    $( "#sortable_all, #sortable_current" ).sortable({
        connectWith: ".connectedSortable"
    }).disableSelection();


});


