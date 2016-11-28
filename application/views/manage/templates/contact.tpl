{extends file='manage/page-form-base.tpl'}
{block name="form-content"}


    {formField label='Biuro projektu' type="textarea" field_name="value_1" id="input-value_1" required="true" value="{if isset($itemPage)}{$itemPage->getValue1()}{/if}" }
{**}
    {formField label='Koordynator projektu' type="textarea" field_name="value_2" id="input-value_2" required="true" value="{if isset($itemPage)}{$itemPage->getValue2()}{/if}" }

    {formField label='Dane adresowe pod mapką' type="textarea" field_name="content" id="cke-editor" required="true" value="{if isset($itemPage)}{$itemPage->getContent()}{/if}" }

{/block}