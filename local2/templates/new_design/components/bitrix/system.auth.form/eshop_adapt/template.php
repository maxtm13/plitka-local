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

CJSCore::Init(array("popup"));
?>
<div class="bx_login_block">

    <?
        use Bitrix\Main\Loader;
        Loader::includeModule("sale");
        $delaydBasketItems = CSaleBasket::GetList(
            array(),
                array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL",
                "DELAY" => "Y"
            ),
          array()
        );


        global $USER;
        if ($USER->IsAuthorized()){
    ?>
        <div class="favorite-icon d-inline v-midle" style="float:left;">
            <a href="https://www.plitkanadom.ru/personal/cart?favorite=true" style="text-decoration:none; float: left;">
                <img src="<?=SITE_TEMPLATE_PATH?>/images/favorite.png" style="max-width:32px;"/>
            </a>
            <div class="count" style="float: left;"><?=$delaydBasketItems?></div>
        </div>
    <?}?>


    <div class="bx_login_ico d-inline v-midle"><a href="/personal/"></a></div>
    <div id="login-line" class="d-inline v-midle">
    <?
    $frame = $this->createFrame("login-line", false)->begin();
        if ($arResult["FORM_TYPE"] == "login")
        {
        ?>
            <a class="bx_login_top_inline_link" href="javascript:void(0)<?//=$arResult["AUTH_URL"]?>" onclick="openAuthorizePopup()"><?=GetMessage("AUTH_LOGIN")?></a>
            <?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
            <a class="bx_login_top_inline_link" href="/login/?register=yes<? //=$arResult["AUTH_REGISTER_URL"]?>" ><?=GetMessage("AUTH_REGISTER")?></a>
            <?endif;
        }
        else
        {
            $name = trim($USER->GetFullName());
            if (strlen($name) <= 0)
                $name = $USER->GetLogin();
        ?>
            <a class="bx_login_top_inline_link" href="<?=$arResult['PROFILE_URL']?>"><?=htmlspecialcharsEx($name);?></a>
            <a class="bx_login_top_inline_link" href="<?=$APPLICATION->GetCurPageParam("logout=yes", Array("logout"))?>"><?=GetMessage("AUTH_LOGOUT")?></a>
        <?
        }
    $frame->beginStub();
        ?>
        <a class="bx_login_top_inline_link" href="javascript:void(0)<?//=$arResult["AUTH_URL"]?>" onclick="openAuthorizePopup()"><?=GetMessage("AUTH_LOGIN")?></a>
        <?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
            <a class="bx_login_top_inline_link" href="<?=$arResult["AUTH_REGISTER_URL"]?>" ><?=GetMessage("AUTH_REGISTER")?></a>
        <?endif;
    $frame->end();
    ?>
    </div>
</div>

<?if ($arResult["FORM_TYPE"] == "login"):?>
    <div id="bx_auth_popup_form" style="display:none;" class="bx_login_popup_form">
    <?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "eshop_adapt_auth",
        array(
            "BACKURL" => $arResult["BACKURL"],
            "AUTH_FORGOT_PASSWORD_URL" => $arResult["AUTH_FORGOT_PASSWORD_URL"],
        ),
        false
    );
    ?>
    </div>

    <script type="text/javascript">
        function openAuthorizePopup()
        {
            var authPopup = BX.PopupWindowManager.create("AuthorizePopup", null, {
                autoHide: true,
                //  zIndex: 0,
                offsetLeft: 0,
                offsetTop: 0,
                overlay : true,
                draggable: {restrict:true},
                closeByEsc: true,
                closeIcon: { right : "12px", top : "10px"},
                content: '<div style="width:400px;height:400px; text-align: center;"><span style="position:absolute;left:50%; top:50%"><img src="<?=$this->GetFolder()?>/images/wait.gif" alt="" /></span></div>',
                events: {
                    onAfterPopupShow: function()
                    {
                        this.setContent(BX("bx_auth_popup_form"));
                    }
                }
            });

            authPopup.show();
        }
    </script>
<?endif?>