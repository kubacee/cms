/**
 * Display modal window event.
 */
$(document).on('click', '.confirm-remove', function() {
    var $element = $(this);

    /* Create window */
    $('#confirm').modal({ backdrop: 'static', keyboard: false })
        .one('click', '#confirm-action', function() {
            $element.find('form').trigger('submit');
        });
});

/**
 * Edit form object
 *
 * @type {{form: (*|jQuery|HTMLElement), init: Function, bindEvents: Function}}
 */
var editMenuForm = {
    /**
     * Form element
     */
    form: "",

    /**
     * Init
     */
    init: function() {
        editMenuForm.form = $('#edit-menu-form');

        editMenuForm.bindEvents();
    },

    /**
     * Form events.
     */
    bindEvents: function() {
        /**
         * Display url input.
         */
        editMenuForm.form.on('change', '#select-page', function() {
            var $input = editMenuForm.form.find('#url-input');

            if ($(this).val() === "-1") {
                $input.css({
                    'visibility' : 'visible'
                });
            } else {
                $input.css({
                    'visibility' : 'hidden'
                });
            }
        });
    }
};

var editPageForm = {
    /**
     * Form element
     */
    form: "",

    /**
     * Init
     */
    init: function() {
        editPageForm.form = $('#edit-page-form');

        editPageForm.bindEvents();
    },

    /**
     * Form events.
     */
    bindEvents: function() {
        editPageForm.form.on('change', 'select[name=template]', function() {
            var templateId = parseInt($(this).val());

            window.location.href = SERVER_PATH + '/managePage/edit/' + PAGE_ID + '/'+ PARENT_ID + '/' + templateId;
        });

        /**
         * Change url on go to plugin button.
         */
        editPageForm.form.on('change', '#select-plugin', function() {
            var pluginId = parseInt($(this).val());
            var $pluginButton = $('.go-to-plugin-button');

            var url = '';

            if (pluginId > 0) {
                url = $pluginButton.data('url') + pluginId;
                $pluginButton.removeClass('disabled');
            } else {
                $pluginButton.addClass('disabled');
            }

            $pluginButton.attr('href', url);
        });
    }
};

var navigationMenu = {
    /**
     * Container element.
     */
    container: "",

    /**
     * Init
     */
    init: function() {
        navigationMenu.container = $('.sidenav .navigation');

        navigationMenu.bindEvents();
    },

    /**
     * Events.
     */
    bindEvents: function() {
        $(window).scroll(function() {
            navigationMenu.moveDown();
        });
    },

    /**
     * Move down container menu.
     */
    moveDown: function () {
        var top = $(window).scrollTop();

        navigationMenu.container.css({
            'margin-top' : top + 20
            //'transition' : 200
        });
    }
};

var addPhotosForm = {
    /**
     * Container element.
     */
    container: "",

    /**
     * Init
     */
    init: function() {
        addPhotosForm.container = $('#add-photos-form');

        addPhotosForm.bindEvents();
    },

    /**
     * Events.
     */
    bindEvents: function() {
        addPhotosForm.container.on('click', '#upload-photos', function () {
            showLoader();
            showScreenLock();

            // Wait for loader.
            setTimeout(function(){
                addPhotosForm.container.submit();
            }, 300);
        });
    }
};

/**
 * Show loader gif.
 */
function showLoader()
{
    $('#loader-gif').fadeIn(200);
}

/**
 * Show screen lock.
 */
function showScreenLock()
{
    $('#screen-lock').fadeIn(200);
}

$(document).ready(function() {
    /* Init */
    editMenuForm.init();
    editPageForm.init();
    addPhotosForm.init();
    navigationMenu.init();

    /* Run search select */
    $("#select-page").select2();

    /* Run datepicker */
    $('#datepicker').datepicker({ dateFormat: 'yy-mm-dd' });
});
