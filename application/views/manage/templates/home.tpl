{extends file='manage/page-form-base.tpl'}
{block name="form-content"}

    {formField label='Nagłówek' type="textarea" field_name="value_2" id="header-name-input" required="true" value="{if isset($itemPage)}{$itemPage->getValue2()}{/if}" }

    {formField label='Treść' type="textarea" field_name="content" id="cke-editor" required="true" value="{if isset($itemPage)}{$itemPage->getContent()}{/if}" }

{/block}