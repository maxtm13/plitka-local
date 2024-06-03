<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($USER->IsAuthorized() || $arParams["ALLOW_AUTO_REGISTER"] == "Y")
{
    if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
    {
        if(strlen($arResult["REDIRECT_URL"]) > 0)
        {
            $APPLICATION->RestartBuffer();
            ?>
            <script type="text/javascript">
                window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
            </script>
            <?
            die();
        }

    }
}

$APPLICATION->SetAdditionalCSS($templateFolder."/style_cart.css");
$APPLICATION->SetAdditionalCSS($templateFolder."/style.css");

CJSCore::Init(array('fx', 'popup', 'window', 'ajax'));
?>

<a name="order_form"></a>

<div id="order_form_div" class="order-checkout">
    <NOSCRIPT>
        <div class="errortext"><?=GetMessage("SOA_NO_JS")?></div>
    </NOSCRIPT>

    <?
    if (!function_exists("getColumnName"))
    {
        function getColumnName($arHeader)
        {
            return (strlen($arHeader["name"]) > 0) ? $arHeader["name"] : GetMessage("SALE_".$arHeader["id"]);
        }
    }

    if (!function_exists("cmpBySort"))
    {
        function cmpBySort($array1, $array2)
        {
            if (!isset($array1["SORT"]) || !isset($array2["SORT"]))
                return -1;

            if ($array1["SORT"] > $array2["SORT"])
                return 1;

            if ($array1["SORT"] < $array2["SORT"])
                return -1;

            if ($array1["SORT"] == $array2["SORT"])
                return 0;
        }
    }
    ?>

    <div class="bx_order_make">
        <?
        if(!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N")
        {
            if(!empty($arResult["ERROR"]))
            {
                foreach($arResult["ERROR"] as $v)
                    echo ShowError($v);
            }
            elseif(!empty($arResult["OK_MESSAGE"]))
            {
                foreach($arResult["OK_MESSAGE"] as $v)
                    echo ShowNote($v);
            }

            include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/auth.php");
        }
        else
        {
            if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
            {
                if(strlen($arResult["REDIRECT_URL"]) == 0)
                {
                    include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/confirm.php");
                }
            }
            else
            {
                ?>
                <script type="text/javascript">
                    var BXFormPosting = false;
                    function submitForm(val)
                    {
                        if (BXFormPosting === true)
                            return true;

                        BXFormPosting = true;
                        if(val != 'Y')
                            BX('confirmorder').value = 'N';

                        var orderForm = BX('ORDER_FORM');
                        BX.showWait();

                        BX.ajax.submit(orderForm, ajaxResult);

                        return true;
                    }

                    function ajaxResult(res)
                    {
                        try
                        {
                            var json = JSON.parse(res);
                            BX.closeWait();

                            if (json.error)
                            {
                                BXFormPosting = false;
                                return;
                            }
                            else if (json.redirect)
                            {
                                window.top.location.href = json.redirect;
                            }
                        }
                        catch (e)
                        {
                            BXFormPosting = false;
                            BX('order_form_content').innerHTML = res;
                        }

                        BX.closeWait();
                    }

                    function SetContact(profileId)
                    {
                        BX("profile_change").value = "Y";
                        submitForm();
                    }
                </script>
                <?if($_POST["is_ajax_post"] != "Y")
            {
                ?><form action="<?=$APPLICATION->GetCurPage();?>" method="POST" name="ORDER_FORM" id="ORDER_FORM" enctype="multipart/form-data">
                <?=bitrix_sessid_post()?>
                <div id="order_form_content">
                    <?
                    }
                    else
                    {
                        $APPLICATION->RestartBuffer();
                    }
                    if(!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y")
                    {
                        foreach($arResult["ERROR"] as $v)
                            echo ShowError($v);
                        ?>
                        <script type="text/javascript">
                            top.BX.scrollToNode(top.BX('ORDER_FORM'));
                        </script>
						<p>f</p>
                        <?
                    }

                    include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/person_type.php");
                    include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props.php");
                    if ($arParams["DELIVERY_TO_PAYSYSTEM"] == "p2d")
                    {
                        include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
                        include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
                    }
                    else
                    {
                        include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
                        include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
                    }

                    include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/related_props.php");

                    include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/summary.php");
                    if(strlen($arResult["PREPAY_ADIT_FIELDS"]) > 0)
                        echo $arResult["PREPAY_ADIT_FIELDS"];
                    ?>

                    <?if($_POST["is_ajax_post"] != "Y")
                    {
                    ?>
                </div>
                <input type="hidden" name="confirmorder" id="confirmorder" value="Y">
                <input type="hidden" name="profile_change" id="profile_change" value="N">
                <input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">
                <input type="hidden" name="json" value="Y">

                <div class="bx_ordercart_order_pay_center test"><a href="javascript:void();" onclick="submitForm('Y'); return false;" id="ORDER_CONFIRM_BUTTON" class="checkout "><?=GetMessage("SOA_TEMPL_BUTTON")?></a></div>
                <label for="" class="checkbox-custom">
                    <input type="checkbox" class="checkbox-cart" id="chbx" checked>
                    <a class="cart__modal"> Нажимая кнопку, я даю свое согласие на обработку моих персональных данных.</a>
                </label>
            </form>
                <?
            if($arParams["DELIVERY_NO_AJAX"] == "N")
            {
                ?>
                <div style="display:none;"><?$APPLICATION->IncludeComponent("bitrix:sale.ajax.delivery.calculator", "", array(), null, array('HIDE_ICONS' => 'Y')); ?></div>
            <?
            }
            }
            else
            {
            ?>
                <script type="text/javascript">
                    top.BX('confirmorder').value = 'Y';
                    top.BX('profile_change').value = 'N';
                </script>
                <?
                die();
            }
            }
        }
        ?>
    </div>
</div>
<style>
    .checkout-disabled {
        pointer-events: none;
        background: linear-gradient(to bottom, #bababa 0%,#7a7a7a 100%) !important;
    }
    .checkbox-custom {
        display: flex;
        justify-content: flex-end;
    }
    .checkbox-cart {
        position: initial !important;
    }
    .main-user-consent-request-popup {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background-color: rgba(0,0,0,0.5);
        overflow: hidden;
        z-index: 9000;
    }
    .main-user-consent-request-popup-cont {
        min-height: 290px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin: 0 auto;
        padding: 20px;
        min-width: 320px;
        background: #fff;
        text-align: center;
        -webkit-transform: translate(-50%,-50%);
        transform: translate(-50%,-50%);
        -webkit-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        overflow-y: auto;
    }
    .main-user-consent-request-popup-header {
        margin: 0 0 30px 0;
        font: normal 18px "Helvetica Neue",Arial,Helvetica,sans-serif;
        color: #000;
        text-align: left;
    }
    .main-user-consent-request-popup-textarea-block {
        margin: 0 0 20px 0;
    }
    .main-user-consent-request-popup-text {
        padding: 5px 10px;
        width: 100%;
        height: 130px;
        border: 1px solid #999;
        background: #fff;
        box-sizing: border-box;
        outline: 0;
        -moz-appearance: none;
    }
    TEXTAREA {
        overflow: auto;
        vertical-align: top;
    }
    .main-user-consent-request-popup-buttons {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }
    .main-user-consent-request-popup-button-acc {
        background: #bbed21;
    }

    .main-user-consent-request-popup-button {
        display: inline-block;
        height: 39px;
        margin: 0 10px 5px 0;
        padding: 0 18px;
        border: 0;
        border-radius: 2px;
        font: normal 12px/39px "Helvetica Neue",Helvetica,Arial,sans-serif;
        color: #535c69;
        outline: 0;
        vertical-align: middle;
        text-decoration: none;
        text-transform: uppercase;
        text-shadow: none;
        white-space: nowrap;
        -webkit-font-smoothing: antialiased;
        -webkit-transition: background-color .2s linear,color .2s linear;
        transition: background-color .2s linear,color .2s linear;
        cursor: pointer;
    }
    .main-user-consent-request-popup-button-rej {
        -webkit-box-shadow: inset 0 0 0 1px #a1a6ac;
        box-shadow: inset 0 0 0 1px #a1a6ac;
        background: 0;
    }

    .main-user-consent-request-popup-button {
        display: inline-block;
        height: 39px;
        margin: 0 10px 5px 0;
        padding: 0 18px;
        border: 0;
        border-radius: 2px;
        font: normal 12px/39px "Helvetica Neue",Helvetica,Arial,sans-serif;
        color: #535c69;
        outline: 0;
        vertical-align: middle;
        text-decoration: none;
        text-transform: uppercase;
        text-shadow: none;
        white-space: nowrap;
        -webkit-font-smoothing: antialiased;
        -webkit-transition: background-color .2s linear,color .2s linear;
        transition: background-color .2s linear,color .2s linear;
        cursor: pointer;
    }
</style>
<script>

</script>
<div class="main-user-consent-request-popup" style="display: none;">
    <div class="main-user-consent-request-popup-cont">
        <div data-bx-head="" class="main-user-consent-request-popup-header">Согласие на обработку персональных данных</div>
        <div class="main-user-consent-request-popup-body">
            <div data-bx-loader="" class="main-user-consent-request-loader" style="display: none;">
                <svg class="main-user-consent-request-circular" viewBox="25 25 50 50">
                    <circle class="main-user-consent-request-path" cx="50" cy="50" r="20" fill="none" stroke-width="1" stroke-miterlimit="10"></circle>
                </svg>
            </div>
            <div data-bx-content="" class="main-user-consent-request-popup-content" style="">
                <div class="main-user-consent-request-popup-textarea-block">
						<textarea data-bx-textarea="" class="main-user-consent-request-popup-text" disabled="" style="margin: 0px; width: 597px; height: 336px;">Согласие на обработку персональных данных

Настоящим в соответствии с Федеральным законом № 152-ФЗ «О персональных данных» от 27.07.2006 года свободно, своей волей и в своем интересе выражаю свое безусловное согласие на обработку моих персональных данных на веб-сайте www.plitkanadom.ru.
Персональные данные - любая информация, относящаяся к определенному или определяемому на основании такой информации физическому лицу.

Согласие дано Оператору для совершения следующих действий с моими персональными данными с использованием средств автоматизации и/или без использования таких средств: сбор, систематизация, накопление, хранение, уточнение (обновление, изменение), использование, обезличивание, а также осуществление любых иных действий, предусмотренных действующим законодательством РФ как неавтоматизированными, так и автоматизированными способами.
Данное согласие дается Оператору для обработки моих персональных данных в следующих целях:
- предоставление мне услуг/работ;
- направление в мой адрес уведомлений, касающихся предоставляемых услуг/работ;
- подготовка и направление ответов на мои запросы;
- направление в мой адрес информации, в том числе рекламной, о мероприятиях/товарах/услугах/работах Оператора.

Настоящее согласие действует до момента его отзыва путем направления соответствующего уведомления на электронный адрес info@plitkanadom.ru. В случае отзыва мною согласия на обработку персональных данных Оператор вправе продолжить обработку персональных данных без моего согласия при наличии оснований, указанных в пунктах 2 – 11 части 1 статьи 6, части 2 статьи 10 и части 2 статьи 11 Федерального закона №152-ФЗ «О персональных данных» от 27.06.2006 г.</textarea>
                </div>
                <div class="main-user-consent-request-popup-buttons">
                    <span data-bx-btn-accept="" class="main-user-consent-request-popup-button main-user-consent-request-popup-button-acc" id="check_yes">Принимаю</span>
                    <span data-bx-btn-reject="" class="main-user-consent-request-popup-button main-user-consent-request-popup-button-rej" id="check_no">Не принимаю</span>
                </div>
            </div>
        </div>
    </div>
</div>
