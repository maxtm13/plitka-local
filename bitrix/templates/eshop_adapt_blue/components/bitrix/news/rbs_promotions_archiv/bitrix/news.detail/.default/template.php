<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="rbs-news-detail">
<?	
	$picPath = $templateFolder.'/prom_cal.png';
	
	?>
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])){?>
		<img
			class="detail_picture"
			border="0"
			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
			width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
			height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
		/>
	<? }else{ ?>
		<img
			class="detail_picture"
			src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>"
			alt="<?=$arResult["NAME"]?>"
			title="<?=$arResult["NAME"]?>"
		/>
		
	<? } ?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h1><?=$arResult["NAME"]?></h1>
	<?endif;?>
	<?
	?>
		<p class="ActTo">Акция заканчивается <? echo FormatDate("d F", MakeTimeStamp($arResult["DATE_ACTIVE_TO"]));?></p>
		<div class="timer">
			<div id="timer-el" class="days">
				<div class="topcal">
				</div>
				<img
					src="<? echo $picPath; ?>"
					class="cal-list"
				/>
				<div class="ost_val">
				</div>
				<div class="ost_t">
				</div>
			</div>
			<div id="timer-el" class="hours">
				<div class="topcal">
				</div>
				<img
					src="<? echo $picPath; ?>"
					class="cal-list"
				/>
				<div class="ost_val">
				</div>
				<div class="ost_t">
				</div>
			</div>
			<div id="timer-el" class="minuts">
				<div class="topcal">
				</div>
				<img
					src="<? echo $picPath; ?>"
					class="cal-list"
				/>
				<div class="ost_val">
				</div>
				<div class="ost_t">
				</div>
			</div>
			<div id="timer-el" class="sec">
				<div class="topcal">
				</div>
				<img
					src="<? echo $picPath; ?>"
					class="cal-list"
				/>
				<div class="ost_val" id="uuu">
				</div>
				<div class="ost_t">
				</div>
			</div>
		</div>
		<script>
			var t1; var t2; var t3; var t4;
			function declOfNum(number, titles) {  
				cases = [2, 0, 1, 1, 1, 2];  
				return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];  
			}
			function getTime(val, g){
				document.getElementsByClassName('ost_val')[g].innerText = val;
				if (g == 0){
					document.getElementsByClassName('ost_t')[g].innerText = declOfNum(val, ['день', 'дня', 'дней']);
				}
				if (g == 1){
					document.getElementsByClassName('ost_t')[g].innerText = declOfNum(val, ['час', 'часа', 'часов']);
				}
				if (g == 2){
					document.getElementsByClassName('ost_t')[g].innerText = declOfNum(val, ['минута', 'минуты', 'минут']);
				}
				if (g == 3){
					document.getElementsByClassName('ost_t')[g].innerText = declOfNum(val, ['секунда', 'секунды', 'секунд']);
				}
			}
			function formatDate(date) {
				var dny = Math.floor(date/86400000);
				date -= dny*86400000;
				var ch  = Math.floor(date/3600000);
				date -= ch*3600000;
				var mi  = Math.floor(date/60000);
				date -= mi*60000;
				var sec = Math.floor(date/1000);
				
				getTime(dny, 0);
				getTime(ch, 1);
				getTime(mi, 2);
				getTime(sec, 3);
			}
			<?
				$dateProm = FormatDate("Y-m-d", MakeTimeStamp($arResult["DATE_ACTIVE_TO"])-3600*3);
				$dateProm = $dateProm.'T'.FormatDate("H:i:s", MakeTimeStamp($arResult["DATE_ACTIVE_TO"])-3600*3);
				$dateProm = "'".$dateProm."z'";
			?>
			const endTime =  new Date(<? echo $dateProm; ?>);
			
			let updateTimer = () => {
			  if (new Date() > endTime) {
				clearInterval(timer);
			  } else {
				let timeDiff = Math.floor(endTime - new Date());
				let t = new Date(timeDiff);
				formatDate(t);
			  }
			}
			let timer = setInterval(updateTimer, 1000);
			updateTimer();
		</script>
		<br>
		<p class="TimeIsLim">
			<?if(strlen($arResult["DETAIL_TEXT"])>0):?>
				<?echo $arResult["DETAIL_TEXT"];?>
			<?else:?>
				<?echo $arResult["PREVIEW_TEXT"];?>
			<?endif?>
		</p>
	<div style="clear:both"></div>
	<br />
	<H1>В акции участвуют</H1>	
</div>
<?
	$cp = $this->__component; // объект компонента
	if (is_object($cp)) {
		$cp->SetResultCacheKeys(array(
                        "AR_IBLOCK_ID_EL",
                        "IS_LINCED_EMPTY_EL",
                        "IS_LINCED_EMPTY_COL1",
                        "IS_LINCED_EMPTY_COL2",
						"IS_LINCED_EMPTY_COL3",
                        "AR_LINKS_EL",
                        "AR_LINKS_COL",
						"DETAIL_PAGE_URL"
                ));
	}
?>	