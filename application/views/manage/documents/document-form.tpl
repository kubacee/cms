{extends file='manage/base.tpl'}
{block name="head"}
{/block}
{block name="content"}

    <div class="list-wrapper">
        <a href="{$backButton}" class="btn btn-primary">
            <span class="glyphicon glyphicon-chevron-left"></span>
            Powróć
        </a>

        {if isset($editedEntity)}
            <h3>{$editedEntity->getName()}</h3>
        {else}
            <h3>Dodaj dokument</h3>
        {/if}


        <ol class="breadcrumb">
            <li class="active"><a href="{url path="/managePlugin/list/"}">Lista wtyczek</a></li>
            <li class="active"><a href="{url path="/manageDocuments/showSets/"}">Lista zestawów</a></li>
            <li class="active"><a href="{url path="/manageDocuments/showDocuments/`$parentEntity->getId()`"}">Lista dokumentów</a></li>
            {if isset($editedEntity)}
                <li class="active">Edycja dokumentu</li>
            {else}
                <li class="active">Dodawanie dokumentu</li>
            {/if}
        </ol>
        <hr>

        <form id="add-document-form"
              class="form-horizontal"
              action="{url path="/manageDocuments/saveDocument/"}{if isset($editedEntity)}{$editedEntity->getId()}{/if}"
              method="POST"
              enctype="multipart/form-data"
                >
            <fieldset>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="text-input">Nazwa: </label>
                    <div class="col-md-5">
                        <input id="text-input" required type="text" name="name" class="form-control" value="{if isset($editedEntity)}{$editedEntity->getName()}{/if}">
                    </div>
                </div>

                {if isset($editedEntity)}
                <div class="form-group">
                    <label class="col-md-3 control-label" for="text-input">Nazwa pliku: </label>
                    <div class="col-md-5">
                        <input id="text-input" type="text" readonly class="form-control" value="{$editedEntity->getValue2()}">
                        <a style="margin-top: 5px" download class="btn btn-sm btn-default" target="_blank" href="{$uploadsUrl}{$editedEntity->getValue1()}">Pobierz plik</a>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="text-input">Rozmiar: </label>
                    <div class="col-md-5">
                        <input id="text-input" type="text" readonly class="form-control" value="{$editedEntity->getValue4()}">
                    </div>
                </div>
                {/if}

                <div class="form-group">
                    <label class="col-md-3 control-label" for="kind-file">Rodzaj pliku: </label>
                    <div class="col-md-5">
                        <select name="value_3" id="kind-file" class="form-control">
                            <option {if isset($editedEntity) && $editedEntity->getValue3() == 'other-icon'}selected{/if} value="other-icon">Inny</option>
                            <option {if isset($editedEntity) && $editedEntity->getValue3() == 'pdf-icon'}selected{/if} value="pdf-icon">PDF</option>
                            <option {if isset($editedEntity) && $editedEntity->getValue3() == 'doc-icon'}selected{/if} value="doc-icon">Dokument</option>
                            <option {if isset($editedEntity) && $editedEntity->getValue3() == 'xls-icon'}selected{/if} value="xls-icon">Excell</option>
                            <option {if isset($editedEntity) && $editedEntity->getValue3() == 'img-icon'}selected{/if} value="img-icon">Obrazek</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="upload-input">Dodaj plik: </label>
                    <div class="col-md-5">
                        <input id="upload-input" type="file" name="file" class="form-control" {if !isset($editedEntity)}required{/if}>
                    </div>
                </div>

                <input type="hidden" name="parent_id" value="{$parentEntity->getId()}">

                <div class="row" style="text-align: center">
                    <button class="btn btn-success">Zapisz</button>
                </div>

            </fieldset>
        </form>

    </div>
{/block}