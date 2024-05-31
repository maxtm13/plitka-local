<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отзывы");
?>
    <br><br><br><br><br><br>
<div class="clear tabs-wrapper">
	<div class="tabs-switch">
 <a href="#tab1" class="active">Отзывы</a><a href="#tab2">ВКонтакте</a>
	</div>
	<div class="tabs">
		<div class="tab" id="tab1">
			 <?$APPLICATION->IncludeComponent(
	"omniweb:prmedia_comments",
	"pnd_commentsNew",
	Array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"ALLOW_RATING" => "Y",
		"ASNAME" => "login",
		"AUTH_PATH" => "/auth/",
		"CACHE_TIME" => "600",
		"CACHE_TYPE" => "A",
		"COMMENTS_COUNT_PAGE" => "10",
		"DATE_FORMAT" => "d.m.Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"NON_AUTHORIZED_USER_CAN_COMMENT" => "N",
		"NO_FOLLOW" => "N",
		"NO_INDEX" => "N",
		"OBJECT_ID" => "8",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "",
		"PREMODERATION" => "Y",
		"SEND_TO_ADMIN_AFTER_ADDING" => "Y",
		"SEND_TO_USER_AFTER_ACTIVATE" => "Y",
		"SHOW_COUNT" => "Y",
		"SHOW_DATE" => "Y",
		"SHOW_USERPIC" => "Y",
		"SORT" => "DESC",
		"TO_USERPAGE" => "/users/#USER_LOGIN#/",
		"USE_CAPTCHA" => "N"
	)
);?>
		</div>
		<div class="tab" id="tab2">
			 <!-- Put this script tag to the <head> of your page --> <script type="text/javascript" src="//vk.com/js/api/openapi.js?154"></script> <script type="text/javascript">
                    VK.init({apiId: 6469713, onlyWidgets: true});
                </script> <!-- Put this div tag to the place, where the Comments block will be -->
			<div id="vk_comments">
			</div>
			 <script type="text/javascript">
                    VK.Widgets.Comments("vk_comments", {limit: 0});
                </script>
            <div id="vk_comments_browse"></div>
            <script type="text/javascript">
                window.onload = function () {
                    VK.init({apiId: 6469713, onlyWidgets: true});
                    VK.Widgets.CommentsBrowse('vk_comments_browse', { limit: 5,norealtime:1 });
                }
            </script>

		</div>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>