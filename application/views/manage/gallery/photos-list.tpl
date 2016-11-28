{*{templateId}*}
{extends file='manage/base.tpl'}
{block name="content"}

    <div class="list-wrapper">
        <a href="{url path="/manageGallery/addPhotos/`$albumEntity->getId()`"}" class="btn btn-success">
            <div class="glyphicon glyphicon-plus"></div>
            Dodaj zdjęcia
        </a>

        <h3>{$albumEntity->getName()}</h3>

        <ol class="breadcrumb">
            <li class=""><a href="{url path="/managePlugin/list/"}">Lista wtyczek</a></li>
            <li class=""><a href="{url path="/manageGallery/showAlbums/`$albumEntity->getId()`"}">Lista albumów</a></li>
            <li class="active">Lista zdjęć</li>
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
                            <a href="{url path="/manageGallery/previewPhoto/`$item->getId()`"}" class="btn btn-default btn-sm show-image">
                                <div class="glyphicon glyphicon-eye-open"></div>
                                Podgląd
                            </a>
                        </td>
                        <td>
                            <div class="btn btn-danger btn-sm confirm-remove">
                                <div class="glyphicon glyphicon-remove"></div>
                                Usuń
                                <form action="{url path="/manageGallery/deletePhoto"}" method="POST">
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