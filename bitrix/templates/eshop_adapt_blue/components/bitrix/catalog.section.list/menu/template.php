<?php require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if($arResult["DEPTH_1"]):?>
<style>
	.sublevels-wrapper { min-height: 700px !important; }
</style>
<ul class="pnd-vm-top-2018">
	<? foreach($arResult["DEPTH_1"] as $k=>$depth1):?>
	<li class="parent hasSublvl" data-key="key<?=$k;?>"<?=(!empty($arResult["DEPTH_2"][$depth1["ID"]]))? ' data-loadsublvl="2"':'';?>>
		<span class="pnd__arr"></span>
		<a href="<?=$depth1["UF_MENU_SECTION_LINK"];?>" class="root-item"><?=$depth1["NAME"];?></a>
		<? if(!empty($arResult["DEPTH_2"][$depth1["ID"]])):?>
		<? if($arParams["AGENT"] != "Y"):?>
		<div class="sublevels-wrapper" data-level="2" style="height: 735px;">
			<div class="pnd__return">Вернуться</div>
			<ul class="sublevel level-2" data-level="2">
			<? foreach($arResult["DEPTH_2"][$depth1["ID"]] as $kk=>$depth2):?>
				<li class="depth-2 parent hasSublvl" data-key="key<?=$kk;?>"<?=(!empty($arResult["DEPTH_3"][$depth2["ID"]]))? ' data-loadsublvl="3"':'';?>>
					<div class="pnd__triangle"></div>
					<a class="parent" href="<?=$depth2["UF_MENU_SECTION_LINK"];?>"><?=$depth2["NAME"];?><span>›</span></a>
					<div class="sublevels-wrapper" data-level="3" style="top: 0px; left: 25%; z-index: 1600; height: 735px;">
						<? if(!empty($arResult["DEPTH_3"][$depth2["ID"]])):?>
						<div class="pnd__return">Вернуться</div>
						<ul class="sublevel level-3" data-level="3">
						<? foreach($arResult["DEPTH_3"][$depth2["ID"]] as $kk=>$depth3): ?>
							<? if($depth3["UF_MENU_COLUMN"] == 4 || empty($depth3["UF_MENU_COLUMN"])):?>
								<? if($depth3["NAME"] != "#" || !empty($depth3["NAME"])):?>
									<li class="depth-3 title"><span><?=($depth3["UF_MENU_SHOW_TITLE"] == '0') ? '' : $depth3["NAME"]; ?></span></li>
									<? if($arResult["ITEMS"][$depth3["ID"]]):?>
										<? foreach($arResult["ITEMS"][$depth3["ID"]] as $item):?>
											<? if($item["NAME"] != "#" || !empty($item["NAME"])):?>
									<li class="depth-3"><a href="<?=$item["URL"];?>"><?=$item["NAME"];?></a></li>
											<? endif; ?>
										<? endforeach;?>
									<? endif; ?>
								<? endif; ?>
							<? endif; ?>
						<? endforeach; ?>	
						</ul>
						<ul class="sublevel level-3" data-level="3">
						<? foreach($arResult["DEPTH_3"][$depth2["ID"]] as $kk=>$depth3): ?>
							<? if($depth3["UF_MENU_COLUMN"] == 5):?>
								<? if($depth3["NAME"] != "#" || !empty($depth3["NAME"])):?>
									<li class="depth-3 title"><span><?=$depth3["NAME"];?></span></li>
									<? if($arResult["ITEMS"][$depth3["ID"]]):?>
										<? foreach($arResult["ITEMS"][$depth3["ID"]] as $item):?>
											<? if($item["NAME"] != "#" || !empty($item["NAME"])):?>
									<li class="depth-3"><a href="<?=$item["URL"];?>"><?=$item["NAME"];?></a></li>
											<? endif; ?>
										<? endforeach;?>
									<? endif; ?>
								<? endif; ?>
							<? endif; ?>
						<? endforeach; ?>	
						</ul>
						<ul class="sublevel level-3" data-level="3">
						<? foreach($arResult["DEPTH_3"][$depth2["ID"]] as $kk=>$depth3): ?>
							<? if($depth3["UF_MENU_COLUMN"] == 6):?>
								<? if($depth3["NAME"] != "#" || !empty($depth3["NAME"])):?>
									<li class="depth-3 title"><span><?=$depth3["NAME"];?></span></li>
									<? if($arResult["ITEMS"][$depth3["ID"]]):?>
										<? foreach($arResult["ITEMS"][$depth3["ID"]] as $item):?>
											<? if($item["NAME"] != "#" || !empty($item["NAME"])):?>
									<li class="depth-3"><a href="<?=$item["URL"];?>"><?=$item["NAME"];?></a></li>
											<? endif; ?>
										<? endforeach;?>
									<? endif; ?>
								<? endif; ?>
							<? endif; ?>
						<? endforeach; ?>	
						</ul>
						<? endif; ?>
						<div class="include-wrapper clear"><div class="clear"></div></div>
					</div>
				</li>
			<? endforeach; ?>
			</ul>
		</div>
		<? endif; ?>
		<? endif; ?>
	</li>
	<? endforeach; ?>
</ul>
<? endif; ?>