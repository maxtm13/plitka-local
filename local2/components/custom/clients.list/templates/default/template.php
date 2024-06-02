<? if($arParams['SHOW_TITLE'] == "Y"){?>
<div class="title-line">
	<div class="title-line__h3">
		Наши клиенты
	</div>
 <a href="/onas/clients/" class="title-line__more">ПОСМОТРЕТЬ ВСЕ</a>
</div>
<? } ?>
<div class="clients">
    <? foreach($arResult['ITEMS'] as $item){?>
    <a href="<?=$item["PROPERTY_URL_NEWS_CLIENTS_VALUE"]?>" class="clients__item" >
        <div class="clients__image"><img src="<?=$item["PICTURE"] ?>" title="<?=$item["NAME"]?>"></div>
        <div class="clients__title"><?=$item["NAME"]?></div>
        <object>
            <div class="clients__descriptions"><?=$item["PREVIEW_TEXT"]?></div>
        </object>
    </a>
    <? } ?>
</div>
<? if($arParams['SHOW_NAV'] == "Y"){?>
<div class="clients__pagination">
    <? $arResult['NAV_STRING'] = $arResult['NAV_RESULT']->GetPageNavStringEx($navComponentObject, 'Страницы', 'arrows');?>
    <?= (!empty($arResult['NAV_STRING'])) ? $arResult['NAV_STRING'] : '' ?>
</div>
<? } ?>