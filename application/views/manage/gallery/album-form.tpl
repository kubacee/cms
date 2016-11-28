{extends file='manage/base.tpl'}
{block name="head"}
{/block}
{block name="content"}

    <div class="list-wrapper">
        <a href="{$backButton}" class="btn btn-primary">
            <span class="glyphicon glyphicon-chevron-left"></span>
            Powróć
        </a>

        {if isset($albumEntity)}
            <h3>{$albumEntity->getName()}</h3>
        {else}
            <h3>Dodaj album</h3>
        {/if}

        <ol class="breadcrumb">
            <li class="active"><a href="{url path="/managePlugin/list/"}">Lista wtyczek</a></li>
            <li class="active"><a href="{url path="/manageGallery/showAlbums/"}">Lista albumów</a></li>
            {if isset($albumEntity)}
                <li class="active">Edycja albumu</li>
            {else}
                <li class="active">Dodawanie albumu</li>
            {/if}
        </ol>
        <hr>

        <form method="POST"
              id="edit-menu-form"
              class="form-horizontal"
              action="{url path="/manageGallery/saveAlbum/"}{if isset($albumEntity)}{$albumEntity->getId()}{/if}"
              enctype="multipart/form-data"
                >
            <fieldset>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="selectbasic">Nazwa</label>
                    <div class="col-md-5">
                        <input id="textinput" value="{if isset($albumEntity)}{$albumEntity->getName()}{/if}" name="name" type="text" placeholder="Nazwa" class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="datepicker">Data </label>
                    <div class="col-md-5">
                        <input id="datepicker" value="{if isset($albumEntity)}{$albumEntity->getDate()}{else}{$smarty.now|date_format:"%Y-%m-%d"}{/if}" name="date" type="text" class="form-control input-md" required}>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="textarea">Krótki opis </label>
                    <div class="col-md-5">
                        <textarea style="height: 100px" id="textarea" name="value_3" class="form-control">{if isset($albumEntity)}{$albumEntity->getValue3()}{/if}</textarea>
                    </div>
                </div>

                {if isset($albumEntity) && $albumEntity->getValue1()}
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="file-input">Podgląd </label>
                        <div class="col-md-5">
                            <img width="300" height="250" src="{$uploadsUrl}/{$albumEntity->getValue1()}">
                        </div>
                    </div>
                {/if}

                <div class="form-group">
                    <label class="col-md-3 control-label" for="file-input">Miniatura albumu </label>
                    <div class="col-md-5">
                        <input type="file" accept="image/*" name="file" id="file-input" value="" class="form-control" {if !isset($albumEntity)}required{/if}/>
                    </div>
                </div>

                <div class="row" style="text-align: center">
                    <button class="btn btn-success">Zapisz</button>
                </div>

            </fieldset>
        </form>

    </div>
{/block}