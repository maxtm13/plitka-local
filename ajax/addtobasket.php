<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Sale;
Bitrix\Main\Loader::includeModule("sale");
Bitrix\Main\Loader::includeModule("catalog");

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
		
	$siteId = \Bitrix\Main\Context::getCurrent()->getSite();
	$fuserId = Sale\Fuser::getId();

	if(!empty($_POST["id"])){
		Add2BasketByProductID((int)$_POST["id"]);
	}

	$basket = Sale\Basket::loadItemsForFUser($fuserId, $siteId);

	$count = count($basket->getQuantityList());
//	$count = array_sum($basket->getQuantityList());

	if($count > 0){

		$order = Sale\Order::create($siteId, $fuserId);
		$order->setPersonTypeId(1);
		$order->setBasket($basket);

		$discounts = $order->getDiscount();
		$discounts->getApplyResult();

		$price = $order->getPrice();

		$text = '<strong>' .$count . '</strong> позиций' . '<br>' . number_format($price, 0, '', ' ') . ' руб.';

	}else{

		$text = '<strong>0</strong> позиций<br>';

	}

	echo json_encode($text);
} else
	die();