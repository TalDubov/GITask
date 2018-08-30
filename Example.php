<?php
/**
 * Created by PhpStorm.
 * User: TalDubov
 */

/* Should be with autoloader or by composer*/
require_once 'Model/Api/Items.php';
require_once 'Model/Api/Token.php';
require_once 'Model/Config.php';
require_once 'Model/ApiException.php';
require_once 'Model/Request.php';
require_once 'Model/Validators/ValidatorInterface.php';
require_once 'Model/Validators/AddItem.php';
require_once 'Model/Validators/GetItem.php';

$myId = '5aa58e5d-8d2e-4033-ba1c-d4b1b40097c2';
$mySecret = 'oBs9mzrffuJFpc1GbwEnQA';
$itemParams = array(
    "name" => "IKS0".rand(1000,9999),
    "description"=>  "פריט לדוגמה",
    "price"=>  20.12,
    "currency"=>  "ILS",
);
try{
    /*Add example*/
    $itemsModel = new \Model\Api\Items($myId, $mySecret);
    $result = $itemsModel->addItem($itemParams);
    /*Get example*/
    $itemsModel = new \Model\Api\Items($myId, $mySecret);
    $result = $itemsModel->getItem($result['id']);
    var_dump($result);
}
catch (\Model\ApiException $ex) {
    echo $ex->getMessage();//TODO: print an error or something
}
