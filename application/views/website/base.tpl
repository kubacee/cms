{* Get logged user *}
{$loggedUser = $auth->getLoggedUser()}
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
        <title>{$page->getName()} - Geokompetencje w praktyce</title>


        <link rel="stylesheet" href="{$cssUrl}website/main.css"/>

        {*<link rel="stylesheet/less" type="text/css" href="{$cssUrl}website/constants.less"/>*}
        {*<link rel="stylesheet/less" type="text/css" href="{$cssUrl}website/main.less"/>*}

        {*<script src="{$jsUrl}less.min.js"></script>*}

        {block name="head"}{/block}

    </head>

    {* Check user session settings *}

    {* Default params *}
    {$contrastActive=''}
    {$fontLargeActive=''}
    {$fontMediumActive=''}
    {$fontNormalActive='active'}

    {* Build class attribute *}
    {$userSettings='class="'}

    {* Check params *}
    {if isset($smarty.session.contrast_design) && $smarty.session.contrast_design == true}
        {$contrastActive='active'}
        {$userSettings = $userSettings|cat:"contrast-design "}
    {/if}

    {if isset($smarty.session.font_size) && $smarty.session.font_size == 'medium'}
        {$fontNormalActive=''}
        {$fontMediumActive='active'}
        {$userSettings = $userSettings|cat:"font-medium "}
    {/if}

    {if isset($smarty.session.font_size) && $smarty.session.font_size == 'large'}
        {$fontNormalActive=''}
        {$fontLargeActive='active'}
        {$userSettings = $userSettings|cat:"font-large "}
    {/if}

    {* build end *}
    {$userSettings = $userSettings|cat:'"'}

    {* end  *}

    <body {$userSettings}>
        <div id="background"></div>
        <header>
            <nav>
                <a href="{url path=""}" class="logo"></a>
                <div class="toggle-menu">
                    <span class="title">Menu</span>
                    <div class="icon-bar"></div>
                    <div class="icon-bar"></div>
                    <div class="icon-bar"></div>
                </div>
                <ul class="menu-container">
                    {foreach $menu as $item}
                    <li class="menu-item {if $item->getPageId() == $page->getId() || $item->getPageId() == $mainParentPage->getId()}active{/if}">
                        <a href="{url path=$item->getPageUrl()}" title="{$item->getName()}">{$item->getName()}</a>
                    </li>
                    {/foreach}
                </ul>
                <ul class="website-controls">
                    <li class="control">
                        <a href="{url path="/settings/contrast"}" class="change-contrast {$contrastActive}">
                            wersja{if $contrastActive}normalna{else}dla słabowidzących{/if}
                        </a>
                    </li>
                    <li class="control ">
                        <a href="{url path="/settings/font"}" class="change-font-size {$fontNormalActive}"></a>
                    </li>
                    <li class="control">
                        <a href="{url path="/settings/font/medium"}" class="change-font-size medium {$fontMediumActive}"></a>
                    </li>
                    <li class="control">
                        <a href="{url path="/settings/font/large"}" class="change-font-size large {$fontLargeActive}"></a>
                    </li>
                </ul>
            </nav>
        </header>

        <main>
        {block name="main"}

        {/block}
        </main>

        <footer>
            <div class="footer-item left"></div>
            <div class="footer-item center"></div>
            <div class="footer-item right"></div>
        </footer>

        {* Flash message *}
        {if $flash_message }
            {include file='flash-message.tpl'}
        {/if}
        <script src="{$jsUrl}jquery/jquery-2.1.4.min.js"></script>
        <script src="{$jsUrl}jquery/jquery-ui.min.js"></script>
        <script src="{$jsUrl}website/main.js"></script>

        <script src="{$jsUrl}/jquery.cookie.min.js"></script>
        <script src="{$jsUrl}/cookies.js"></script>
        {literal}
            <script>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

                ga('create', 'UA-78640581-1', 'auto');
                ga('send', 'pageview');

            </script>
        {/literal}
    </body>
</html>