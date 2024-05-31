<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$sess = [];

if(!empty($_SESSION["SORT_VS_COUNT"])){
	$sess = json_decode($_SESSION["SORT_VS_COUNT"]);
}

$thissort['sort-collection'] = ['UF_HIT',$exsort[1]];
$thissort['sort-product'] = ['PROPERTY_POPULAR',$exsort[1]];
$thisinpage = 40;

$sorttypes = [
	'POPULAR#DESC' => 'По популярности',
	'PRICE#ASC' => 'Сначала дешёвые',
	'PRICE#DESC' => 'Сначала дорогие',
	'NAME#ASC' => 'По алфавиту',
	'ID#DESC' => 'Сначала новинки',
];
$isinpage = [40 , 80];

$issort = $sess->issort;
$inpage = $sess->inpage;

if(!empty($sess->issort)){
	$exsort = explode('#', $issort);


	if($issort == 'POPULAR#DESC'):
		$thissort['sort-collection'] = ['UF_HIT',$exsort[1]];
		$thissort['sort-product'] = ['PROPERTY_POPULAR',$exsort[1]];

	elseif($issort == 'PRICE#ASC' || $issort == 'PRICE#DESC'):
		$thissort['sort-collection'] = ['UF_CATALOG_PRICE_1', $exsort[1]];
		$thissort['sort-product'] = ['CATALOG_PRICE_1',$exsort[1]];

	else:
		$thissort['sort-collection'] = $thissort['sort-product'] = [$exsort[0],$exsort[1]];
	endif;
}

if(!empty($inpage)){
	$thisinpage = ($inpage == 20 ? 40 : (int)$inpage);
}
?>
<style>
	
	.is-sort__block { padding: 0 0 22px; font-size: 14px; white-space: nowrap; border-bottom: solid 1px #ededed; }
	.is-sort__title { padding-right: 10px; }
	.is-sort__select { border: solid 1px #ededed; background: #fff; outline: none !important; font-size: 14px; padding: 5px; width: 200px; margin: 0 20px 0 0; box-sizing: border-box; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1); overflow: hidden; white-space: nowrap; line-height: 20px;
	}
	.is-sort__select.type-sort { width: 170px; }
	.is-sort__select.type-inpage { width: 60px; text-align: center; margin: 0; }
	.is-sort__select option { display: block; padding: 5px 10px; line-height: 20px; }
	
	@media(max-width:768px){
		.no-mob { display: none  !important; }
	}
</style>
<div class="is-sort__block">
	<span class="is-sort__title">Сортировать:</span>
	<select id="is-sort" class="is-sort__select type-sort">
		<? $i = 0; foreach($sorttypes as $k=>$item): $i++; ?>
			<option <?=($issort == $k ? ' selected=""' : ($i == 1 ? ' selected=""' : ''));?> value="<?=$k;?>"><?=$item;?></option>
		<? endforeach; ?>
	</select>
	<span class="is-sort__title no-mob">Показать по:</span>
	<select id="is-inpage" class="is-sort__select type-inpage no-mob">
		<? $i = 0; foreach($isinpage as $k=>$item): $i++; ?>
			<option <?=($inpage == $item ? ' selected=""' : ($i == 1 ? ' selected=""' : ''));?> value="<?=$item;?>"><?=$item;?></option>
		<? endforeach; ?>
	</select>
</div>
<script>
	
	$('#is-sort , #is-inpage').on('change', function(){
		
		setsortinpage();
		
	});
	
	function setsortinpage(){
		$.ajax({
			url: '/ajax/set_sort_inpage.php',
			type: 'POST',
			data: {
				sort : $('#is-sort').val(),
				inpage : $('#is-inpage').val()
			},
			dataType: 'json',
			beforeSend: function () {
				$('body').addClass('wait');
			},
			success: function (data) {
				$('body').removeClass('wait');
				window.location.reload();
			}
		});
	}
</script>