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
<style>
	    .bottom_up {
    float: right;
	padding-right: 50px;
}

a#Go_Top {
    position: fixed;
    right: 10px;
    top: 69%;
    padding: 10px;
	z-index: 1;
}


@media (max-width:900px){
   .bottom_up{
       display:none;
	   
   }
}

.mini-calc .mc-submit .btn-submit {
    margin-bottom: 25px !important;
}
.btn-submit {
    margin-bottom: 25px !important;
}

.mc-volume {
    padding-bottom: 20px !important;
}

.mini-calc .mc-title {
    padding: 36px 0 12px 0px !important;
	}
</style>
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
				<p><span itemprop="telephone">+7(495) 777-71-21</span><br/>
				 <span itemprop="telephone">+7(936) 777-77-15</span><br/>
				 <span itemprop="telephone">+7(499) 784-43-71</span><br/>
				 <span itemprop="telephone">+7(499) 784-41-53</span><br/></p>
			</div>
			<div class="footer-column-1">
				<p>Прием заказов:</p>
				<p>
					Пн-Пт - с 9:30 до 18:30;<br/>
					Сб- с 10:00 до 15:00  без перерывов;
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
<noscript><img src="//counter.rambler.ru/top100.cnt?pid=2416929"></noscript>
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
				<div align="center">© 2010 - 2017 «Плитка на дом»</div>
			</div>
				
			<script type="text/javascript">
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			  ga('create', 'UA-50963862-1', 'auto');
			  ga('send', 'pageview');

			</script>

			<!-- Yandex.Metrika counter -->
			<script type="text/javascript">
			(function (d, w, c) {
				(w[c] = w[c] || []).push(function() {
					try {
						w.yaCounter24968570 = new Ya.Metrika({id:24968570,
								webvisor:true,
								clickmap:true,
								trackLinks:true,
								accurateTrackBounce:true});
					} catch(e) { }
				});

				var n = d.getElementsByTagName("script")[0],
					s = d.createElement("script"),
					f = function () { n.parentNode.insertBefore(s, n); };
				s.type = "text/javascript";
				s.async = true;
				s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

				if (w.opera == "[object Opera]") {
					d.addEventListener("DOMContentLoaded", f, false);
				} else { f(); }
			})(document, window, "yandex_metrika_callbacks");
			</script>
			<noscript><div><img src="//mc.yandex.ru/watch/24968570" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
			<!-- /Yandex.Metrika counter -->
<!-- livetex. code -->
			<!-- {literal} -->
        <script type='text/javascript'>
        window['liv'+'e'+'Te'+'x'] = true,
        window['li'+'v'+'eT'+'exI'+'D'] = 28057,
        window['l'+'i'+'ve'+'Tex'+'_obje'+'ct'] = true;
        (function() {
        var t = document['create'+'Elem'+'ent']('script');
        t.type ='text/javascript';
        t.async = true;
        t.src = '//cs15.livet'+'ex.ru/js/cli'+'ent.js';
        var c = document['getElem'+'entsByTa'+'gName']('script')[0];
        if ( c ) c['pa'+'ren'+'tNo'+'de']['ins'+'er'+'tBefo'+'r'+'e'](t, c);
        else document['docum'+'en'+'tEleme'+'nt']['firs'+'t'+'Ch'+'i'+'ld']['appe'+'nd'+'Child'](t);
        })();
        </script>
        <!-- {/literal} -->
		<!-- End livetex. code -->
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

<style>
.lt-wrapper-footer {
    display: none !important;
}
body div { text-decoration: none !important; }


input#set_filter {
	background: url(/bitrix/templates/eshop_adapt_blue/images/pokozat.png) no-repeat;
    color: #fff;
	height: 25px;
	width: 80px;
	text-align:right;
	text-decoration: none;
	font-style: normal
}

input#del_filter {
	background: url(/bitrix/templates/eshop_adapt_blue/images/sbrosit.png) no-repeat;
    color: #fff;
	height: 25px;
	width: 80px;
	text-align:right;
	text-decoration: none;
	font-style: normal
}

a.bx_filter_search_button_1 {
	background: url(/bitrix/templates/eshop_adapt_blue/images/any-search.png) no-repeat;
    color: #fff;
	text-decoration: none;
	font-style: normal;
	font-size: 14px;
}

span#login-line {
    display: none; 
}

.bx_filter_section.m4 {
    z-index: 150;
	position: inherit;
}

.dl-menuwrapper {
    width: 100%;
    max-width: 300px;
    float: left;
    position: relative;
    -webkit-perspective: 1000px;
    -moz-perspective: 1000px;
    perspective: 1000px;
    -webkit-perspective-origin: 50% 200%;
    -moz-perspective-origin: 50% 200%;
    perspective-origin: 50% 200%;
    z-index: 10000;
}


span.prop-ico-sample {
    display: none;
}
span.prop-ico-sample {
    display: none !important;
}

a.social-icon-link-fs {
    width: 30px;
    height: 30px;
    display: block;
    background: url(/bitrix/templates/eshop_adapt_blue/images/sprite1.png) no-repeat;
	background-position: 0px -240px;
}

a.social-icon-link-tw {
    width: 30px;
    height: 30px;
    display: block;
    background: url(/bitrix/templates/eshop_adapt_blue/images/sprite1.png) no-repeat;
	background-position: 0px -571px;
}
a.social-icon-link-gp {
    width: 30px;
    height: 30px;
    display: block;
    background: url(/bitrix/templates/eshop_adapt_blue/images/sprite1.png) no-repeat;
	background-position: 0px -301px;
}
a.social-icon-link-yt {
    width: 30px;
    height: 30px;
    display: block;
    background: url(/bitrix/templates/eshop_adapt_blue/images/sprite1.png) no-repeat;
	background-position: 0px -870px;
}

a.social-icon-link-in {
    width: 30px;
    height: 30px;
    display: block;
    background: url(/bitrix/templates/eshop_adapt_blue/images/sprite1.png) no-repeat;
    background-position: 0px -421px;
}

a.social-icon-link-ok {
    width: 30px;
    height: 30px;
    display: block;
    background: url(/bitrix/templates/eshop_adapt_blue/images/sprite1.png) no-repeat;
    background-position: 0px -511px;
}
a.social-icon-link-vk:link {
    width: 30px;
    height: 30px;
    display: block;
    background: url(/bitrix/templates/eshop_adapt_blue/images/sprite1.png) no-repeat;
	background-position: 0px -781px;
}
ul.social {
    list-style: none;
}

li.social {
    display: inline-block;
}

a.social-icon-link-vk:hover{
    width: 30px;
    height: 30px;
    display: block;
    background: url(/bitrix/templates/eshop_adapt_blue/images/sprite1.png) no-repeat;
	background-position: 0px -751px;
}
a.social-icon-link-fs:hover{
    width: 30px;
    height: 30px;
    display: block;
    background: url(/bitrix/templates/eshop_adapt_blue/images/sprite1.png) no-repeat;
    background-position: 0px -210px;
}
a.social-icon-link-tw:hover{
    width: 30px;
    height: 30px;
    display: block;
    background: url(/bitrix/templates/eshop_adapt_blue/images/sprite1.png) no-repeat;
	background-position: 0px -601px;
}

a.social-icon-link-gp:hover{
    width: 30px;
    height: 30px;
    display: block;
    background: url(/bitrix/templates/eshop_adapt_blue/images/sprite1.png) no-repeat;
	background-position: 0px -331px;
}
a.social-icon-link-yt:hover{
    width: 30px;
    height: 30px;
    display: block;
    background: url(/bitrix/templates/eshop_adapt_blue/images/sprite1.png) no-repeat;
    background-position: 0px -840px;
}

a.social-icon-link-in:hover{
    width: 30px;
    height: 30px;
    display: block;
    background: url(/bitrix/templates/eshop_adapt_blue/images/sprite1.png) no-repeat;
    background-position: 0px -391px;
}
a.social-icon-link-ok:hover{
    width: 30px;
    height: 30px;
    display: block;
    background: url(/bitrix/templates/eshop_adapt_blue/images/sprite1.png) no-repeat;
    background-position: 0px -481px;
}

.item_old_price {
   text-decoration: line-through !important;
}

span.percent {
    position: absolute;
    width: 72px;
    height: 74px;
    background: url(/bitrix/components/bitrix/catalog.viewed.products/templates/.default/images/stick_disc.png) no-repeat center;
    color: #fff;
    text-align: center;
    text-shadow: 0 1px 0 #ffffff;
    font-weight: bold;
    font-size: 28px;
    line-height: 74px;
}
span.measure_discount {
    padding-left: 6px;
    font-size: 19px;
}


.pnlm-load-button {
    top: 31% !important;
    left: 38% !important;
    width: 301px !important;
    height: 242px !important;
    background-image: url(/bitrix/templates/eshop_adapt_blue/images/panorama.jpg);
}
.pnlm-load-button p {
    display: none;
}
</style>
</body>
</html>