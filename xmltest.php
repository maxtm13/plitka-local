<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
/*

$fabriksID = [
  //--------------------------------Беларусь
    23161, //Керамин
    23162, //Березакерамика
    23402, //Meissen
    38491, //Villeroy Boch
  //--------------------------------Индия
    44687, //Staro
    55898, //Arcadia Ceramica
    49546, //Neodom
    54891, //Colortile
    55207, //Primavera
    56291, //Dav Keramika
    48707, //Italica
    49654, //Bluezone
    50839, //ITC ceramic
    55152, //LV Granito
    53962, //Realistik Индия
  //--------------------------------Иран
    55003, //Eefa Ceram
    54738, //Marjan Tile
    50166, //Eurotile
  //--------------------------------Испания
    23265, //Equipe
    23149, //Mainzu
    23140, //Dual Gres
    23213, //Exagres
    23318, //Arcana
    38808, //Dvomo
    23153, //Pamesa Ceramica
    23311, //Kerlife
    23244, //Fanal
    23269, //Emigres
    23143, //Gaya Fores
    23227, //Gres de Aragon
    37590, //Keratile
    23134, //APE Ceramicas
    23215, //Gresmanc
    23218, //Grespania
    40060, //Wow
    23293, //Venis
    23313, //Vidrepur
    23182, //Argenta Ceramica
    23239, //Realonda Ceramica
    33072, //Vives
    49434, //DNA tiles
    23211, //Porcelanosa
    23221, //EL Barco
    23190, //Aparici
    23249, //Decocer
    23438, //Peronda
    23254, //Alaplana
    43616, //Harmony
    44009, //Museum
    23440, //Adex
    23150, //Metropol Ceramica
    23203, //Stylnul (STN Ceramica)
    23194, //Codicer 95
    23192, //Benadresa Azulejos
    23523, //Ezarri
    23217, //Colorker
    23152, //Oset
    23312, //Gresan
    23214, //Ecoceramic
    23205, //Undefasa
    23247, //Monopole
    23411, //Natucer
    23250, //El Molino
    23505, //Apavisa
    23373, //Geotiles
    23266, //Tau Ceramica
  //--------------------------------Италия
    23415, //Mirage
    23379, //Imola
    23369, //Atlas Concorde
    23299, //RHS Ceramiche (Rondine group)
    36731, //41zero42
    23420, //Marazzi
    23443, //Vallelunga
    23432, //Marca Corona
    23260, //ABK Group
    23416, //Ragno
    23417, //Sant Agostino
    55187, //Ceramica Fioranese
    23514, //La Fabbrica
    23264, //Piemme
    23442, //Rex Ceramiche
    53535, //La Fenice
    23284, //Serenissima Cir
    23368, //Impronta Italgraniti
    23385, //Naxos
    23298, //Cerdomus
    43731, //Ergon
  //--------------------------------Китай
    23471, //Bonaparte
    44683, //Starmosaic
    23397, //NS-Mosaic
    35045, //Imagine Mosaic
    47797, //Juliano
    50054, //NT Ceramic
    50450, //Villa Ceramica
    37737, //Tonomosaic
  //--------------------------------Польша
    23207, //Tubadzin
    23158, //Paradyz
    23392, //Cerrad
  //--------------------------------Португалия
    23493, //Domino
  //--------------------------------Россия
    23166, //Kerama Marazzi
    44924, //Axima
    23511, //Gracia Ceramica
    23167, //Italon
    23163, //Azori
    23187, //Cersanit
    42628, //Laparet
    46349, //Грани таганая
    23169, //Estima
    23291, //Atlas Concorde Russia
    23164, //Lasselsberger-Ceramics
    45970, //Гранитея
    45296, //Creto
    23170, //Нефрит
    23165, //Coliseum Gres
    23510, //Unitile (Шахтинская плитка)
    23406, //Уральский гранит
    34225, //Belleza
    23290, //Пиастрелла
    55856, //Idalgo (Идальго)
    42640, //Eletto Ceramica
    42775, //ProGRES
    36492, //Global Tile
    23229, //Кировская керамика (М-Квадрат)
    23277, //Grasaro
    45845, //Ametis
    55143, //Incolor
  //--------------------------------Турция
    23288, //Vitra
    31989, //Травертин
    36940, //Kutahya
    54809, //Etili Seramik
  //--------------------------------Хорватия
    34536, //Technistone
  //--------------------------------Чехия
  23431, //Rako
];

*/

$fabriksID = [
  //--------------------------------Турция
    23288, //Vitra
    31989, //Травертин
    36940, //Kutahya
    54809, //Etili Seramik
  //--------------------------------Хорватия
    34536, //Technistone
  //--------------------------------Чехия
];

//Формируем массив коллекций из списка фабрик
$arSectionList = []; // Массив коллекций
$arSectionListID = []; //Массив ИД коллекций
$arFilter = [
  'ACTIVE' => 'Y',
  'GLOBAL_ACTIVE' => 'Y',
  'IBLOCK_ID' => 4,
  'INCLUDE_SUBSECTIONS' => 'Y',
  'SECTION_ID' => $fabriksID,
];
$arSelect = [
  'NAME',
  'ID',
  'CODE',
  'IBLOCK_SECTION_ID',
  'UF_MORO_PHOTO'
];
$db = CIBlockSection::GetList([], $arFilter, false, $arSelect);
while ($dbResult = $db->GetNext()) {
  $arSectionListID[] = $dbResult['ID'];
  $arSectionList[$dbResult['ID']] = [
    'name' => $dbResult['NAME'],
    'photos' => $dbResult['UF_MORO_PHOTO']
  ];
}

// Формируем список товаров
$arFilter = [
  'ACTIVE' => 'Y',
  'GLOBAL_ACTIVE' => 'Y',
  'IBLOCK_ID' => 4,
  '!=PROPERTY_AVAILABILITY' => 'Нет в наличии',
  'IBLOCK_SECTION_ID' => $arSectionListID
];
$arSelect = [
  'ID',
  'CATALOG_PRICE_1',
  'DETAIL_PICTURE',
  'NAME',
  'CODE',
  'IBLOCK_SECTION_ID',
  'PROPERTY_MANUFACTURE',
  'PROPERTY_COLOR',
  'PROPERTY_COUNTRY',
  'PROPERTY_SHTUK_V_UPAC',
  'PROPERTY_FORM',
  'PROPERTY_SIZE_WIDTH',
  'PROPERTY_SIZE_LENGTH',
];
$res = CIBlockElement::GetList([], $arFilter, false, [], $arSelect);
while ($arSect = $res->GetNext()) {
  $arSectionList[$arSect['IBLOCK_SECTION_ID']]['items'][] = [
    'name' => 'Плитка ' . $arSect['NAME'],
    'price' => $arSect['CATALOG_PRICE_1'],
    'brand' => $arSect["PROPERTY_MANUFACTURE_VALUE"],
    'img' => $arSect['DETAIL_PICTURE'],
    'code' => $arSect['CODE'],
    'props' => [
      0 => 'Бренд: ' . $arSect["PROPERTY_MANUFACTURE_VALUE"],
      1 => 'Цвет: ' . implode(',', $arSect["PROPERTY_COLOR_VALUE"]),
      2 => 'Страна производитель: ' . $arSect["PROPERTY_COUNTRY_VALUE"],
      3 => 'Штук в упаковке: ' . $arSect["PROPERTY_SHTUK_V_UPAC_VALUE"],
      4 => 'Форма: ' . implode(',', $arSect["PROPERTY_FORM_VALUE"]),
      4 => 'Размер (ШхД): ' . $arSect["PROPERTY_SIZE_WIDTH_VALUE"] . 'x' . $arSect["PROPERTY_SIZE_LENGTH_VALUE"],
    ]
  ];
}

//Создаем экземпляр документа
$xml = new DomDocument('1.0', 'utf-8');

//Создаем основной раздел каталога
$ymCatalog = $xml->appendChild($xml->createElement('Ads'));
$ymCatalog->setAttribute('target', 'Avito.ru');
$ymCatalog->setAttribute('formatVersion', '3');

foreach($arSectionList as $collectionCode => $collection) {
  foreach($collection['items'] as $productItem) {
    $description = '';
    $description .= '<![CDATA[<p>Характеристики:</p>';
    $description .= '<ul>';
      foreach($productItem['props'] as $prop) {
        $description .= '<li>' . $prop . '</li>';
      }
    $description .= '</ul>]]>';

    //Создаем тег товара
    $product = $ymCatalog->appendChild($xml->createElement('Ad'));

    //ИД товара
    $xmlID = $product->appendChild($xml->createElement('Id'));
    $xmlID->appendChild($xml->createTextNode($productItem['code']));

    //Телефон
    $xmlPhone = $product->appendChild($xml->createElement('ContactPhone'));
    $xmlPhone->appendChild($xml->createTextNode('+7 (800) 755-755-7'));

    //Адрес
    $xmlAddress = $product->appendChild($xml->createElement('Address'));
    $xmlAddress->appendChild($xml->createTextNode('Москва, 2-й Вязовский проезд, д. 10, стр. 2'));

    //Категория
    $xmlCategory = $product->appendChild($xml->createElement('Category'));
    $xmlCategory->appendChild($xml->createTextNode('Ремонт и строительство'));

    //Состояние
    $xmlCondition = $product->appendChild($xml->createElement('Condition'));
    $xmlCondition->appendChild($xml->createTextNode('Новое'));

    //Тип товара
    $xmlGodsType = $product->appendChild($xml->createElement('GoodsType'));
    $xmlGodsType->appendChild($xml->createTextNode('Стройматериалы'));

    //Подраздел товара
    $xmlGodsSubType = $product->appendChild($xml->createElement('GoodsSubType'));
    $xmlGodsSubType->appendChild($xml->createTextNode('Отделка'));

    //Тип товара
    $xmlFinishingType = $product->appendChild($xml->createElement('FinishingType'));
    $xmlFinishingType->appendChild($xml->createTextNode('Плитка, керамогранит и мозаика'));

    //Тип товара конечный
    $xmlFinishingSubType = $product->appendChild($xml->createElement('FinishingSubType'));
    $xmlFinishingSubType->appendChild($xml->createTextNode('Керамическая плитка'));

    //Тип реализации товара
    $xmlAdType = $product->appendChild($xml->createElement('AdType'));
    $xmlAdType->appendChild($xml->createTextNode('Товар приобретен на продажу'));

    //Наименование
    $xmlTitle = $product->appendChild($xml->createElement('Title'));
    $xmlTitle->appendChild($xml->createTextNode($productItem['name']));

    //Описание
    $xmlTitle = $product->appendChild($xml->createElement('Description'));
    $xmlTitle->appendChild($xml->createTextNode($description));

    //Цена
    $xmlTitle = $product->appendChild($xml->createElement('Price'));
    $xmlTitle->appendChild($xml->createTextNode($productItem['price']));

    //Фото
    if (!empty($collection['photos'])) {
      $xmlImages = $product->appendChild($xml->createElement('Images'));

        if (!empty($productItem['img'])) {
          $xmlImg = $xmlImages->appendChild($xml->createElement('Image'));
          $xmlImg->setAttribute('url', CFile::GetPath($productItem['img']));
        }

        foreach($collection['photos'] as $photo) {
          $xmlImg = $xmlImages->appendChild($xml->createElement('Image'));
          $xmlImg->setAttribute('url', CFile::GetPath($photo));
        }
    } else {
      if (!empty($productItem['img'])) {
        $xmlImages = $product->appendChild($xml->createElement('Images'));
        $xmlImg = $xmlImages->appendChild($xml->createElement('Image'));
        $xmlImg->setAttribute('url', CFile::GetPath($productItem['img']));
      }
    }

  }
}

//Устанавливаем форматирование документа
$xml->formatOutput = true;

$xml->save($_SERVER['DOCUMENT_ROOT'] . '/upload/avitoFeed.xml');
