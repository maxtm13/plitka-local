<? 
//namespace Сollections;

use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Loader;
Loader::includeModule("highloadblock");

class Collections {

	const HL_BLOCK_ID = 10; // Указываем ID хайлоад блока

	public static function setCollections($data){
		if(is_array($data)){
			foreach($data as $item){
				self::getCollections($item);
			}
		}
	}

	protected static function getCollections($id) {

		$IBLOCK_ID = $id;
		$entity = \Bitrix\Iblock\Model\Section::compileEntityByIblock($IBLOCK_ID);
		$res = $entity::getList(array(
			'order' => array('LEFT_MARGIN'=>'ASC'),
			'filter' => array(
				'IBLOCK_ID' => $IBLOCK_ID,
				'ACTIVE' => 'Y',
			), 
			'select' =>  array(
				'ID',
				'NAME',
				'DESCRIPTION',
				'IBLOCK_SECTION_ID',
				'DEPTH_LEVEL',
				'PICTURE',
				'LEFT_MARGIN',
				'RIGHT_MARGIN',
				'UF_CATALOG_PRICE_1',
				'UF_MORO_PHOTO',
				'IBLOCK_SECTION_PAGE_URL' => 'IBLOCK.SECTION_PAGE_URL',
			),
		));
		while ($item = $res->fetch()) {

			if  ($item['DEPTH_LEVEL'] == 1) {
				$rsCountry['ID'] = $item['ID'];
				$rsCountry['NAME'] = $item['NAME'];
				$arCountry[] = $rsCountry;
			} else if ($item['DEPTH_LEVEL'] == 2) {
				$rsFactory['ID'] = $item['ID'];
				$rsFactory['COUNTRY_ID'] = $rsCountry['ID'];
				$rsFactory['NAME'] = $item['NAME'];
				$arFactory[] = $rsFactory;
			} else if ($item['DEPTH_LEVEL'] == 3) {
				$rsCollections = $item;
				$rsCollections['FULL_NAME'] = $item['NAME'].' - '.$rsFactory['NAME'];
				$rsCollections['COUNTRY_ID'] = $rsCountry['ID'];
				$rsCollections['FACTORY_ID'] = $rsFactory['ID'];
				$rsCollections['FACTORY_NAME'] = $rsFactory['NAME'];
				$rsCollections['COUNTRY_NAME'] = $rsCountry['NAME'];
				$rsCollections['IBLOCK_ID'] = $IBLOCK_ID;
				$rsCollections['SRC_PICTURE'] = CFile::GetPath($item['PICTURE']);
				if(count($item['UF_MORO_PHOTO']) > 0){
					foreach($item['UF_MORO_PHOTO'] as $src){
						$rsCollections['MORE_PICTURE'][] = CFile::GetPath($src);
					}
					$rsCollections['MORE_PICTURE'] = serialize($rsCollections['MORE_PICTURE']);
				}
				$rsCollections['DESCRIPTION'] = $item['DESCRIPTION'];
				$rsCollections['PAGE_URL'] = CIBlock::ReplaceDetailUrl($item['IBLOCK_SECTION_PAGE_URL'], $item, true, 'S');
				if ($item['UF_CATALOG_PRICE_1'] > 0){
					self::setCollectionsHL($rsCollections);
				}
			}
		}
	}

	protected static function setCollectionsHL($collections) {

		$hlblock = HL\HighloadBlockTable::getById(self::HL_BLOCK_ID)->fetch(); 
		$entity = HL\HighloadBlockTable::compileEntity($hlblock); 
		$entity_data_class = $entity->getDataClass();

		$result = $entity_data_class::getList(array(
		   "select" => array("*"),
		   "order" => array("ID" => "ASC"),
		   "filter" => array("UF_COLLECTIONS_ID"=>$collections["ID"])
		));

		if($arRow = $result->Fetch()) {
			$data = [
				"UF_NAME"=>$collections["NAME"],
				"UF_FULL_NAME"=>$collections["FULL_NAME"],
				"UF_IBLOCK_ID"=>$collections['IBLOCK_ID'],
				"UF_COUNTRY_ID"=>$collections["COUNTRY_ID"],
				"UF_COUNTRY_NAME"=>$collections["COUNTRY_NAME"],
				"UF_FACTORY_ID"=>$collections["FACTORY_ID"],
				"UF_FACTORY_NAME"=>$collections["FACTORY_NAME"],
				"UF_PAGE_URL"=>$collections["PAGE_URL"],
				"UF_SRC_PICTURE"=>$collections["SRC_PICTURE"],
				"UF_SRC_MORE_PHOTO"=> $collections["MORE_PICTURE"],
				"UF_DESCRIPTION"=>$collections["DESCRIPTION"],
				"UF_PRICE"=>$collections["UF_CATALOG_PRICE_1"],
			];
			$entity_data_class::update($arRow['ID'], $data);
		} else {
			$data = [
				"UF_COLLECTIONS_ID"=>$collections["ID"],
				"UF_NAME"=>$collections["NAME"],
				"UF_FULL_NAME"=>$collections["FULL_NAME"],
				"UF_IBLOCK_ID"=>$collections['IBLOCK_ID'],
				"UF_COUNTRY_ID"=>$collections["COUNTRY_ID"],
				"UF_COUNTRY_NAME"=>$collections["COUNTRY_NAME"],
				"UF_FACTORY_ID"=>$collections["FACTORY_ID"],
				"UF_FACTORY_NAME"=>$collections["FACTORY_NAME"],
				"UF_PAGE_URL"=>$collections["PAGE_URL"],
				"UF_SRC_PICTURE"=>$collections["SRC_PICTURE"],
				"UF_SRC_MORE_PHOTO"=> $collections["MORE_PICTURE"],
				"UF_DESCRIPTION"=>$collections["DESCRIPTION"],
				"UF_PRICE"=>$collections["UF_CATALOG_PRICE_1"],
			];
			$entity_data_class::add($data);
		}
	}

	public static function getCollectionsHL($data) { 
		$hlblock = HL\HighloadBlockTable::getById(self::HL_BLOCK_ID)->fetch(); 
		$entity = HL\HighloadBlockTable::compileEntity($hlblock); 
		$entity_data_class = $entity->getDataClass();

		$result = $entity_data_class::getList(array(
		   "select" => ["*"],
		   "order" => ["ID" => "ASC"],
		   "filter" => [
			   "UF_IBLOCK_ID"=> $data["UF_IBLOCK_ID"],
			]
		));

		while($arRow = $result->Fetch()){
		   $arResult[] = $arRow;
		}
		return $arResult;
	}

}