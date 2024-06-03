<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
				<?$curPage = $APPLICATION->GetCurPage(true);?>
				</div> <!-- //bx_content_section-->
				<?if ($wizTemplateId == "eshop_adapt_vertical"):?>
					<div class="bx_sidebar">
						<?$APPLICATION->IncludeComponent("bitrix:menu", "catalog_vertical", array(
								"ROOT_MENU_TYPE" => "left",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_TIME" => "36000000",
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
	<div class="footer_inner_bottom_line_container">
		<div class="wrp_footer">
			<div class="footer_inner_bottom_line">
				<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom_menu", array(
						"ROOT_MENU_TYPE" => "bottom",
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
			</div>
			<a href="javascript:void(0)" class="mobile-ftr-menu-show"><i class="ico-mobile-menu"></i></a>
		</div>
	</div><!-- //footer_inner_bottom_line_container -->
	<div class="footer_wrap">
		<div class="footer_wrap_container" itemscope itemtype="http://schema.org/Organization">
			<span itemprop="name" class="dn">Плитка на дом</span>
			<div class="footer-column-0">
				<meta itemprop="telephone" content="+7 (495) 777-71-21">
				<p><a href="tel:+74957777121"><span style="color: #d88a0a;">+7 (495) 777-71-21</span></a><br>
                   <a href="tel:+78007557557"><span style="color: #d88a0a;">+7 (800) 755-755-7</span></a><br>
                   <a href="mailto:info@plitkanadom.ru">info@plitkanadom.ru</a> <br>
                   <a href="/sitemap/">Карта сайта</a>
				</p>
					<div class="market">
						<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/yandexmarket.php"), false);?>
					</div>
			</div>
			<div class="footer-column-1">
				<p>Прием заказов: <br/>
				    круглосуточно без выходных!<br/><br/>
					Офис и склад:<br/>
					Пн-Пт - с 9:30 до 18:30;<br/>
					Сб - с 10:00 до 15:00  без перерывов;<br>
				</p>
			</div>
			<div class="footer-column-2" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<p>Адрес:</p>
				<p>
					<span itemprop="addressLocality">Москва</span>, <span itemprop="streetAddress">2-й Вязовский пр-д, 10, стр.2</span> <br/>(в
					районе метро "Рязанский проспект")<br/>
					<a href="mailto:info@plitkanadom.ru">info@plitkanadom.ru</a>
				</p>
			</div>
			<div class="footer-column-3">
			<ul class="social">
<li class="social"> <a class="social-icon-link-fs" href="https://www.facebook.com/pages/%D0%9A%D0%B5%D1%80%D0%B0%D0%BC%D0%B8%D1%87%D0%B5%D1%81%D0%BA%D0%B0%D1%8F-%D0%BF%D0%BB%D0%B8%D1%82%D0%BA%D0%B0/378809075589877" title="Facebook" target="_blank" rel="nofollow"></a> </li>

<li class="social"> <a class="social-icon-link-tw" href="https://twitter.com/Plitkanadom" title="Twitter" target="_blank" rel="nofollow"></a></li>

 <li class="social"> <a class="social-icon-link-gp" href="https://plus.google.com/+%D0%9F%D0%BB%D0%B8%D1%82%D0%BA%D0%B0%D0%9D%D0%B0%D0%B4%D0%BE%D0%BC-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD/posts" title="Google+" target="_blank" rel="nofollow"></a></li>

 <li class="social"> <a class="social-icon-link-yt" href="https://www.youtube.com/channel/UC38XOpu6Ov6-eRogcQxDBnw" title="YouTube" target="_blank" rel="nofollow"></a> </li>
  <li class="social"> <a class="social-icon-link-in" href="https://www.instagram.com/plitkanadom.ru/" title="Instagram" target="_blank" rel="nofollow"></a></li>

 <li class="social"> <a class="social-icon-link-ok" href="http://ok.ru/plitkanado/" title="Ok" target="_blank" rel="nofollow"></a></li>

 <li class="social"> <a class="social-icon-link-vk" href="https://vk.com/public64362093" title="Vkontakte" target="_blank" rel="nofollow"></a></li>

 </ul>
			</div>
			<div class="footer-column-4">
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
				<!--LiveInternet counter--><script type="text/javascript"><!--
				document.write("<a href='//www.liveinternet.ru/click' rel = 'nofollow'"+
				"target=_blank><img src='//counter.yadro.ru/hit?t44.2;r"+
				escape(document.referrer)+((typeof(screen)=="undefined")?"":
				";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
				screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
				";"+Math.random()+
				"' alt='' title='LiveInternet' "+
				"border='0' width='31' height='31' style = 'margin-top: 10px;display: none;'><\/a>")
				//--></script><!--/LiveInternet-->
			</div>

			<br/>
			<div class="copir0">
				<div style="text-align: center">© 2010 - 2018 «Плитка на дом»</div>
			</div>			
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'PweBR1BfjL';var d=document;var w=window;function l(){var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script>
<!-- {/literal} END JIVOSITE CODE -->
<!-- Yandex.Metrika counter -->
<?/*<script type="text/javascript" >
(function (d, w, c) {
 (w[c] = w[c] || []).push(function() {
try { var yaCounter24968570 = new Ya.Metrika({id: 24968570, params:window.dataLayer||{ }}); }
catch(e) { }
});
</script>*/?>
<!-- Old metrika 17.12.2018 off
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter24968570 = new Ya.Metrika({
                    id:24968570,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    ecommerce:"dataLayer", 
                    params:window.dataLayer||{ }
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/24968570" style="position:absolute; left:-9999px;" alt="" /></div></noscript> -->
<!-- /Yandex.Metrika counter -->
<!-- old metrika end-->


<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(24968570, "init", {
        id:24968570,
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
<script type="text/javascript">

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
		</div> <?/*.footer_wrap_container*/?>
	</div> <?/*.footer_wrap*/?>

		<?/*</div>*/?>
</div> <!-- //wrap -->
	<?/*</div>*/?>



<?/*<style type="text/css">
.bx_page {
	font: 14px Arial;
}
.bx_page h4 {
	color: #d1772a;
	font: Bold 24px Arial;
}
.copir0 {
float: left;
width: 100%;
}
.footer-column-4 {
  width: 130px;
  margin-left: 75px;
  margin-top: 8px;
  display: inline-block;
}
.lt-wrapper-footer {
    display: none !important;
	}
</style>*/?>
<!--delete watermark live-->
<?php global $sotbitSeoMetaTitle;
global $sotbitSeoMetaKeywords;
global $sotbitSeoMetaDescription;
global $sotbitSeoMetaBreadcrumbTitle;
global $sotbitSeoMetaH1;  

if(!empty($sotbitSeoMetaH1)) {
   $APPLICATION->SetTitle($sotbitSeoMetaH1); 
} 
if(!empty($sotbitSeoMetaTitle)) {
  $APPLICATION->SetPageProperty("title", $sotbitSeoMetaTitle);
}
if(!empty($sotbitSeoMetaKeywords)) {
  $APPLICATION->SetPageProperty("keywords", $sotbitSeoMetaKeywords);
}
if(!empty($sotbitSeoMetaDescription)) {
  $APPLICATION->SetPageProperty("description", $sotbitSeoMetaDescription);
} 
/*if(!empty($sotbitSeoMetaBreadcrumbTitle) ) {
  $APPLICATION->AddChainItem($sotbitSeoMetaBreadcrumbTitle);
}*/ ?>
<?include($_SERVER['DOCUMENT_ROOT'].'/.utlab/metas.php');?>
<script type="text/javascript" src="/ds-comf/ds-form/js/dsforms.js"></script>
<script type="text/javascript" src="/d-celi.js"></script>
<? /*RBS_CUSTOM_START*/ ?>
<script>

	$(document).on('ready', function(){
		$('.rbs-catalog-btn').on('click', function(){
			$('.dl-menuwrapper ul.dl-menu').toggleClass('dl-menuopen');
			$('.worakarea_wrap_container .sidebar').removeClass('show');
			$('.rbs-header-brands').hide();
		});
		$('.rbs-filter-btn').on('click', function(){
			$('.worakarea_wrap_container .sidebar').toggleClass('show');
			$('.dl-menuwrapper ul.dl-menu').removeClass('dl-menuopen');
			$('.rbs-header-brands').hide();
		});
		$('.rbs-brand-btn').on('click', function(){
			$('.rbs-header-brands').toggle();
			$('.dl-menuwrapper ul.dl-menu').removeClass('dl-menuopen');
			$('.worakarea_wrap_container .sidebar').removeClass('show');
		});
		$('.rbs-call-answer a').on('click', function(){
			$('.rbs-call-phones').toggle();
		});
	});
	
	
</script>
<? /*RBS_CUSTOM_END*/ ?>
</body>
</html>