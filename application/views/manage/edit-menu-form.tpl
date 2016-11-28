{extends file='manage/base.tpl'}
{block name="head"}
{/block}
{block name="content"}

    <div class="list-wrapper">
        <a href="{$backButton}" class="btn btn-primary">
            <span class="glyphicon glyphicon-chevron-left"></span>
            Powróć
        </a>
        {if isset($itemMenu)}
            <h3>Edytuj pozycję menu</h3>
        {else}
            <h3>Dodaj pozycję menu</h3>
        {/if}
        <ol class="breadcrumb">
            {foreach $breadCrumb as $item}
                {if $item@last}
                <li class="active">{$item['name']}</li>
                {else}
                <li class="active"><a href="{url path=""}/manage/menu/list/{$item['id']}">{$item['name']}</a></li>
                {/if}
            {/foreach}
        </ol>
        <hr>

        <form id="edit-menu-form"
              class="form-horizontal"
              {if isset($itemMenu)}
                  action="{url path="/manageMenu/edit/`$itemMenu->getId()`"}"
              {else}
                  action="{url path="/manageMenu/add"}"
              {/if}
               method="POST">
            <input type="hidden" name="parent" value="{if isset($pageId) && $pageId > 0}{$pageId}{else}0{/if}" >
            <fieldset>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="selectbasic">Nazwa</label>
                    <div class="col-md-5">
                        <input id="textinput" value="{if isset($itemMenu)}{$itemMenu->getName()}{/if}" name="name" type="text" placeholder="Nazwa" class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="textinput">Podlinkuj podstronę</label>
                    <div class="col-md-5">
                        <select id="select-page" name="page" class="form-control">
                            <option {if isset($itemMenu) && $itemMenu->getPageId() == 0}selected{/if} value="0">Brak</option>
                            <option {if isset($itemMenu) && $itemMenu->getPageId() == -1}selected{/if} value="-1">Własny adres</option>
                            {foreach $pageList as $item}
                                <option
                                    {if isset($itemMenu) && $item->getId() == $itemMenu->getPageId()}selected{/if}
                                    value="{$item->getId()}">{$item->getName()}
                                </option>
                            {/foreach}
                        </select>

                        <input
                            {if isset($itemMenu) && $itemMenu->getPageId() == -1}
                                style="visibility: visible"
                            {/if}
                               id="url-input"
                               name="url"
                               type="text"
                               placeholder="adres url"
                               class="form-control input-md"
                               value="{if isset($itemMenu)}{$itemMenu->getUrl()}{/if}"
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="select-icon">Ikona </label>
                    <div class="col-md-5" >
                        <select id="select-icon" name="icon_name" class="form-control input-md">
                            <option value="home" {if isset($itemMenu) && $itemMenu->getIconName() == 'home'}selected{/if}>strona główna</option>
                            <option value="about-us" {if isset($itemMenu) && $itemMenu->getIconName() == 'about-us'}selected{/if}>o nas</option>
                            <option value="news" {if isset($itemMenu) && $itemMenu->getIconName() == 'news'}selected{/if}>aktualności</option>
                            <option value="gallery" {if isset($itemMenu) && $itemMenu->getIconName() == 'gallery'}selected{/if}>galeria</option>
                            <option value="course" {if isset($itemMenu) && $itemMenu->getIconName() == 'course'}selected{/if}>szkolenia i konferencje</option>
                            <option value="contact" {if isset($itemMenu) && $itemMenu->getIconName() == 'contact'}selected{/if}>kontakt</option>
                        </select>
                    </div>
                </div>

                <div class="row" style="text-align: center">
                    <button class="btn btn-success">Zapisz</button>
                </div>

            </fieldset>
        </form>

    </div>
{/block}