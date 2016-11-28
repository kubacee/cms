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
            <h3>Dodaj stanowisko</h3>
        {/if}

        <ol class="breadcrumb">
            <li class="active"><a href="{url path="/managePlugin/list/"}">Lista wtyczek</a></li>
            <li class="active"><a href="{url path="/manageTeam/showTeams/"}">Lista stanowisk</a></li>
            {if isset($editedEntity)}
                <li class="active">Edycja stanowiska</li>
            {else}
                <li class="active">Dodawanie stanowiska</li>
            {/if}
        </ol>
        <hr>

        <form method="POST"
              id="edit-menu-form"
              class="form-horizontal"
              action="{url path="/manageTeam/savePerson/"}{if isset($editedEntity)}{$editedEntity->getId()}{/if}"
              enctype="multipart/form-data"
                >
            <fieldset>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="selectbasic">Stanowisko</label>
                    <div class="col-md-5">
                        <input id="textinput" value="{if isset($editedEntity)}{$editedEntity->getName()}{/if}" name="name" type="text" placeholder="" class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="selectbasic">Imię i nazwisko</label>
                    <div class="col-md-5">
                        <input id="textinput" value="{if isset($editedEntity)}{$editedEntity->getValue1()}{/if}" name="value_1" type="text" placeholder="" class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="selectbasic">Numer pokoju</label>
                    <div class="col-md-5">
                        <input id="textinput" value="{if isset($editedEntity)}{$editedEntity->getValue2()}{/if}" name="value_2" type="text" placeholder="" class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="selectbasic">Email</label>
                    <div class="col-md-5">
                        <input id="textinput" value="{if isset($editedEntity)}{$editedEntity->getValue3()}{/if}" name="value_3" type="text" placeholder="" class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="selectbasic">Telefon</label>
                    <div class="col-md-5">
                        <input id="textinput" value="{if isset($editedEntity)}{$editedEntity->getValue4()}{/if}" name="value_4" type="text" placeholder="" class="form-control input-md" required="">
                    </div>
                </div>

                <div class="row" style="text-align: center">
                    <button class="btn btn-success">Zapisz</button>
                </div>

            </fieldset>
        </form>

    </div>
{/block}