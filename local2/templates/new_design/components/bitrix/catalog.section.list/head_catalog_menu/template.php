<?php require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if($arResult["DEPTH_1"]):
?>
<ul class="is-head__catalog-ul">
	<? foreach($arResult["DEPTH_1"] as $k=>$depth1):?>
	<li class="parent depth-1<?=(!empty($arResult["DEPTH_2"][$depth1["ID"]]))? ' hasSublvl':'';?>" data-key="key<?=$k;?>"<?=(!empty($arResult["DEPTH_2"][$depth1["ID"]]))? ' data-loadsublvl="2"':'';?> id="item<?=$depth1["ID"];?>">
		<span class="pnd__arr" onClick="openMenu('<?=$depth1["ID"];?>');"><img src="/image/new_design/menu_arrow.svg" alt="" /></span>
		<a href="<?=$depth1["UF_MENU_SECTION_LINK"];?>" class="root-item<?=($depth1["UF_MENU_SECTION_LINK"] == $arParams["CUR_DIR"] ? ' is-selected' : '');?>">
			<? $url = $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH . '/svg/'.$depth1["CODE"].".svg";
			if(file_exists($url)):?>
			<img src="<?=SITE_TEMPLATE_PATH . '/svg/'.$depth1["CODE"].".svg";?>" alt="<?=$depth1["NAME"];?>" />
			<? endif; ?>
			<?=$depth1["NAME"];?>
		</a>
		<? if(!empty($arResult["DEPTH_2"][$depth1["ID"]])):?>
		<? // if($arParams["AGENT"] != "Y"):?>
		<div class="sublevels-wrapper" data-level="2">
			<div class="max-window">
				<? /*
				<div class="pnd__return">Вернуться</div>
				*/ ?>
				<ul class="sublevel level-2" data-level="2">
			<? foreach($arResult["DEPTH_2"][$depth1["ID"]] as $kk=>$depth2):?>
				<li class="depth-2<?if(!empty($arResult["DEPTH_3"][$depth2["ID"]])){echo " parent";}?> hasSublvl" data-key="key<?=$kk;?>"<?=(!empty($arResult["DEPTH_3"][$depth2["ID"]]))? ' data-loadsublvl="3"':'';?> id="item<?=$depth2["ID"];?>">
					<div class="pnd__triangle" onClick="openMenu('<?=$depth2["ID"];?>');"></div>
					<a class="<?if(!empty($arResult["DEPTH_3"][$depth2["ID"]])){echo "parent ";}?><?=($depth2["UF_MENU_SECTION_LINK"] == $arParams["CUR_DIR"] ? ' is-selected' : '');?>" href="<?=$depth2["UF_MENU_SECTION_LINK"];?>">
						<? if($depth2["UF_ICON"]): ?>
						<? // =file_get_contents($_SERVER['DOCUMENT_ROOT'].CFile::GetPath($depth2["UF_ICON"]));?>
						<img src="<?=CFile::GetPath($depth2["UF_ICON"]);?>" alt="<?=$depth2["NAME"];?>" />
						<? endif; ?>
						<?=$depth2["NAME"];?>
						<?if(!empty($arResult["DEPTH_3"][$depth2["ID"]])) {?>
							<span><img src="/image/new_design/menu_arrow.svg" alt="" /></span>
						<?}?>
						</a>
					<div class="sublevels-wrapper" data-level="3">
						<? if(!empty($arResult["DEPTH_3"][$depth2["ID"]])):?>
						<? /*
						<div class="pnd__return">Вернуться</div>
						*/ ?>
						<ul class="sublevel level-3" data-level="3">
						<? foreach($arResult["DEPTH_3"][$depth2["ID"]] as $kk=>$depth3): ?>
							<? if($depth3["UF_MENU_COLUMN"] == 4 || empty($depth3["UF_MENU_COLUMN"])):?>
								<? if($depth3["NAME"] != "#" || !empty($depth3["NAME"])):?>
									<li class="depth-3 title">
										<? if($depth3["UF_MENU_SHOW_TITLE"] != '0'):?>
												<? $url = $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH . '/svg/'.$depth3["CODE"].".svg";
												if(file_exists($url)):?>
												<? // =file_get_contents($url);?>
												<img src="<?=SITE_TEMPLATE_PATH . '/svg/'.$depth3["CODE"].".svg";?>" alt="<?=$depth3["NAME"];?>" />
												<? endif; ?>
										<? endif; ?>
										<span><?=($depth3["UF_MENU_SHOW_TITLE"] == '0') ? '' : $depth3["NAME"]; ?></span>
									</li>
									<? if($arResult["ITEMS"][$depth3["ID"]]):?>
										<? $i = 0; foreach($arResult["ITEMS"][$depth3["ID"]] as $item):?>
											<? if($item["NAME"] != "#" || !empty($item["NAME"])):?>
									<li class="depth-3"><a href="<?=$item["URL"];?>" class="is-depth3<?=($item["URL"] == $arParams["CUR_DIR"] ? ' is-selected' : '');?>"><?=$item["NAME"];?></a></li>
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
									<li class="depth-3 title">
										<? $url = $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH . '/svg/'.$depth3["CODE"].".svg";
										if(file_exists($url)):?>
										<? // =file_get_contents($url);?>
										<img src="<?=SITE_TEMPLATE_PATH . '/svg/'.$depth3["CODE"].".svg";?>" alt="<?=$depth3["NAME"];?>" />
										<? endif; ?>
										<span><?=$depth3["NAME"];?></span>
									</li>
									<? if($arResult["ITEMS"][$depth3["ID"]]):?>
										<? foreach($arResult["ITEMS"][$depth3["ID"]] as $item):?>
											<? if($item["NAME"] != "#" || !empty($item["NAME"])):?>
									<li class="depth-3"><a href="<?=$item["URL"];?>" class="is-depth3<?=($item["URL"] == $arParams["CUR_DIR"] ? ' is-selected' : '');?>"><?=$item["NAME"];?></a></li>
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
									<li class="depth-3 title">
										<? $url = $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH . '/svg/'.$depth3["CODE"].".svg";
										if(file_exists($url)):?>
										<? // =file_get_contents($url);?>
										<img src="<?=SITE_TEMPLATE_PATH . '/svg/'.$depth3["CODE"].".svg";?>" alt="<?=$depth3["NAME"];?>" />
										<? endif; ?>
										<span><?=$depth3["NAME"];?></span>
									</li>
									<? if($arResult["ITEMS"][$depth3["ID"]]):?>
										<? foreach($arResult["ITEMS"][$depth3["ID"]] as $item):?>
											<? if($item["NAME"] != "#" || !empty($item["NAME"])):?>
									<li class="depth-3"><a href="<?=$item["URL"];?>" class="is-depth3<?=($item["URL"] == $arParams["CUR_DIR"] ? ' is-selected' : '');?>"><?=$item["NAME"];?></a></li>
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
		</div>
		<? // endif; ?>
		<? endif; ?>
	</li>
	<? endforeach; ?>
</ul>
<div class="catalog-burger">
	<img src="/image/new_design/catalog_burger.svg" alt="Каталог" />Каталог
</div>
<? endif; ?>
