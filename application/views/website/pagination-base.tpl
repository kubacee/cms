{if $pagination.max > 1 }
    <div class="pagination-container">
        {if $pagination.currentPage != 1 }
            {*{$pagePath = "`$pagination.currentRoute`"}*}
            <a class="pagination-arrow go-to-first" href="{url path="`$pagination['currentRoute']`/1"}"></a>
            <a class="pagination-arrow go-to-prev" href="{url path="`$pagination['currentRoute']`/`$pagination.currentPage - 1`"}"></a>
        {else}
            <span class="pagination-arrow go-to-first"></span>
            <span class="pagination-arrow go-to-prev"></span>
        {/if}

        {for $pageNumber=1 to $pagination.max max=5}
            {if $pageNumber == $pagination.currentPage}
                <span class="page-number current">{$pageNumber}</span>
            {else}
                <a class="page-number" href="{url path="`$pagination['currentRoute']`/`$pageNumber`"}">{$pageNumber}</a>
            {/if}
        {/for}

        {if $pagination.currentPage != $pagination.max }
            <a class="pagination-arrow go-to-next" href="{url path="`$pagination['currentRoute']`/`$pagination.currentPage + 1`"}"></a>
            <a class="pagination-arrow go-to-last" href="{url path="`$pagination['currentRoute']`/`$pagination.max`"}"></a>
        {else}
            <span class="pagination-arrow go-to-next"></span>
            <span class="pagination-arrow go-to-last"></span>
        {/if}
    </div>
{/if}