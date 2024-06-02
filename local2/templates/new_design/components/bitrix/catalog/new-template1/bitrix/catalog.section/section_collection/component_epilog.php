<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
global $APPLICATION;
if (isset($templateData['TEMPLATE_THEME']))
{
	$APPLICATION->SetAdditionalCSS($templateData['TEMPLATE_THEME']);
}
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        //преносим блок Вы смотрели
        if (jQuery('.viewedProductsBlock').length > 0) {
            jQuery('.viewedProdWrapper').append(jQuery('.viewedProductsBlock'));
        }
    });
</script>

