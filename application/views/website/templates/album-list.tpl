{extends file='website/base.tpl'}

{block name="main"}
    {*
        value1 = server file name
        value2 = original file name
     *}
    <section id="album-items-container">
        <h1>{$page->getName()}</h1>
        <hr>
        <div class="wrapper">
        {foreach $list as $item}
            <a class="album-item"
                   href="{url path=$item->getPageUrl()}"
                   style="background-image: url('{$uploadsUrl}/{$item->getPluginSilent()->getValue1()}');"
                >
                <div class="album-title">
                    <span>{$item->getName()}</span>
                </div>
            </a>
        {/foreach}
        </div>
    </section>

    {include file='website/pagination-base.tpl'}
{/block}