<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/templates/" . SITE_TEMPLATE_ID . "/header.php");
$curPage = $APPLICATION->GetCurPage(true);
$canonical_ignore = ['/personal/', '/login/'];
global $checkdate, $usergropus, $checktime, $dir, $ccurency, $USER;
$dir = $APPLICATION->GetCurDir();
$usergroups = $USER->GetUserGroupArray();
$checkdate = date('Y',strtotime(date("Y") . '-01-01 -1year'));
$checktime = checkTime();
$ccurency = getCurrecy();

$allmainpages = [
	"/santekhnika/",
	"/collections/",
	"/napolnye-pokrytiya/",
	"/sukhie-stroitelnye-smesi/"
];
?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<?
		$cur_page = $APPLICATION->GetCurPage();
		$curPageUrl = "https://www.plitkanadom.ru".$cur_page;
	?>   
	<meta property="og:title" content="<?$APPLICATION->ShowTitle();?>" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?=$curPageUrl;?>" />
	<meta property="og:description" content="<?$APPLICATION->ShowProperty('description');?>" /> 
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image" content="<?$APPLICATION->ShowProperty('og_image');?>" />
	<meta property="og:locale" content="ru_RU" >
	<meta property="og:site_name" content="plitkanadom.ru" />
	
	<link rel="apple-touch-icon" sizes="180x180" href="/local2/templates/new_design/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/local2/templates/new_design/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/local2/templates/new_design/icons/favicon-16x16.png">
    <link rel="manifest" href="/local2/templates/new_design/icons/site.webmanifest">
    <link rel="mask-icon" href="/local2/templates/new_design/icons/safari-pinned-tab.svg" color="#000000">
    <link rel="shortcut icon" href="/local2/templates/new_design/icons/favicon.ico">
    <meta name="msapplication-TileColor" content="#000000">
    <meta name="msapplication-config" content="/local/templates/new_design/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

	<? // $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/custom.css'); ?>
	
	<title><? $APPLICATION->ShowTitle() ?></title>
	
	<?
	$APPLICATION->ShowHead();
		  
	$APPLICATION->SetPageProperty("canonical", "https://www.plitkanadom.ru".explode("?",$_SERVER["SCRIPT_URL"])[0]);
	
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery-3.6.0.min.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/slick/slick.min.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.fancybox.min.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.js");
  $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/custom.js");
			
	$APPLICATION->SetAdditionalCSS('/css/jquery.fancybox.min.css');
	$APPLICATION->SetAdditionalCSS('/css/slick-theme.css');
	$APPLICATION->SetAdditionalCSS('/css/slick.css');
	$APPLICATION->SetAdditionalCSS('/css/custom.css');
	if($USER->IsAuthorized()) {
		$APPLICATION->SetAdditionalCSS("/css/admincss.css");
	}
	
	$seoID = getElementID($_SERVER["SCRIPT_URL"],"PROPERTY_NEW",33);
	  
	if($seoID && ERROR_404 != "Y"){
		$APPLICATION->IncludeComponent("bitrix:news.detail", "seo_tags",
			[
				"IBLOCK_TYPE" => "services",
				"IBLOCK_ID" => "33",
				"ELEMENT_ID" => $seoID,
				"ELEMENT_CODE" => "",
				"FIELD_CODE" => ["PREVIEW_TEXT", "DETAIL_TEXT", "IPROPERTY_TEMPLATES"],
				"PROPERTY_CODE" => ["NEW", "REAL"],
				"SET_TITLE" => "Y",
				"ADD_ELEMENT_CHAIN" => "N",
				"SET_CANONICAL_URL" => "N",
				"SET_BROWSER_TITLE" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_META_DESCRIPTION" => "N",
				"BROWSER_TITLE" => "-",
				"META_KEYWORDS" => "-",
				"META_DESCRIPTION" => "-",
				"SET_STATUS_404" => "N",
				"SHOW_404" => "N",
				"SET_LAST_MODIFIED" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"USE_PERMISSIONS" => "N",
				"CACHE_TYPE" => "N",
				"CACHE_TIME" => "360000",
				"CACHE_GROUPS" => "N",
				"PAGEN" => ($_REQUEST["PAGEN_2"] ? $_REQUEST["PAGEN_2"] : $_REQUEST["PAGEN_1"])
			], false
		);
	}

	/**/	
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.colorbox.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/script.js");

//	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/font/style.css'); //подключение шрифта
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/colors+plitka_styles+colorbox+adaptive.css', true); //подключение объединне
   ?>
	<? // $APPLICATION->SetAdditionalCSS("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"); ?>
   
	<!-- BEGIN UIS CODE -->
    <script type="text/javascript">
        var __cs = __cs || [];
        __cs.push(["setCsAccount", "iwhHaUcLgX35PidBLNVA1Uhl4QF0h4aA"]);
    </script>
    <script type="text/javascript" async src="https://app.uiscom.ru/static/cs.min.js"></script>
    <!-- END UIS CODE -->

    <!-- calltouch -->
   <script src="/bitrix/templates/eshop_adapt_blue/js/calltouch.js"></script>
    <!-- calltouch -->
<? if(!$USER->IsAdmin()):?>
	<!-- Google Tag Manager -->
    <script data-skip-moving="true">
        (function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-MKTP88P');
    </script>
    <!-- End Google Tag Manager -->

	<!-- Yandex.Metrika counter -->
	<script type="text/javascript" >
	(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
	m[i].l=1*new Date();
	for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
	k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
	(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

	ym(24968570, "init", {
		clickmap:true,
		trackLinks:true,
		accurateTrackBounce:true,
		webvisor:true,
		ecommerce:"dataLayer"
	});
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/24968570" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->
	<? endif; ?>
    <meta name="yandex-verification" content="fb8ee7760b445179"/>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;800&display=swap" rel="stylesheet">
	
</head>
<body class="<?=($dir=="/")? 'main' : 'pages';?>">
<? if($USER->IsAdmin() || $USER->GetID()==1033):?>
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
<? endif; ?>
<? if(!$USER->IsAdmin()):?>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MKTP88P" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MKTP88P" height="0" width="0"
                style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(24968570, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true,
            ecommerce:"dataLayer"
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/24968570" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
<? endif; ?>
	<div class="wrapper">
		<header>
			<div class="max-window head">
				<div class="is-head__logo">
					<a href="<?=($dir=="/")? 'javascript:void(0);' : '/';?>"><img src="<?=SITE_TEMPLATE_PATH . "/svg/logotype.svg";?>" alt="<?=$depth1["NAME"];?>" /></a>
				</div>
				<div class="is-burger"><span></span><span></span><span></span></div>
				<div class="is-head__mobile-menu"></div>
				<div class="is-head__search" id="is-search">
					<? $APPLICATION->IncludeComponent(
						"bitrix:search.title",
						"head",
						[
							 "NUM_CATEGORIES" => "3",
							 "AJAX_MODE" => "N",
							 "TOP_COUNT" => "5",
							 "ORDER" => "date",
							 "USE_LANGUAGE_GUESS" => "N",
							 "CHECK_DATES" => "N",
							 "SHOW_OTHERS" => "N",
							 "PAGE" => SITE_DIR . "search/",
							 "CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),
							 "CATEGORY_0" => [
								  0 => "iblock_catalog",
							 ],
							 "CATEGORY_0_iblock_catalog" => [
								  0 => "all",
							 ],
							 "CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
							 "SHOW_INPUT" => "Y",
							 "INPUT_ID" => "title-search-input1",
							 "CONTAINER_ID" => "search1",
							 "PRICE_CODE" => [
								  0 => "BASE",
							 ],
							 "SHOW_PREVIEW" => "Y",
							 "PREVIEW_WIDTH" => "100",
							 "PREVIEW_HEIGHT" => "100",
							 "CONVERT_CURRENCY" => "N",
							 "CURRENCY_ID" => "RUB",
							 "PRICE_VAT_INCLUDE" => "Y",
							 "PREVIEW_TRUNCATE_LEN" => "",
							 "COMPONENT_TEMPLATE" => "head",
							 "COMPOSITE_FRAME_MODE" => "A",
							 "COMPOSITE_FRAME_TYPE" => "AUTO"
						],
						false
				  );
					?>
				</div>
				<div class="is-head__info">
					<div class="is-head__info-block">
						<div class="is-head__info-phone">
							<a href="tel:+74957777121">+7 (495) <strong>77-77-121</strong></a>
							<div class="is-head__info-time">пн.-пт: 9:30-21:00; сб.-вс.: 9:30-19:00</div>
						</div>
					</div>
					<div class="is-head__info-block">
						<div class="is-head__info-phone">
							<a href="tel:+78007557557">+7 (800) <strong>755-755-7</strong></a>
							<div class="is-head__info-time">Бесплатно для регионов России</div>
						</div>
					</div>
				</div>
				<div class="is-head__profile">
					<div class="is-head__favorites"><a href="https://www.plitkanadom.ru/personal/cart/?favorite=true"><img class="is-icon" src="<?=SITE_TEMPLATE_PATH . "/svg/favorite_love.svg";?>" alt="Избранное" /></a></div>
					<? Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("isauth"); ?>
					<? if(!$USER->IsAuthorized()):?>
					<a href="/auth/"><img src="<?=SITE_TEMPLATE_PATH . "/svg/login.svg";?>" alt="вход" /> вход</a>
					<a href="/auth/?register=yes">регистрация</a>
					<? else: ?>
					<a href="/personal/"><img src="<?=SITE_TEMPLATE_PATH . "/svg/login.svg";?>" alt="вход" /> <?=$USER->GetFirstName()." ".$USER->GetLastName();?></a>
					<a href="/auth/?logout=yes">выход</a>
					<? endif; ?>
					<? Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("isauth", ""); ?>
				</div>
				<div class="is-head__basket" id="is-basket">
					<a href="/personal/cart/" class="bx_cart_block">
						<div class="is-icon__block"><img src="/local2/templates/new_design/svg/basket.svg" alt="Корзина" /></div>
						<div class="bx_small_cart"></div>
					</a>
				</div>
			</div>
			<div class="is-head__catalog">
				<div class="max-window">
					<div class="is-head__catalog-block">
						<? $APPLICATION->IncludeComponent(
							"bitrix:catalog.section.list",
							"head_catalog_menu",
							[
								  "IBLOCK_TYPE" => 'services',
								  "IBLOCK_ID" => 27,
								  "SECTION_ID" => "0",
								//  "AGENT" => (strpos($_SERVER['HTTP_USER_AGENT'], "Screaming") === false ? "N" : "Y"),
								  "SECTION_CODE" => "",
								  "SECTION_URL" => "",
								  "COUNT_ELEMENTS" => "N",
								//  "CUR_DIR" => $APPLICATION->GetCurPage(),
								  "TOP_DEPTH" => "3",
								  "SECTION_FIELDS" => "",
								  "SECTION_USER_FIELDS" => ["UF_MENU_SECTION_C","UF_MENU_SECTION_LINK","UF_MENU_COLUMN","UF_MENU_SHOW_TITLE","UF_ICON"],
								  "ADD_SECTIONS_CHAIN" => "N",
								  "CACHE_TYPE" => "Y",
								  "CACHE_TIME" => "360000",
								  "CACHE_NOTES" => "",
								  "CACHE_GROUPS" => "N",
								  "CUSTOM_SECTION_SORT" => ["DEPTH_LEVEL"=>"ASC","SORT"=>"ASC"],
							]
						);
					?>
					<script>
						$(document).ready(function(){
							$('.is-head__catalog-ul').find('a').each(function(){
								var link = $(this).attr('href');
								if(link == '<?=$_SERVER['SCRIPT_URL'];?>'){
									$(this).addClass('is-selected');
									$(this).parents('.depth-2').find('.parent').addClass('is-selected');
									$(this).parents('.depth-1').find('.root-item').addClass('is-selected');
								}
							});
						});
					</script>
					<? if($APPLICATION->GetDirProperty("showFilter") == 'Y'): ?>
					<div class="rbs-filter-btn filter-burger is_element"><span></span><span></span>
						<img src="/image/new_design/filter_burger.svg" alt="Фильтр" />Фильтр<span></span>
					</div>
					 <? endif; ?>
					</div>
					<div class="is-head__menu">
						<ul>
							<li class="hasSublvl"  id="item001">
								<span class="is-head__arr" onclick="openMenu('001');"><img src="/image/new_design/menu_arrow.svg" alt=""></span>
								<a href="/onas/">О нас</a>
								<ul class="is-head__submenu">
									<li><a href="/onas/">О нас</a></li>
									<li><a href="/onas/clients/">Наши клиенты</a></li>
									<li><a href="/onas/otzyvy/">Отзывы</a></li>
								</ul>
							</li>
							<li class="hasSublvl"  id="item002">
								<span class="is-head__arr" onclick="openMenu('002');"><img src="/image/new_design/menu_arrow.svg" alt=""></span>
								<a href="/how-to-buy/">Покупателю</a>
								<ul class="is-head__submenu">
									<li><a href="/how-to-buy/">Покупателю</a></li>
									<li><a href="/news/">Новости</a></li>
									<li><a href="/articles/">Cтатьи и советы</a></li>
								</ul>
							
							</li>
							<li class="hasSublvl"  id="item003">
								<span class="is-head__arr" onclick="openMenu('003');"><img src="/image/new_design/menu_arrow.svg" alt=""></span>
								<a href="/oplata/">Оплата</a>
								<ul class="is-head__submenu">
									<li><a href="/oplata/">Оплата</a></li>
									<li><a href="/oplata/rassrochka/">Рассрочка</a></li>
								</ul>
							</li>
							<li><a href="/dostavka/">Доставка</a></li>

							<li class="hasSublvl"  id="item005">
								<span class="is-head__arr" onclick="openMenu('005');"><img src="/image/new_design/menu_arrow.svg" alt=""></span>
								<a href="/3d-design/">Дизайн 3D</a>
								<ul class="is-head__submenu">
									<li><a href="/3d-design/">Дизайн 3D</a></li>
									<li><a href="/3d-design-online/">Онлайн 3D-дизайн</a></li>
								</ul>
							</li>

							<li><a href="/shourum/">Шоурум</a></li>
							<li><a href="/contacts/">Контакты</a></li>
						</ul>
						<? /* $APPLICATION->IncludeComponent(
						  "bitrix:menu",
							  "head",
							  [
									"ROOT_MENU_TYPE" => "top",
									"MENU_CACHE_TYPE" => "A",
									"MENU_CACHE_TIME" => "360000",
									"MENU_CACHE_USE_GROUPS" => "N",
									"MENU_CACHE_GET_VARS" => [],
									"MAX_LEVEL" => "1",
									"USE_EXT" => "N",
									"DELAY" => "N",
									"ALLOW_MULTI_SELECT" => "N"
							  ],
							  false
						); */ ?>
					</div>
					<div class="is-head__webs">
						<a class="web__tube" href="https://www.youtube.com/channel/UC38XOpu6Ov6-eRogcQxDBnw" target="_blank" title="YouTube"></a>
						<a class="web__ok" href="http://ok.ru/plitkanado/" target="_blank" title="Ok">
						<a class="web__vk" href="https://vk.com/public64362093" target="_blank" title="Vkontakte"></a>
					</div>
					<div class="is-head__contacts">
						<a href="/contacts/director/"><img src="<?=SITE_TEMPLATE_PATH . "/svg/direktor.svg";?>" alt="Написать директору" /> Написать директору</a>
						<a href="mailto:info@plitkanadom.ru" target="_blank"><img src="<?=SITE_TEMPLATE_PATH . "/svg/direktor.svg";?>" alt="написать письмо" /> info@plitkanadom.ru</a>
					</div>
				</div>
			</div>
			<?
			 $mainDir = [
				  "collections" => 4,
				  "napolnye-pokrytiya" => 9,
				  "santekhnika" => 11
			 ];
			 $exDir = [];
			 $exDir = explode('/',$dir);
			 if($mainDir[$exDir[1]]){?>
			<? $APPLICATION->IncludeComponent("bitrix:catalog.main","brands_alfabet", [
				"IBLOCK_TYPE" => "catalog",
				"IBLOCK_ID" => [$mainDir[$exDir[1]]],
				"SORT" => "ID",
				"SORT_ORDER" => "ASC",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "360000",
				"CACHE_GROUPS" => "N",
				"COMPONENT_TEMPLATE" => "brands_alfabet",
				"COMPOSITE_FRAME_MODE" => "A",
				"COMPOSITE_FRAME_TYPE" => "DYNAMIC_WITH_STUB_LOADING",
			]); ?>
			<? } ?>
		</header>
		<main class="<?=($dir == "/")? 'main' : 'inner';?><?=(ERROR_404 == "Y")? ' is-error__page' : ''; ?>">
			<div class="max-window">
			<? if ($curPage != SITE_DIR . "index.php") : ?>
				<? $APPLICATION->IncludeComponent(
						"bitrix:breadcrumb", "",[
							"START_FROM" => "0",
							"PATH" => "",
							"SITE_ID" => "-"
						], false,
						['HIDE_ICONS' => 'Y']
					);
				?>
				<h1><?= $APPLICATION->ShowTitle(false); ?></h1>
			<? endif ?>
			<? if(ERROR_404 != "Y"):?>
				<? $showFilter = '';
				$isNice = getElementID($_SERVER['REQUEST_URI'], 'PROPERTY_NEW', 33);
				
				global $isniceSer;
				
				if(!empty($isNice)){
					$showFilter = true;
					
					$isnicePath = getNiceRealPath($_SERVER['REQUEST_URI'], 'PROPERTY_NEW', 33);
					$isniceSer = unserialize($isnicePath)["VALUE"];
					
				}elseif($dir != "/santekhnika/"){
					$showFilter = $APPLICATION->GetDirProperty("showFilter");
				}else{
					$sectionId = intval(($_REQUEST["sec_id"]) ? $_REQUEST["sec_id"] : omniGetSIDFromPageUrl(11));
					if($sectionId > 0){
						$showFilter = $APPLICATION->GetDirProperty("showFilter");
					}
				}
				if($showFilter == "Y"):
				?>
					<div class="sidebar">
						<div class="rbs-filter-btn mobile-close-filter filter-burger">
							<span></span>
							<span></span>
							<span></span>
						</div>
						<?
						$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						[
						"AREA_FILE_SHOW" => "sect",
						"AREA_FILE_SUFFIX" => "left",
						"AREA_FILE_RECURSIVE" => "Y",
						"EDIT_MODE" => "html",
						],
						false,
						['HIDE_ICONS' => 'Y']
						);
						?>
					</div>
				<? endif; ?>
			<? endif; ?>
			<div class="center-side<?=($showFilter == "Y" ? ' halfblock' : ' fullblock');?>">	
			<div class="bx_content_section">
