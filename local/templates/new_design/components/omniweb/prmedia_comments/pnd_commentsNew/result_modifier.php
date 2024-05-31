<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
if ($APPLICATION->GetCurPage(true) == '/index.php') {
	/*добавляем страницу к заголовку браузера и в описание,
	добавляем canonical*/
	$getParamPagen = 0;
	$getParamPagenName = '';
	$resultPagenName = 'PAGEN_'.$arResult['NAV_RESULT']->NavNum;
	$pagenPrev = 0;
	$pagenNext = 0;
	if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
		$http = $_SERVER['HTTP_X_FORWARDED_PROTO'];
	} else {
		$http = !empty($_SERVER['HTTPS']) ? "https" : "http";
	}
	$canonical = $http.'://'.SITE_SERVER_NAME.$APPLICATION->GetCurPage();
	//canonical
	$APPLICATION->AddHeadString('<link rel="canonical" href="'.$canonical.'" />', true);
	foreach($_GET as $getParamKey=>$getParamVal) {
		if (substr_count($getParamKey, 'PAGEN_') != 0) {
			$getParamPagen = $getParamVal;
			$getParamPagenName = $getParamKey;
			$pagenPrev = $getParamVal - 1;
			$pagenNext = $getParamVal + 1;
		}
	}
	if ($getParamPagen > 1) {
		$pagen = 'Страница '.$getParamPagen.'. ';
		//заголовок браузера
		$page_prop = $pagen.$APPLICATION->GetProperty('title');
		$APPLICATION->SetPageProperty('title', $page_prop);
		//описание
		$page_prop = $pagen.$APPLICATION->GetProperty('description');
		$APPLICATION->SetPageProperty('description', $page_prop);
		if ($resultPagenName == $getParamPagenName) { //был переход
			if ($getParamPagen == 2) {
				$APPLICATION->AddHeadString('<link rel="prev" href="'.$canonical.'" />', true);
			} else {
				$APPLICATION->AddHeadString('<link rel="prev" href="'.$canonical.'?'.$getParamPagenName.'='.$pagenPrev.'" />', true);
			}
			if ($getParamPagen < $arResult['NAV_RESULT']->NavPageCount) { //если тек. страница меньше кол-ва страниц
				$APPLICATION->AddHeadString('<link rel="next" href="'.$canonical.'?'.$getParamPagenName.'='.$pagenNext.'" />', true);
			}
		}
	} else {
		if ($arResult['NAV_RESULT']->NavPageCount > 1) {
			$APPLICATION->AddHeadString('<link rel="next" href="'.$canonical.'?'.$resultPagenName.'=2" />', true);
		}
	}
}
?>