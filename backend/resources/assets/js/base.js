$('document').ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /**
     * Initialize necessary js libs
     */
    var Libs = {

        'owl': function () {

            $('.owl-carousel__catalog').owlCarousel({
                loop:false,
                margin:30,
                responsive:{
                    0:{
                        items:1
                    },
                    768:{
                        items:3
                    },
                    1024:{
                        items:5
                    }
                }
            });

            $(".owl-carousel").owlCarousel({
                loop:false,
                margin:30,
                responsive:{
                    0:{
                        items:1
                    },
                    768:{
                        items:3
                    },
                    1024:{
                        items:5
                    }
                }
            });


        },

        'clamp': function () {

            var module = document.getElementsByClassName('clamp');
            for(var i = 0; i < module.length; i++) {
                $clamp(module[i], {clamp: 3});
            }

        },

    };
    Libs.owl();
    Libs.clamp();

    /**
     * Feedback callback
     */
    $(".feedback-callback.short").click(function(event){
        $(".feedback-callback").toggleClass('hidden');
    });

    $(document).click(function(event){
        if ($(event.target).closest(".feedback-callback").length) return;
        $(".feedback-callback.short").removeClass('hidden');
        $(".feedback-callback.full").addClass('hidden');
    });

    $("#callbackSend").click(function(event){

        var phone = $("#callbackPhone").val();
        var name = $("#callbackName").val();
        var link = window.location.href;
        var referrer = document.referrer;

        if(phone == ''){
            $("#callbackPhone").css("border-color", "red");
            return;
        }else if(name == ''){
            $("#callbackName").css("border-color", "red");
            return;
        }

        $.post("/feedback/callback",
            {
                'client_phone': phone,
                'client_name': name,
                'site_link': link,
                'site_referrer': referrer,
            }, function(data){
                if(data == "ok") {
                    $("#callbackSend").addClass("hidden");
                    $("#callbackSend").next("p").removeClass("hidden").text(name + ", мы Вам скоро перезвоним!");
                } else if(data == "bad") {
                    $("#callbackSend").next("p").removeClass("hidden").text(name + ", сервис с данное время не работает.");
                }
            });

        event.preventDefault();
    });

    /**
     * Masks for input form
     */
    $('.inp_phone').mask("+375 (99) 999-99-99");
    $('.inp_home_phone').mask("+375 (2132) 9-99-99");

    var FormBase = {

        checkBox: function() {

            $('.gui_checkbox').parent().click(function () {
               $(this).find('.checkbox').toggleClass('active');
            });
        }
    }
    FormBase.checkBox();

});