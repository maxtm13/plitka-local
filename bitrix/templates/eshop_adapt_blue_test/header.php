<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
$wizTemplateId = COption::GetOptionString("main", "wizard_template_id", "eshop_adapt_horizontal", SITE_ID);
CUtil::InitJSCore();
CJSCore::Init(array("fx"));
$curPage = $APPLICATION->GetCurPage(true);

$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/script.js");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.colorbox.js");

$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/font/style.css'); //подключение шрифта
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/colors+plitka_styles+colorbox+adaptive.css', true); //подключение объединне
?>
<?/*<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">*/?>
<!DOCTYPE html>
<html <?/*xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>"*/?> lang="<?=LANGUAGE_ID?>">
<head>
 <?/*
  if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/d-robots-checker.php')) {
      include_once($_SERVER['DOCUMENT_ROOT'] . '/d-robots-checker.php');
      if(durIsDisallowed($_SERVER['REQUEST_URI'], '*')) {
          echo '<meta name="googlebot" content="noindex">' . PHP_EOL;
      }
  }*/
 ?>
 	<meta name="yandex-verification" content="bba5100bb7c2d238" />
 	<meta name="yandex-verification" content="b737155eb0bc4df9" />
 	<meta name="yandex-verification" content="3d4f8b000105d9b7" />
 	<meta name="google-site-verification" content="dA8oQagUhx6GHR2Nmw5BVCBg2kNrfD1fsk3sO2I06uY" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>favicon.ico" />
	<?/*<link href="/bitrix/templates/eshop_adapt_blue/bootstrap.min.css" rel="stylesheet" media="screen" />*/?>
	<title><?$APPLICATION->ShowTitle()?></title>
	<?//$APPLICATION->ShowHead();
	echo '<meta http-equiv="Content-Type" content="text/html; charset='.LANG_CHARSET.'"'.(true ? ' /':'').'>'."\n";
	$APPLICATION->ShowMeta("robots", false, true);
	$APPLICATION->ShowMeta("keywords", false, true);
	$APPLICATION->ShowMeta("description", false, true);
	$APPLICATION->ShowCSS(true, true);
	?>
	<?
    CJSCore::Init(array("jquery"));
	$APPLICATION->ShowHeadStrings();
	$APPLICATION->ShowHeadScripts();
	?>
	<?/*<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/colors+plitka_styles+colorbox+adaptive.css")?>" />
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/colors.css")?>" />
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/plitka_styles.css")?>" />
	<link rel="stylesheet" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/colorbox.css")?>" />
	<link rel="stylesheet" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/adaptive.css")?>" />*/?>
	<? /*<style>
		.topper-menu{background:url(images/bg-topper-menu.png) repeat-x;height:35px}.topper-wrap{width:1200px;margin:0 auto}.topper-wrap ul{list-style:none;margin:0;padding-top:8px}.topper-wrap ul li{float:left;padding-left:20px}.topper-wrap ul li a{color:#333;text-decoration:none}.topper-wrap ul li.first{padding-left:0}.topper-wrap ul li a:hover{color:#fff;text-shadow:-1px -1px 1px #af4516;text-decoration:underline}.topper-menu{height:auto;min-height:35px}.topper-wrap .mobile, .header_inner_bottom_line .pnd-tree-menu, .header_inner_bottom_line .mobile a, .wrp_footer .mobile-ftr-menu-show{display:none;}.header_inner_container_two{width:auto}.header_inner_container_two{margin-top:5px}.header_inner_container_auth{float:right;margin-top:-1px}.header_inner_container_auth{margin-top:7px}.header_inner_container_auth a{font-size:.65em}.header_wrap{height:370px;min-width:1200px}.header_wrap_container{margin:0 auto;padding-bottom:40px;width:1200px}.header_wrap{background:url(images/bg_main.jpg) no-repeat center}body,.wrap,html.bx-no-touch body,.header_wrap,.header_inner_bottom_line_container,.footer_inner_bottom_line_container{min-width:230px}.topper-wrap,.header_wrap_container,.wrp,.wrp_footer{max-width:1200px}.topper-wrap,.worakarea_wrap_container,.footer_wrap_container,.header_wrap_container,.wrp,.wrp_footer{width:90%}.header_wrap_container{padding-bottom:0}.header_wrap a[itemprop="name"]{display:none}.header_inner_bottom_line_container,.footer_inner_bottom_line_container{min-width:1200px;position:relative;margin-bottom:-9px;background:url(images/effects.png) no-repeat center;height:59px;margin-top:-3px}.header_inner_bottom_line_container,.footer_inner_bottom_line_container{height:60px}.header_inner_bottom_line_container{margin-top:0;margin-bottom:0}.header_inner_bottom_line,.footer_inner_bottom_line{background-position:275px 5px;min-height:60px}.worakarea_wrap_container{padding:0}.sidebar{width:200px;float:left}.center-side{float:left;width:870px;margin-left:30px;margin-top:-18px}
	</style> */ ?>
	<?php /*if (substr_count($_SERVER['HTTP_USER_AGENT'], 'Trident') > 0 && $APPLICATION->GetCurPage() == '/personal/cart/') { //ie ?>
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="expires" content="0" />
		<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
		<meta http-equiv="pragma" content="no-cache" />
	<?php }*/ ?>
	<!-- Google Tag Manager -->
<script data-skip-moving="true">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MKTP88P');</script>
<!-- End Google Tag Manager -->
<script type="text/javascript">
var __cs = __cs || [];
__cs.push(["setCsAccount", "gQmftrytddaonPqG6yzg1C5WCWTRaRkq"]);
</script>
<script type="text/javascript" async src="//app.comagic.ru/static/cs.min.js"></script>
<meta name="yandex-verification" content="fb8ee7760b445179" />
</head>
<script language="JavaScript" type="text/javascript">
$(function() {
 $.fn.scrollToTop = function() {
  $(this).hide().removeAttr("href");
  if ($(window).scrollTop() >= "250") $(this).fadeIn("slow")
  var scrollDiv = $(this);
  $(window).scroll(function() {
   if ($(window).scrollTop() <= "250") $(scrollDiv).fadeOut("slow")
   else $(scrollDiv).fadeIn("slow")
  });
  $(this).click(function() {
   $("html, body").animate({scrollTop: 0}, "slow")
  })
 }
});

$(function() {
 $("#Go_Top").scrollToTop();
});
</script>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MKTP88P"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<body class="<?$APPLICATION->ShowViewContent("body_class");?>">
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div id="overlay"></div>
<div id="find-less">
	<div class="close"></div>
	<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/find-less.php"), false);?>

</div>
<div class="wrap" id="bx_eshop_wrap">
	<div class="topper-menu">
		<div class="topper-wrap">
			<div class="mobile">
				<a href="<?php echo SITE_DIR; ?>"><img src="/bitrix/templates/eshop_adapt_blue/images/home-link.png" alt="home" /></a>
				<a class="mobile-menu-show" href="javascript:void(0)"><img src="<?php echo SITE_TEMPLATE_PATH; ?>/images/white_menu.gif" alt="mobile menu ico" /></a>
			</div>
			<ul>
				<li>
				</li>
				<?$APPLICATION->IncludeComponent("bitrix:menu", "top_menu", array(
						"ROOT_MENU_TYPE" => "top",
						"MENU_CACHE_TYPE" => "A",
						"MENU_CACHE_TIME" => "36000000",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => array(
						),
						"MAX_LEVEL" => "1",
						"USE_EXT" => "Y",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N"
					),
					false
				);?>
			</ul>

			<div class="header_inner_container_auth">
				<?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "eshop_adapt", array(
						"REGISTER_URL" => SITE_DIR."login/",
						"PROFILE_URL" => SITE_DIR."personal/",
						"SHOW_ERRORS" => "N"
					),
					false,
					array()
				);?>
			</div>
				<div class="header_inner_container_two">
				<div class="search_top">
				<?$APPLICATION->IncludeComponent(
	"bitrix:search.title",
	"visual1",
	array(
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "5",
		"CHECK_DATES" => "N",
		"SHOW_OTHERS" => "N",
		"PAGE" => SITE_DIR."search/index.php",
		"CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),
		"CATEGORY_0" => array(
			0 => "iblock_catalog",
		),
		"CATEGORY_0_iblock_catalog" => array(
			0 => "all",
		),
		"CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "title-search-input1",
		"CONTAINER_ID" => "search1",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
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
	),
	false
);?>
			</div>
</div>

		</div>
	</div>

	<div class="header_wrap">

		<div class="header_wrap_container">

			<div class="header_inner">
				<div class="header_inner_container_one">
					<div class="header_inner_include_aria" style="color: #fff;">
						<div class="logo_container">
						<a href="/" ><img src="/bitrix/templates/eshop_adapt_blue/images/logo.png" alt="logo" /></a>
						</div>


						<div class="search_container">
						<div class="search_bottom">
						<div class="search_bottom_off">
							<?$APPLICATION->IncludeComponent(
	"bitrix:search.title",
	"visual1",
	array(
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "5",
		"CHECK_DATES" => "N",
		"SHOW_OTHERS" => "N",
		"PAGE" => SITE_DIR."search/index.php",
		"CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),
		"CATEGORY_0" => array(
			0 => "iblock_catalog",
		),
		"CATEGORY_0_iblock_catalog" => array(
			0 => "all",
		),
		"CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "title-search-input",
		"CONTAINER_ID" => "search",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"SHOW_PREVIEW" => "Y",
		"PREVIEW_WIDTH" => "75",
		"PREVIEW_HEIGHT" => "75",
		"CONVERT_CURRENCY" => "Y",
		"ORDER" => "date",
		"USE_LANGUAGE_GUESS" => "N",
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"CURRENCY_ID" => "RUB",
		"COMPONENT_TEMPLATE" => "visual1"
	),
	false
);?>
						</div>
</div>
</div>




						<div class="phones">
							<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?>
						</div>

						<div class="email">
							<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/schedule.php"), false);?>
						</div>

					</div>
				</div>
				<?/*---flash disabled---*/?>
				<a <?if ($curPage != SITE_DIR."index.php"):?>class="site_title"<?endif?> href="<?=SITE_DIR?>">
						<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_name.php"), false);?>
					</a>
				<div class="clb"></div>
			</div>  <!-- //header_inner -->

			<?if ($APPLICATION->GetCurPage(true) == SITE_DIR."index.php"):?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "sect",
						"AREA_FILE_SUFFIX" => "inc",
						"AREA_FILE_RECURSIVE" => "N",
						"EDIT_MODE" => "html",
					),
					false,
					Array('HIDE_ICONS' => 'Y')
				);?>
			<?endif?>

		</div> <!-- //header_wrap_container -->
	</div> <!-- //header_wrap -->
		<div>
			<div class="wrp" style="background: none; height:auto;">
				<?$APPLICATION->IncludeComponent(
	"yenisite:catalog.abcd.brands", 
	"alphabet_index", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"HL_IBLOCK" => "N",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "4",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"FILTER_NAME" => "arrFilter",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"GENERATION" => "Y",
		"LIST_ENABLE" => "Y",
		"SHOW_NUMBER" => "Y",
		"GROUP_NUMBER" => "N",
		"SHOW_RUS" => "Y",
		"GROUP_RUS" => "N",
		"SHOW_ENG" => "Y",
		"GROUP_ENG" => "N",
		"SHOW_ALL" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
			</div>
		</div>
	<div class="header_inner_bottom_line_container">
		<div class="wrp">

			<div class="header_inner_bottom_line">
				<div class="mobile">
					<a class="mobile-cart-show" href="javascript:void(0)" title="<?php echo GetMessage('TMPL_CART'); ?>"><i class="ico-mobile-cart"></i></a>
					<!--<a class="mobile-menu-show" href="javascript:void(0)" title="<?php echo GetMessage('TMPL_CATALOG_MENU'); ?>"><i class="ico-mobile-menu"></i></a>-->
					<a class="mobile-param-show" href="javascript:void(0)" title="<?php echo GetMessage('TMPL_PARAM_SEL'); ?>"><i class="ico-mobile-param"></i></a>
				</div>
				<!--noindex--><div class="mobil_menu">
					<div class="mob-menu-inner">
						<?$APPLICATION->IncludeComponent(
	"coderoid:mobilemenu", 
	".default", 
	array(
		"ROOT_MENU_TYPE" => "catalog",
		"MENU_COLOR" => "style_orange",
		"MENU_EFFECT" => "effect2",
		"MENU_BACK" => "Вернуться",
		"MAX_LEVEL" => "4",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => ".default",
		"COMPOSITE" => "Y"
	),
	false
);?>
					</div>
				</div><!--/noindex-->
				<?php /*mobile menu*/ ?>
				<?/*$APPLICATION->IncludeComponent("sitecoders:automenu", "pnd_tree", Array(
					"ROOT_MENU_TYPE" => "catalog",	// Тип меню для первого уровня
						"MENU_CACHE_TYPE" => "A",	// Тип кеширования
						"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
						"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
						"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
						"MAX_LEVEL" => "1",	// Уровень вложенности меню
						"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
						"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
						"DELAY" => "N",	// Откладывать выполнение шаблона меню
						"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
					),
					false
				);*/?>
				<?php /*normal menu*/ ?>
                <?$APPLICATION->IncludeComponent("sitecoders:automenu", "template1", Array(
					"ROOT_MENU_TYPE" => "catalog",	// Тип меню для первого уровня
						"MENU_CACHE_TYPE" => "Y",	// Тип кеширования
						"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
						"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
						"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
						"MAX_LEVEL" => "1",	// Уровень вложенности меню
						"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
						"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
						"DELAY" => "N",	// Откладывать выполнение шаблона меню
						"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
					),
					false
				);?>
			</div>
			<div class="header_top_section">
				<div class="header_top_section_container_one">
					<div class="bx_cart_login_top">
						<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line",
	"template1",
	array(
		"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"SHOW_PERSONAL_LINK" => "N",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_TOTAL_PRICE" => "Y",
		"SHOW_PRODUCTS" => "N",
		"POSITION_FIXED" => "N",
		"COMPONENT_TEMPLATE" => "template1",
		"SHOW_EMPTY_VALUES" => "Y",
		"SHOW_AUTHOR" => "N",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"POSITION_HORIZONTAL" => "right",
		"POSITION_VERTICAL" => "top",
		"SHOW_DELAY" => "N",
		"SHOW_NOTAVAIL" => "N",
		"SHOW_SUBSCRIBE" => "N",
		"SHOW_IMAGE" => "Y",
		"SHOW_PRICE" => "Y",
		"SHOW_SUMMARY" => "Y",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/"
	),
	false
);?>
					</div>
				</div>
			</div>  <!-- //header_top_section -->
		</div>

	</div><!-- //header_inner_bottom_line_container -->
	<div class="top-menu-shadow"></div>
	<div class="workarea_wrap">
		<div class="worakarea_wrap_container workarea <?if ($wizTemplateId == "eshop_adapt_vertical"):?>grid1x3<?else:?>grid<?endif?>">
			<div class="sidebar">
                <?
                if ($_REQUEST['sec_id'] > 0) {
                    $sid = $_REQUEST['sec_id'];
                } else {
                    $sid = omniGetSIDFromPageUrl();
                }
                if ($sid > 0) {
                    CModule::IncludeModule('iblock');
                    $rSec = CIBlockSection::GetByID($sid);
                    $arSec = $rSec->GetNext();
                    $form_action = $arSec['SECTION_PAGE_URL'];
                } else {
                    $form_action = '/collections/';
                }
                $arNazn = array('/collections/aglomeratnaya-plitka', '/collections/dekorativnaya-plitka', '/collections/keramogranit', '/collections/klinker', '/collections/mozaika', '/collections/napolnaya-plitka', '/collections/nastennaya-plitka', '/collections/plitka-dlya-basseina', '/collections/plitka-dlya-vannoi', '/collections/plitka-dlya-kukhni');
                if (in_array($APPLICATION->GetCurPage(), $arNazn)) {
                    $sid = 0;
                    /*if ($APPLICATION->GetCurPage() == '/collections/nastennaya-plitka') {
                        $form_action = '/collections/';
                    } else {*/
                    $form_action = $APPLICATION->GetCurPage();
                    //}
                }
                $template = ".default"; //filter_vertical
                global $USER;
                if($_SERVER["REMOTE_ADDR"] == "37.193.73.132" && $USER->IsAdmin())
                {
                    var_dump('REMOTE_ADDR true');
                    $template = ".default";//".default";
                }

                ?>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:catalog.smart.filter",
                    $template,
                    Array(
                        "IBLOCK_TYPE" => "catalog",
                        "IBLOCK_ID" => "4",
                        "SECTION_ID" => $sid, //'', //$el['ID'],
                        "FILTER_NAME" => "arrFilter",
                        "PRICE_CODE" => array(	// Тип цены
                            0 => "BASE",
                        ),
                        "COMPOSITE_FRAME_MODE" => "A",
                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                        "CACHE_TYPE" => "Y",
                        "CACHE_TIME" => "36000000",
                        "CACHE_NOTES" => "",
                        "CACHE_GROUPS" => "Y",
                        "SAVE_IN_SESSION" => "N",
                        "XML_EXPORT" => "N",
                        "SECTION_TITLE" => "NAME",
                        "SECTION_DESCRIPTION" => "DESCRIPTION",
                        "FORM_ACTION" => $form_action, //'/filter-tiles/',
                        'SEARCH_EVERYWHERE' => '/collections/',
                    ),
                    false,
                    array('HIDE_ICONS' => 'N')
                );?>

                <?/*$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "sect",
						"AREA_FILE_SUFFIX" => "left",
						"AREA_FILE_RECURSIVE" => "Y",
						"EDIT_MODE" => "html",
					),
					false,
					Array('HIDE_ICONS' => 'Y')
				);*/?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "sect",
						"AREA_FILE_SUFFIX" => "left_btm",
						"AREA_FILE_RECURSIVE" => "N",
						"EDIT_MODE" => "html",
					),
					false,
					Array('HIDE_ICONS' => 'N')
				);?>
			</div>
			<div class="center-side">
				<div class="bx_content_section">
					<?if ($curPage != SITE_DIR."index.php"):?>
						<?/*<style type="text/css">
						.header-table tr td {
							height: 35px;
							min-width: 10px;
						}
						.header-table .ltd {
							width: 55px;
							background: url('/header1.png') 0px -140px no-repeat;
						}
						.header-table .rtd {
							width: 55px;
							background: url('/header1.png') 0px -175px no-repeat;
						}
						.header-table .ltd2 {
							width: 25%;
							background: url('/header1.png') 0px -105px repeat-x;
						}
						.header-table .rtd2 {
							width: 25%;
							background: url('/header1.png') 0px -105px repeat-x;
						}
						.header-table .ltd3 {
							width: 10px;
							background: url('/header1.png') 0px -0px no-repeat;
						}
						.header-table .rtd3 {
							width: 10px;
							background: url('/header1.png') -45px -35px no-repeat;
						}
						.header-table .ctd {
							background: url('/header1.png') 0px -70px repeat-x;
							font: Bold 18px Arial;
							color: white;
							text-transform: uppercase;
						}
						.header-table {
							width: 100%;
							margin-bottom: 10px;
						}
						</style>*/?>
						<div class="cube-3">
							<div style="background:url(/bitrix/templates/eshop_adapt_blue/images/bg-cube.png) no-repeat;height:35px;">
								<h1 class="page-title"><?=$APPLICATION->ShowTitle(false);?></h1>
								<? /* H1 всегда
								include 'urlh1.php';
								?>
								<? if (in_array($APPLICATION->GetCurPAge(false), $urlH1)) { ?>
									<h1 class="page-title"><?=$APPLICATION->ShowTitle(false);?></h1>
								<? } else { ?>
									<span class="page-title"><?=$APPLICATION->ShowTitle(false);?></span>
								<? }*/ ?>
							</div>
						</div>
						<div id="navigation">
							<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array(
									"START_FROM" => "0",
									"PATH" => "",
									"SITE_ID" => "-"
								),
								false,
								Array('HIDE_ICONS' => 'Y')
							);?>
						</div>
						<!--script language="JavaScript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script-->
					<?endif?>



