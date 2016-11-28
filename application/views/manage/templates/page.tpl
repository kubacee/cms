{extends file='manage/page-form-base.tpl'}
{block name="form-content"}

    {formField label='Treść' type="textarea" field_name="content" id="cke-editor" required="true" value="{if isset($itemPage)}{$itemPage->getContent()}{/if}" }

{/block}