{extends file='manage/base.tpl'}
{block name="content"}

    <div class="list-wrapper">
        {*<a href="{$backButton}" class="btn btn-primary">*}
            {*<span class="glyphicon glyphicon-chevron-left"></span>*}
            {*Powróć*}
        {*</a>*}
        {if !isset($pageId)}
            {$pageId = ''}
        {/if}
        <a href="{url path="/manage/menu/add/$pageId"}" class="btn btn-success">
            <div class="glyphicon glyphicon-plus"></div>
            Dodaj menu
        </a>

        <h3>Menu</h3>

        <ol class="breadcrumb">
        {foreach $breadCrumb as $item}
            {if $item@last}
            <li class="active">{$item['name']}</li>
            {else}
            <li class="active"><a href="{url path="/manage/menu/list/`$item['id']`"}">{$item['name']}</a></li>
            {/if}
        {/foreach}
        </ol>
        <hr>

        <div class="table-responsive">
            <table class="table table-condensed table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th style="width: 100%">Nazwa</th>
                    <th class="action"></th>
                    <th class="action"></th>
                    {*<th class="action"></th>*}
                    {*<th class="action"></th>*}
                </tr>
                </thead>
                <tbody>
                {$count = 1}
                {foreach $list as $item}
                    <tr>
                        <td>{$count++}</td>
                        <td>{$item->getName()}</td>
                        {*<td>*}
                        {*<a href="/manage/menu/list/{$item->getId()}" class="btn btn-default btn-sm">*}
                            {*<div class="glyphicon glyphicon-list"></div>*}
                            {*Przejdź*}
                        {*</a>*}
                        {*</td>*}
                        <td>
                            <a href="{url path="/manage/menu/edit/`$item->getId()`"}" class="btn btn-primary btn-sm">
                                <div class="glyphicon glyphicon-pencil"></div>
                                Edytuj
                            </a>
                        </td>
                        {*<td>*}
                            {*<a href="/manage/menu/add/{$item->getId()}" class="btn btn-success btn-sm">*}
                                {*<div class="glyphicon glyphicon-plus"></div>*}
                                {*Dodaj*}
                            {*</a>*}
                        {*</td>*}
                        <td>
                            <div class="btn btn-danger btn-sm confirm-remove">
                                <div class="glyphicon glyphicon-remove"></div>
                                Usuń
                                <form action="{url path="/manageMenu/delete"}" method="POST">
                                    <input type="hidden" value="{$item->getId()}" name="id">
                                </form>
                            </div>
                        </td>
                    </tr>
                {foreachelse}
                    <tr>
                        <td colspan="6">Brak danych</td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </div>
    </div>
{/block}