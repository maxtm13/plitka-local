<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$exDir = explode("/",$_SERVER['REQUEST_URI']);

if(count($exDir)>3){
	define("ERROR_404", "Y");
	\Bitrix\Iblock\Component\Tools::process404('Страница Не найдена', true, true, true, false);
}else{
//	$APPLICATION->SetPageProperty("description", "Отличная возможность приобрести декоративную керамическую плитку мозаику (mozaika) для пола, стен по лучшей стоимости за м2 в интернет магазине plitkanadom с доставкой по Москве и в Регионы
//	");
	// $APPLICATION->SetPageProperty("keywords", "коллекции керамической плитки");
//	$APPLICATION->SetPageProperty("title", "Плитка Мозаика (Для Ванной, Кухни) Купить По Лучшим Ценам В Москве!");
//	$APPLICATION->SetTitle("Плитка мозаика для ванной и кухни");
//	$APPLICATION->AddChainItem('Мозаика');
//	$APPLICATION->SetCurPage("/collections/mozaika");
	//$GLOBALS['arrFilter'] = array("DEPTH_LEVEL" => 3, "PROPERTY_45" => 27);
	$GLOBALS['arrFilter']['DEPTH_LEVEL'] = 3;
	$GLOBALS['arrFilter']["PROPERTY_45"] = 27;

if($_SESSION["SORT_VS_COUNT"]){
	$sess = unserialize($_SESSION["SORT_VS_COUNT"]);
}	
	
//	$getPage = $APPLICATION->GetCurPage();
//	$_SERVER["REQUEST_URI"] = $getPage;

	$arSPagen = $APPLICATION->IncludeComponent(
		"omniweb:catalog.section.list",
		"section-list-catalog",
		Array(
			"ADD_SECTIONS_CHAIN" => "N",
			"CACHE_GROUPS" => "N",
			"CACHE_TIME" => "360000",
			"CACHE_TYPE" => "A",
			"COUNT_ELEMENTS" => "N",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"FILTER_NAME" => "arrFilter",
			"FILTER_SORT_PANEL" => "Y",
			"HIDE_SECTION_NAME" => "N",
			"IBLOCK_ID" => "4",
			"IBLOCK_TYPE" => "catalog",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "arrows",
			"PAGER_TITLE" => "Разделы",
			"SECTION_CODE" => "",
			"SECTION_COUNT" => "40",
			"SECTION_FIELDS" => array("",""),
			"SECTION_ID" => "",
			"SECTION_URL" => "",
			"SECTION_USER_FIELDS" => array("UF_HEADER","UF_MORO_PHOTO","UF_82",'UF_91','UF_92','UF_ASSIGN','UF_ASSIGN_ONLY','UF_CATALOG_PRICE_1','UF_AVAILABILITY','UF_TOPTEXT'),
			"SHOW_PARENT_NAME" => "N",
			"TOP_DEPTH" => "3",
			"VIEW_MODE" => "TILE",
		//	  'RBS_SORT' => $rbs_sort,
			"COLLECII" => "Y",
				"SORT_BY" => ($sess["sort"]["type"] ? $sess["sort"]["type"] : "UF_HIT"),
			 "SORT_ORDER" => ($sess["sort"]["order"] ? $sess["sort"]["order"] : "DESC"),
			 "IN_PAGE" => ($sess["inpage"] ? $sess["inpage"] : "40"),
			 "PAGE" => ($_SERVER["REDIRECT_URL"] ?? $_SERVER["REQUEST_URI"]),
			  	"PAGEN" => ($_REQUEST['PAGEN_2'] ? $_REQUEST['PAGEN_2'] : $_REQUEST['PAGEN_1']),
			  "YEAR" => date('Y',strtotime(date("Y").'-01-01 -1year')),
		)
	);?> <?if(!isset($_REQUEST['PAGEN_'.$arSPagen['NavNum']]) || $_REQUEST['PAGEN_'.$arSPagen['NavNum']] == 1):?>
	<?php /* if ($getPage === '/collections/mozaika') { ?>
	<div class="imgtim2">
		 <p>Предлагаем вашему вниманию самый оригинальный материал для оформления стен и пола в ванной или на кухне &mdash; мозаику в огромном ассортименте видов и классов. Мы собрали все популярные типы этого удивительного отделочного материала, который открывает горизонты для экспериментов в интерьерном дизайне.</p>
		 <p>Здесь вы найдете как оригинальную плитку на стены в ванной или кухне (рабочая зона, облицовка по периметру), так и эффектный материал для декора пола.</p>
		 <p>Мозаичная керамика &mdash; это не просто популярный способ облицовки пола или стен, с ней любое помещение заиграет новыми красками. При этом настенная с матовой, полуматовой, стеклянной глазурованной или полированной глянцевой поверхностью прекрасно моется и не боится химического воздействия.</p>
		 <p>Мелкая напольная керамика может принимать практически любые формы &mdash; художественного панно, декоративных вставок, элементов единой композиции. Стандартных или больших размеров, она прекрасно выдерживает механические нагрузки, может иметь рельефную поверхность (противоскользящий эффект) и окрашиваться в любые цвета.</p>
		 <h3>Доставка по Москве</h3>
		 <p>В нашем интернет-магазине можно купить оригинальную брендовую плитку по самой выгодной цене за 1 м2. В ассортименте &mdash; коллекции от признанных производителей более чем из 25 стран мира, включая Россию, Беларусь, Италию, Польшу.</p>
		 <p>Для тех, кто хочет поэкспериментировать с необычными комбинациями, мы создали бесплатный онлайн-сервис 3D-дизайна. Обязательно воспользуйтесь им, чтобы попробовать себя в роли дизайнера, ведь с таким отделочным материалом можно создать настоящее произведение художественного искусства в интерьере.</p>
		 <img width="25%" alt="1.jpg" src="/upload/medialibrary/e49/1.jpg" height="auto" title="1.jpg" style="display: block;" padding-right="10px"><br>
	</div>
	<? } */ ?>
<? endif;
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>