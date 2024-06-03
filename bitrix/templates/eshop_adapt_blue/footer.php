<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$seoID = getElementID($_SERVER["SCRIPT_URL"],"PROPERTY_NEW",33);
	if($seoID){
		$APPLICATION->IncludeComponent("bitrix:news.detail", "seo_tags_foot",
			[
				"IBLOCK_TYPE" => "services",
				"IBLOCK_ID" => "33",
				"ELEMENT_ID" => $seoID,
				"ELEMENT_CODE" => "",
				"FIELD_CODE" => ["PREVIEW_TEXT", "DETAIL_TEXT", "IPROPERTY_TEMPLATES"],
				"PROPERTY_CODE" => ["NEW", "REAL"],
				"SET_TITLE" => "N",
				"ADD_ELEMENT_CHAIN" => "N",
				"SET_CANONICAL_URL" => "N",
				"SET_BROWSER_TITLE" => "Y",
				"SET_META_KEYWORDS" => "Y",
				"SET_META_DESCRIPTION" => "Y",
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
				"PAGEN" => $_REQUEST["PAGEN_1"]
			], false
		);
	}
?>
<?$curPage = $APPLICATION->GetCurPage(true);?>
</div> <!-- //bx_content_section-->
<?if ($wizTemplateId == "eshop_adapt_vertical"):?>
    <div class="bx_sidebar">
        <?$APPLICATION->IncludeComponent("bitrix:menu", "catalog_vertical", array(
            "ROOT_MENU_TYPE" => "left",
            "MENU_CACHE_TYPE" => "A",
            "MENU_CACHE_TIME" => "360000",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "CACHE_SELECTED_ITEMS" => "N",
            "MENU_THEME" => "site",
            "MENU_CACHE_GET_VARS" => array(
            ),
            "MAX_LEVEL" => "3",
            "CHILD_MENU_TYPE" => "left",
            "USE_EXT" => "Y",
            "DELAY" => "N",
            "ALLOW_MULTI_SELECT" => "N"
        ),
            false
        );?>
        <?if (
            $APPLICATION->GetCurPage(false) != SITE_DIR."personal/cart/"
            && $APPLICATION->GetCurPage(false) != SITE_DIR."personal/order/make/"
        ):?>
            <?if ($curPage != SITE_DIR."index.php"):?>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR."include/viewed_product.php",
                        "AREA_FILE_RECURSIVE" => "N",
                        "EDIT_MODE" => "html",
                    ),
                    false,
                    Array('HIDE_ICONS' => 'Y')
                );?>
            <?endif?>
        <?endif?>
    </div> <?/*.bx_sidebar*/?>
    <div style="clear: both;"></div>
<?endif?>
<?if (
    $wizTemplateId == "eshop_adapt_horizontal"
    && $APPLICATION->GetCurPage(false) != SITE_DIR."personal/cart/"
    && $APPLICATION->GetCurPage(false) != SITE_DIR."personal/order/make/"
):?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_DIR."include/viewed_product.php",
            "AREA_FILE_RECURSIVE" => "N",
            "EDIT_MODE" => "html",
        ),
        false,
        Array('HIDE_ICONS' => 'Y')
    );?>
<?endif?>
</div> <!-- //center-side-->
</div> <!-- //worakarea_wrap_container workarea-->
</div> <!-- //workarea_wrap-->

<div style="clear:both;"></div>
<div class="bottom_up">
    <a href='#' id='Go_Top' title="Вернуться к началу"><img src ="/bitrix/templates/eshop_adapt_blue/images/upq.png" alt="Наверх" title="Наверх" /></a>
</div>
<div style="clear:both;"></div>

</main>
<footer class="new-footer">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 top_block">
                <span class="input-caption">Оставайтесь в курсе последних новостей</span>
                <form action="">
                    <input type="text" placeholder="E-mail адрес" />
                    <button type="submit"><span></span></button>
                </form>
            </div>
            <div class="col-md-4 block_soc">
                <div>
                    <a href="https://www.youtube.com/channel/UC38XOpu6Ov6-eRogcQxDBnw" target="_blank" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="http://ok.ru/plitkanado/" target="_blank" title="Ok">
                        <i class="fab fa-odnoklassniki"></i>
                    </a>
                    <a href="https://twitter.com/Plitkanadom" target="_blank" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com/plitkanadom.ru/" target="_blank" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://vk.com/public64362093" target="_blank" title="Vkontakte">
                        <i class="fab fa-vk"></i>
                    </a>
                    <a href="https://www.facebook.com/%D0%9F%D0%BB%D0%B8%D1%82%D0%BA%D0%B0-%D0%BD%D0%B0-%D0%B4%D0%BE%D0%BC%D1%80%D1%83-378809075589877/" target="_blank" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </div>
            </div>
            <div class="col-12 block_sections">
                <div class="row">
                    <div class="col-md-4 footer_menu">
                        <div class="off footer-menu-title">
                            Каталог
                            <i class="fas fa-angle-down"></i>
                        </div>
                        <ul>
                            <li>
                                <a href="/collections/plitka-dlya-vannoi">Плитка для ванной</a>
                            </li>
                            <li>
                                <a href="/collections/napolnaya-plitka">Напольная плитка</a>
                            </li>
                            <li>
                                <a href="/collections/keramogranit">Керамогранит</a>
                            </li>
                            <li>
                                <a href="/collections/klinker">Ступени (Клинкер)</a>
                            </li>
                            <li>
                                <a href="/collections/ispanskaya-plitka">Испанская плитка</a>
                            </li>
                            <li>
                                <a href="/collections/italyanskaya-plitka">Итальянская плитка</a>
                            </li>
                            <li>
                                <a href="/napolnye-pokrytiya/laminat">Ламинат</a>
                            </li>
                            <li>
                                <a href="/napolnye-pokrytiya/parketnaya-doska">Паркетная доска</a>
                            </li>
                            <li>
                                <a href="/santekhnika/dushevoy-ugolok">Душевой уголок</a>
                            </li>
                            <li>
                                <a href="/santekhnika/vanny">Ванные</a>
                            </li>
                            <li>
                                <a href="/collections/mozaika">Мозаика</a>
                            </li>
                            <li>
                                <a href="/santekhnika/installyatsii">Инсталляция</a>
                            </li>
                            <li>
                                <a href="/collections/rossiiskaya-plitka/kerama-marazzi">Керама Марацци</a>
                            </li>
                            <li>
                                <a href="/collections/rossiiskaya-plitka/alma-ceramica">Alma Ceramica</a>
                            </li>
                            <li>
                                <a href="/collections/ispanskaya-plitka/equipe">Equipe</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-xl-2 footer_menu">
                        <div class="off footer-menu-title">
                            Покупателям
                            <i class="fas fa-angle-down"></i>
                        </div>
                        <ul>
                            <li>
                                <a href="/contacts/">Контакты</a>
                            </li>
                            <li>
                                <a href="/content/dostavka/">Доставка</a>
                            </li>
                            <li>
                                <a href="/shourum/">Шоурум</a>
                            </li>
                            <li>
                                <a href="/onas/">Почему мы</a>
                            </li>
                            <li>
                                <a href="/news/">Новости</a>
                            </li>
                            <li>
                                <a href="/articles/">Статьи</a>
                            </li>
                            <li>
                                <a href="/3d-design/">Раскладка плитки</a>
                            </li>
                            <li>
                                <a href="/contacts/director/">Написать директору</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-xl-3 footer_menu">
                        <div class="off footer-menu-title">
                            Наши предложения
                            <i class="fas fa-angle-down"></i>
                        </div>
                        <ul>
                            <li>
                                <a href="/promotions/">Акции и распродажи</a>
                            </li>
                            <li>
                                <a href="/populyarnaya-plitka/">Хиты</a>
                            </li>
                            <li>
                                <a href="/novinki/">Новинки</a>
                            </li>
                            <li>
                                <a href="/likvidaciya-sklada/">Уценка</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-xl-2 footer_menu">
                        <div class="off">
                            Контакты
                            <i class="fas fa-angle-down"></i>
                        </div>
                        <ul>
                            <li>
                                <a href="tel:+7 (495) 777-71-21" class="phone">+7 (495) 777-71-21</a><br />
                                <a href="tel:+7 (800) 755-755-7" class="phone">+7 (800) 755-755-7</a>
                            </li>
                            <li>
                                <a href="mailto:info@plitkanadom.ru" class="e_mail">info@plitkanadom.ru</a>
                            </li>
                            <li class="mb">
                                <span>Москва, 2-й Вязовский<br />пр-д, 10, стр.2</span>
                            </li>
                            <li class="mb">
                                <span>Офис и склад:<br />Пн-Пт - с 9:30 до 18:00;<br />Сб - с 9:30 до 15:00<br />без перерывов;</span>
                            </li>
                            <li class="mb">
                                <span>Приём заказов:<br />круглосуточно без выходных!</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 bottom_block">
                <div class="row">
                    <div class="col-md-6 col-for-span">
                       <span><div class="yandex-market"><a rel="nofollow" href="https://market.yandex.ru/shop--plitkanadom-ru/96890/reviews" target="_blank"><img class="yandex-market" width="122" height="49" src="/bitrix/templates/eshop_adapt_blue/images/yandex-market_5_star.png" data-src="/bitrix/templates/eshop_adapt_blue/images/yandex-market_5_star.png" alt="yandex-market">
                       <span>Смотреть отзывы</span></a></div></span>
                    </div>
                    <div class="col-md-6 col-policy">
                        <a href=""></a>
                    </div>
                </div>
            </div>
            <div class="col-12 bottom_block">
                <div class="row">
                    <div class="col-md-6 col-for-span">
                        <span>© 2010 - 2020 «Плитка на дом»</span>
                    </div>
                    <div class="col-md-6 col-policy">
                        <a href="/policy/" rel="nofollow">Политика конфиденциальности</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<? /*
<!-- Top100 (Kraken) Counter -->
<script>
    (function (w, d, c) {
        (w[c] = w[c] || []).push(function() {
            var options = {
                project: 2416929
            };
            try {
                w.top100Counter = new top100(options);
            } catch(e) { }
        });
        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src =
            (d.location.protocol == "https:" ? "https:" : "http:") +
            "//st.top100.ru/top100/top100.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(window, document, "_top100q");
</script>
<noscript><img src="//counter.rambler.ru/top100.cnt?pid=2416929" alt=""></noscript>
<!-- END Top100 (Kraken) Counter -->
*/ ?>
<!--LiveInternet counter--><script async type="text/javascript"><!--
    document.write("<a href='//www.liveinternet.ru/click' rel = 'nofollow'"+
        "target=_blank><img src='//counter.yadro.ru/hit?t44.2;r"+
        escape(document.referrer)+((typeof(screen)=="undefined")?"":
            ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
            screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
        ";"+Math.random()+
        "' alt='LiveInternet' title='LiveInternet' "+
        "border='0' width='31' height='31' style = 'margin-top: 10px;display: none;'><\/a>")
    //--></script><!--/LiveInternet-->
</div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(24968570, "init", {
        id:24968570,
		  webvisor:true,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        ecommerce:"dataLayer"
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/24968570" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!-- Start zvonok online -->
<script async type="text/javascript">

    var ZingayaConfig = {"buttonLabel":"Позвонить с сайта","labelColor":"#14227d","labelFontSize":15,"labelTextDecoration":"none","labelFontWeight":"bold","labelShadowDirection":"bottom","labelShadowColor":"#8fd3ec","labelShadow":0,"buttonBackgroundColor":"#68c3f0","buttonGradientColor1":"#68c3f0","buttonGradientColor2":"#5bbaee","buttonGradientColor3":"#5fbdef","buttonGradientColor4":"#62bfef","buttonShadow":"true","buttonHoverBackgroundColor":"#69ad26","buttonHoverGradientColor1":"#30b3f1","buttonHoverGradientColor2":"#2aa8ef","buttonHoverGradientColor3":"#2cacf0","buttonHoverGradientColor4":"#2daef0","buttonActiveShadowColor1":"","buttonActiveShadowColor2":"","buttonCornerRadius":22,"buttonPadding":8,"iconColor":"#ffffff","iconOpacity":1,"iconDropShadow":0,"iconShadowColor":"#13487f","iconShadowDirection":"bottom","iconShadowOpacity":0.5,"callme_id":"6935a6a313964ac984456b36aa201c22","poll_id":null,"analytics_id":null,"zid":"7d42fe554198bbc751dd0248832458d1","type":"widget","widgetPosition":"left","plain_html":false,"save":1};
    (function(d, t) {
        var g = d.createElement(t),s = d.getElementsByTagName(t)[0];g.src = '//d1bvayotk7lhk7.cloudfront.net/js/zingayabutton.js';g.async = 'true';
        g.onload = g.onreadystatechange = function() {
            if (this.readyState && this.readyState != 'complete' && this.readyState != 'loaded') return;
            try {Zingaya.load(ZingayaConfig, 'zingaya6935a6a313964ac984456b36aa201c22'); if (!Zingaya.SVG()) {
                var p = d.createElement(t);p.src='//d1bvayotk7lhk7.cloudfront.net/PIE.js';p.async='true';s.parentNode.insertBefore(p, s);
                p.onload = p.onreadystatechange = function() {
                    if (this.readyState && this.readyState != 'complete' && this.readyState != 'loaded') return;
                    if (window.PIE) PIE.attach(document.getElementById("zingayaButton"+ZingayaConfig.callme_id));
                }}} catch (e) {}};
        s.parentNode.insertBefore(g, s);
    }(document, 'script'));

</script>
<!-- End zvonok online -->

	<div class="clear"></div>
</div>

<?php

if(ERROR_404 == "Y"){
	$APPLICATION->SetTitle("Страница не найдена");
	$APPLICATION->SetPageProperty("title", "Страница не найдена");
	$APPLICATION->SetPageProperty("description", "");
}

if(ERROR_404 != "Y"){
	/*
	global $sotbitSeoMetaTitle;
	// global $sotbitSeoMetaKeywords;
	global $sotbitSeoMetaDescription;
	global $sotbitSeoMetaBreadcrumbTitle;
	global $sotbitSeoMetaH1;

	if(!empty($sotbitSeoMetaH1)) {
		 $APPLICATION->SetTitle($sotbitSeoMetaH1);
	}
	if(!empty($sotbitSeoMetaTitle)) {
		 $APPLICATION->SetPageProperty("title", $sotbitSeoMetaTitle);
	}
	*/
/*
if(!empty($sotbitSeoMetaKeywords)) {
    $APPLICATION->SetPageProperty("keywords", $sotbitSeoMetaKeywords);
}
*//*
	if(!empty($sotbitSeoMetaDescription)) {
		 $APPLICATION->SetPageProperty("description", $sotbitSeoMetaDescription);
	}
	*/
/*if(!empty($sotbitSeoMetaBreadcrumbTitle) ) {
  $APPLICATION->AddChainItem($sotbitSeoMetaBreadcrumbTitle);
}*/ ?>
<?
	/*
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
				"ADD_ELEMENT_CHAIN" => "Y",
				"SET_CANONICAL_URL" => "Y",
				"SET_BROWSER_TITLE" => "Y",
				"SET_META_KEYWORDS" => "Y",
				"SET_META_DESCRIPTION" => "Y",
				"BROWSER_TITLE" => "-",
				"META_KEYWORDS" => "-",
				"META_DESCRIPTION" => "-",
				"SET_STATUS_404" => "N",
				"SHOW_404" => "N",
				"SET_LAST_MODIFIED" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"USE_PERMISSIONS" => "N",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "360000",
				"CACHE_GROUPS" => "Y"
			], false
		);
	}
	*/
?>
	<?include($_SERVER['DOCUMENT_ROOT'].'/.utlab/metas.php');  // нужно проверять на необходимость оставить ?>
<? } ?>
<? /* <script async type="text/javascript" src="/ds-comf/ds-form/js/dsforms.js"></script> */ ?>
<script async type="text/javascript" src="/d-celi.js"></script>
<? /* <script async src="/js/lightbox.min.js"></script> */ ?>
<script async src="/js/jquery.fancybox.min.js"></script>
<script async type="text/javascript" src="/js/jquery.js"></script>

<link rel="stylesheet" href="/css/jquery.fancybox.min.css" />
<? /* <link rel="stylesheet" href="/css/lightbox.min.css" /> */ ?>

<? if($_GET['PAGEN_1']){
    $APPLICATION->SetPageProperty("title",$APPLICATION->GetPageProperty("title").' | '.$_GET['PAGEN_1']. ' страница каталога');
    $APPLICATION->SetPageProperty("description",$APPLICATION->GetPageProperty("description").'. '.$_GET['PAGEN_1']. ' страница каталога');
}
?>
<!-- BEGIN COMAGIC INTEGRATION WITH ROISTAT -->
<script>
    (function(){
        var onReady = function(){
            var interval = setInterval(function(){
                if (typeof Comagic !== "undefined" && typeof Comagic.setProperty !== "undefined" && typeof Comagic.hasProperty !== "undefined") {
                    Comagic.setProperty("roistat_visit", window.roistat.visit);
                    Comagic.hasProperty("roistat_visit", function(resp){
                        if (resp === true) {
                            clearInterval(interval);
                        }
                    });
                }
            }, 1000);
        };
        var onRoistatReady = function(){
            window.roistat.registerOnVisitProcessedCallback(function(){
                onReady();
            });
        };
        if (typeof window.roistat !== "undefined") {
            onReady();
        } else {
            if (typeof window.onRoistatModuleLoaded === "undefined") {
                window.onRoistatModuleLoaded = onRoistatReady;
            } else {
                var previousOnRoistatReady = window.onRoistatModuleLoaded;
                window.onRoistatModuleLoaded = function(){
                    previousOnRoistatReady();
                    onRoistatReady();
                };
            }
        }
    })();
</script>
<!-- END COMAGIC INTEGRATION WITH ROISTAT -->
</body>
</html>