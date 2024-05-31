<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
// $APPLICATION->SetPageProperty("keywords", "о компании плитка на дом");
$APPLICATION->SetPageProperty("title", "О компании «Плитка на дом»");
$APPLICATION->SetPageProperty("description", "О компании «Плитка на дом». Большой опыт работы в сфере продаж плитки, керамогранита, мозаики, напольных покрытий и сантехники. Открыты для сотрудничества с производителями.");
$APPLICATION->SetTitle("О компании Плитка на дом");
$reviews = getVideoReviewfromFile();
?><h2 style="text-align: center;"><strong><span style="color:#c15c1f; text-transform: uppercase;"><span style="font-size:36px;"><span style="font-family:open sans,sans-serif;">Наш офис</span></span></span></strong></h2>
<div class="image">
 <img alt="Наш офис" src="/image/new_design/office.jpg" style="width: 100%; height: 100%;">
</div>
<h2 style="text-align: center;"><strong><span style="color:#c15c1f; text-transform: uppercase;"><span style="font-size:36px;"><span style="font-family:open sans,sans-serif;">Служба доставки</span></span></span></strong></h2>
<div class="image">
 <img alt="Служба доставки" src="/image/new_design/office_2.jpg" style="width: 100%; height: 100%;">
</div>
<h2 style="text-align: center;"><strong><span style="color:#c15c1f; text-transform: uppercase;"><span style="font-size:36px;"><span style="font-family:open sans,sans-serif;"><a id="we_are_the_best" ></a>Почему выбирают нас?</span></span></span></strong></h2>
 <br>
 <iframe class="i-adaptive-5" src="https://www.youtube-nocookie.com/embed/PNokm3_XRzE?rel=0&autoplay=0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
<p>
 <strong><?=number_format($reviews, 0, '', ' ');?></strong> просмотров
</p>
<div class="box subcat">
	<div class="box-content">
		<div class="box-product box-subcat">
			<ul class="row">
				<li class="cat-height span2 catimg">
				<div class="image">
 <img alt="Выгодные цены" src="/onas/image/logo-1.png">
				</div>
				<div class="name subcatname">
					<p>
						 Наши цены выгодно отличаются от цен на строительных рынках
					</p>
				</div>
 </li>
				<li class="cat-height span2 catimg">
				<div class="image">
 <img alt="Выгодные цены" src="/onas/image/logo-5.png">
				</div>
				<div class="name subcatname">
					<p>
						 Огромный выбор плитки, керамогранита, ламината, паркетной доски и сантехники в одном месте.
					</p>
				</div>
 </li>
				<li class="cat-height span2 catimg">
				<div class="image">
 <img alt="Выгодные цены" src="/onas/image/logo-33.png">
				</div>
				<div class="name subcatname">
					<p>
						 Вся представленная продукция только от официальных производителей, 1-го сорта.
					</p>
				</div>
 </li>
				<li class="cat-height span2 catimg">
				<div class="image">
 <img alt="Выгодные цены" src="/onas/image/logo-44.png">
				</div>
				<div class="name subcatname">
					<p>
						 Оперативная доставка товара вам домой или на объект
					</p>
				</div>
 </li>
			</ul>
		</div>
	</div>
</div>
 <br>
 <br>
<h2 style="text-align: center;"><strong><span style="color:#c15c1f; text-transform: uppercase;"><span style="font-size:36px;"><span style="font-family:open sans,sans-serif;">НАШИ ПРЕИМУЩЕСТВА</span></span></span></strong></h2>
<div class="table1">
	<table>
	<tbody>
	<tr>
		<td>
 <img width="90" alt="Kerama marazzi" src="/onas/image/pp1.png" height="90">
		</td>
		<td>
			<p>
 <b>Гарантированно низкие цены!</b>
			</p>
			<p class="text-justify">
				 Мы работаем по схеме мелкооптовой компании, поэтому цены у нас значительно ниже, чем в рознице. У нас действует <a href="/promotions/nashli-deshevle-my-snizim-tsenu/">акция "Если нашли дешевле"</a>: если Вы нашли представленный у нас товар дешевле, мы предложим Вам&nbsp;более низкую цену. При этом, мы должны проверить: являются ли актуальными цены в данном магазине&nbsp;и есть ли товар там в наличии.
			</p>
		</td>
	</tr>
	<tr>
		<td>
 <img width="90" alt="Kerama marazzi" src="/onas/image/p2.png" height="90">
		</td>
		<td>
			<p>
 <b>Дозаказ плитки</b>
			</p>
			<p class="text-justify">
				 Возможность <a href="/how-to-buy/">дозаказать плитку</a>, если Вам не хватило несколько штук! Мы всегда помогаем нашим клиентам, если не хватило плитки (в отличие от многих интернет-магазинов и продавцов на рынках).
			</p>
		</td>
	</tr>
	<tr>
		<td>
 <img width="90" alt="Kerama marazzi" src="/onas/image/p33.png" height="90">
		</td>
		<td>
			<p>
 <b>Беспатная доставка и подъем</b>
			</p>
			<p class="text-justify">
				 Возможна <a href="/promotions/besplatnaya-dostavka-i-podyem/">бесплатная доставка и подъем</a> для товаров, где есть знак.
			</p>
		</td>
	</tr>
	<tr>
		<td>
 <img width="90" alt="Kerama marazzi" src="/onas/image/p4.png" height="90">
		</td>
		<td>
			<p>
 <b>Нам можно доверять</b>
			</p>
			<p class="text-justify">
				 Опыт работы в продаже <a href="/collections/">плитки</a>, <a href="/collections/keramogranit">керамогранита</a>, <a href="/collections/mozaika">мозаики</a>, <a href="/napolnye-pokrytiya/">напольных покрытий</a> и <a href="/santekhnika/">сантехники</a>&nbsp;- более 19 лет!
			</p>
		</td>
	</tr>
	<tr>
		<td>
 <img width="90" alt="Kerama marazzi" src="/onas/image/p5.png" height="90">
		</td>
		<td>
			<p>
 <b>Постоянные скидки!</b>
			</p>
			<p>
				 У нас можно получить скидки на товары, которые отмечены стикером "%".
			</p>
		</td>
	</tr>
	<tr>
		<td>
 <img width="90" alt="Kerama marazzi" src="/onas/image/247.png" height="90">
		</td>
		<td>
			<p>
 <b>Работаем 24/7</b>
			</p>
			<p>
				 Мы работаем 24 часа в сутки 7 дней в неделю!
			</p>
		</td>
	</tr>
	<tr>
		<td>
 <img width="90" alt="Kerama marazzi" src="/onas/image/p7.png" height="90">
		</td>
		<td>
			<p>
 <b>Огромный ассортимент товара</b>
			</p>
			<p>
				 Более 350 000 наименований плитки, керамогранита, мозаики, ламината, паркетной доски и сантехники!
			</p>
		</td>
	</tr>
	<tr>
		<td>
 <img width="90" alt="Kerama marazzi" src="/onas/image/p8.png" height="90">
		</td>
		<td>
			<p>
 <b>Мы работаем без предоплаты!</b>
			</p>
			<p class="text-justify">
				 В большинстве случаев мы не просим сделать предоплату - Вы оплачиваете заказ при получении товара. Предоплата потребуется только в случае дозаказа плитки (если не хватило плитки) и при доставке плитки по России (вне Московской области) транспортной компанией.
			</p>
		</td>
	</tr>
	<tr>
		<td>
 <img width="90" alt="Kerama marazzi" src="/onas/image/p9.png" height="80">
		</td>
		<td>
			<p>
 <b>Отправляем транспортными компаниями</b>
			</p>
			<p>
				 Мы активно работаем с регионами России - <a href="/dostavka/">поставляем плитку через транспортные компании</a>, которые Вы выберете сами.
			</p>
		</td>
	</tr>
	<tr>
		<td>
 <img width="90" alt="Kerama marazzi" src="/onas/image/p10.png" height="90">
		</td>
		<td>
			<p>
 <b>Собственный шоу-рум</b>
			</p>
			<p class="text-justify">
				 Собственный <a href="/shourum/">шоу-рум</a>. У нас есть свой шоу-рум, где Вы можете посмотреть образцы плитки.
			</p>
			<p class="text-justify">
				 Представленная в шоу-руме плитка на сайте отмечена значком:
			</p>
			<p class="text-justify">
 <img width="193" alt="Шоу-рум" src="/upload/medialibrary/36c/shourum1.jpg" height="176">&nbsp;<img width="193" alt="shorum3.jpg" src="/upload/medialibrary/a17/shorum3.jpg" height="176" title="shorum3.jpg">
			</p>
			<p class="text-justify">
				 &nbsp;
			</p>
			<p class="text-justify">
				 Внимание! Далеко не вся, имеющаяся в продаже плитка, есть в шоу-руме!
			</p>
		</td>
	</tr>
	</tbody>
	</table>
</div>
<div id="block-timi" style="display: block;">
<?$APPLICATION->IncludeComponent(
	"custom:clients.list",
	"default",
	Array(
		"FILTER" => ['IBLOCK_ID'=>23,'ACTIVE'=>'Y'],
		"GROUP_BY" => false,
		"NAV_PARAMS" => ['nPageSize'=>8],
		"SELECT" => ['ID','NAME','PREVIEW_PICTURE','PREVIEW_TEXT','PROPERTY_URL_NEWS_CLIENTS',],
		"SHOW_NAV" => "N",
		"SHOW_TITLE" => "Y",
		"SORT" => ['sort'=>'asc','id'=>'desc']
	)
);?>
</div>
 <br>
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
                    VK.Widgets.Comments("vk_comments", {limit: 20, attach: "*"});
                </script>
		</div>
	</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>