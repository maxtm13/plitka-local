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

$strReturn .= '<div class="bx-breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{

	if($arResult[$index]["LINK"] == "/santekhnika/brand/") {continue;}
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	//$arrow = '<span class="row-right"><svg width="7" height="7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z"/></svg></span>';
	if($index > 0) {
		$arrow = '<span class="row-right"><svg width="7" height="7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z"/></svg></span>';
	} else {
		$arrow = '';
	}

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '<div class="bx-breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

		$strReturn .= $arrow; 
		$strReturn .= '<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item">';
		$strReturn .= '<span itemprop="name">';
		$strReturn .= $title;
		$strReturn .= '</span>';
		$strReturn .= '<meta itemprop="position" content="'.($index + 1).'" /></a></div>';
	}
	else
	{
		$strReturn .= '
			<div class="bx-breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><link href="'.$APPLICATION->GetCurPage(false).'" itemprop="item">
				'.$arrow.'
				<span itemprop="name" class="bx-breadcrumb-item-grey">'.$title.'</span><meta itemprop="position" content="'.($index + 1).'" />
			</div>';
	}
	
}

$strReturn .= '<div style="clear:both"></div></div>';

return $strReturn;
