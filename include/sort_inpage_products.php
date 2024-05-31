<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$info = unserialize($_SESSION["is-info"]);

$issort = [
	'POPULAR#DESC' => 'По популярности',
	'PRICE#ASC' => 'Сначала дешёвые',
	'PRICE#DESC' => 'Сначала дорогие',
	'NAME#ASC' => 'По алфавиту',
	'ID#DESC"' => 'Сначала новинки',
];
$isinpage = [20, 40 , 80];
?>
<style>
	.is-sort__block { padding: 0 0 22px; font-size: 14px; white-space: nowrap; border-bottom: solid 1px #ededed; }
	.is-sort__title { padding-right: 10px; }
	.is-sort__select { border: solid 1px #ededed; background: #fff; outline: none !important; font-size: 14px; padding: 5px; width: 200px; margin: 0 20px 0 0; box-sizing: border-box; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1); overflow: hidden; white-space: nowrap; line-height: 20px;
	}
	.is-sort__select.type-sort { width: 200px; }
	.is-sort__select.type-inpage { width: 60px; text-align: center; margin: 0; }
	.is-sort__select option { display: block; padding: 5px 10px; line-height: 20px; }
</style>
<div class="is-sort__block">
	<span class="is-sort__title">Сортировать:</span>
	<select id="is-sort" class="is-sort__select type-sort">
		<? $i = 0; foreach($issort as $k=>$item): $i++; ?>
			<option <?=($info["sort-check"] == $k ? ' selected=""' : ($i == 1 ? ' selected=""' : ''));?> value="<?=$k;?>"><?=$item;?></option>
		<? endforeach; ?>
	</select>
	<span class="is-sort__title">Показать по:</span>
	<select id="is-inpage" class="is-sort__select type-inpage">
		<? $i = 0; foreach($isinpage as $k=>$item): $i++; ?>
			<option <?=($info["inpage"] == $item ? ' selected=""' : ($i == 1 ? ' selected=""' : ''));?> value="<?=$item;?>"><?=$item;?></option>
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
				ajax : true,
				unbot : '',
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