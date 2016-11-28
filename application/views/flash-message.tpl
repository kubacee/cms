<script>
    var flashType = "{$flash_message.type}";
    var message = '';
    var delay = '{$flash_message.delay}';

    {foreach $flash_message.message as $message}
        message += " {$message}";
    {/foreach}

//    $(document).ready(function() {
//        if (!delay) {
//            $('#confirm').modal({ backdrop: 'static', keyboard: false })
//                    .one('click', '#confirm-action', function() {
//                        $element.find('form').trigger('submit');
//                    });
//        } else {
//            setTimeout(function() {
//
//            }, 300);
//        }
//
//    });
</script>

<div class="alert alert-{$flash_message.type}">
    <strong>
    {foreach $flash_message.message as $message}
        {$message}
    {/foreach}
    </strong>
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
</div>
