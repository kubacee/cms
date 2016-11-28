{extends file='website/base.tpl'}

{block name="main"}

    {$className="blank-page"}

    {if isset($pageType) && $pageType == 'news'}
        {$className="news"}
    {elseif isset($pageType) && $pageType == 'training'}
        {$className="training"}
    {/if}

    <h1>{$page->getName()}</h1>
    <hr>
    <ul class="list-container">
        {foreach $list as $item}
            <li class="">
                <a class="list-item" href="{url path=$item->getPageUrl()}">
                    <span class="mobile-page-date">{$item->getDate(2)}</span>
                    <span class="page-title-container">
                        <span class="page-cell left">
                            <span class="line"></span>
                        </span>
                        <span class="page-cell name-cell">
                            <span class="page-name">{$item->getName()}</span>
                        </span>
                        <span class="page-cell">
                            <span class="line"></span>
                        </span>
                        <span class="page-cell date-cell">
                            <span class="page-date">{$item->getDate(2)}</span>
                        </span>
                        <span class="page-cell right">
                                <span class="line"></span>
                        </span>
                    </span>
                    <span class="short-content-item">{$item->getContent()|strip_tags:false|truncate:500}<span class="more-button">Więcej...</span></span>
                </a>
            </li>
        {/foreach}
    </ul>

    {include file='website/pagination-base.tpl'}

{/block}