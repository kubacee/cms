{* Get logged user *}
{$loggedUser = $auth->getLoggedUser()}
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
        <title>System zarządzania treścią</title>

        <link rel="stylesheet" href="{$cssUrl}manage/select2.min.css"/>
        <link rel="stylesheet" href="{$cssUrl}manage/bootstrap.min.css"/>
        <link rel="stylesheet" href="{$cssUrl}manage/select-bootstrap.css"/>
        <link rel="stylesheet" href="{$cssUrl}manage/bootstrap-theme.min.css"/>
        <link rel="stylesheet" href="{$cssUrl}manage/bootstrap-datetimepicker.min.css"/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


        <link rel="stylesheet" href="{$cssUrl}manage/custom.css"/>

        <script src="{$jsUrl}jquery/jquery-2.1.4.min.js"></script>
        <script src="{$jsUrl}jquery/jquery-ui.min.js"></script>
        <script src="{$jsUrl}jquery/bootstrap.min.js"></script>
        {*<script src="{$jsUrl}jquery/bootstrap-datetimepicker.min.js"></script>*}
        <script src="{$jsUrl}manage/select2.js"></script>

        <script src="{$jsUrl}manage/main.js"></script>
        <script>
            var SERVER_PATH = "{url path=""}";
        </script>

        {block name="head"}{/block}
    </head>
    <body>
        <nav class="navbar navbar-inverse visible-xs">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <form action="{url path="/auth/logout"}" method="POST">
                        <button type="submit" class="btn btn-default">Wyloguj</button>
                    </form>
                    <a class="navbar-brand" href="#">CMS</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li {if isset($menuAction)}class="active"{/if}><a href="{url path="/manage/menu"}">Menu</a></li>
                        <li {if isset($pageAction)}class="active"{/if}><a href="{url path="/managePage/list"}">Podstrony</a></li>
                        <li {if isset($pluginAction)}class="active"{/if}><a href="{url path="/managePlugin/list"}">Wtyczki</a></li>
                        <li {if isset($settingsAction)}class="active"{/if}><a href="{url path="/manageSettings/list"}">Ustawienia</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row content">
                <div class="col-sm-3 sidenav hidden-xs">
                    <div class="navigation">
                        <nav>
                            <form action="{url path="/auth/logout"}" method="POST" style="float: left; margin-right: 10px;">
                                <button type="submit" class="btn btn-danger">Wyloguj</button>
                            </form>

                            <h2 style="margin-bottom: 10px;">CMS</h2>

                            <ul class="nav nav-pills nav-stacked">
                                <li><a style="color: #777 " href="{url path=""}" target="_blank">Przejdź do strony</a></li>

                                <li {if isset($menuAction)}class="active"{/if}>
                                    <a href="{url path="/manage/menu/list/0"}">
                                        {*<div class="glyphicon glyphicon-list-alt"></div>*}
                                        Menu
                                    </a>
                                </li>
                                <li {if isset($pageAction)}class="active"{/if}><a href="{url path="/managePage/list"}">Podstrony</a></li>
                                <li {if isset($pluginAction)}class="active"{/if}><a href="{url path="/managePlugin/list"}">Wtyczki</a></li>
                                <li {if isset($settingsAction)}class="active"{/if}><a href="{url path="/manageSettings/list"}">Ustawienia</a></li>
                            </ul>

                            <div class="cms-info-container">
                                <hr>
                                <div class="partner-wrapper">
                                    <a class="partner-name" target="_blank" href="http://www.exgeo.pl">Exgeo &copy;</a>
                                    <div class="product-name">CMS 2016 &copy;</div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="col-sm-9">
                    {* Flash message *}
                    {if $flash_message }
                        {include file='flash-message.tpl'}
                    {/if}

                    <div class="page-container">
                        {block name="content"}{/block}
                    </div>
                </div>
            </div>
        </div>

        <div id="confirm" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Czy napewno chcesz usunąć?</h4>
                    </div>
                    {*<div class="modal-body">*}
                        {*<p>One fine body&hellip;</p>*}
                    {*</div>*}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Nie</button>
                        <button id="confirm-action" type="button" class="btn btn-danger">Tak</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </body>

    <div id="loader-gif"></div>
    <div id="screen-lock"></div>

    {block name="foot"}{/block}
</html>