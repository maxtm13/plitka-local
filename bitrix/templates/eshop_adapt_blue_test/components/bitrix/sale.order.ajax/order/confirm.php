<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if (!empty($arResult["ORDER"]))
{
	?>
	<b><?=GetMessage("SOA_TEMPL_ORDER_COMPLETE")?></b><br /><br />
	<table class="sale_order_full_table">
		<tr>
			<td>
				<?= GetMessage("SOA_TEMPL_ORDER_SUC", Array("#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"], "#ORDER_ID#" => $arResult["ORDER"]["ACCOUNT_NUMBER"]))?>
				<br /><br />
				<?= GetMessage("SOA_TEMPL_ORDER_SUC1", Array("#LINK#" => $arParams["PATH_TO_PERSONAL"])) ?>
				<? $arProducts = array();

$productsData = array();

$basketItems = array();

$dbBasket = CSaleBasket::GetList(array("NAME" => "ASC"),array("ORDER_ID" => $arResult['ORDER_ID'], "ACTIVE" => 'Y'));      

while ($arBasket = $dbBasket->Fetch())
{   
   $arProducts[$arBasket['ID']] = array(
      'ID' => $arBasket['ID'],
      'PRODUCT_ID' => $arBasket['PRODUCT_ID'],
      'NAME' => $arBasket['NAME'],
      'PRICE' => $arBasket['PRICE'],
      'QUANTITY' => $arBasket['QUANTITY'],
      'DETAIL_PAGE_URL' => $arBasket['DETAIL_PAGE_URL'],
   );

   $basketItems[] = $arBasket['PRODUCT_ID'];
}

$resProducts = \CIBlockElement::GetList(
    array(),
    array(
        'ID' => array_unique($basketItems)
    ),
    false,
    false,
    array(
        'ID',
        'IBLOCK_ID',
        'IBLOCK_SECTION_ID',
    )
);

while ($arProduct = $resProducts->Fetch()) {

    $cat='';
    $depth=9;
    $catid=$arProduct['IBLOCK_SECTION_ID'];
    do{
    $res = CIBlockSection::GetByID($catid);
    if($ar_res = $res->GetNext()){
        if($depth!=9){
        $cat='/'.$cat;
        }
        $cat=$ar_res['NAME'].$cat;
        $depth=$ar_res['DEPTH_LEVEL'];
        $catid=$ar_res['IBLOCK_SECTION_ID'];
        $inid=$ar_res['IBLOCK_ID'];
    }  
    }
    while($depth>1);

    $res1 = CIBlock::GetByID($inid);
    if($ar_res1 = $res1->GetNext()){
      $cat=$ar_res1['NAME'].'/'.$cat;
    }

    $arProduct['SECTION_NAME']=$cat;    
    $productsData[$arProduct['ID']] = $arProduct;
}

?>
<!--script>
var dataLayer = [{
	"ecommerce": {
        "purchase": {
            "actionField": {
   id: "<?=$arResult['ORDER_ID']?>",
   price: <?=intval($arResult["ORDER"]['PRICE'])?>, 
   currency: "RUR",
   exchange_rate: 1, },
   products: 
   [
      <?foreach($arProducts as $products){?>
      {
         id: "<?=intval($products['PRODUCT_ID'])?>", 
         name: "<?=$products['NAME']?>", 
         price: <?=intval($products['PRICE'])?>,
		 brand: <?=intval($products['PRICE'])?>,
		 category: "<?=$products['DETAIL_PAGE_URL']?>",
         quantity: <?=intval($products['QUANTITY'])?>
      }, 
      <?}?>
      {
         id: "0",
         name: "Доставка",
         price: <?=intval($arResult["ORDER"]["PRICE_DELIVERY"])?>,
         quantity: 1
      }
   ]
}}
   }];
</script-->

<?if ($USER->IsAdmin()):?> 

<? //echo "<pre>"; print_r($arBasket); echo "</pre>";?>
<? echo $arBasket['DETAIL_PAGE_URL']; ?>
<? echo $products['PARENT_SECTION_INFO']['NAME']; ?>
<?endif?>

<script>
dataLayer.push({
  'ecommerce': {
    'purchase': {
      'actionField': {
        'id': '<?=$arResult['ORDER_ID']?>',                         // Transaction ID. Required for purchases and refunds.
        'affiliation': 'Online Store',
        'revenue': '<?=intval($arResult["ORDER"]['PRICE'])?>'                     // Total transaction value (incl. tax and shipping)
      },
      'products': // List of productFieldObjects.
	  [
	  <?foreach($arProducts as $products){?> 
	  {                            
        'name': '<?=$products['NAME']?>',     // Name or ID is required.
        'id': '<?=intval($products['PRODUCT_ID'])?>',
        'price': '<?=intval($products['PRICE'])?>',
        'brand': '',
        'category': '<?=$productsData[$products['PRODUCT_ID']]['SECTION_NAME']?>',
        'variant': '',
        'quantity': <?=intval($products['QUANTITY'])?>,
        'coupon': ''                            // Optional fields may be omitted or set to empty string.
       }, <?}?> ]
    }
  }
});
</script>

			</td>
		</tr>
	</table>
	<?
	if (!empty($arResult["PAY_SYSTEM"]))
	{
		?>
		<br /><br />

		<table class="sale_order_full_table">
			<tr>
				<td class="ps_logo">
					<div class="pay_name"><?=GetMessage("SOA_TEMPL_PAY")?></div>
					<?=CFile::ShowImage($arResult["PAY_SYSTEM"]["LOGOTIP"], 100, 100, "border=0", "", false);?>
					<div class="paysystem_name"><?= $arResult["PAY_SYSTEM"]["NAME"] ?></div><br>
				</td>
			</tr>
			<?
			if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0)
			{
				?>
				<tr>
					<td>
						<?
						if ($arResult["PAY_SYSTEM"]["NEW_WINDOW"] == "Y")
						{
							?>
							<script language="JavaScript">
								window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))?>');
							</script>
							<?= GetMessage("SOA_TEMPL_PAY_LINK", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))))?>
							<?
							if (CSalePdf::isPdfAvailable() && CSalePaySystemsHelper::isPSActionAffordPdf($arResult['PAY_SYSTEM']['ACTION_FILE']))
							{
								?><br />
								<?= GetMessage("SOA_TEMPL_PAY_PDF", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))."&pdf=1&DOWNLOAD=Y")) ?>
								<?
							}
						}
						else
						{
							if (strlen($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"])>0)
							{
								include($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"]);
							}
						}
						?>
					</td>
				</tr>
				<?
			}
			?>
		</table>
		<?
	}
}
else
{
	?>
	<b><?=GetMessage("SOA_TEMPL_ERROR_ORDER")?></b><br /><br />

	<table class="sale_order_full_table">
		<tr>
			<td>
				<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST", Array("#ORDER_ID#" => $arResult["ACCOUNT_NUMBER"]))?>
				<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST1")?>
			</td>
		</tr>
	</table>
	<?
}
?>
