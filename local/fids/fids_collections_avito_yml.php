<?php require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?header("Content-Type: text/xml;");?>
<?echo "<"."?xml version=\"1.0\"?".">"?>
<Ads formatVersion="3" target="Avito.ru" crm_version="1CAvitoModule">
<?
	$exclude = htmlspecialchars($request->getQuery("del"));
	$exclude = explode(',', $exclude);
	$data = ["UF_IBLOCK_ID" => [4]];
	$collection = \Collections::getCollectionsHL($data);

?>
	<?foreach($collection as $key=>$item){?>
		<?if(!in_array($item['UF_FACTORY_ID'], $exclude)){?>
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
				<Id><?=$item['UF_COLLECTIONS_ID']?></Id>
				<Title><?=htmlspecialchars($item['UF_FULL_NAME'])?></Title>
				<DateBegin><?=$dateBegin?></DateBegin>
				<DateEnd>2030-11-01T00:00:00+03:00</DateEnd>
				<ListingFee>PackageSingle</ListingFee>
				<AdStatus>Free</AdStatus>
				<ContactMethod>По телефону и в сообщениях</ContactMethod>
				<ManagerName>Менеджер</ManagerName>
				<ContactPhone>+7 495 182-22-29</ContactPhone>
				<Address>Москва, 2-й Вязовский проезд, д. 10, стр. 2</Address>
				<Price><?=$item['UF_PRICE']?></Price>
				<?if($item['UF_DESCRIPTION']){?>
					<Description><?=htmlspecialchars($item['UF_DESCRIPTION'])?></Description>
				<?}else{?>
					<Description>'Вac приветствуeт Плитка на Дом❗ Более 100.000 видов плитки и керамогранита из Италии, Испании, Ирана, Турции, России, Беларуси и других производителей Звоните! И мы проконсультируем вас по ассортименту и производителям, подберем лучший вариант под ваш запрос за 10 минут! Керамическая плитка <?=htmlspecialchars($item['UF_NAME'])?>' фабрики <?=htmlspecialchars($item['UF_FACTORY_NAME'])?> по доступной цене! ХАРАКТЕРИСТИКА ПО ТОВАРУ ❗ На фото не все плитки из коллекции <?=htmlspecialchars($item['UF_NAME'])?> фабрики <?=htmlspecialchars($item['UF_FACTORY_NAME'])?> ❗ Добавьте это объявление в ⭐ Избранное, чтобы не потерять. ❗Реализуем в Розницу и Оптом со склада в Москве❗ Прoчность и надёжнoсть, пpoтивоcкoльзящее покрытие, стильный дизайн, устойчивость к температурным перепадам и воздействию влаги, низкая истираемость, долговечность. Звоните прямо сейчас для выбора товаров и бесплатной консультации с нашими специалистами или переходите в профиль! ПЛЮСЫ РАБОТЫ С НАМИ ✅ Выгодные условия сотрудничества ОПТОМ и в Розницу: дизайнеры, архитекторы, прорабы, строительно-подрядные организации / фирмы. ✅ Прямые поставки от ведущих зарубежных и российских производителей ✅ Множество различных моделей на любой вкус и цвет ✅Бесплатный 3D-дизайн (раскладка плитки + визуализация) в ПОДАРОК нашим клиентам! ✅Скидки постоянным и оптовым покупателям ✅Доставка в удобное для Вас время по Москве и Московской области ✅Работаем с юридическими и физическими лицами, с НДС и без НДС ❓Ищите, какой вариант подобрать по цене и качеству? ПОДПИШИТЕСЬ на наш профиль, чтобы не потерять нас, каждую неделю обновляем ассортимента! Больше товара в профиле или на сайте Возможно, Вы искали: Крупноформатный керамогранит, крупноформатная керамика, напольная плитка, плитка для ванны, плитка для пола, плитка для стен, керамогранит со склада, керамическая плитка, плитка под мрамор, плитка под дерево, плитка под камень, плитка под бетон, плитка моноколор, плитка под кирпич, плитка под травертин, плитка под оникс, пэчворк, метлахская плитка, кислотоупорная плитка, кислотостойкая плитка, кафель, кафельная плитка, плитка на фасад, клинкер, фасадная плитка, вентилируемый фасад, полированный керамогранит, глянцевый керамогранит, матовый керамогранит, лаппатированный керамогранит, карвинг, мозаика, керамогранит на вентфасад, кварцвиниловая плитка, кварцвинил, пвх плитка, spc плитка, каменно полимерная плитка, виниловая плитка Плитка60*60, Плитка 600*600, Плитка 60*120, Плитка 600*1200, Плитка1200*600, Плитка30*60, Плитка 300*600, Плитка600*300, Плитка80*160, Плитка 800*1600, Плитка1600*800, Плитка100*300, Плитка 1000*3000, Плитка 3000*1000, Плитка 20*120, Плитка 200*1200, Плитка 1200*200, Плитка 30*90, Плитка 300*900, Плитка 900*300, Плитка 80*80, Плитка 800*800, Плитка 45*45, Плитка 450*450, Плитка 50*50, Плитка 500*500, Плитка 30*30, Плитка 300*300, Плитка 120*240, Плитка 1200*2400, Плитка 2400*1200,керамическая плитка опт, плитка в опт, керамическая плитка прочная, к оптовый магазин плитки, оптом плитка в Москве, керамическая плитка Москва, керамическая плитка Московская область, керамическая плитка Балашиха, керамическая плитка Одинцово, керамическая плитка Раменское, керамическая плитка Химки , керамическая плитка Мытищи, керамическая плитка Люберцы, керамическая плитка Видное, керамическая плитка Внуково, керамическая плитка Домодедово</Description>
				<?}?>
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
					<?if($item['UF_SRC_PICTURE']){?>
						<Image url="https://www.plitkanadom.ru<?=$item['UF_SRC_PICTURE']?>"/>
					<?}?>
					<?if($item['UF_SRC_MORE_PHOTO']){
						$arr = unserialize($item['UF_SRC_MORE_PHOTO']);
						foreach($arr as $src){?>
							<Image url="https://www.plitkanadom.ru<?=$src?>"/>
						<?}?>
					<?}?>
				</Images>
			</Ad>
		<?}?>
	<?}?>

</Ads>