<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?> 

<?/*echo "<pre>";?>
<? print_r($arResult["ITEMS"]);?>
<?echo "</pre>";*/
$IBLOCK_ID = 4;
?>
<?foreach($arResult["ITEMS"] as $cell=>$arElement):
	$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));

	$arSelect = Array("ID", "NAME","IBLOCK_SECTION_ID", "DATE_ACTIVE_FROM", "");
      $arFilter = Array("ID" => $arElement['ID'], "IBLOCK_ID"=>4, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","INCLUDE_SUBSECTIONS" => "Y");
      $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
      while($ob = $res->GetNextElement()) {
         
         $arFields = $ob->GetFields();
         
		$res = CIBlockSection::GetByID($arFields['IBLOCK_SECTION_ID']);
		if($ar_res = $res->GetNext()){
  			$ar_res['NAME'];
  			//echo $ar_res['PICTURE'];
  			$picture = CFile::ResizeImageGet($ar_res['PICTURE'], array('width'=>300, 'height'=>600), BX_RESIZE_IMAGE_PROPORTIONAL); //CFile::GetPath($ar_res['PICTURE']);

  			?>
			<div class="collection">
  				<div class="colection-title"><a href="<? echo $ar_res['SECTION_PAGE_URL']?>"><? echo $ar_res['NAME']; ?></a></div>
  				<div class="collection-image">
  					<a href="<? echo $ar_res['SECTION_PAGE_URL']?>"><img src="<?echo $picture['src'];?>" alt="<? echo $ar_res['NAME']; ?>" /></a>
				
  				</div>
  				<div class="collection-price">
				<div class="collection-price-old">
  					Старая цена: <? echo round(1.3*$arElement['PRICES']['BASE']['VALUE']);
					?></div>
					Цена: <? echo $arElement['PRICES']['BASE']['PRINT_DISCOUNT_VALUE_VAT']; ?>
  					<a href="<? echo $ar_res['SECTION_PAGE_URL']?>"><img src="/bitrix/templates/eshop_adapt_blue/images/bt-orange-buy.png" alt="купить" /></a>
  				</div>
			</div>
  		<?

  			//echo "<pre>";print_r($arResult["ITEMS"]);echo "</pre>";
  		}
  	}	
endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

