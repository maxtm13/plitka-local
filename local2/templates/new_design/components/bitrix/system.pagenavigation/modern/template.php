<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

global $pagefileter, $isnice;

$question = "?";

if(!empty($pagefileter)){
	
	$needurl = $_SERVER["REDIRECT_URL"];
	
	unset($pagefileter["page"], $pagefileter["clear_cache"], $pagefileter["CODE"]);
	
	$i = 0;
	foreach($pagefileter as $k=>$val){
	//	if(empty($isnice[$k])){ //открывает ещё больше глюков с фильтром которых не заметно изначально
			$i++;
			$needurl = $needurl.($i==1 ? '?' : '&').$k.'='.$val;
	//	}
	}
	
	unset($arResult["NavQueryString"]);
	
	$arResult["sUrlPath"] = $needurl;
	if($i > 0){
		$question = '&';
	}
}

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}
?>
<div class="modern-page-navigation">
<?

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? $question.$arResult["NavQueryString"] : "");
?>
	<span class="modern-page-title"><?=GetMessage("pages")?></span>
<?
if($arResult["bDescPageNumbering"] === true):
	$bFirst = true;
	if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
		if($arResult["bSavePage"]):
?>
			
			<a class="modern-page-previous" href="<?=$arResult["sUrlPath"]?><?=$question;?><?=$strNavQueryString?>page=<?=($arResult["NavPageNomer"]+1)?>"><?=GetMessage("nav_prev")?></a>
<?
		else:
			if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):
?>
			<a class="modern-page-previous" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_prev")?></a>
<?
			else:
?>
			<a class="modern-page-previous" href="<?=$arResult["sUrlPath"]?><?=$question;?><?=$strNavQueryString?>page=<?=($arResult["NavPageNomer"]+1)?>"><?=GetMessage("nav_prev")?></a>
<?
			endif;
		endif;
		
		if ($arResult["nStartPage"] < $arResult["NavPageCount"]):
			$bFirst = false;
			if($arResult["bSavePage"]):
?>
			<a class="modern-page-first" href="<?=$arResult["sUrlPath"]?><?=$question;?><?=$strNavQueryString?>page=<?=$arResult["NavPageCount"]?>">1</a>
<?
			else:
?>
			<a class="modern-page-first" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a>
<?
			endif;
			if ($arResult["nStartPage"] < ($arResult["NavPageCount"] - 1)):
/*?>
			<span class="modern-page-dots">...</span>
<?*/
?>	
			<a class="modern-page-dots" href="<?=$arResult["sUrlPath"]?><?=$question;?><?=$strNavQueryString?>page=<?=intval($arResult["nStartPage"] + ($arResult["NavPageCount"] - $arResult["nStartPage"]) / 2)?>">...</a>
<?
			endif;
		endif;
	endif;
	do
	{
		$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;
		
		if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
?>
		<span class="<?=($bFirst ? "modern-page-first " : "")?>modern-page-current"><?=$NavRecordGroupPrint?></span>
<?
		elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):
?>
		<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="<?=($bFirst ? "modern-page-first" : "")?>"><?=$NavRecordGroupPrint?></a>
<?
		else:
?>
		<a href="<?=$arResult["sUrlPath"]?><?=$question;?><?=$strNavQueryString?>page=<?=$arResult["nStartPage"]?>"<?
			?> class="<?=($bFirst ? "modern-page-first" : "")?>"><?=$NavRecordGroupPrint?></a>
<?
		endif;
		
		$arResult["nStartPage"]--;
		$bFirst = false;
	} while($arResult["nStartPage"] >= $arResult["nEndPage"]);
	
	if ($arResult["NavPageNomer"] > 1):
		if ($arResult["nEndPage"] > 1):
			if ($arResult["nEndPage"] > 2):
/*?>
		<span class="modern-page-dots">...</span>
<?*/
?>
		<a class="modern-page-dots" href="<?=$arResult["sUrlPath"]?><?=$question;?><?=$strNavQueryString?>page=<?=round($arResult["nEndPage"] / 2)?>">...</a>
<?
			endif;
?>
		<a href="<?=$arResult["sUrlPath"]?><?=$question;?><?=$strNavQueryString?>page=1"><?=$arResult["NavPageCount"]?></a>
<?
		endif;
	
?>
		<a class="modern-page-next"href="<?=$arResult["sUrlPath"]?><?=$question;?><?=$strNavQueryString?>page=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("nav_next")?></a>
<?
	endif; 

else:
	$bFirst = true;

	if ($arResult["NavPageNomer"] > 1):
		if($arResult["bSavePage"]):
?>
			<a class="modern-page-previous" href="<?=$arResult["sUrlPath"]?><?=$question;?><?=$strNavQueryString?>page=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("nav_prev")?></a>
<?
		else:
			if ($arResult["NavPageNomer"] > 2):
?>
			<a class="modern-page-previous" href="<?=$arResult["sUrlPath"]?><?=$question;?><?=$strNavQueryString?>page=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("nav_prev")?></a>
<?
			else:
?>
			<a class="modern-page-previous" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_prev")?></a>
<?
			endif;
		
		endif;
		
		if ($arResult["nStartPage"] > 1):
			$bFirst = false;
			if($arResult["bSavePage"]):
?>
			<a class="modern-page-first" href="<?=$arResult["sUrlPath"]?><?=$question;?><?=$strNavQueryString?>page=1">1</a>
<?
			else:
?>
			<a class="modern-page-first" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a>
<?
			endif;
			if ($arResult["nStartPage"] > 2):
/*?>
			<span class="modern-page-dots">...</span>
<?*/
?>
			<a class="modern-page-dots" href="<?=$arResult["sUrlPath"]?><?=$question;?><?=$strNavQueryString?>page=<?=round($arResult["nStartPage"] / 2)?>">...</a>
<?
			endif;
		endif;
	endif;

	do
	{
		if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
?>
		<span class="<?=($bFirst ? "modern-page-first " : "")?>modern-page-current"><?=$arResult["nStartPage"]?></span>
<?
		elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):
?>
		<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="<?=($bFirst ? "modern-page-first" : "")?>"><?=$arResult["nStartPage"]?></a>
<?
		else:
?>
		<a href="<?=$arResult["sUrlPath"]?><?=$question;?><?=$strNavQueryString?>page=<?=$arResult["nStartPage"]?>"<?
			?> class="<?=($bFirst ? "modern-page-first" : "")?>"><?=$arResult["nStartPage"]?></a>
<?
		endif;
		$arResult["nStartPage"]++;
		$bFirst = false;
	} while($arResult["nStartPage"] <= $arResult["nEndPage"]);
	
	if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
		if ($arResult["nEndPage"] < $arResult["NavPageCount"]):
			if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)):
/*?>
		<span class="modern-page-dots">...</span>
<?*/
?>
		<a class="modern-page-dots" href="<?=$arResult["sUrlPath"]?><?=$question;?><?=$strNavQueryString?>page=<?=round($arResult["nEndPage"] + ($arResult["NavPageCount"] - $arResult["nEndPage"]) / 2)?>">...</a>
<?
			endif;
?>
		<a href="<?=$arResult["sUrlPath"]?><?=$question;?><?=$strNavQueryString?>page=<?=$arResult["NavPageCount"]?>"><?=$arResult["NavPageCount"]?></a>
<?
		endif;
?>
		<a class="modern-page-next" href="<?=$arResult["sUrlPath"]?><?=$question;?><?=$strNavQueryString?>page=<?=($arResult["NavPageNomer"]+1)?>"><?=GetMessage("nav_next")?></a>
<?
	endif;
endif;

if ($arResult["bShowAll"]):
	if ($arResult["NavShowAll"]):
?>
		<a class="modern-page-pagen" href="<?=$arResult["sUrlPath"]?><?=$question;?><?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0"><?=GetMessage("nav_paged")?></a>
<?
	else:
?>
		<a class="modern-page-all" href="<?=$arResult["sUrlPath"]?><?=$question;?><?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1"><?=GetMessage("nav_all")?></a>
<?
	endif;
endif
?>
</div>