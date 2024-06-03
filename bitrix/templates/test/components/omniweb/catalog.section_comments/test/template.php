<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$APPLICATION->AddHeadString('<script type="text/javascript" src="'.$templateFolder.'/script.js"></script>', true);

$templateData = array(
	'TABS_ID' => 'soc_comments_'.$arResult['ELEMENT']['ID'],
	'TABS_FRAME_ID' => 'soc_comments_div_'.$arResult['ELEMENT']['ID'],
	'BLOG_USE' => ($arResult['BLOG_USE'] ? 'Y' : 'N'),
	'FB_USE' => $arParams['FB_USE'],
	'VK_USE' => $arParams['VK_USE'],
	'BLOG' => array(
		'BLOG_FROM_AJAX' => $arResult['BLOG_FROM_AJAX'],
	),
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
);

if (!$templateData['BLOG']['BLOG_FROM_AJAX']) {
	if (!empty($arResult['ERRORS']))
	{
		ShowError(implode('<br>', $arResult['ERRORS']));
		return;
	}

	$arData = array();
	$arJSParams = array(
		'serviceList' => array(

		),
		'settings' => array(

		)
	);

	if ($arResult['BLOG_USE'])
	{
		$templateData['BLOG']['AJAX_PARAMS'] = array(
			'IBLOCK_ID' => $arResult['ELEMENT']['IBLOCK_ID'],
			'ELEMENT_ID' => $arResult['ELEMENT']['ID'],
			'URL_TO_COMMENT' => $arParams['~URL_TO_COMMENT'],
			'WIDTH' => $arParams['WIDTH'],
			'COMMENTS_COUNT' => $arParams['COMMENTS_COUNT'],
			'BLOG_USE' => 'Y',
			'BLOG_FROM_AJAX' => 'Y',
			'FB_USE' => 'N',
			'VK_USE' => 'N',
			'BLOG_TITLE' => $arParams['~BLOG_TITLE'],
			'BLOG_URL' => $arParams['~BLOG_URL'],
			'PATH_TO_SMILE' => $arParams['~PATH_TO_SMILE'],
			'EMAIL_NOTIFY' => $arParams['EMAIL_NOTIFY'],
			'AJAX_POST' => $arParams['AJAX_POST'],
			'SHOW_SPAM' => $arParams['SHOW_SPAM'],
			'SHOW_RATING' => $arParams['SHOW_RATING'],
			'RATING_TYPE' => $arParams['~RATING_TYPE'],
			'CACHE_TYPE' => 'N',
			'CACHE_TIME' => '0',
			'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
			'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME'],
			'SHOW_DEACTIVATED' => $arParams['SHOW_DEACTIVATED'],
		);

		$arJSParams['serviceList']['blog'] = true;
		$arJSParams['settings']['blog'] = array(
			'ajaxUrl' => $templateFolder.'/ajax.php?IBLOCK_ID='.$arResult['ELEMENT']['IBLOCK_ID'].'&ELEMENT_ID='.$arResult['ELEMENT']['ID'].'&SITE_ID='.SITE_ID,
			'ajaxParams' => array(),
			'contID' => 'bx-cat-soc-comments-blg_'.$arResult['ELEMENT']['ID']
		);

		$arBlogCommentParams = array(
			'SEO_USER' => 'N',
			'ID' => $arResult['BLOG_DATA']['BLOG_POST_ID'],
			'BLOG_URL' => $arResult['BLOG_DATA']['BLOG_URL'],
			'PATH_TO_SMILE' => $arParams['PATH_TO_SMILE'],
			'COMMENTS_COUNT' => $arParams['COMMENTS_COUNT'],
			"DATE_TIME_FORMAT" => $DB->DateFormatToPhp(FORMAT_DATE), //was FORMAT_DATETIME
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"AJAX_POST" => $arParams["AJAX_POST"],
			"AJAX_MODE" => "N",
			"AJAX_OPTION_HISTORY" => "N",
			"SIMPLE_COMMENT" => "Y",
			"SHOW_SPAM" => $arParams["SHOW_SPAM"],
			"NOT_USE_COMMENT_TITLE" => "Y",
			"SHOW_RATING" => $arParams["SHOW_RATING"],
			"RATING_TYPE" => $arParams["RATING_TYPE"],
			"PATH_TO_POST" => $arResult["URL_TO_COMMENT"],
			"IBLOCK_ID" => $templateData['BLOG']['AJAX_PARAMS']['IBLOCK_ID'],
			"ELEMENT_ID" => $templateData['BLOG']['AJAX_PARAMS']['ELEMENT_ID'],
			"NO_URL_IN_COMMENTS" => "L",
			'SECTION_NAME' => $arResult['ELEMENT']['NAME'],
			'SITE_ID' => SITE_ID
		);
		
		$arData["BLOG"] =  array(
			"NAME" => ($arParams['BLOG_TITLE'] != '' ? $arParams['BLOG_TITLE'] : GetMessage('IBLOCK_CSC_TAB_COMMENTS')),
			"ACTIVE" => "Y",
			"CONTENT" => '<div id="bx-cat-soc-comments-blg_'.$arResult['ELEMENT']['ID'].'">'.GetMessage("IBLOCK_CSC_COMMENTS_LOADING").'</div>'
		);
	}

	if ($arParams["FB_USE"] == "Y")
	{
		$arJSParams['serviceList']['facebook'] = true;
		$arJSParams['settings']['facebook'] = array(
			'parentContID' => $templateData['TABS_ID'],
			'contID' => 'bx-cat-soc-comments-fb_'.$arResult['ELEMENT']['ID'],
			'facebookPath' => '//connect.facebook.net/'.(strtolower(LANGUAGE_ID)."_".strtoupper(LANGUAGE_ID)).'/all.js#xfbml=1'
		);
		$arData["FB"] = array(
			"NAME" => isset($arParams["FB_TITLE"]) && trim($arParams["FB_TITLE"]) != "" ? $arParams["FB_TITLE"] : "Facebook",
			"CONTENT" => '<div id="fb-root"></div>
			<div id="bx-cat-soc-comments-fb_'.$arResult['ELEMENT']['ID'].'"><div class="fb-comments" data-href="'.$arResult["URL_TO_COMMENT"].'"'.
			(isset($arParams["FB_COLORSCHEME"]) ? ' data-colorscheme="'.$arParams["FB_COLORSCHEME"].'"' : '').
			(isset($arParams["COMMENTS_COUNT"]) ? ' data-numposts="'.$arParams["COMMENTS_COUNT"].'"' : '').
			(isset($arParams["FB_ORDER_BY"]) ? ' data-order-by="'.$arParams["FB_ORDER_BY"].'"' : '').
			(isset($arResult["WIDTH"]) ? ' data-width="'.($arResult["WIDTH"] - 20).'"' : '').
			'></div></div>'.PHP_EOL
		);
	}

	if ($arParams["VK_USE"] == "Y")
	{
		$arData["VK"] = array(
			"NAME" => isset($arParams["VK_TITLE"]) && trim($arParams["VK_TITLE"]) != "" ? $arParams["VK_TITLE"] : GetMessage("IBLOCK_CSC_TAB_VK"),
			"CONTENT" => '
				<div id="vk_comments"></div>
				<script type="text/javascript">
					BX.ready(BX.defer(function(){
						if (!!window.VK)
						{
							VK.init({
								apiId: "'.(isset($arParams["VK_API_ID"]) && strlen($arParams["VK_API_ID"]) > 0 ? $arParams["VK_API_ID"] : "API_ID").'",
								onlyWidgets: true
							});

							VK.Widgets.Comments(
								"vk_comments",
								{
									pageUrl: "'.$arResult["URL_TO_COMMENT"].'",'.
									(isset($arParams["COMMENTS_COUNT"]) ? "limit: ".$arParams["COMMENTS_COUNT"]."," : "").
									(isset($arResult["WIDTH"]) ? "width: ".($arResult["WIDTH"] - 20)."," : "").
									'attach: false
								}
							);
						}
					}));
				</script>'
		);
	}

	if (!empty($arData)) {
		$arTabsParams = array(
			"DATA" => $arData,
			"ID" => $templateData['TABS_ID']
		);

		if (isset($arResult["WIDTH"]))
		{
			$arTabsParams["WIDTH"] = $arResult["WIDTH"];
		}
		?>
		<h3><?php echo GetMessage('PND_CUSTOMES_REVIEWS'); ?></h3>
		<div id="<? echo $templateData['TABS_FRAME_ID']; ?>" class="bx_soc_comments_div bx_important <? echo $templateData['TEMPLATE_CLASS']; ?>">
			<?/***<div id="soc_comments_<? echo $arParams["ELEMENT_ID"]; ?>" class="bx-catalog-tab-section-container">
				<div class="bx-catalog-tab-body-container">
					<div class="bx-catalog-tab-container">
						<div id="soc_comments_<? echo $arParams["ELEMENT_ID"]; ?>BLOG_cont">
							<div id="bx-cat-soc-comments-blg_<?=$arResult['ELEMENT']['ID']?>">***/?>
								<?/*$APPLICATION->IncludeComponent(
									"bitrix:catalog.tabs",
									"",
									$arTabsParams,
									$component,
									array("HIDE_ICONS" => "Y")
								);*/?>
								<?$APPLICATION->IncludeComponent(
									'bitrix:blog.post.comment',
									'adapt',
									$arBlogCommentParams,
									$component,
									array('HIDE_ICONS' => 'Y')
								);?>
							<?/***</div>
						</div>
					</div>
				</div>
			</div>***/?>
		</div> <!--.bx_soc_comments_div-->
		<script type="text/javascript">
			var obCatalogComments_<? echo $arResult['ELEMENT']['ID']; ?> = new JCCatalogSocnetsComments(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
		</script>
	<? } else {
		ShowError(GetMessage("IBLOCK_CSC_NO_DATA"));
	}
} ?>