{extends file='website/base.tpl'}

{block name="main"}
    <h1>{$page->getName()}</h1>
    <hr>
    <section id="documents-container">
        {$count = 0}
        {$colorClass = ''}
        {foreach $documentCategories as $category}
            {if $count == 0}
                {$colorClass='color-green'}
            {/if}

            {if $count == 1}
                {$colorClass='color-blue'}
            {/if}

            {if $count == 2}
                {$colorClass='color-red'}
                {$count = 0}
            {/if}
            <div class="category-box {$colorClass}">
                <div class="category-name">{$category->getName()}</div>
                <div class="category-content">
                    {foreach $category->getChildrenList() as $child}
                    <a href="{$uploadsUrl}{$child->getValue1()}" download="" class="single-document">
                        <div class="icon {$child->getValue3()}"></div>
                        <div class="name">{$child->getName()}</div>
                        <div class="clear-fix"></div>
                    </a>
                    {/foreach}
                </div>
            </div>

            {$count = $count + 1}
        {/foreach}
    </section>
{/block}