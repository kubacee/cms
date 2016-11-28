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
            <h3>Dodaj zestaw</h3>
        {/if}

        <ol class="breadcrumb">
            <li class="active"><a href="{url path="/managePlugin/list/"}">Lista wtyczek</a></li>
            <li class="active"><a href="{url path="/manageDocuments/showSets/"}">Lista zestawów</a></li>
            {if isset($editedEntity)}
                <li class="active">Edycja zestawu</li>
            {else}
                <li class="active">Dodawanie zestawu</li>
            {/if}
        </ol>
        <hr>

        <form method="POST"
              id="edit-menu-form"
              class="form-horizontal"
              action="{url path="/manageDocuments/saveSet/"}{if isset($editedEntity)}{$editedEntity->getId()}{/if}"
              enctype="multipart/form-data"
                >
            <fieldset>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="selectbasic">Nazwa</label>
                    <div class="col-md-5">
                        <input id="textinput" value="{if isset($editedEntity)}{$editedEntity->getName()}{/if}" name="name" type="text" placeholder="Nazwa" class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="datepicker">Data: </label>
                    <div class="col-md-5">
                        <input id="datepicker" value="{if isset($editedEntity)}{$editedEntity->getDate()}{else}{$smarty.now|date_format:"%Y-%m-%d"}{/if}" name="date" type="text" class="form-control input-md" required}>
                    </div>
                </div>

                <div class="row" style="text-align: center">
                    <button class="btn btn-success">Zapisz</button>
                </div>

            </fieldset>
        </form>

    </div>
{/block}