{extends file='website/base.tpl'}
{block name="main"}
    <div class="home-container">
        <div class="home-title">
            {$page->getValue2()|unescape:'html'}
        </div>
    </div>
    <div class="home-belt"></div>
    <div class="home-content">{$page->getContent()}</div>
{/block}