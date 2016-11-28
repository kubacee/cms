{extends file='manage/page-form-base.tpl'}
{block name="form-content"}

    <div class="form-group">
        <label class="col-md-3 control-label" for="textinput">Treść</label>
        <div class="col-md-8">
            <textarea name="content" id="cke-editor" class="form-control" >{if isset($itemPage)}{$itemPage->getContent()}{/if}</textarea>
        </div>
    </div>

{/block}