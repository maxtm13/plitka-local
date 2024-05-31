<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;
$aMenuLinksExt = array();

if(CModule::IncludeModule('iblock'))
{
	$arFilter = array(
		"TYPE" => "catalog",
		"SITE_ID" => SITE_ID,
	);

	$dbIBlock = CIBlock::GetList(array('SORT' => 'ASC', 'ID' => 'ASC'), $arFilter);
	$dbIBlock = new CIBlockResult($dbIBlock);

	if ($arIBlock = $dbIBlock->GetNext())
	{
		if(defined("BX_COMP_MANAGED_CACHE"))
			$GLOBALS["CACHE_MANAGER"]->RegisterTag("iblock_id_".$arIBlock["ID"]);

		if($arIBlock["ACTIVE"] == "Y")
		{
			/*---bgn 2017-08-07---*/
			if (file_exists($_SERVER['DOCUMENT_ROOT'].'/left_menu_tile.dat') && $arIBlock['ID'] == CATALOG_ID) {
				$aMenuLinksExt = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/left_menu_tile.dat');
				$aMenuLinksExt = unserialize($aMenuLinksExt);
			} else {
			/*---end 2017-08-07---*/
				$aMenuLinksExt = $APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
					"IS_SEF" => "Y",
					"SEF_BASE_URL" => "",
					"SECTION_PAGE_URL" => $arIBlock['SECTION_PAGE_URL'],
					"DETAIL_PAGE_URL" => $arIBlock['DETAIL_PAGE_URL'],
					"IBLOCK_TYPE" => $arIBlock['IBLOCK_TYPE_ID'],
					"IBLOCK_ID" => $arIBlock['ID'],
					"DEPTH_LEVEL" => "2",
					"CACHE_TYPE" => "Y",
				), false, Array('HIDE_ICONS' => 'Y'));
			/*---bgn 2017-08-07---*/
				if ($arIBlock['ID'] == CATALOG_ID) {
					file_put_contents($_SERVER['DOCUMENT_ROOT'].'/left_menu_tile.dat', serialize($aMenuLinksExt));
				}
			}
			/*---end 2017-08-07---*/
		}
	}

	if(defined("BX_COMP_MANAGED_CACHE"))
		$GLOBALS["CACHE_MANAGER"]->RegisterTag("iblock_id_new");
}

$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
?>
