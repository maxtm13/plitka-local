<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

//получим ключи пунктов, которые надо отображать на мобильном
$arMobileShowKey = [];
for($i = count($arResult) - 1; $i >= 0; $i--) {
    if (!empty($arResult[$i]['LINK'])) {
        if (count($arMobileShowKey) < 2) {
            $arMobileShowKey[] = $i;
        } else {
            break;
        }
    }
}
sort($arMobileShowKey);

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()
$css = $APPLICATION->GetCSSArray();
if(!is_array($css) || !in_array("/bitrix/css/main/font-awesome.css", $css))
{
	$strReturn .= '<link href="'.CUtil::GetAdditionalFileURL("/bitrix/css/main/font-awesome.css").'" type="text/css" rel="stylesheet" />'."\n";
}

$strReturn .= '<div class="bx-breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
    $hideCls = '';
    if (in_array($index, $arMobileShowKey) && $index == $arMobileShowKey[0]) {
        $hideCls = ' mobileHide';
    }
	$arrow = ($index > 0? '<i class="fa fa-angle-right'.$hideCls.'"></i>' : '');

	$hideCls = '';
	if (!in_array($index, $arMobileShowKey)) {
	    $hideCls = ' mobileHide';
    }
	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{

		$strReturn .= '
			<div class="bx-breadcrumb-item'.$hideCls.'" id="bx_breadcrumb_'.$index.'" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				'.$arrow.'
				<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item">
					<span itemprop="name">'.$title.'</span>
				</a>
				<meta itemprop="position" content="'.($index + 1).'" />
			</div>';
	}
	else
	{
		$strReturn .= '
			<div class="bx-breadcrumb-item'.$hideCls.'">
				'.$arrow.'
				<span>'.$title.'</span>
			</div>';
	}
}

$strReturn .= '<div style="clear:both"></div></div>';

return $strReturn;
