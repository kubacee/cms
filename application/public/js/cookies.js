function initializeCookiesInfo() {
    if (
        'undefined' === typeof $.cookie ||
        'undefined' !== typeof $.cookie('cookiesAccepted')
    ) {
        return;
    }

    var cookiesInfoStylesheets =
        '<style type="text/css">\
            #cookies-info {\
                background-color: #454754;\
                border-radius: 5px;\
                bottom: 10px;\
                color: #B5B5B5;\
                font-size: 0;\
                height: 124px;\
                left: 10px;\
                overflow: hidden;\
                position: fixed;\
                text-align: center;\
                width: 400px;\
                z-index: 9999;\
            }\
            #cookies-info .info {\
                font-size: 12px;\
                margin: 15px;\
            }\
            #cookies-info .info a{\
                color: white;\
                cursor: pointer\
            }\
            #cookies-info .buttons .cookie-button {\
                background: url(\'data:image/png;base64,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\') no-repeat 0 0;\
                cursor: pointer;\
                display: inline-block;\
                height: 33px;\
                outline: none;\
                vertical-align: middle;\
                width: 34px;\
            }\
            #cookies-info .cookie-button.cancel {\
                margin-right: 10px;\
            }\
            #cookies-info .cookie-button.ok {\
                background-position: -44px 0;\
            }\
            #cookies-info .buttons {\
                text-align: right;\
                margin-right: 10px;\
                margin-top: 10px;\
            }\
        </style>';

    var cookiesInfoHTML =
        '<div id="cookies-info">\
            <div class="info">Nasza strona wykorzystuje pliki cookies (ciasteczka). Jeśli chcesz korzystać z naszej strony, musisz zaakceptować używanie ciasteczek\
            <a href="http://wszystkoociasteczkach.pl/" target="_blank">Więcej informacji o ciasteczkach</a> <a href="http://wszystkoociasteczkach.pl/" target="_blank">(cookies)</a> \
            <div class="buttons">\
                <a href="http://wszystkoociasteczkach.pl/" class="cookie-button cancel" target="_blank"></a>\
                <span class="cookie-button ok"></span>\
            </div>\
        </div>';

    $('head').append(cookiesInfoStylesheets);

    $('body')
        .delegate('#cookies-info a.cookie-button.cancel', 'click', function (event) {
            $('#cookies-info').hide();

            return true;
        })
        .delegate('#cookies-info span.cookie-button.ok', 'click', function (event) {
            $.cookie('cookiesAccepted', '1', {
                'expires': 365,
                'path': '/'
            });

            $('#cookies-info').hide();
            return true;
        })
        .append(cookiesInfoHTML)
    ;
}

$(document).ready(function () {
    // Initialize cookies info.
    initializeCookiesInfo();
});