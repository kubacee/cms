{*{templateId}*}
{extends file='manage/base.tpl'}
{block name="content"}

    <div class="list-wrapper">
        <a href="{url path=""}/manageGallery/editAlbum" class="btn btn-success">
            <div class="glyphicon glyphicon-plus"></div>
            Dodaj album
        </a>

        <h3>Galeria</h3>

        <ol class="breadcrumb">
            <li ><a href="{url path=""}/managePlugin/list">Lista wtyczek</a></li>
            <li class="active">Lista albumów</li>
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
                    <tr>
                        <td>{$count++}</td>
                        <td>{$item->getName()}</td>
                        <td>
                            <a href="{url path="/manageGallery/showPhotos/`$item->getId()`"}" class="btn btn-default btn-sm">
                                <div class="glyphicon glyphicon-list"></div>
                                Przejdź
                            </a>
                        </td>
                        <td>
                            <a href="{url path="/manageGallery/editAlbum/`$item->getId()`"}" class="btn btn-primary btn-sm">
                                <div class="glyphicon glyphicon-pencil"></div>
                                Edytuj
                            </a>
                        </td>
                        <td>
                            <a href="{url path="/manageGallery/addPhotos/`$item->getId()`"}" class="btn btn-success btn-sm">
                                <div class="glyphicon glyphicon-plus"></div>
                                Dodaj
                            </a>
                        </td>
                        <td>
                            <div class="btn btn-danger btn-sm confirm-remove">
                                <div class="glyphicon glyphicon-remove"></div>
                                Usuń
                                <form action="{url path="/manageGallery/deleteAlbum"}" method="POST">
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