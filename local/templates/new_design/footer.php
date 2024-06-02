<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $checkdate, $usergropus, $checktime, $dir, $ccurency;
?>
	<?
	$seoID = getElementID($_SERVER["SCRIPT_URL"],"PROPERTY_NEW",33);
		if($seoID && ERROR_404 != "Y"){
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
					"CACHE_GROUPS" => "N",
					"PAGEN" => htmlspecialchars($_REQUEST["PAGEN_1"])
				], false
			);
		}
	?>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div id="GoUp" class="easer5"><img src="/image/new_design/goup.png" alt="" /></div>
		</main>
		<footer class="is-foot">
			<div class="foot-block">
				<div class="max-window">
					<div class="foot-menu">
						<div class="foot-menu__block">
							<div class="foot-menu__title">Каталог</div>
							<ul>
								<li><a href="/collections/plitka-dlya-vannoi">Плитка для ванной</a></li>
								<li><a href="/collections/napolnaya-plitka">Напольная плитка</a></li>
								<li><a href="/collections/keramogranit">Керамогранит</a></li>
								<li><a href="/collections/klinker">Ступени (Клинкер)</a></li>
								<li><a href="/collections/ispanskaya-plitka">Испанская плитка</a></li>
								<li><a href="/collections/italyanskaya-plitka">Итальянская плитка</a></li>
								<li><a href="/napolnye-pokrytiya/laminat">Ламинат</a></li>
								<li><a href="/napolnye-pokrytiya/parketnaya-doska">Паркетная доска</a></li>
							</ul>
							<ul>
								<li><a href="/santekhnika/dushevoy-ugolok">Душевой уголок</a></li>
								<li><a href="/santekhnika/vanny">Ванные</a></li>
								<li><a href="/collections/mozaika">Мозаика</a></li>
								<li><a href="/santekhnika/installyatsii">Инсталляция</a></li>
								<li><a href="/collections/rossiiskaya-plitka/kerama-marazzi">Керама Марацци</a></li>
								<li><a href="/collections/rossiiskaya-plitka/laparet">Laparet</a></li>
								<li><a href="/collections/ispanskaya-plitka/equipe">Equipe</a></li>
							</ul>
						</div>
						<div class="foot-menu__block">
							<div class="foot-menu__title">Покупателям</div>
							<ul>
								<li><a href="/contacts/">Контакты</a></li>
								<li><a href="/dostavka/">Доставка</a></li>
								<li><a href="/shourum/">Шоурум</a></li>
								<li><a href="/onas/">Почему мы</a></li>
								<li><a href="/news/">Новости</a></li>
								<li><a href="/articles/">Статьи</a></li>
								<li><a href="/3d-design/">Раскладка плитки</a></li>
								<li><a href="/contacts/director/">Написать директору</a></li>
							</ul>
						</div>
						<div class="foot-menu__block">
							<div class="foot-menu__title">Наши предложения</div>
							<ul>
								<li><a href="/promotions/">Акции и распродажи</a></li>
								<li><a href="/populyarnaya-plitka/">Хиты</a></li>
								<li><a href="/novinki/">Новинки</a></li>
								<li><a href="/likvidaciya-sklada/">Уценка</a></li>
							</ul>
						</div>
					</div>
					<div class="foot-contact">
						<div class="foot-contact__block">
							<div class="foot-contact__item">
								<div class="foot-contact__title">Контакты</div>
								<a class="foot_phone" href="tel:+74957777121">+7 (495) <strong>77-77-121</strong></a><br />
							</div>
							<div class="foot-contact__item">
								<div class="foot-contact__title"></div>
								<a class="foot_phone" href="tel:+78007557557">+7 (800) <strong>755-755-7</strong></a><br />Бесплатно для регионов России
							</div>
						</div>
						<div class="foot-contact__block type-small">
							<div class="foot-contact__title">Адрес</div>
							<adress>Москва,<br>2-й Вязовский пр-д. 10, стр.2</address><br>
							Email: <a href="mailto:info@plitkanadom.ru">info@plitkanadom.ru</a>
						</div>
						<div class="foot-contact__block type-small">
							<div class="foot-contact__title">Офис и шоу-рум</div>
							Пн-Пт - с 9:30 до 18:00<br />Сб, Вс - с 9:30 до 15:00<br />без перерывов
						</div>
					</div>
				</div>
				<div class="foot-links">
					<div class="max-window">
						<div class="foot-links__ya">
							<a rel="nofollow" href="https://market.yandex.ru/shop--plitkanadom-ru/96890/reviews" target="_blank">
								<img src="/image/new_design/ya_rating.png" alt="" />
								<img src="/image/new_design/stars.png" alt="" />
								Смотреть отзывы
							</a>
						</div>
						<div class="foot-web">
							<? /*
							<a class="web__tik" href="https://vm.tiktok.com/ZMNYFD32X/" target="_blank" title="TikTok"></a>
							*/ ?>
							<a class="web__tube" href="https://www.youtube.com/channel/UC38XOpu6Ov6-eRogcQxDBnw" target="_blank" title="YouTube"></a>
							<a class="web__ok" href="https://ok.ru/plitkanado/" target="_blank" title="Ok"></a>
							<? /*
							<a class="web__twitt" href="https://twitter.com/Plitkanadom" target="_blank" title="Twitter">
								<svg height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg>
							</a>
							*/ ?>
							<? /*
							<a class="web__insta" href="https://www.instagram.com/plitkanadom.ru/" target="_blank" title="Instagram">
								<svg height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg>
							</a>
							*/ ?>
							<a class="web__vk" href="https://vk.com/public64362093" target="_blank" title="Vkontakte"></a>
                            <a class="web__tgk" href="https://t.me/plitkanadom_ru" target="_blank" title="Telegram"></a>
                            <? /*
							<a class="web__facebook" href="https://www.facebook.com/%D0%9F%D0%BB%D0%B8%D1%82%D0%BA%D0%B0-%D0%BD%D0%B0-%D0%B4%D0%BE%D0%BC%D1%80%D1%83-378809075589877/" target="_blank" title="Facebook">
								<svg height="17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></svg>
							</a>
							*/ ?>
						</div>
					</div>
				</div>
				<div class="foot-price">
					<div class="max-window">
						<p>Указанные на сайте цены не являются публичной офертой (ст. 435 ГК РФ). Наличие товара просьба уточнять в офисе продаж или по телефону</p>
					</div>
				</div>
				<div class="foot-info">
					<div class="max-window">
						<div class="foot-info__copyright">&copy; 2010 - <?=date("Y");?> &laquo;Плитка на дом&raquo;</div>
						<div class="foot-info__policy"><a href="/policy/" rel="nofollow">Политика конфиденциальности</a></div>
					</div>
				</div>
			</div>
		</footer>
	</div>
<? if(!$USER->IsAdmin()):?>
	<? if (strpos($_SERVER['HTTP_USER_AGENT'], 'Speed Insights') !== FALSE): ?>
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
	<? endif; ?>
<? endif; ?>
<?php

if(ERROR_404 == "Y"){
	$APPLICATION->SetTitle("Страница не найдена");
	$APPLICATION->SetPageProperty("title", "Страница не найдена");
	$APPLICATION->SetPageProperty("description", "");
}

$APPLICATION->SetPageProperty("keywords", "");
?>
<? if(!$USER->IsAdmin()):?>
<!-- Top100 (Kraken) Counter -->
<script>
    (function (w, d, c) {
    (w[c] = w[c] || []).push(function() {
        var options = {
            project: 2416929,
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
<noscript>
  <img src="//counter.rambler.ru/top100.cnt?pid=2416929" alt="Топ-100" />
</noscript>
<!-- END Top100 (Kraken) Counter -->
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

<!-- KUPI.RU STATISTIC -->
<script src="https://kupi.ru/js/r17.js" async type="text/javascript"></script>
<!-- END KUPI.RU STATISTIC -->

<? endif; ?>

<? if (strpos($_SERVER['HTTP_USER_AGENT'], 'Speed Insights') !== FALSE): ?>
	<script type="application/ld+json">
	{
	"@context": "https://schema.org",
	"@type": "Organization",
	"address": [
		{
			"@type": "PostalAddress",
			"addressLocality": "Москва",
			"streetAddress": "2-й Вязовский пр-д, 10, стр.2 (в районе метро «Рязанский проспект»)"
		}
		],
	"description": "Мы работаем по схеме мелкооптовой компании, поэтому цены у нас значительно ниже, чем в рознице. У нас действует акция Если нашли дешевле: если Вы нашли представленный у нас товар дешевле, мы предложим Вам более низкую цену. При этом, мы должны проверить: являются ли актуальными цены в данном магазине и есть ли товар там в наличии.",
	"name": "Плитка на дом.ru",
	"telephone": ["+7(800)755-755-7", "+7(800)755-755-7", "+7(495)7777-121"],
	"email": "info@plitkanadom.ru",
	"image": "https://dev.plitkanadom.ru/local/templates/new_design/svg/logotype.svg"
	}
	</script>
	<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "WebSite",
		"url": "https://www.plitkanadom.ru/",
		"potentialAction": {
		"@type": "SearchAction",
		"target": "https://www.plitkanadom.ru/search/?q={search_term_string}",
		"query-input": "required name=search_term_string"
		}
	}
	</script>
	<!-- Скрипт от - Regmarkets.ru -->
	<script src="https://regmarkets.ru/js/r17.js" async type="text/javascript"></script>


<? endif; ?>
</body>
</html>
