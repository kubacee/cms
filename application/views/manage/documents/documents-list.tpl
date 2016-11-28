{extends file='manage/base.tpl'}
{block name="content"}

    <div class="list-wrapper">
        <a href="{url path="/manageDocuments/editDocument/0/"}{$parentEntity->getId()}" class="btn btn-success">
            <div class="glyphicon glyphicon-plus"></div>
            Dodaj dokument
        </a>

        <h3>{$parentEntity->getName()}</h3>

        <ol class="breadcrumb">
            <li ><a href="{url path="/managePlugin/list"}">Lista wtyczek</a></li>
            <li ><a href="{url path="/manageDocuments/showSets"}">Lista kategorii dokumentów</a></li>
            <li class="active">Lista dokumentów</li>
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
                </tr>
                </thead>
                <tbody>
                {$count = 1}
                {foreach $list as $item}
                    <tr>
                        <td>{$count++}</td>
                        <td>{$item->getName()}</td>
                        <td>
                            <a href="{url path="/manageDocuments/editDocument/"}{$item->getId()}/{$parentEntity->getId()}" class="btn btn-primary btn-sm">
                                <div class="glyphicon glyphicon-pencil"></div>
                                Edytuj
                            </a>
                        </td>
                        <td>
                            <div class="btn btn-danger btn-sm confirm-remove">
                                <div class="glyphicon glyphicon-remove"></div>
                                Usuń
                                <form action="{url path="/manageDocuments/deleteDocument"}" method="POST">
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