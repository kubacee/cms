{*{templateId}*}
{extends file='manage/base.tpl'}
{block name="content"}

    <div class="list-wrapper">
        <a href="{url path="/managePage/edit/0/`$parentId`/`$templateId`"}" class="btn btn-success">
            <div class="glyphicon glyphicon-plus"></div>
            Dodaj podstronę
        </a>
        
        <h3>Podstrony</h3>

        <ol class="breadcrumb">
        {foreach $breadCrumb as $item}
            {if $item@last}
            <li class="active">{$item['name']}</li>
            {else}
            <li class="active"><a href="{url path="/managePage/list/`$item['id']`"}">{$item['name']}</a></li>
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
                    <th class="action"></th>
                    <th class="action"></th>
                </tr>
                </thead>
                <tbody>
                {$count = 1}
                {foreach $list as $item}
                    <tr title="{$item->getDate()}">
                        <td>{$count++}</td>
                        <td>{$item->getName()}</td>
                        <td>
                        <a href="{url path="/managePage/list/`$item->getId()`"}" class="btn btn-default btn-sm">
                            <div class="glyphicon glyphicon-list"></div>
                            Przejdź
                        </a>
                        </td>
                        <td>
                            <a href="{url path="/managePage/edit/`$item->getId()`/`$item->getParentId()`/`$item->getTemplateId()`"}"
                               class="btn btn-primary btn-sm">
                                <div class="glyphicon glyphicon-pencil"></div>
                                Edytuj
                            </a>
                        </td>
                        <td>
                            <a href="{url path="/managePage/edit/0/`$item->getId()`/`$templateId`"}" class="btn btn-success btn-sm">
                                <div class="glyphicon glyphicon-plus"></div>
                                Dodaj
                            </a>
                        </td>
                        <td>
                            {if $item->getStartPage() == 1}
                                <div class="btn btn-danger btn-sm disabled">
                                    <div class="glyphicon glyphicon-remove"></div>
                                    Usuń
                                </div>
                            {else}
                                <div class="btn btn-danger btn-sm confirm-remove">
                                    <div class="glyphicon glyphicon-remove"></div>
                                    Usuń
                                    <form action="{url path="/managePage/delete"}" method="POST">
                                        <input type="hidden" value="{$item->getId()}" name="id">
                                    </form>
                                </div>
                            {/if}
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