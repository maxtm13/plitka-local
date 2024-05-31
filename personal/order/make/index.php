<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
/*
$show = false;
if(empty($_REQUEST["ORDER_ID"])){
	Bitrix\Main\Loader::includeModule("sale");
	$basket = Bitrix\Sale\Basket::loadItemsForFUser(Bitrix\Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
	$price = $basket->getPrice();
	$arOrder = '';
	if(!empty($_REQUEST["reorder"]) && is_numeric(htmlspecialchars($_REQUEST["reorder"])) && empty($_REQUEST["ORDER_ID"])){
		$arOrder = CSaleOrder::GetByID((int)$_REQUEST["reorder"]);
	}
	   
	if((int)$price < 3000 && $price > 0 && !empty($arOrder) || (int)$price >= 3000){
		$show = true;
	}
}
if(!empty($_REQUEST["ORDER_ID"])){
	$show = true;
}
if($show != true){
	LocalRedirect('/personal/cart/');
}else{
*/
	$APPLICATION->IncludeComponent(
		"bitrix:sale.order.ajax", 
		"order", 
		array(
			"ALLOW_AUTO_REGISTER" => "Y",
			"ALLOW_NEW_PROFILE" => "N",
			"COUNT_DELIVERY_TAX" => "N",
			"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
			"DELIVERY2PAY_SYSTEM" => "",
			"DELIVERY_NO_AJAX" => "N",
			"DELIVERY_NO_SESSION" => "N",
			"DELIVERY_TO_PAYSYSTEM" => "d2p",
			"DISABLE_BASKET_REDIRECT" => "N",
			"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
			"PATH_TO_AUTH" => "/auth/",
			"PATH_TO_BASKET" => "/personal/cart/",
			"PATH_TO_ORDER" => "/personal/order/make/",
			"PATH_TO_PAYMENT" => "/personal/order/payment/",
			"PATH_TO_PERSONAL" => "/personal/order/",
			"PAY_FROM_ACCOUNT" => "N",
			"PRODUCT_COLUMNS" => "",
			"PROP_1" => array(
				0 => "20",
				1 => "4",
				2 => "6",
				3 => "5",
			),
			"PROP_2" => "",
			"SEND_NEW_USER_NOTIFY" => "N",
			"SET_TITLE" => "Y",
			"SHOW_ACCOUNT_NUMBER" => "Y",
			"SHOW_PAYMENT_SERVICES_NAMES" => "Y",
			"SHOW_STORES_IMAGES" => "N",
			"TEMPLATE_LOCATION" => "popup",
			"USE_PREPAYMENT" => "N",
			"COMPONENT_TEMPLATE" => "order",
			"SHOW_NOT_CALCULATED_DELIVERIES" => "L",
			"COMPATIBLE_MODE" => "Y",
			"USE_PRELOAD" => "Y",
			"ACTION_VARIABLE" => "action",
			"PRODUCT_COLUMNS_VISIBLE" => array(
				0 => "PREVIEW_PICTURE",
				1 => "PROPERTY_DISCOUNT",
			),
			"ADDITIONAL_PICT_PROP_1" => "-",
			"ADDITIONAL_PICT_PROP_4" => "-",
			"ADDITIONAL_PICT_PROP_7" => "-",
			"ADDITIONAL_PICT_PROP_9" => "-",
			"ADDITIONAL_PICT_PROP_11" => "-",
			"ADDITIONAL_PICT_PROP_15" => "-",
			"ADDITIONAL_PICT_PROP_17" => "-",
			"ADDITIONAL_PICT_PROP_18" => "-",
			"BASKET_IMAGES_SCALING" => "standard",
			"ALLOW_APPEND_ORDER" => "Y",
			"SPOT_LOCATION_BY_GEOIP" => "Y",
			"SHOW_VAT_PRICE" => "Y",
			"USER_CONSENT" => "Y",
			"USER_CONSENT_ID" => "0",
			"USER_CONSENT_IS_CHECKED" => "Y",
			"USER_CONSENT_IS_LOADED" => "N",
			"REORDER" => htmlspecialchars($_REQUEST["reorder"])
		),
		false
	);
/* } */
?>
<? if(empty($_REQUEST["ORDER_ID"])){?>
<div class="vk-block">
	<!-- VK Widget -->
	<script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>
	<!-- VK Widget -->
	<div id="vk_groups">
	<script type="text/javascript">
	VK.Widgets.Group("vk_groups", {mode: 0, wide: 1, width: "auto", height: "250", color1: 'FFFFFF', color2: '2B587A', color3: 'ff8a00'}, 64362093);
	</script>
	</div>
	<!-- VK Widget -->
</div>
<? } ?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>