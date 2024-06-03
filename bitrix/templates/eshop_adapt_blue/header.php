<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/templates/" . SITE_TEMPLATE_ID . "/header.php");
$wizTemplateId = COption::GetOptionString("main", "wizard_template_id", "eshop_adapt_horizontal", SITE_ID);
// CUtil::InitJSCore();
// CJSCore::Init(["fx"]);
$curPage = $APPLICATION->GetCurPage(true);

$canonical_ignore = ['/personal/', '/login/'];
?>
<!DOCTYPE html>
<html <? /*xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>"*/ ?> lang="<?= LANGUAGE_ID ?>">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="shortcut icon" type="image/x-icon" href="<?= SITE_DIR ?>favicon.ico"/>
	<? /*<link href="/bitrix/templates/eshop_adapt_blue/bootstrap.min.css" rel="stylesheet" media="screen" />*/ ?>
	<?
   //Мои кастомные стили
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/custom.css');

	$seoID = getElementID($_SERVER["SCRIPT_URL"],"PROPERTY_NEW",33);
	  
	if($seoID){

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
				"CACHE_GROUPS" => "Y",
				"PAGEN" => ($_REQUEST["PAGEN_2"] ? $_REQUEST["PAGEN_2"] : $_REQUEST["PAGEN_1"])
			], false
		);
	}
	?>
	<title><? $APPLICATION->ShowTitle() ?></title><?
	
	$APPLICATION->SetPageProperty("canonical", "https://www.plitkanadom.ru".$_SERVER["SCRIPT_URL"]);
	
	$APPLICATION->ShowHead();
		
    // echo '<meta http-equiv="Content-Type" content="text/html; charset=' . LANG_CHARSET . '"' . (true ? ' /' : '') . '>' . "\n";
    
    // $APPLICATION->ShowMeta("keywords", false, true);
    // $APPLICATION->ShowMeta("description", false, true);
    // $APPLICATION->ShowMeta("robots", false, true);
    // $APPLICATION->ShowLink('canonical', 'canonical');
    

    $APPLICATION->AddHeadScript("/js/jquery-1.11.0.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/script.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.colorbox.js");

    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/font/style.css'); //подключение шрифта
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/colors+plitka_styles+colorbox+adaptive.css', true); //подключение объединне
    // $APPLICATION->ShowCSS(true, true);
    ?>
    <?
    // CJSCore::Init(["jquery"]);

    //Прячем каноникал на страницах в игноре 
    // if (!in_array($_SERVER["SCRIPT_URL"], $canonical_ignore)) {$APPLICATION->ShowHeadStrings();}
    // $APPLICATION->ShowHeadScripts();
    $APPLICATION->SetAdditionalCSS("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css");
    ?>
    <? /*<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/colors+plitka_styles+colorbox+adaptive.css")?>" />
    <link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/colors.css")?>" />
    <link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/plitka_styles.css")?>" />
    <link rel="stylesheet" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/colorbox.css")?>" />
    <link rel="stylesheet" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/adaptive.css")?>" />*/ ?>
    <?php /*if (substr_count($_SERVER['HTTP_USER_AGENT'], 'Trident') > 0 && $APPLICATION->GetCurPage() == '/personal/cart/') { //ie ?>
        <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
        <meta http-equiv="pragma" content="no-cache" />
    <?php }*/ ?>
    <? // $APPLICATION->IncludeComponent("abricos:antisovetnik", "", [], false); ?>
<? /* Статистика телефонии - отключаю потому что их сайт не грузится и скрипт не загружаетя и убивает подтверждение что заказ оформлен */ ?>
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
    <meta name="yandex-verification" content="fb8ee7760b445179"/>
</head>

<body class="<? $APPLICATION->ShowViewContent("body_class"); ?>">
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MKTP88P" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
<div id="overlay"></div>
<? /*
	<div id="find-less">
    <div class="close"></div>
    <? $APPLICATION->IncludeComponent("bitrix:main.include", "",
        ["AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/find-less.php"], false); ?>

</div>
*/ ?>
<div class="wrap" id="bx_eshop_wrap">
    <header>
        <div class="topper-menu">
            <div class="topper-wrap">
                <div class="mobile">
                    <a class="rbs-home-mobile-btn" href="<?php echo SITE_DIR; ?>"><img
                                src="/bitrix/templates/eshop_adapt_blue/images/home-link.png" alt="home"/></a>
                    <? /*RBS_CUSTOM_START*/ ?>
                    <a class="mobile-menu-show" href="javascript:void(0)">
                        <img src="<?php echo SITE_TEMPLATE_PATH; ?>/images/rbs-top-menu-hamb.png" alt="mobile menu ico"/>
                        <!-- <i class="rbs-menu-top-hamb"></i> -->
                    </a>

                    <a class="rbs-mobile-logo" href="<?= SITE_DIR ?>">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/rbs-top-logo-mobile.png" alt="plitkanadom.ru">
                    </a>
                    <? /*RBS_CUSTOM_START*/ ?>
                </div>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "top_menu",
                    [
                        "ROOT_MENU_TYPE" => "top",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "360000",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => [],
                        "MAX_LEVEL" => "1",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N"
                    ],
                    false
                ); ?>
                <div class="header_inner_container_auth">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:system.auth.form",
                        "eshop_adapt",
                        [
                            "REGISTER_URL" => SITE_DIR . "login/",
                            "PROFILE_URL" => SITE_DIR . "personal/",
                            "SHOW_ERRORS" => "N"
                        ],
                        false,
                        []
                    ); ?>
                </div>
                <? /*RBS_CUSTOM_START*/ ?>
                <div class="rbs-top-cart-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="0.776cm"
                         height="0.706cm">
                        <path fill-rule="evenodd" fill="rgb(255, 100, 0)"
                              d="M19.118,16.072 L19.118,14.618 L6.399,14.618 L7.211,13.163 L19.660,11.971 L21.824,4.034 L5.182,4.034 L4.234,0.065 L0.175,0.065 L0.175,1.388 L3.152,1.388 L5.993,12.501 L4.234,15.940 L4.234,17.925 C4.234,18.983 5.182,19.910 6.264,19.910 C7.346,19.910 8.293,18.983 8.293,17.925 C8.293,16.866 7.346,15.940 6.264,15.940 L16.412,15.940 L16.412,17.925 C16.412,18.983 17.359,19.910 18.442,19.910 C19.524,19.910 20.471,18.983 20.471,17.925 C20.471,16.999 19.929,16.337 19.118,16.072 Z"/>
                    </svg>
                </div>
                <? /*RBS_CUSTOM_END*/ ?>
                <div class="search_top">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:search.title",
                        "visual1",
                        [
                            "NUM_CATEGORIES" => "1",
                            "TOP_COUNT" => "5",
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
                            "PREVIEW_WIDTH" => "75",
                            "PREVIEW_HEIGHT" => "75",
                            "CONVERT_CURRENCY" => "Y",
                            "ORDER" => "date",
                            "USE_LANGUAGE_GUESS" => "N",
                            "PRICE_VAT_INCLUDE" => "Y",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "CURRENCY_ID" => "RUB",
                            "COMPONENT_TEMPLATE" => "visual1",
                            "COMPOSITE_FRAME_MODE" => "A",
                            "COMPOSITE_FRAME_TYPE" => "AUTO"
                        ],
                        false
                    ); ?>
                </div>
            </div>
        </div>
        <div class="header_wrap">
            <div class="header_wrap_container">
                <div class="header_inner">
                    <div class="header_inner_container_one">
                        <div class="header_inner_include_aria" style="color: #fff;">
                            <div class="logo_container">
                                <a href="/"><img src="/bitrix/templates/eshop_adapt_blue/images/logo.png" alt="logo"/></a>
                            </div>
                            <div class="phones">
                                <? $APPLICATION->IncludeComponent("bitrix:main.include", "",
                                    ["AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/telephone.php"], false); ?>
                            </div>
                            <div class="email">
                                <? $APPLICATION->IncludeComponent("bitrix:main.include", "",
                                    ["AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/schedule.php"], false); ?>
                            </div>
                        </div>
                    </div>
                    <? /*---flash disabled---*/ ?>
                    <a <? if ($curPage != SITE_DIR . "index.php") : ?>class="site_title" <? endif ?> href="<?= SITE_DIR ?>">
                        <? $APPLICATION->IncludeComponent("bitrix:main.include", "",
                            ["AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/company_name.php"], false); ?>
                    </a>
                    <div class="clb"></div>
                </div> <!-- //header_inner -->
                <? if ($APPLICATION->GetCurPage(true) == SITE_DIR . "index.php") : ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        [
                            "AREA_FILE_SHOW" => "sect",
                            "AREA_FILE_SUFFIX" => "inc",
                            "AREA_FILE_RECURSIVE" => "N",
                            "EDIT_MODE" => "html",
                        ],
                        false,
                        ['HIDE_ICONS' => 'Y']
                    ); ?>
                <? endif ?>
            </div>
        </div>
        <div class="header_inner_bottom_line_container">
            <div class="wrp">
                <div class="header_inner_bottom_line">
                    <div class="mobile">
                        <a class="mobile-cart-show" href="javascript:void(0)"
                           title="<?php echo GetMessage('TMPL_CART'); ?>"><i class="ico-mobile-cart"></i></a>
                        <? /*<a class="mobile-menu-show" href="javascript:void(0)" title="<?php echo GetMessage('TMPL_CATALOG_MENU'); ?>"><i class="ico-mobile-menu"></i></a>*/ ?>
                        <a class="mobile-param-show" href="javascript:void(0)"
                           title="<?php echo GetMessage('TMPL_PARAM_SEL'); ?>"><i class="ico-mobile-param"></i></a>
                    </div>
                    <? /*RBS_CUSTOM_START*/ ?>
                    <div class="rbs-mobile-menu">
                        <ul>
                            <li class="rbs-catalog-btn">Каталог</li>
                            <!-- <li class="rbs-brand-btn">Производители</li> -->
                            <?php if (isCatalogSection() !== false) { ?>
                                <li class="rbs-filter-btn">Фильтр</li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="rbs-call-answer">
                        <a href="javascript:void(0)"><i></i></a>
                    </div>
                    <div class="rbs-call-phones">
                        <a href="tel:+74957777121">+7 (495) 77-77-121</a>
                        <a href="tel:+78007557557">+7 (800) 755-755-7</a>
                    </div>
                    <? $APPLICATION->IncludeComponent(
								"bitrix:catalog.section.list",
								"menu",
								[
									  "IBLOCK_TYPE" => 'services',
									  "IBLOCK_ID" => 27,
									  "SECTION_ID" => "0",
									  "AGENT" => (strpos($_SERVER['HTTP_USER_AGENT'], "Screaming") === false ? "N" : "Y"),
									  "SECTION_CODE" => "",
									  "SECTION_URL" => "",
									  "COUNT_ELEMENTS" => "N",
									  "CUR_DIR" => $APPLICATION->GetCurPage(),
									  "TOP_DEPTH" => "3",
									  "SECTION_FIELDS" => "",
									  "SECTION_USER_FIELDS" => ["UF_MENU_SECTION_C","UF_MENU_SECTION_LINK","UF_MENU_COLUMN","UF_MENU_SHOW_TITLE"],
									  "ADD_SECTIONS_CHAIN" => "N",
									  "CACHE_TYPE" => "Y",
									  "CACHE_TIME" => "360000",
									  "CACHE_NOTES" => "",
									  "CACHE_GROUPS" => "Y",
									  "CUSTOM_SECTION_SORT" => ["DEPTH_LEVEL"=>"ASC","SORT"=>"ASC"]
								]
							);
						 ?>
						 
						 <? /* <ul class="pnd-vm-top-2018">
						 				<li class="parent"><a href="/collections/" class="root-item">Керамическая плитка</a></li>
										<li class="parent"><a href="/napolnye-pokrytiya/" class="root-item">Напольные покрытия</a></li>
										<li class="parent"><a href="/santekhnika/" class="root-item">Сантехника</a></li>
										<li class="parent"><a href="/promotions/" class="root-item">Акции</a></li>
									</ul>
									*/ ?>
                </div>
                <div class="header_top_section">
                    <div class="header_top_section_container_one">
                        <div class="bx_cart_login_top">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:sale.basket.basket.line",
                                "template1",
                                [
                                    "PATH_TO_BASKET" => SITE_DIR . "personal/cart/",
                                    "PATH_TO_PERSONAL" => SITE_DIR . "personal/",
                                    "SHOW_PERSONAL_LINK" => "N",
                                    "SHOW_NUM_PRODUCTS" => "Y",
                                    "SHOW_TOTAL_PRICE" => "Y",
                                    "SHOW_PRODUCTS" => "N",
                                    "POSITION_FIXED" => "N",
                                    "COMPONENT_TEMPLATE" => "template1",
                                    "SHOW_EMPTY_VALUES" => "Y",
                                    "SHOW_AUTHOR" => "N",
                                    "PATH_TO_REGISTER" => SITE_DIR . "login/",
                                    "PATH_TO_PROFILE" => SITE_DIR . "personal/",
                                    "POSITION_HORIZONTAL" => "right",
                                    "POSITION_VERTICAL" => "top",
                                    "SHOW_DELAY" => "N",
                                    "SHOW_NOTAVAIL" => "N",
                                    "SHOW_SUBSCRIBE" => "N",
                                    "SHOW_IMAGE" => "Y",
                                    "SHOW_PRICE" => "Y",
                                    "SHOW_SUMMARY" => "Y",
                                    "PATH_TO_ORDER" => SITE_DIR . "personal/order/make/"
                                ],
                                false
                            ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="top-menu-shadow"></div>
        <div class="max-width">
            <?
                $mainDir = [
                    "collections" => 4,
                    "napolnye-pokrytiya" => 9,
                    "santekhnika" => 11
                ];
                $exDir = [];
                $exDir = explode('/',$APPLICATION->GetCurDir());
                if($mainDir[$exDir[1]]){
                    $APPLICATION->IncludeComponent("bitrix:catalog.section.list","brands_alfabet",
                        [
                              "VIEW_MODE" => "TEXT",
                              "SHOW_PARENT_NAME" => "Y",
                              "IBLOCK_TYPE" => "catalog",
                              "IBLOCK_ID" => $mainDir[$exDir[1]],
                              "SECTION_ID" => '',
                              "SECTION_CODE" => "",
                              "SECTION_URL" => "",
                              "COUNT_ELEMENTS" => "N",
                              "TOP_DEPTH" => "2",
                              "SECTION_FIELDS" => "",
                              "SECTION_USER_FIELDS" => ["UF_NO_ALFABET"],
                              "ADD_SECTIONS_CHAIN" => "Y",
                              "CACHE_TYPE" => "A",
                              "CACHE_TIME" => "36000000",
                              "CACHE_NOTES" => "",
                              "CACHE_GROUPS" => "Y",
                              "CUSTOM_SECTION_SORT" => ["NAME"=>"ASC"]
                        ],false 
                    );
                } 
            ?>
        </div>
    </header>
    <main>
        <div class="workarea_wrap">
            <div class="worakarea_wrap_container workarea <? if ($wizTemplateId == "eshop_adapt_vertical") : ?>grid1x3<? else : ?>grid<? endif ?>">
                <div class="sidebar">
                    <? // if ($_SERVER['REMOTE_ADDR'] != '188.186.184.43') : ?>
                    <? $showFilter = '';
                        $showFilter = $APPLICATION->GetDirProperty("showFilter");
                        if($showFilter){
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
                        }else{
                            $APPLICATION->IncludeFile("/include/side_block.php",[],["MODE"=>"html"]);
                        }
                    ?>
                    <? // endif; ?>
                </div>
                <div class="center-side">
                    <div class="bx_content_section">
                        <? if ($curPage != SITE_DIR . "index.php") : ?>
                            <div id="navigation">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:breadcrumb",
                                    "",
                                    [
                                        "START_FROM" => "0",
                                        "PATH" => "",
                                        "SITE_ID" => "-"
                                    ],
                                    false,
                                    ['HIDE_ICONS' => 'Y']
                                ); ?>
                            </div>
                            <div class="cube-3">
                                <div class="main-h1" style="background:url(/bitrix/templates/eshop_adapt_blue/images/bg-cube.png) no-repeat;height:35px;">
                                    <h1 class="page-title"><?= $APPLICATION->ShowTitle(false); ?></h1>
                                </div>
                            </div>
                        <? endif ?>
