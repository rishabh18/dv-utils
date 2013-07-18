<?php
//creates a cash order with gharpay-like input feed
//using token based auth

$token = "c3d9a429cd84fa8bebdfc60f29f11c3f7197eaa0"; // replace this with your token key
$url = "http://test.delhivery.com/api/p/createOrder/json/?token=$token";
$data = array();

/////////////start: building the order feed/////////////////////
$order_feed = array();
$customer_details = array();
$order_details = array();
$product_details = array();

$customer_details['address'] = 'test address';
$customer_details['contactNo'] = '9871160555';
$customer_details['email'] = 'tech.admin@delhivery.com';
$customer_details['firstName'] = 'karan';
$customer_details['lastName'] = 'agarwal';
$customer_details['prefix'] = 'Mr.';

$product_details['productID'] = 'productID_1';
$product_details['productQuantity'] = '1';
$product_details['unitCost'] = '30';
$product_details['productDescription'] = 'this is a test description';

$order_details['productDetails'] = $product_details;
$order_details['pincode'] = '110054';
$order_details['clientOrderID'] = '7723571A';
$order_details['deliveryDate'] = '20-06-2013';
$order_details['InvoiceUrl'] = 'www.example.com/example.html';
$order_details['paymentMode'] = 'cash';

$order_feed['customerDetails'] = $customer_details;
$order_feed['orderDetails'] = $order_details;

/////////////end: building the order feed/////////////////////

$data['format'] = 'json'; // input data format
$data['data'] = json_encode($order_feed);

$header[] = "Accept:application/json";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$result = curl_exec($ch);


print_r($result);
curl_close($ch);

?>
