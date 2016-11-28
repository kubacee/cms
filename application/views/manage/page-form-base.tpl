{if !isset($templateId)}
    {$templateId = 0}
{/if}

{function formField}
    {$idAttr = ''}
    {$valueAttr = ''}
    {$requiredAttr = ''}
    {$placeholderAttr = ''}

    {if isset($id)}
        {$idAttr = $id}
    {/if}

    {if isset($required) && $required == true}
        {$requiredAttr = 'required'}
    {/if}

    {if isset($placeholder)}
        {$placeholderAttr = $placeholder}
    {/if}

    {if isset($value)}
        {$valueAttr = $value}
    {/if}

    {if $type == 'textarea'}
        <div class="form-group">
            <label class="col-md-3 control-label" for="{$idAttr}">{$label}</label>
            <div class="col-md-8">
                <textarea id="{$idAttr}" name="{$field_name}" placeholder="{$placeholderAttr}" class="form-control" {$requiredAttr} style="min-height: 100px">
                    {$valueAttr}
                </textarea>
            </div>
        </div>
    {else}
        <div class="form-group">
            <label class="col-md-3 control-label" for="{$idAttr}">{$label}</label>
            <div class="col-md-5">
                <input id="{$idAttr}" value="{$valueAttr}" name="{$field_name}" type="{$type}" placeholder="{$placeholderAttr}" class="form-control input-md" {$requiredAttr}>
            </div>
        </div>
    {/if}
{/function}

{function formDatePickerField}
    {$valueAttr = ''}
    {$placeholderAttr = ''}

    {if isset($required) && $required == true}
        {$requiredAttr = 'required'}
    {/if}

    {if isset($value)}
        {$valueAttr = $value}
    {/if}

    <div class="form-group">
        <label class="col-md-3 control-label" for="datepicker">{$label}</label>
        <div class="col-md-5">
            <input id="datepicker" value="{$valueAttr}" name="date" type="text" class="form-control input-md" {$requiredAttr}>
        </div>
    </div>
{/function}

{* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ *}

{extends file='manage/base.tpl'}
{block name="head"}
    <script src="{$publicUrl}ckeditor/ckeditor.js"></script>
    <script>
        var PAGE_ID = {$pageId};
        var PARENT_ID = {$parentId};

        $(document).ready(function() {
            CKEDITOR.replace('cke-editor', {
                filebrowserImageUploadUrl:  SERVER_PATH + '/file/uploadImage',
                width: "auto",
                height: 500
            });

            CKEDITOR.replace('cke-editor-min', {
                filebrowserImageUploadUrl: SERVER_PATH + '/file/uploadImage',
                width: "auto",
                height: 200
            });

        });
    </script>
{/block}

{block name="content"}
    <div class="list-wrapper">


        {*
            TMP SOLUTION BACK BUTTON,
            Url in back button is from http refferer.
            When user change temaplate then is reload.
        *}

        {$backId = 0}

        {foreach $breadCrumb as $item}
            {if !$item@last}
                {$backId = $item['id']}
            {/if}
        {/foreach}

        <a href="{url path="/managePage/list/$backId"}" class="btn btn-primary">
            <span class="glyphicon glyphicon-chevron-left"></span>
            Powróć
        </a>

        {if isset($itemPage)}
            <h3>Edytuj stronę</h3>
        {else}
            <h3>Dodaj stronę</h3>
        {/if}
        <ol class="breadcrumb">
            {foreach $breadCrumb as $item}
                {if $item@last}
                    <li class="active" title="{$item['name']}">{$item['name']|truncate:50}</li>
                {else}
                    <li class="active"><a href="{url path="/managePage/list/`$item['id']`"}" title="{$item['name']}">{$item['name']|truncate:50}</a></li>
                {/if}
            {/foreach}
        </ol>
        <hr>

        <form id="edit-page-form"
                class="form-horizontal"
                action="{url path="/managePage/savePage/"}{if isset($itemPage)}{$itemPage->getId()}{/if}"
                method="POST"
                enctype="multipart/form-data"
            >
            <input type="hidden" name="parent" value="{if isset($parentId) && $parentId > 0}{$parentId}{else}0{/if}" >
            <input type="hidden" name="template" value="{$templateId}" >
            <fieldset>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="selectbasic">Szablon</label>
                    <div class="col-md-5">
                        <select class="form-control input-md" required="" name="template" id="select-search">
                            {foreach $templates as $item}
                                {if $item->getId() == $templateId}
                                    <option selected value="{$item->getId()}">{$item->getName()}</option>
                                {else}
                                    <option value="{$item->getId()}">{$item->getName()}</option>
                                {/if}
                            {/foreach}
                        </select>
                    </div>
                </div>

                {formField label='Nazwa' type="text" field_name="name" id="name" required="true" value="{if isset($itemPage)}{$itemPage->getName()}{/if}" }

                {formDatePickerField label='Data dodania' required="true" value="{if isset($itemPage)}{$itemPage->getDate()}{else}{$smarty.now|date_format:"%Y-%m-%d"}{/if}" }

                {* Form fields *}
                {block name="form-content"}

                {/block}

                {if isset($pluginList)}
                <div class="form-group">
                    <label class="col-md-3 control-label" for="select-plugin">{if isset($pluginLabel)}{$pluginLabel}{else}Przypisz wtyczkę{/if}</label>
                    <div class="col-md-5">
                        <select id="select-plugin" class="form-control input-md" required="" name="plug_id" id="select-search" style="width:88%">
                            <option value="0">Wybierz</option>
                            {foreach $pluginList as $item}
                                {if isset($itemPage) && $item->getId() == $itemPage->getPlugId()}
                                    <option selected value="{$item->getId()}">{$item->getName()}</option>
                                {else}
                                    <option value="{$item->getId()}">{$item->getName()}</option>
                                {/if}
                            {/foreach}
                        </select>

                        {if isset($pluginEditRoute)}
                            {$pluginButtonClass = "disabled"}

                            {if isset($itemPage) && $itemPage->getPlugId() > 0}
                                {$pluginButtonClass = ""}
                            {/if}

                            <a class="btn btn-default go-to-plugin-button {$pluginButtonClass}" data-url="{$pluginEditRoute}"
                               href="{$pluginEditRoute}{if isset($itemPage)}{$itemPage->getPlugId()}{/if}"
                                >
                                <span class="glyphicon glyphicon-search"></span>
                            </a>
                        {/if}

                    </div>
                </div>
                {/if}

                <div class="row" style="text-align: center">
                    <button class="btn btn-success">Zapisz</button>
                </div>

            </fieldset>
        </form>

    </div>
{/block}