{extends file='website/base.tpl'}

{block name="head"}
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
    <link rel="stylesheet"  href="{$publicUrl}/fancybox/jquery.fancybox-1.3.4.css">
    <script type="text/javascript" src="{$publicUrl}/fancybox/jquery.mousewheel-3.0.4.pack"></script>
    <script type="text/javascript" src="{$publicUrl}/fancybox/jquery.fancybox-1.3.4.js"></script>
    <script>
        $(document).ready(function() {
            $(".photo-box").fancybox();
        });
    </script>
{/block}

{block name="main"}
    <section id="album-items-container">
        <h1>{$page->getName()}</h1>
        <hr>
        {*<div class="sub-title">{$page->getName()}</div>*}
        {if isset($photosList)}
        <div class="wrapper">
        {foreach $photosList as $page}
            <a href="{$uploadsUrl}/{$page->getValue1()}" class="album-item photo-box" rel="gallery01" style="background-image: url('{$uploadsUrl}/{$page->getValue1()}');">
            </a>
        {/foreach}
        </div>
        {/if}
    </section>

{/block}