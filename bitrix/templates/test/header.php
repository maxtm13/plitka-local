<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
$wizTemplateId = COption::GetOptionString("main", "wizard_template_id", "eshop_adapt_horizontal", SITE_ID);
CUtil::InitJSCore();
CJSCore::Init(array("fx"));
$curPage = $APPLICATION->GetCurPage(true);

$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/script.js");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.colorbox.js");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>favicon.ico" />
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
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/colors.css")?>" />
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/plitka_styles.css")?>" />
	<link rel="stylesheet" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/colorbox.css")?>" />
	<link rel="stylesheet" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/adaptive.css")?>" />
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
<body class="<?$APPLICATION->ShowViewContent("body_class");?>">
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div style="position:fixed; background:#f00; color:#fff; font-weight:bold; font-size:1.2em; padding: 5px; right:0; z-index:10;">TEST</div>
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
					<a href="/"><img src="/bitrix/templates/eshop_adapt_blue/images/home-link.png" alt="home" /></a>
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
						"USE_LANGUAGE_GUESS" => "Y",
						"PRICE_VAT_INCLUDE" => "Y",
						"PREVIEW_TRUNCATE_LEN" => "",
						"CURRENCY_ID" => "RUB"
					),
					false
				);?>
			</div>				
		</div>
	</div>
	
	<div class="header_wrap">

		<div class="header_wrap_container">
		
			<div class="header_inner">
				<div class="header_inner_container_one">
					<div class="header_inner_include_aria"><span style="color: #fff;">
						<a href="/" ><img src="/bitrix/templates/eshop_adapt_blue/images/logotype.png" alt="logo" /></a>
						<div class="phones">
							<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?>
						</div>
						<div class="email">
							<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/schedule.php"), false);?>
						</div></span>
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

	
	<div class="header_inner_bottom_line_container">
		<div class="wrp">
			<div class="header_inner_bottom_line">
				<div class="mobile">
					<a class="mobile-cart-show" href="javascript:void(0)" title="<?php echo GetMessage('TMPL_CART'); ?>"><i class="ico-mobile-cart"></i></a>
					<a class="mobile-menu-show" href="javascript:void(0)" title="<?php echo GetMessage('TMPL_CATALOG_MENU'); ?>"><i class="ico-mobile-menu"></i></a>
					<a class="mobile-param-show" href="javascript:void(0)" title="<?php echo GetMessage('TMPL_PARAM_SEL'); ?>"><i class="ico-mobile-param"></i></a>
				</div>
				<?php /*mobile menu*/ ?>
				<?$APPLICATION->IncludeComponent("sitecoders:automenu", "pnd_tree", Array(
					"ROOT_MENU_TYPE" => "catalog",	// Тип меню для первого уровня
						"MENU_CACHE_TYPE" => "A",	// Тип кеширования
						"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
						"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
						"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
						"MAX_LEVEL" => "2",	// Уровень вложенности меню
						"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
						"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
						"DELAY" => "N",	// Откладывать выполнение шаблона меню
						"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
					),
					false
				);?>
				<?php /*normal menu*/ ?>
                <?$APPLICATION->IncludeComponent("sitecoders:automenu", "template1", Array(
					"ROOT_MENU_TYPE" => "catalog",	// Тип меню для первого уровня
						"MENU_CACHE_TYPE" => "Y",	// Тип кеширования
						"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
						"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
						"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
						"MAX_LEVEL" => "2",	// Уровень вложенности меню
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
				<?$APPLICATION->IncludeComponent(
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
				);?>
			</div>
			<div class="center-side">
				<div class="bx_content_section">
					<?if ($curPage != SITE_DIR."index.php"):?>
						<style>
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
						</style>
						<div class="cube-3">
							<div style="background:url(/bitrix/templates/eshop_adapt_blue/images/bg-cube.png) no-repeat;height:35px;">
								<span class="page-title"><?=$APPLICATION->ShowTitle(false);?></span>
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
						<script language="JavaScript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
					<?endif?>

					
					
