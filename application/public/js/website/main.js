
$(document).ready(function() {
    /* Hide/open responsive menu */
    $('.toggle-menu').click(function() {
       $('.menu-container').toggleClass('show');
    });

    /* Hide/open document container */
    $('.documents-container').on('click', '.title', function() {
        var $self = $(this),
            $slideContent = $self.parents('.documents-container').find('.content');

        if ($slideContent.height() == 1) {
            $self.find('.arrow').addClass('up');
            $slideContent.css('height', '100%');
        } else {
            $slideContent.css('height', 1);
            $self.find('.arrow').removeClass('up');
        }
    });

    /* Stick footer to bottom */
    var windowH = $(window).height();
    $('main').css('min-height', windowH - 300);
});