{function name='breadCrumb'}
    <ol class="breadcrumb">
        {foreach $data as $item}
            {if $item@last}
                <li class="active">{$item['name']}</li>
            {else}
                <li class="active"><a href="{url path="/manage/page/`$type`/`$item['id']`"}">{$item['name']}</a></li>
            {/if}
        {/foreach}
    </ol>
{/function}

{function name='formField'}
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

    <div class="form-group">
        <label class="col-md-3 control-label" for="{$idAttr}">{$label}</label>
        <div class="col-md-5">
            <input id="{$idAttr}" value="{$valueAttr}" name="{$name}" type="{$type}" placeholder="{$placeholderAttr}" class="form-control input-md" {$requiredAttr}>
        </div>
    </div>
{/function}

{function name='formSelectTemplate'}
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
{/function}

{* ~ *}

{extends file='manage/base.tpl'}

{block name="content"}
    <div class="list-wrapper">
        <a href="{$backButton}" class="btn btn-primary">
            <span class="glyphicon glyphicon-chevron-left"></span>
            Powróć
        </a>

        <h3>{$titleForm}</h3>

        {breadCrumb data=$breadCrumb type='page'}
        <hr>

        <form action="{$actionForm}"
              id="{$idForm}"
              class="form-horizontal"
              method="POST"
                >

            <fieldset>
                <input type="hidden" name="parent" value="{if isset($pageId) && $pageId > 0}{$pageId}{else}0{/if}" >
                <input type="hidden" name="template" value="{$templateId}" >

                {formSelectTemplate templates=$templates templateId=$templateId}

                {formField label='Nazwa' type="text" name="name" value="{if isset($itemPage)}{$itemPage->getName()}{/if}" }

                {* Form fields *}
                {block name="form-content"}

                {/block}

                <div class="row" style="text-align: center">
                    <button class="btn btn-success">Zapisz</button>
                </div>
            </fieldset>
        </form>

    </div>
{/block}