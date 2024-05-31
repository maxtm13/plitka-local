<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$exDir = explode("/",$_SERVER['REQUEST_URI']);

if(count($exDir)>3){
	define("ERROR_404", "Y");
	\Bitrix\Iblock\Component\Tools::process404('Страница Не найдена', true, true, true, false);
}else{
	$APPLICATION->SetPageProperty("title", "Купить агломератную плитку | Искусственный гранит");
	// $APPLICATION->SetPageProperty("keywords", "агломератная плитка, искусственный гранит, плитка, купить, дешево");
	$APPLICATION->SetPageProperty("description", "Если Вы хотите купить агломератную плитку, посетите наш интернет-магазин. Только у нас продажа искусственного гранита по выгодным ценам.");
//	$APPLICATION->SetTitle("Агломератная плитка");
//	$APPLICATION->AddChainItem('Агломератная плитка');
	//$GLOBALS['arrFilter'] = array("DEPTH_LEVEL" => 3, "PROPERTY_45" => 5083);
	$GLOBALS['arrFilter']['DEPTH_LEVEL'] = 3;
	$GLOBALS['arrFilter']["PROPERTY_45"] = 5083;

if($_SESSION["SORT_VS_COUNT"]){
	$sess = unserialize($_SESSION["SORT_VS_COUNT"]);
}
	
	?><?$arSPagen = $APPLICATION->IncludeComponent(
		"omniweb:catalog.section.list",
		"section-list-catalog",
		Array(
			"IBLOCK_TYPE" => "catalog",
			"IBLOCK_ID" => "4",
			"SECTION_ID" => "",
			"SECTION_CODE" => "",
			"COUNT_ELEMENTS" => "N",
			"TOP_DEPTH" => "3",
			"SECTION_FIELDS" => array("",""),
			"SECTION_USER_FIELDS" => array("UF_HEADER", "UF_MORO_PHOTO", "UF_82", 'UF_91', 'UF_92', 'UF_ASSIGN', 'UF_ASSIGN_ONLY', 'UF_CATALOG_PRICE_1', 'UF_AVAILABILITY', 'UF_TOPTEXT'),
			"VIEW_MODE" => "TILE",
			"SHOW_PARENT_NAME" => "N",
			"SECTION_URL" => "",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "360000",
			"CACHE_GROUPS" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"HIDE_SECTION_NAME" => "N",
			"FILTER_NAME" => "arrFilter",
			"SECTION_COUNT" => "40",
			"PAGER_TEMPLATE" => "arrows",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"PAGER_TITLE" => "Разделы",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			'FILTER_SORT_PANEL' => 'Y',
			"SORT_BY" => ($sess["sort"]["type"] ? $sess["sort"]["type"] : "UF_HIT"),
			 "SORT_ORDER" => ($sess["sort"]["order"] ? $sess["sort"]["order"] : "DESC"),
			 "IN_PAGE" => ($sess["inpage"] ? $sess["inpage"] : "40"),
			 "PAGE" => ($_SERVER["REDIRECT_URL"] ?? $_SERVER["REQUEST_URI"]),
			  	"PAGEN" => ($_REQUEST['PAGEN_2'] ? $_REQUEST['PAGEN_2'] : $_REQUEST['PAGEN_1']),
			  "YEAR" => date('Y',strtotime(date("Y").'-01-01 -1year')),
		)
	);?> <? /* if (!isset($_REQUEST['PAGEN_'.$arSPagen['NavNum']]) || $_REQUEST['PAGEN_'.$arSPagen['NavNum']] == 1):?>
	<div class="imgtim">
	 <img title="a_e174c266.jpg" src="/upload/medialibrary/0c2/a_e174c266.jpg" alt="a_e174c266.jpg" align="left" height="151" width="200"><br>
		<p>
	 <br>
		</p>
	 <span style="font-size: 14pt;"> </span>
	</div>
	 <span style="font-size: 14pt;"> </span><?endif;?><br>
	 <br>
	 <br>
	<h2>
	Искусственный гранит плитка </h2>
	 Полноценный аналог натурального камня, которым является искусственный гранит – материал, производимый в виде плиток. В качестве компонентов при создании искусственного камня используются: слюда, кварцевый песок, глина и полевой шпат.
	<p>
		 Чтобы разнообразить цветовую гамму искусственного мрамора и гранита, к этим компонентам добавляются минеральные добавки. Материал превосходит по своим эксплуатационным характеристикам, техническим свойствам и цветовой гамме, натуральный камень.
	</p>
	<h2>Преимущества искусственного гранита</h2>
	<p>
	</p>
	<p>
		 Натуральный гранит имеет очень слоистую и пористую структуру, что делает его ненадежным. В отличие от природного камня, искусственный камень гранит, произведенный в соответствии со всеми требованиями технологии, имеет плотную структуру без пустот. Из преимуществ искусственного гранита следует отметить:
	</p>
	<p>
	</p>
	<ul>
		<li>
		<p>
			 широкую линейку размеров и богатую цветовую гамму;
		</p>
	 </li>
		<li>
		<p>
			 искусственный гранит плитка – легкий и прочный материал, не поддающийся пагубному воздействию прямых солнечных лучей, влаги и температурных перепадов (выдерживает от -50 до +80 ˚С);
		</p>
	 </li>
		<li>
		<p>
			 материал не стирается, не деформируется и выдерживает большие механические нагрузки;
		</p>
	 </li>
		<li>
		<p>
			 отделочный материал не трескается в процессе распила и сверления, поэтому купить искусственный гранит и заняться его самостоятельным монтажом могут люди, не обладающие достаточными знаниями и квалификацией.
		</p>
	 </li>
	</ul>
	<p>
	</p>
	<p>
		 Если сравнивать с натуральным камнем, то цена искусственного гранита значительно ниже. К тому же, искусственный материал надежнее, привлекательнее внешне и не создает радиационный фон.
	</p>
	<h2>Агломератная плитка</h2>
	<p>
	</p>
	<p>
		 Идеальным вариантом для отделки санузлов, кухонь и помещений является агломератная плитка, поскольку она практически не стирается. Этот материал с легкостью выдерживает повышенные температуры. Даже если на плитку поставить горячую кастрюлю или чайник, то ее поверхность не потеряет изначальный вид.
	</p>
	<p>
		 Многие потребители предпочитают купить агломератную плитку еще и потому, что она не поддается негативному воздействию как натуральных, так и химических красителей или веществ. Материал не требует особого ухода, поверхность такой плитки не нужно чистить и отмывать, ее достаточно протереть.
	</p>
	 <br>
<? */ ?>
	<?/*endif;*/?>
	<?/******************************/?>

<? } ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>