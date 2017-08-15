{{ header("Content-type:text/html;charset=utf-8") }}
<!DOCTYPE html>
<html class="no-js" lang="ru">

    <head>
        <meta charset="utf-8">
        <title>{{ sprintf('%s%s', config('titles.admin_page_title_template'), $page->getTitle()) }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link rel='shortcut icon' type='image/x-icon' href='/images/favicon/favicon.ico' />

        <!-- Load CSS, CSS Localstorage & WebFonts Main Function -->
        <script>!function(e){"use strict";function t(e,t,n){e.addEventListener?e.addEventListener(t,n,!1):e.attachEvent&&e.attachEvent("on"+t,n)}function n(t,n){return e.localStorage&&localStorage[t+"_content"]&&localStorage[t+"_file"]===n}function a(t,a){if(e.localStorage&&e.XMLHttpRequest)n(t,a)?o(localStorage[t+"_content"]):l(t,a);else{var s=r.createElement("link");s.href=a,s.id=t,s.rel="stylesheet",s.type="text/css",r.getElementsByTagName("head")[0].appendChild(s),r.cookie=t}}function l(e,t){var n=new XMLHttpRequest;n.open("GET",t,!0),n.onreadystatechange=function(){4===n.readyState&&200===n.status&&(o(n.responseText),localStorage[e+"_content"]=n.responseText,localStorage[e+"_file"]=t)},n.send()}function o(e){var t=r.createElement("style");t.setAttribute("type","text/css"),r.getElementsByTagName("head")[0].appendChild(t),t.styleSheet?t.styleSheet.cssText=e:t.innerHTML=e}var r=e.document;e.loadCSS=function(e,t,n){var a,l=r.createElement("link");if(t)a=t;else{var o;o=r.querySelectorAll?r.querySelectorAll("style,link[rel=stylesheet],script"):(r.body||r.getElementsByTagName("head")[0]).childNodes,a=o[o.length-1]}var s=r.styleSheets;l.rel="stylesheet",l.href=e,l.media="only x",a.parentNode.insertBefore(l,t?a:a.nextSibling);var c=function(e){for(var t=l.href,n=s.length;n--;)if(s[n].href===t)return e();setTimeout(function(){c(e)})};return l.onloadcssdefined=c,c(function(){l.media=n||"all"}),l},e.loadLocalStorageCSS=function(l,o){n(l,o)||r.cookie.indexOf(l)>-1?a(l,o):t(e,"load",function(){a(l,o)})}}(this);</script>

        <!-- Load Fonts CSS Start -->
        <script>
            loadLocalStorageCSS( "webfonts", "/styles/fonts.min.css?ver=1.0.0" );
        </script>
        <!-- Load Fonts CSS End -->

        <!-- Load Custom CSS Start -->
        <link rel="stylesheet" href="/styles/administrator.min.css?ver=1.12">
        <!-- Load Custom CSS End -->

        <div style='height: 0; width: 0; position: absolute; visibility: hidden'>
            @include('components.svg')
        </div>

        <!-- Load Custom CSS Compiled without JS Start -->
        <noscript>
            <link rel="stylesheet" href="/styles/fonts.min.css">
        </noscript>
        <!-- Load Custom CSS Compiled without JS End -->

        <!-- Custom Browsers Color Start -->
        <!-- Chrome, Firefox OS and Opera -->
        <meta name="theme-color" content="#2297D6">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#2297D6">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-status-bar-style" content="#2297D6">
        <!-- Custom Browsers Color End -->

    </head>

    <body>

        @include('components.analytics')

        @yield('content')
        <a href="" id="upload_img" class="hidden"></a>
        <!-- Load Scripts Start -->
        <script src="/scripts/libs.min.js?v.2.22"></script>
        <script src="/scripts/libs/ajax_upload.js"></script>
        <script src="/scripts/admin.min.js?v.2.22"></script>
        <script src="/scripts/administrator.min.js?v.122"></script>
        <script>

            $(document).ready(function(){
                $('.catalog_index_top-items').removeClass('invisible');
            });

            var AdminMenu = {

                'showMenu': function () {

                    $('.showAdminMenu').click(function (e) {

                        $('.admin-panel__left-side').toggleClass('active');

                        e.preventDefault();
                        return false;
                    });

                    $(document).click(function(event){
                        if ($(event.target).closest(".admin-panel__left-side").length) return;
                        $('.admin-panel__left-side').removeClass('active');
                    });

                },

            };
            AdminMenu.showMenu();

        </script>
        <!-- Load Scripts End -->

    </body>

</html>