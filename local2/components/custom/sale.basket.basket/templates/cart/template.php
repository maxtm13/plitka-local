<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixBasketComponent $component */
$curPage = $APPLICATION->GetCurPage().'?'.$arParams["ACTION_VARIABLE"].'=';
$arUrls = array(
	"delete" => $curPage."delete&id=#ID#",
	"delay" => $curPage."delay&id=#ID#",
	"add" => $curPage."add&id=#ID#",
);
unset($curPage);

$arBasketJSParams = array(
	'SALE_DELETE' => GetMessage("SALE_DELETE"),
	'SALE_DELAY' => GetMessage("SALE_DELAY"),
	'SALE_TYPE' => GetMessage("SALE_TYPE"),
	'TEMPLATE_FOLDER' => $templateFolder,
	'DELETE_URL' => $arUrls["delete"],
	'DELAY_URL' => $arUrls["delay"],
	'ADD_URL' => $arUrls["add"]
);
?>
<script type="text/javascript">
	var basketJSParams = <?=CUtil::PhpToJSObject($arBasketJSParams);?>
</script>
<?
$APPLICATION->AddHeadScript($templateFolder."/script.js");

if (strlen($arResult["ERROR_MESSAGE"]) <= 0)
{
	?>
	<div id="warning_message">
		<?
		if (!empty($arResult["WARNING_MESSAGE"]) && is_array($arResult["WARNING_MESSAGE"]))
		{
			foreach ($arResult["WARNING_MESSAGE"] as $v)
				ShowError($v);
		}
		?>
	</div>
	<?

	$normalCount = count($arResult["ITEMS"]["AnDelCanBuy"]);
	$normalHidden = ($normalCount == 0) ? 'style="display:none;"' : '';

	$delayCount = count($arResult["ITEMS"]["DelDelCanBuy"]);
	$delayHidden = ($delayCount == 0) ? 'style="display:none;"' : '';

	$subscribeCount = count($arResult["ITEMS"]["ProdSubscribe"]);
	$subscribeHidden = ($subscribeCount == 0) ? 'style="display:none;"' : '';

	$naCount = count($arResult["ITEMS"]["nAnCanBuy"]);
	$naHidden = ($naCount == 0) ? 'style="display:none;"' : '';

	?>
<?if ($arResult["allSum"] < 3000):?>
<span><style>.bx_ordercart_order_pay_center { display: none; }</style></span>
<?endif?>
<div class="rodobwna" <?if ($arResult["allSum"] >= 3000):?>style="display:none;"<?endif?>>
<p class="min-order">Оформление заказа возможно после наполнения корзины на сумму более 3 000 рублей.</p>	
	<ul class="reorder-info">
				<li><a href="#" onclick="history.back();">Продолжить покупки</a></li>
				<li class="reorder"><a href="/personal/order/make/">Это дозаказ</a></li>
	</ul>
</div>

		<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="basket_form" id="basket_form">
			<div id="basket_form_container">
				<div class="bx_ordercart">
					<div class="bx_sort_container">
						<span><?=GetMessage("SALE_ITEMS")?></span>
						<a href="javascript:void(0)" id="basket_toolbar_button" class="current" onclick="showBasketItemsList()"><?=GetMessage("SALE_BASKET_ITEMS")?><div id="normal_count" class="flat" style="display:none">&nbsp;(<?=$normalCount?>)</div></a>

						<?if($_GET['favorite']!='true'){?>	
							<a href="javascript:void(0)" id="basket_toolbar_button_delayed" onclick="showBasketItemsList(2)" <?=$delayHidden?>><?=GetMessage("SALE_BASKET_ITEMS_DELAYED")?><div id="delay_count" class="flat">&nbsp;(<?=$delayCount?>)</div></a>
						<?}else{?>
							<a href="javascript:void(0)" class="current" id="basket_toolbar_button_delayed" onclick="showBasketItemsList(2)" <?=$delayHidden?>><?=GetMessage("SALE_BASKET_ITEMS_DELAYED")?><div id="delay_count" class="flat">&nbsp;(<?=$delayCount?>)</div></a>
							<script>
								$(document).ready(function(){
									console.log('Отображаем отложенные');
									$('#basket_items_delayed').css({'display':'block'});
								});
							</script>
						<?}?>

						<a href="javascript:void(0)" id="basket_toolbar_button_subscribed" onclick="showBasketItemsList(3)" <?=$subscribeHidden?>><?=GetMessage("SALE_BASKET_ITEMS_SUBSCRIBED")?><div id="subscribe_count" class="flat">&nbsp;(<?=$subscribeCount?>)</div></a>
						<a href="javascript:void(0)" id="basket_toolbar_button_not_available" onclick="showBasketItemsList(4)" <?=$naHidden?>><?=GetMessage("SALE_BASKET_ITEMS_NOT_AVAILABLE")?><div id="not_available_count" class="flat">&nbsp;(<?=$naCount?>)</div></a>
					</div>
					<?
					include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items.php");
					include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items_delayed.php");
					include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items_subscribed.php");
					include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items_not_available.php");
					?>
				</div>
			</div>
			<input type="hidden" name="BasketOrder" value="BasketOrder" />
			<!-- <input type="hidden" name="ajax_post" id="ajax_post" value="Y"> -->
<a href="javascript:history.go(-1)" onclick="history.back()"><img alt="Назад" float:="" right="" src="/bitrix/templates/eshop_adapt_blue/images/prodol.jpg" style="float: right; margin-left: 10px; margin-right: 21px;"></a>
<p><b><font color="#FF0000">Внимание:</font></b></p>
<p><b style="color: #333333; font-family: arial;">Минимальная сумма заказа в нашем интернет-магазине составляет 3.000 рублей</b></p>
<p align="justify" style="color: #333333; font-family: arial;">Но если Вы уже являетесь нашим клиентом (покупали плитку у нас), то Вы сможете докупить плитку <ul class="reorder-info"><li class="reorder"><a href="/personal/order/make/">Это дозаказ</a></li></ul> к предыдущему заказу у нас, если Вам не хватило плитки по различным причинам. Для этого Вам достаточно предъявить чек или сказать номер Вашего предыдущего заказа.</p>
<p align="justify" style="color: #333333; font-family: arial;">
<b style="color: #333333; font-family: arial;">
Стоимость доставки определяется менеджером при оформлении заказа
</b>
</p>
<p>
Стоимость доставки плитки зависит от пункта назначения, веса и объема заказа. Стоимость доставки плитки по Москве может варьироваться в зависимости от удаленности от нашего склада (район метро "Рязанский проспект") и может составлять от 800 до 1500 руб.
Стоимость доставки плитки внутри 3-го транспортного кольца составляет 1800 руб.
За пределами МКАД доставка плитки стоит 35 руб за 1 км расстояния от МКАД плюс 1800 руб
</p>
<p>
<b>Бесплатная доставка</b>
</p>
<p>
Если в Вашем заказе присутствует товар, отмеченный мигающим стикером "Бесплатная доставка", на сумму от 15 000 рублей, мы осуществим бесплатную доставку в пределах МКАД.
</p>
<p><a href="/content/dostavka-plitki-i-keramogranita-po-moskve-i-rossii/">Больше информации о доставке по этой ссылке</a></p>
		</form>
	<?
}
else
{
	ShowError($arResult["ERROR_MESSAGE"]);
}
?>