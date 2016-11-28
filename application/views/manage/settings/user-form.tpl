{extends file='manage/base.tpl'}
{block name="head"}
{/block}
{block name="content"}

    <div class="list-wrapper">
        <a href="{$backButton}" class="btn btn-primary">
            <span class="glyphicon glyphicon-chevron-left"></span>
            Powróć
        </a>

        <h3>Edycja użytkownika</h3>

        <ol class="breadcrumb">
            <li class="active"><a href="{url path="/manageSettings/list/"}">Lista ustawień</a></li>
            <li class="active">Edycja użytkownika</li>
        </ol>
        <hr>

        <form method="POST"
              class="form-horizontal"
              action="{url path="/manageSettings/saveEditedUser"}"
                >
            <fieldset>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="selectbasic">Login:</label>
                    <div class="col-md-5">
                        <input id="textinput" readonly value="{if isset($loginUser)}{$loginUser->getLogin()}{/if}" type="text" class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="textinput">Wprowadź aktualne hasło: </label>
                    <div class="col-md-5">
                        <input id="textinput" type="password" name="old_password" class="form-control input-md" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="textinput">Wprowadź nowe hasło: </label>
                    <div class="col-md-5">
                        <input id="textinput" type="password" name="new_password" class="form-control input-md" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="textinput">Powtórz nowe hasło: </label>
                    <div class="col-md-5">
                        <input id="textinput" type="password" name="new_password_repeated" class="form-control input-md" required>
                    </div>
                </div>

                <div class="row" style="text-align: center">
                    <button class="btn btn-success">Zapisz</button>
                </div>

            </fieldset>
        </form>

    </div>
{/block}