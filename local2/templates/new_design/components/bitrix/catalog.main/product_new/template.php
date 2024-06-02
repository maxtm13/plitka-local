<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<? if(!empty($arResult["IDS"])):
$meastype = ['кв. м.', 'шт.'];
$calc = [4 => 100, 9 => 1000];
?>
<?

if (!empty($arParams["IS_FILTER"])) {
    global $arActiveFilterParams;
?>
    <div class="activeFilterParams">
        <?foreach($arActiveFilterParams as $afParam) {
            $str = '';
            $link = 'javascript:void(0)';
            if (!empty($afParam['MIN']['VALUE']) || !empty($afParam['MAX']['VALUE'])) {
                $tmp = array();
                //$prmAdd = array();
                $prmDel = array();
                if (!empty($afParam['MIN']['VALUE'])) {
                    $tmp[] = GetMessage('FROM').' '.$afParam['MIN']['VALUE'];
                    //$prmAdd[] = $afParam['MIN']['CONTROL_ID'].'=';
                    $prmDel[] = $afParam['MIN']['CONTROL_ID'];
                }
                if (!empty($afParam['MAX']['VALUE'])) {
                    $tmp[] = GetMessage('TO').' '.$afParam['MAX']['VALUE'];
                    //$prmAdd[] = $afParam['MAX']['CONTROL_ID'].'=';
                    $prmDel[] = $afParam['MAX']['CONTROL_ID'];
                }
                $str = implode(' ', $tmp);
                if (!empty($afParam['PRICE'])) {
                    $str .= ' руб.';
                } else {
                    $str = $afParam['NAME'].': '.$str;
                }
                $link = $APPLICATION->GetCurPageParam('', $prmDel);
            } else {
                $str = $afParam['NAME'];
                $link = $APPLICATION->GetCurPageParam('', array($afParam['CONTROL_ID']));
            }
            if (count($arActiveFilterParams) == 1) {
                $link = $APPLICATION->GetCurPage();
            }?>
            <a class="afParam" href="<?=$link?>"><?=$str?> <span>&#10006;</span></a>
        <?}?>
    </div>
<?}
?>
<div class="is-goods__slider<?=$arParams["MARGIN"] == "N" ? ' no-margin' : '';?>">
	<div class="is-goods__list" itemscope="" itemtype="http://schema.org/ItemList">
		<div id="is-slider__<?=$arParams["TYPE"];?>" class="is-goods__list">
			<? foreach($arResult["IDS"] as $isid):
			
				$show = true;
				
				$pr = $dp = ''; $sale = 0;
				$item = $arResult["GOODS"][$isid];

				if($item['PICTURE']['width'] > $item['PICTURE']['height']){
					$imgstyle = "po-shirine";
				}
				if($item['PICTURE']['width'] = $item['PICTURE']['height']){
					$imgstyle = "kvadrat";
				}
				if($item['PICTURE']['width'] < $item['PICTURE']['height']){
					$imgstyle = "po-visote";
				}
			
				if($item["NIGHT_PRICE"] == 1 && $arParams["NIGHT"] == 1){
					$pr = getNightPrice($item["MARGIN"], $item["CATALOG_PURCHASING_PRICE"], $item["CATALOG_PURCHASING_CURRENCY"]);
				}else{
					$pr = $arResult["PRICES"][$item["ID"]]["PRICE"];
					$dp = $arResult["PRICES"][$item["ID"]]["DISCOUNT_PRICE"];
					if(!empty($item["OLD_PRICE"]) && $pr == $dp){
						$pr = $item["OLD_PRICE"];
					}
					if($pr > $dp && $arResult["PRICES"][$item["ID"]]["DISCOUNT_PRICE"] < $arResult["PRICES"][$item["ID"]]["PRICE"]){
						$sale = round((1 - $dp / $pr) * 100, 1);
					}
				}
			?>
			<?	$measure = $dlina = $shirina = $kmprice = $price = '';
				$itemsize = $cursize = [];

				$units_recalc = false;
			
				$measure = ($item["PROPERTY_UNITS_TMP_VALUE"] ?? $item["PROPERTY_MEASURE_VALUE"]);

				$cursize = [
					0 => trim(str_replace('.', ',', (!empty($item['PROPERTY_SIZE_WIDTH_VALUE']) ? $item['PROPERTY_SIZE_WIDTH_VALUE'] : ($item['PROPERTY_WIDTH_MM_VALUE'] / 100)))),
					1 => trim(str_replace('.', ',', (!empty($item['PROPERTY_SIZE_LENGTH_VALUE']) ? $item['PROPERTY_SIZE_LENGTH_VALUE'] : ($item['PROPERTY_LENGTH_MM_VALUE'] / 100))))
				];	

				$itemSize = [
					0 => trim(str_replace(',', '.', (!empty($item['PROPERTY_SIZE_WIDTH_VALUE']) ? ($item['PROPERTY_SIZE_WIDTH_VALUE'] / 100) : ($item['PROPERTY_WIDTH_MM_VALUE'] / 1000)))),
					1 => trim(str_replace(',', '.', (!empty($item['PROPERTY_SIZE_LENGTH_VALUE']) ? ($item['PROPERTY_SIZE_LENGTH_VALUE'] / 100) : ($item['PROPERTY_LENGTH_MM_VALUE'] / 1000))))
				];
				
				foreach($itemSize as $size){
					if(!is_numeric($size)){
						$show = false;
					}
				}

				if(in_array($item["IBLOCK_ID"] , [4, 9]) && !empty($measure) && $show == true):

				// Подсчёт еденицы измерения

					if($item["IBLOCK_ID"] == 9 && !empty($item['PROPERTY_KVM_V_UPAC_VALUE'])){
						$sqr = $item['PROPERTY_KVM_V_UPAC_VALUE']; //площадь в упаковке
					}else{
						$sqr = $itemSize[0] * $itemSize[1]; //площадь
					}
					
					$price = ($dp > 0 ? $dp : $pr);
					
					if($measure == 'упак.' || $measure == 'шт.'){
						$sprice = number_format($price, 0, '', '');
						$kmprice = number_format(ceil(($price/$sqr)), 0, '', '');
					}else{
						$kmprice = number_format($price, 0, '', '');
						$sprice = number_format(ceil(($price*$sqr)), 0, '', '');
					}
				//	$sqr = round($sqr * 10000) / 10000; ???????

					if (in_array($measure , $meastype) && !empty($itemSize) && is_numeric($itemSize[0]) && is_numeric($itemSize[1])) {

						$units_recalc = true;

					}

				endif;
			?>
			<div class="is-goods__block <?=$imgstyle;?>" data-id="list<?=$item["ID"];?>" itemscope="" itemtype="http://schema.org/Product" itemprop="itemListElement">
				<meta itemprop="category" content="<?=$arResult["SECTION"]["NAME"];?>">
				<meta itemprop="image" content="https://www.plitkanadom.ru<?=$item["PICTURE"]["src"];?>">
				<meta itemprop="description" content="<? echo $arItem['NAME']; ?>"/>
				<a href="<?=$item["DETAIL_PAGE_URL"];?>" itemprop="url">
					<span class="is-height"></span>
					<? if($sale > 0): ?>
					<span class="stiker skidka">-<?=$sale;?>%</span>
					<? endif; ?>
					<? if($item['IS_NEW'] == true):?>
					<div class="stiker isnew">Новинка</div>
                	<? endif; ?>
					<? if($item['DISCOUNT'] == 1):?>
					<? if($item["NIGHT_PRICE"] == 1 && $arParams["NIGHT"] == 1):?>
                    <div class="stiker isdeliverysale<? if($item['IS_NEW'] == true):?> have-new<? endif; ?>" title="<?=getMessage('DICOUNT_TITLE_LIFT');?>"><?=getMessage('DICOUNT_TITLE_STICKER');?></div>
					<? else: ?>
					<div class="stiker isdeliverysale<? if($item['IS_NEW'] == true):?> have-new<? endif; ?>" title="<?=getMessage('DICOUNT_TITLE');?>"><?=getMessage('DICOUNT_TITLE_STICKER');?></div>
                	<? endif; ?>
					<? endif; ?>
					<? if($item['DISCOUNT'] == 2):?>
					<? if($item["NIGHT_PRICE"] == 1 && $arParams["NIGHT"] == 1):?>
                    <div class="stiker isdelivery" title="<?=getMessage('DICOUNT_TITLE2_LIFT');?>"><?=getMessage('DICOUNT_TITLE2_STICKER');?></div>
                	<? else: ?>
					<div class="stiker isdelivery" title="<?=getMessage('DICOUNT_TITLE2');?>"><?=getMessage('DICOUNT_TITLE2_STICKER');?></div>
					<? endif; ?>
					<? endif; ?>
					<? if(!empty($item["PICTURE"])):?>
						<img class="is-img" src="<?=$item["PICTURE"]['MIN']["src"];?>" alt="<?=$item["NAME"];?>" />
					<? else: ?>
						<img class="is-img" src="/image/new_design/empty.jpg" alt="<?=$item["NAME"];?>" />
					<? endif; ?>
					<strong class="is-goods__name" itemprop="name"><?=$item["NAME"];?></strong>
					<div class="is-goods__params-block">
						<div class="is-goods__params-item"><span>Код товара:</span> <?=$item["ID"];?></div>
						<? if(!empty($itemSize[0]) && $itemSize[0] > 0 && !empty($itemSize[1]) && $itemSize[1] > 0):?>
						<div class="is-goods__params-item"><span>Размер:</span> <?=implode(" x ", $cursize)?> cм.</div>
						<? endif; ?>
						<?  if(!empty($item["PROPERTY_COLOR_VALUE"])):?>
						<div class="is-goods__params-item"><span>Цвет:</span> <?=$item["PROPERTY_COLOR_VALUE"];?></div>
						<? endif; ?>
					</div>
					<span class="is-goods__price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
						<meta itemprop="price" content="?=number_format(($dp > 0 ? $dp : $pr), 0, '', ' ');?>"/>
                    	<meta itemprop="priceCurrency" content="RUB"/>
						<? if($dp > 0 && $pr > $dp){?><span class="is-goods__price-old"><?=number_format($pr, 0, '', ' ');?> руб.</span><? } ?><span class="set-price" data-sprice="<?=$sprice;?>" data-kmprice="<?=$kmprice;?>"><?=number_format(($dp > 0 ? $dp : $pr), 0, '', ' ');?></span> руб.<?=(!empty($item["UNITS_TMP"]) ? '/<span class="is-quanty__type">'.$item["UNITS_TMP"]."</span>" : '');?>
					</span>
				</a>
				<div class="is-goods__quantity" data-id="list<?=$item["ID"];?>">
					<div class="is-goods__btn" data-type="down">-</div>
					<input type="text" size="3" class="is-goods__input" value="1" data-measure="<?=($measure ?? "шт.");?>">
					<div class="is-goods__btn" data-type="up">+</div>
					<? if(!empty($measure)):?>
						<? if($measure == 'кв. м.'):?>
							<span class="is-goods__change selected" data-measure="кв. м.">кв. м.</span>
							<span class="is-goods__change" data-measure="<?=($item["IBLOCK_ID"] == 9 && !empty($item['PROPERTY_KVM_V_UPAC_VALUE']) ? 'упак.' : 'шт.');?>"><?=($item["IBLOCK_ID"] == 9 && !empty($item['PROPERTY_KVM_V_UPAC_VALUE']) ? 'упак.' : 'шт.');?></span>
						<? else: ?>
							<span class="is-goods__change selected" data-measure="<?=($item["IBLOCK_ID"] == 9 && !empty($item['PROPERTY_KVM_V_UPAC_VALUE']) ? 'упак.' : 'шт.');?>"><?=($item["IBLOCK_ID"] == 9 && !empty($item['PROPERTY_KVM_V_UPAC_VALUE']) ? 'упак.' : 'шт.');?></span>
							<span class="is-goods__change" data-measure="кв. м.">кв. м.</span>
						<? endif; ?>
					<? endif; ?>
				</div>
				<div class="is-goods__buy" data-id="<?=$item["ID"];?>" data-sqr="<?=$sqr;?>" data-measure="<?=$measure;?>">Купить</div>
			</div>
			<? endforeach; ?>
		</div>
	</div>
</div>
<?=$arResult["NAV_STRING"];?>

<? if(!empty($arResult["SECTION"])):?>
	<div class="section-block__text"><?=$arResult["SECTION"]["DESCRIPTION"];?></div>
<? endif; ?>

<script>
	$(document).ready(function(){
		
		$('.is-goods__change').on('click', function(){
			
			if(!$(this).hasClass('selected')){
				
				var measure = $(this).attr('data-measure');
				var isval = $(this).parent('.is-goods__quantity').find('.is-goods__input').val();
				var id = $(this).parent('.is-goods__quantity').attr('data-id');
				var sprice = $('[data-id="'+id+'"]').find('.set-price').attr('data-sprice');
				var kprice = $('[data-id="'+id+'"]').find('.set-price').attr('data-kmprice');
				
				$.ajax({
					url: '/ajax/fixcalculate.php',
					type: 'POST',
					dataType: 'json',
					data: {
						ajax : true,
						measure : measure,
						val : isval,
						sqr : $(this).parent('.is-goods__quantity').next('.is-goods__buy').attr('data-sqr'),
					},
					beforeSend: function () {
						$('body').addClass('wait');
					},
					success: function (data) {
						
						var isval = data.value;
						
						if(isval >= 1000){
							isval = 999;
						}
						
						$('[data-id="'+id+'"]').find('.is-goods__input').val(data.value);
					}
					
				});
				
				$(this).parent('.is-goods__quantity').find('.is-goods__change').removeClass('selected');

				$(this).parent('.is-goods__quantity').find('.is-goods__input').attr('data-measure', measure);
				
				if(measure == "шт." || measure == "упак."){
					$('[data-id="'+id+'"]').find('.set-price').html(sprice);
					
				}else{
					$('[data-id="'+id+'"]').find('.set-price').html(kprice);
				}
				
				$('[data-id="'+id+'"]').find('.is-quanty__type').html(measure);
				
				$(this).addClass('selected');
				
				$('body').removeClass('wait');

			}
		
		});
		
		$('.is-goods__buy').on('click', function(){
		if(!$('body').hasClass('wait')){
			
			var isid = $(this).attr('data-id');
			var measure = $('[data-id="list'+isid+'"]').find('.is-goods__input').attr('data-measure');
			
			$.ajax({
				url: '/ajax/addtobasket.php',
				type: 'POST',
				dataType: 'json',
				data: {
					ajax : true,
					id : isid,
					qaunty : $(this).prev('.is-goods__quantity').find('.is-goods__input').val(),
					type : 'add',
					measure : measure,
					originmeasure :$(this).attr('data-measure'),
					sqrorg : $(this).attr('data-sqr'),
					sqrset : $(this).parent('.is-goods__quantity').find('.is-goods__input').attr('data-sqr'),
				},
				beforeSend: function () {
					$('body').addClass('wait');
				},
				success: function (data) {
					$('.bx_small_cart').html(data);
					$('body').removeClass('wait');
				}
			});
		}
	});
		
		$('.is-goods__btn').on('click', function() {
			var type = $(this).attr('data-type');
			var val = $(this).parent('.is-goods__quantity').find('.is-goods__input').val();
			if(type == 'up'){
				val = (parseFloat(val) + 1).toFixed(2);
			}
			if(type == 'down'){
				val = (parseFloat(val) - 1).toFixed(2);
			}
			
			val = val.replace('.00', '');
			
			if(val < 1){
				val = 1;
			}
			
			if(val >= 1000){
				val = 999;
			}
			
			$(this).parent('.is-goods__quantity').find('.is-goods__input').val(val);
		});
		
		$('.is-goods__input').on('keyup', function() {
			var val = $(this).val();
			
			if(val.length > 0){
				var vtype = $(this).attr('data-measure');
				if(vtype == 'кв. м.'){
					val = val.replace(',', '.');
					val = val.replace(/[^0-9.]/g,"");
				}else{
					val = val.replace(/[^0-9]/g,"");
				}
				if(val >= 100){
					val = 99;
				}
			}
			$(this).val(val);
		});
		
	});
</script>

<?  endif; ?>