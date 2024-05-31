<?php
	
	require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

	if (CModule::IncludeModule('iblock'))
	{

		$rs = CIBlockSection::GetList(
		   array(),
		   array('SECTION_ID'=>23360,'IBLOCK_ID'=>4)
		);
		$k = "0";
		while ($ar = $rs->GetNext()) 
		{
/*			echo "<pre> - " . $k;
			print_r($ar);
			echo "</pre>";*/
			$arResult["ITEMS"][] = $ar;
		}


		foreach ($arResult["ITEMS"] as $arItem) 
		{

			$k ++;
			$DESCRIPTION = "<p>Плитка Alta Ceramica имеет самобытный стиль и ярко выделяется на фоне конкурентов. Это продукция премиум-класса для самых разных помещений. Она оправдывает свою цену долгим сроком службы, стойкостью к механическим нагрузкам и агрессии среды, а также неприхотливостью в уходе. Плитка ". $arItem["NAME"] . " идеально вписывается в общую концепцию бренда. Оригинальный дизайн с актуальной цветовой гаммой, выверенная геометрия базовых элементов и декора, практичная поверхность — вот что сделало керамику этой итальянской фабрики популярной, в том числе в России. Оставьте заявку, и мы быстро выполним доставку любого количества материала.</p>";
		
			$bs = new CIBlockSection;

			$arFields = Array(
				"DESCRIPTION" => $DESCRIPTION,
				"DESCRIPTION_TYPE" => "html"
			);

			$res = $bs->Update($arItem["ID"], $arFields);
			
			echo $k . " -> " . $res . "</br>";

		}

	}


//	Плитка " . $arItem["NAME"] . "