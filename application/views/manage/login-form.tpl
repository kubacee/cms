{* Get logged user *}
{$loggedUser = $auth->getLoggedUser()}
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
        <title>System zarządzania treścią</title>
        {block name="head"}{/block}
        <link rel="stylesheet" href="{$cssUrl}manage/custom.css"/>
        <link rel="stylesheet" href="{$cssUrl}manage/bootstrap.min.css"/>
        <link rel="stylesheet" href="{$cssUrl}manage/bootstrap-theme.min.css"/>
        <script src="{$jsUrl}jquery/jquery-2.1.4.min.js"></script>
        <script src="{$jsUrl}jquery/bootstrap.min.js"></script>
        <script src="{$jsUrl}manage/main.js"></script>
    </head>
    <body>

    <div class="container">
        {if $auth->isLogin()}
            <form id="login-form" method="POST" action="{url path="/auth/logout"}">
                {* Flash message *}
                {if $flash_message }
                    {include file='flash-message.tpl'}
                {/if}
                <h2 class="form-signin-heading">Witaj w panelu zarządzania</h2>

                <fieldset>
                    <button style="margin-top: 0px" class="btn btn-primary" type="submit">Wyloguj</button>
                    <a href="{url path="/manage/menu/list/0"}" class="btn btn-default">Przejdź do panelu</a>
                </fieldset>
            </form>
        {else}
            <form id="login-form" method="POST" action="{url path="/auth/login"}">
                {* Flash message *}
                {if $flash_message }
                    {include file='flash-message.tpl'}
                {/if}
                <h2 class="form-signin-heading">Panel logowania</h2>

                <fieldset>
                    <label for="login" class="sr-only">Login</label>
                    <input type="text" id="login" name="login" class="form-control" placeholder="Login" required="" autofocus="">
                    <label for="password" class="sr-only">Hasło</label>
                    <input type="password" id="password" class="form-control" name="password" placeholder="Hasło" required="">

                    <button class="btn btn-primary" type="submit">Zaloguj</button>
                </fieldset>
            </form>
        {/if}
    </div>



    </body>
</html>