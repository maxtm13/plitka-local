<?php require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?header("Content-Type: text/xml;");?>
<?echo "<"."?xml version=\"1.0\"?".">"?>
<Ads formatVersion="3" target="Avito.ru" crm_version="1CAvitoModule">
<?
	$getCollections = $_SERVER['DOCUMENT_ROOT'].'/local/fids/json/json_iblock_4_collections.json';

	$id_element = htmlspecialchars($request->getQuery("id"));

	if(file_exists($getCollections)){
		$collection = file_get_contents($getCollections);
		$collection = json_decode($collection, true);
	}

?>
	<?foreach($collection as $key=>$item){?>
			<? if ($item['ID'] == $id_element){?>
			<?

				$res = ($key/400); // Сколько штук в день
				$day = round($res);
				$dateBegin = "2023-12-28"; // Дата начала показа объявлений
				$minute = ($minute<400?$minute+1:$minute=1);
				$dateBegin = date('Y-m-d\TH:i:s+03:00', strtotime($dateBegin.'+'.$day.'day'));
				$dateBegin = date('Y-m-d\TH:i:s+03:00', strtotime($dateBegin.'+9 hour'));
				$dateBegin = date('Y-m-d\TH:i:s+03:00', strtotime($dateBegin.'+'.$minute.'minute'));

			?>
			<Ad>
				<Id><?=$item['ID']?></Id>
				<Title><?=htmlspecialchars($item['FULL_NAME'])?></Title>
				<DateBegin><?=$dateBegin?></DateBegin>
				<DateEnd>2030-11-01T00:00:00+03:00</DateEnd>
				<ListingFee>PackageSingle</ListingFee>
				<AdStatus>Free</AdStatus>
				<ContactMethod>По телефону и в сообщениях</ContactMethod>
				<ManagerName>Менеджер</ManagerName>
				<ContactPhone>+7 495 182-22-29</ContactPhone>
				<Address>Москва, 2-й Вязовский проезд, д. 10, стр. 2</Address>
				<Price><?=$item['UF_CATALOG_PRICE_1']?></Price>
				<Description><?=htmlspecialchars($item['AVITO_DESCRIPTION'])?></Description>
				<AdType>Товар приобретен на продажу</AdType>
				<Latitude/>
				<Longitude/>
				<Category>Ремонт и строительство</Category>
				<GoodsType>Стройматериалы</GoodsType>
				<Condition>Новое</Condition>
				<Availability/>
				<GoodsSubType>Отделка</GoodsSubType>
				<FinishingType/>
				<FinishingSubType/>
				<Images>

					<Image url="https://www.plitkanadom.ru<?=$item['SRC_PICTURE']?>"/>
					<?if($item['MORE_PICTURE']){
						foreach($item['MORE_PICTURE'] as $src){?>
							<Image url="https://www.plitkanadom.ru<?=$src?>"/>
						<?}?>
					<?}?>
				</Images>
			</Ad>
			<?}?>
	<?}?>

</Ads>
