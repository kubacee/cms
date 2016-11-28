{extends file='manage/base.tpl'}
{block name="head"}
{/block}
{block name="content"}

    <div class="list-wrapper">
        <a href="{$backButton}" class="btn btn-primary">
            <span class="glyphicon glyphicon-chevron-left"></span>
            Powróć
        </a>

        <h3>Dodaj zdjęcia</h3>

        <ol class="breadcrumb">
            <li class="active"><a href="{url path="/managePlugin/list/"}">Lista wtyczek</a></li>
            <li class="active"><a href="{url path="/manageGallery/showAlbums/"}">Lista albumów</a></li>
            <li class="active"><a href="{url path="/manageGallery/showPhotos/`$albumEntity->getId()`"}">Lista zdjęć</a></li>
            <li class="active">Dodawanie zdjęć</li>
        </ol>
        <hr>

        <form id="add-photos-form"
              class="form-horizontal"
              action="{url path="/manageGallery/savePhotos/"}"
              method="POST"
              enctype="multipart/form-data"
                >
            <fieldset>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="file-input">Dodaj zdjęcia: </label>
                    <div class="col-md-5">
                        <input type="file" accept="image/*" name="files[]" id="file-input" value="" class="form-control" multiple required  />
                    </div>
                </div>

                <input type="hidden" name="album_id" value="{$albumEntity->getId()}">

                <div class="row" style="text-align: center">
                    <div id="upload-photos" class="btn btn-success ">Zapisz</div>
                </div>

            </fieldset>
        </form>

    </div>
{/block}