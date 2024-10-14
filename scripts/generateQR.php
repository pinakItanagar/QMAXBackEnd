<?php
header('Content-Type: *');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
include('qrcode/qrlib.php'); 
$product_code = "123";
$json = file_get_contents('php://input');
$obj = json_decode($json, TRUE);
echo "<pre>";
print_r($_POST['productList']);
die();

//$file_name = "qrcode/test_" .$product_code.".png";
//QRcode::png($product_code, $file_name); 
$op_response = array( 
    "response_status" => $obj->productList,
    "op_status" => 1
);
echo json_encode($op_response);
?>