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
<style>
	.ost_val { line-height: 30px; }
</style>
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
        <h2 style="color: rgb(0, 0, 0); text-transform: uppercase; font-size: 24px; font-weight: 600;"><?=$arResult["NAME"]?></h2>
	<?endif;?>
	<?
	?>
		<?
			$Dnow = MakeTimeStamp(FormatDate("Y-m-d H:i:s", date("Y")), "YYYY-MM-DD HH:MI:SS");
			$Dend = MakeTimeStamp($arResult["DATE_ACTIVE_TO"]);
			if ($Dnow < $Dend):
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
				<div class="ost_val" id="dates">
				</div>
				<div class="ost_t" id="dnote">
				</div>
			</div>
			<div id="timer-el" class="hours">
				<div class="topcal">
				</div>
				<img
					src="<? echo $picPath; ?>"
					class="cal-list"
				/>
				<div class="ost_val" id="hours">
				</div>
				<div class="ost_t" id="hnote">
				</div>
			</div>
			<div id="timer-el" class="minuts">
				<div class="topcal">
				</div>
				<img
					src="<? echo $picPath; ?>"
					class="cal-list"
				/>
				<div class="ost_val" id="minutes">
				</div>
				<div class="ost_t" id="mnote">
				</div>
			</div>
			<div id="timer-el" class="sec">
				<div class="topcal">
				</div>
				<img
					src="<? echo $picPath; ?>"
					class="cal-list"
				/>
				<div class="ost_val" id="seconds">
				</div>
				<div class="ost_t" id="snote">
				</div>
			</div>
		</div>
	<? /*
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
	*/
		$dateProm = FormatDate("Y-m-d", MakeTimeStamp($arResult["DATE_ACTIVE_TO"])-3600*3);
		$dateProm = $dateProm.'T'.FormatDate("H:i:s", MakeTimeStamp($arResult["DATE_ACTIVE_TO"])-3600*3);
	?>
	<link rel="stylesheet" href="/css/jquery.countdown.css" />
	<?
		$newdate = FormatDate("Y, m, d", MakeTimeStamp($arResult["DATE_ACTIVE_TO"])-3600*3);
	?>
	<script src="/js/jquery.countdown.js"></script>
	<script>
			$(function(){
				var ts = new Date('<?=$dateProm;?>'),tss = new Date('<?=$dateProm;?>'),
					endCount = true;

				console.log('<?=$newdate;?>');
				console.log(ts);
				console.log(tss);
				if((new Date()) > ts){
					// The new year is here! Count towards something else.
					// Notice the *1000 at the end - time must be in milliseconds
					ts = (new Date()).getTime() + 10*24*60*60*1000;
					endCount = false;
				}

				$('#countdown').countdown({
					timestamp	: ts,
					callback	: function(days, hours, minutes, seconds){
						
						var datesN = declOfNum(days, ['день', 'дня', 'дней']);
						var hoursN = declOfNum(hours, ['час', 'часа', 'часов']);
						var minutsN = declOfNum(minutes, ['минута', 'минуты', 'минут']);
						var secondsN = declOfNum(seconds, ['секунда', 'секунды', 'секунд']);

						$('#dates').html(days);
						$('#hours').html(hours);
						$('#minutes').html(minutes);
						$('#seconds').html(seconds);
						
						$('#dnote').html(datesN);
						$('#hnote').html(hoursN);
						$('#mnote').html(minutsN);
						$('#snote').html(secondsN);
					}
				});

			});
		/*
			$.date = function(dateObject) {
				 var d = new Date(dateObject);
				 var day = d.getDate();
				 var month = d.getMonth() + 1;
				 var year = d.getFullYear();
				 if (day < 10) {
					  day = "0" + day;
				 }
				 if (month < 10) {
					  month = "0" + month;
				 }
				 var date = year + ",  + month + ", " + day;

				 return date;
			};
			
			var getd = $.date(ddd);
		*/
		//	console.log(getd);
		
			function declOfNum(number, titles) {  
				cases = [2, 0, 1, 1, 1, 2];  
				return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];  
			}

		</script>
		<?
			else:
		?>
		<p class="ActTo">Акция завершила срок действия и перемещена в архив</p>
		<?
			endif;
		?>
		
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
   <? /* <h2 style="color: rgb(0, 0, 0); text-transform: uppercase; font-size: 24px; font-weight: 600;">В акции участвуют</H2> */ ?>
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
						"DETAIL_PAGE_URL",
						"PROP_S_COL",
						"PROP_S_PRO"
                ));
	}
?>	