{extends file='website/base.tpl'}

{block name="main"}
    <h1>{$page->getParent()->getName()}</h1>
    <hr>
    <article id="sub-page-content">
        <span class="mobile-page-date">{$page->getDate(2)}</span>
        <span class="page-title-container">
            <span class="page-cell left">
                <span class="line"></span>
            </span>
            <span class="page-cell name-cell">
                <span class="page-name">{$page->getName()}</span>
            </span>
            <span class="page-cell">
                <span class="line"></span>
            </span>
            <span class="page-cell date-cell">
                <span class="page-date">{$page->getDate(2)}</span>
            </span>
            <span class="page-cell right">
                    <span class="line"></span>
            </span>
        </span>
        <section id="content">
            {$page->getContent()}
        </section>
    </article>
{/block}