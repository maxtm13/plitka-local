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
		<a href='#' id='Go_Top' title="Вернуться к началу"><img src ="/bitrix/templates/eshop_adapt_blue/images/upq.png" alt="Наверх" title="Наверх"></a>
    </div>
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
				<P>Прием заказов:</p>
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
					<A HREF="MAILTO:info@plitkanadom.ru">info@plitkanadom.ru</a>
				</p>				
			</div>
			<div class="footer-column-3">
				<a href="http://ok.ru/plitkanado/" id="ok"><div class="soc"></div></a>
				<a href="https://www.facebook.com/pages/%D0%9A%D0%B5%D1%80%D0%B0%D0%BC%D0%B8%D1%87%D0%B5%D1%81%D0%BA%D0%B0%D1%8F-%D0%BF%D0%BB%D0%B8%D1%82%D0%BA%D0%B0/378809075589877" id="fb"><div class="soc"></div></a>
				<a href="https://twitter.com/Plitkanadom" id="tw"><div class="soc"></div></a>
				<a href="https://vk.com/public64362093" id="vk"><div class="soc"></div></a>
			</div>  
			<div class="footer-column-4">
				<!-- begin of Top100 code -->
				<script id="top100Counter" type="text/javascript" src="http://counter.rambler.ru/top100.jcn?2416929"></script>
				<noscript>
				<a href="http://top100.rambler.ru/navi/2416929/">
				<img src="http://counter.rambler.ru/top100.cnt?2416929" alt="Rambler's Top100" border="0" />
				</a>
				</noscript>
				<!-- end of Top100 code -->	
				<a href="https://plus.google.com/+%D0%9F%D0%BB%D0%B8%D1%82%D0%BA%D0%B0%D0%9D%D0%B0%D0%B4%D0%BE%D0%BC-%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD/posts"><img src="/bitrix/templates/eshop_adapt_blue/images/DaF.png" /></a>
				<!--LiveInternet counter--><script type="text/javascript"><!--
				document.write("<a href='//www.liveinternet.ru/click' rel = 'nofollow'"+
				"target=_blank><img src='//counter.yadro.ru/hit?t44.2;r"+
				escape(document.referrer)+((typeof(screen)=="undefined")?"":
				";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
				screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
				";"+Math.random()+
				"' alt='' title='LiveInternet' "+
				"border='0' width='31' height='31' style = 'margin-top: 10px;'><\/a>")
				//--></script><!--/LiveInternet-->
			</div> 
				
			<br>
			<div class="copir0">
				<div align="center">© 2010 - 2015 «Плитка на дом»</div>
			</div>
				
			<script>
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
			<!-- Start SiteHeart code -->
			<script>
			(function(){
			var widget_id = 815318;
			_shcp =[{widget_id : widget_id}];
			var lang =(navigator.language || navigator.systemLanguage 
			|| navigator.userLanguage ||"en")
			.substr(0,2).toLowerCase();
			var url ="widget.siteheart.com/widget/sh/"+ widget_id +"/"+ lang +"/widget.js";
			var hcc = document.createElement("script");
			hcc.type ="text/javascript";
			hcc.async =true;
			hcc.src =("https:"== document.location.protocol ?"https":"http")
			+"://"+ url;
			var s = document.getElementsByTagName("script")[0];
			s.parentNode.insertBefore(hcc, s.nextSibling);
			})();
			</script>
			<!-- End SiteHeart code -->
			<div class="clear"></div>
		</div> <?/*.footer_wrap_container*/?>
	</div> <?/*.footer_wrap*/?>
			
		<?/*</div>*/?>
</div> <!-- //wrap -->
	<?/*</div>*/?>
	

	
<style>
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
</style>
	
</body>
</html>
