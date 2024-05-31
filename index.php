<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
    <br><br>
<?
$APPLICATION->SetPageProperty("title", "Интернет-магазин керамической плитки, керамогранита и сантехники - «ПлиткаНаДом»");
$APPLICATION->SetPageProperty("description", "Более 350 000 наименований керамической плитки, керамогранита, мозаики, сантехники и напольных покрытий. Опыт работы с 2002 года. Собственный шоу-рум. Доставка по всей России.");
$APPLICATION->SetTitle("«Плитка на дом» — онлайн-гипермаркет плитки, керамогранита и сантехники");
global $checkdate, $usergropus, $checktime, $ccurency;
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.line",
	"main_banner",
	Array(
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "A",
		"FIELD_CODE" => ["NAME","DETAIL_PICTURE","PREVIEW_PICTURE","PROPERTY_URL_SLIDER"],
		"IBLOCKS" => [MAIN_BANNERS],
		"IBLOCK_TYPE" => "services",
		"IS_TITLE" => "h3",
		"NEWS_COUNT" => "11",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?>
<div class="bennefits">
	<div class="bennefits-top">
		<div class="item" data-title="Мы работаем по схеме мелкооптовой компании, поэтому цены у нас значительно ниже, чем в рознице.">
			<div class="icon icon-header-1 sr-icon">
			</div>
 <br>
 <span class="text">Гарантированно низкие цены!</span>
		</div>
		<div class="item" data-title="Мы работаем 24 часа в сутки 7 дней в неделю!.">
			<div class="icon icon-header-2 sr-icon">
			</div>
 <br>
 <span class="text">Работаем 24/7</span>
		</div>
		<div class="item" data-title="Вы оплачиваете заказ при получении товара.">
			<div class="icon icon-header-3 sr-icon">
			</div>
 <br>
 <span class="text">Мы работаем без предоплаты!</span>
		</div>
		<div class="item" data-title="Возможность дозаказать плитку, если Вам не хватило несколько штук!">
			<div class="icon icon-header-4 sr-icon">
			</div>
 <br>
 <span class="text">Дозаказ плитки</span>
		</div>
	</div>
	<div class="bennefits-bot">
		<div class="item" data-title="Более 350 000 наименований единиц товара.">
			<div class="icon icon-header-5 sr-icon">
			</div>
 <br>
 <span class="text">Огромный ассортимент товара</span>
		</div>
		<div class="item" data-title="У нас можно получить скидки на товары, которые отмечены стикером «%».">
			<div class="icon icon-header-6 sr-icon">
			</div>
 <br>
 <span class="text">Постоянные скидки!</span>
		</div>
		<div class="item" data-title="Опыт работы в продаже плитки, керамогранита, мозаики, напольных покрытий и сантехники - более 19 лет!">
			<div class="icon icon-header-7 sr-icon">
			</div>
 <br>
 <span class="text">Нам можно доверять</span>
		</div>
 <a href="/promotions/besplatnaya-dostavka-i-podyem/" class="item" data-title="Мы работаем 24 часа в сутки 7 дней в неделю!">
		<div class="icon icon-header-8 sr-icon">
		</div>
 <br>
 <span class="text">Бесплатная доставка и подъем</span> </a>
	</div>
</div>
<div class="is-banners__list">
	<div class="is-banners__item">
 <a href="/promotions/nashli-deshevle-my-snizim-tsenu/"><img alt="Нашли дешевле?" src="/image/new_design/banner1.jpg"></a>
	</div>
	<div class="is-banners__item">
 <a href="/oplata/"><img alt="Дозаказ плитки" src="/image/new_design/banner2.jpg"></a>
	</div>
</div>
<div class="is-serts">
	<h1><strong>«Плитка на дом.ру»</strong> — онлайн-гипермаркет плитки, керамогранита и сантехники</h1>
	<div class="is-serts__text">
		<p>
			 Наш интернет-магазин — это крупнейшая база кафельных напольных и настенных покрытий в Московской области. Каталог включает керамическую плитку, мозаику, керамогранит и декоративные элементы. Представлены коллекции для отделки помещений с нормальной и повышенной влажностью, а также варианты для облицовки лестниц и зон на открытом воздухе.
		</p>
		
	</div>
	<div class="is-serts__img">
 <a data-fancybox="sertif" href="/upload/iblock/e46/cersanit.jpeg"><img alt="cersanit" src="/upload/iblock/e46/cersanit.jpeg"></a> <a data-fancybox="sertif" href="/upload/iblock/b87/ren_tv.jpg"><img alt="ren-tv" src="/upload/iblock/b87/ren_tv.jpg"></a> <a data-fancybox="sertif" href="/upload/iblock/5f9/blagodarnost_ot_tnt3.jpg"><img alt="tnt" src="/upload/iblock/5f9/blagodarnost_ot_tnt3.jpg"></a>
	</div>
</div>
<? $APPLICATION->IncludeComponent(
	"bitrix:catalog.main", 
	"section_slider", 
	array(
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "A",
		"IBLOCK_ID" => array(
			0 => CATALOG_ID,
		),
		"IBLOCK_TYPE" => "catalog",
		"LINK" => "/populyarnaya-plitka/",
		"PAGE_ELEMENT_COUNT" => "12",
		"TITLE" => "Популярные коллекции плитки",
		"TYPE" => "POPULAR",
		"COMPONENT_TEMPLATE" => "section_slider",
		"IBLOCK_URL" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
); ?>
<? $APPLICATION->IncludeComponent(
	"bitrix:catalog.main", 
	"section_slider", 
	array(
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "A",
		"IBLOCK_ID" => array(
			0 => CATALOG_FLOOR_ID,
		),
		"IBLOCK_TYPE" => "catalog",
		"LINK" => "/populyarniy-laminat/",
		"PAGE_ELEMENT_COUNT" => "12",
		"TITLE" => "Популярные коллекции напольных покрытий",
		"TYPE" => "POPULAR",
		"COMPONENT_TEMPLATE" => "section_slider",
		"IBLOCK_URL" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
); ?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.main",
	"product_slider",
	Array(
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "A",
		"CHECK_DATE" => $checkdate,
		"CURENCY" => $ccurency,
		"IBLOCK_ID" => [11],
		"IBLOCK_TYPE" => "catalog",
		"LINK" => "/populyarnya-santekhnika/",
		"MARGIN" => "N",
		"NIGHT" => $checktime,
		"PAGE_ELEMENT_COUNT" => 12,
		"SORT" => "PROPERTY_POPULAR",
		"SORT_ORDER" => "DESC",
		"TITLE" => "Популярные товары сантехники",
		"TYPE" => "POPULAR",
		"USER_GROUP" => $usergropus,
		"YEAR" => date("Y")
	)
);?>
<? $APPLICATION->IncludeComponent(
	"bitrix:catalog.main", 
	"section_slider", 
	array(
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "A",
		"IBLOCK_ID" => array(
			0 => CATALOG_ID,
		),
		"IBLOCK_TYPE" => "catalog",
		"LINK" => "/novinki/",
		"PAGE_ELEMENT_COUNT" => "12",
		"TITLE" => "Коллекции новинок плитки",
		"TYPE" => "NEW",
		"COMPONENT_TEMPLATE" => "section_slider",
		"IBLOCK_URL" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
); ?>
<? $APPLICATION->IncludeComponent(
	"bitrix:catalog.main", 
	"section_slider", 
	array(
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "A",
		"IBLOCK_ID" => array(
			0 => CATALOG_FLOOR_ID,
		),
		"IBLOCK_TYPE" => "catalog",
		"LINK" => "/novinki-laminat/",
		"PAGE_ELEMENT_COUNT" => "12",
		"TITLE" => "Коллекции новинок напольных покрытий",
		"TYPE" => "NEW",
		"COMPONENT_TEMPLATE" => "section_slider",
		"IBLOCK_URL" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
); ?>

<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.main",
	"product_slider",
	Array(
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "A",
		"CHECK_DATE" => $checkdate,
		"CURENCY" => $ccurency,
		"IBLOCK_ID" => [11],
		"IBLOCK_TYPE" => "catalog",
		"LINK" => "/novinki-santekhnika/",
		"MARGIN" => "N",
		"NIGHT" => $checktime,
		"PAGE_ELEMENT_COUNT" => 12,
		"SORT" => "DATE_CREATE",
		"SORT_ORDER" => "DESC",
		"TITLE" => "Новинки сантехники",
		"TYPE" => "NEW",
		"USER_GROUP" => $usergropus,
		"YEAR" => date("Y")
	)
);?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.main",
	"popluar_brands",
	Array(
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "A",
		"IBLOCK_ID" => [4,9,11],
		"IBLOCK_TYPE" => "catalog",
		"PAGE_ELEMENT_COUNT" => 20,
		"SORT" => "ID",
		"SORT_ORDER" => "ASC"
	)
);?>
<?
/* ЛИКВИДАЦИЯ СКЛАДА - если открываем - то удалить эту строку
$APPLICATION->IncludeComponent("bitrix:catalog.main","product_slider", [
	"IBLOCK_TYPE" => "catalog",
	"TYPE" => "LICVID",
	"LINK" => '/likvidaciya-sklada/',
	"TITLE" => "Ликвидация склада плитки",
	"PAGE_ELEMENT_COUNT" => 10,
	"SORT" => "ID",
	"SORT_ORDER" => "DESC",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "360000",
	"CACHE_GROUPS" => "N",
	"COMPONENT_TEMPLATE" => "product_slider",
	"COMPOSITE_FRAME_MODE" => "A",
	"COMPOSITE_FRAME_TYPE" => "DYNAMIC_WITH_STUB_LOADING",
	"NIGHT" => $checktime,
	"USER_GROUP" => $usergropus,
	"CHECK_DATE" => $checkdate,
	"CURENCY" => $ccurency
]);
ЛИКВИДАЦИЯ СКЛАДА - если открываем - то удалить эту строку */
?>
<?$APPLICATION->IncludeComponent(
	"custom:clients.list",
	"default",
	Array(
		"FILTER" => ['IBLOCK_ID'=>23,'ACTIVE'=>'Y'],
		"GROUP_BY" => false,
		"NAV_PARAMS" => ['nPageSize'=>4],
		"SELECT" => ['ID','NAME','PREVIEW_PICTURE','PREVIEW_TEXT','PROPERTY_URL_NEWS_CLIENTS',],
		"SHOW_NAV" => "N",
		"SHOW_TITLE" => "Y",
		"SORT" => ['sort'=>'asc','id'=>'desc']
	)
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>