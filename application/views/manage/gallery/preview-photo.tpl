{extends file='manage/base.tpl'}
{block name="head"}
{/block}
{block name="content"}

    <div class="list-wrapper">
        <a href="{$backButton}" class="btn btn-primary">
            <span class="glyphicon glyphicon-chevron-left"></span>
            Powróć
        </a>

        <h3>Podgląd zdjęcia</h3>

        <ol class="breadcrumb">
            <li class="active"><a href="{url path="/managePlugin/list/"}">Lista wtyczek</a></li>
            <li class="active"><a href="{url path="/manageGallery/showAlbums/"}">Lista albumów</a></li>
            <li class="active"><a href="{url path="/manageGallery/showPhotos/`$albumEntity->getId()`"}">Lista zdjęć</a></li>
            <li class="active">Podgląd zdjęcia</li>
        </ol>
        <hr>

        <div class="form-horizontal" >
            <fieldset>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="file-input">Nazwa pliku: </label>
                    <div class="col-md-5">
                        <input class="form-control" type="text" readonly value="{$photoEntity->getName()}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="file-input">Podgląd: </label>
                    <div class="col-md-5">
                        <img src="{$uploadsUrl}/{$photoEntity->getValue1()}" width="100%" >
                    </div>
                </div>

            </fieldset>
        </div>

    </div>
{/block}