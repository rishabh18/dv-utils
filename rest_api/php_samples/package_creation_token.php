<?php
$token = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"; // replace this with your token key
$url = "http://test.delhivery.com/cmu/push/json/?token=".$token;

$params = array(); // this will contain request meta and the package feed
$package_data = array(); // package data feed
$shipments = array();
$pickup_location = array();

/////////////start: building the package feed/////////////////////
$shipment = array();
$shipment['name'] = 'John Kapoor'; // consignee name
$shipment['order'] = '3002199823224D'; // client order number
$shipment['products_desc'] = 'Resume services';
$shipment['order_date'] = '2013-04-08T18:30:00+00:00'; // ISO Format
$shipment['payment_mode'] = 'Cash';
$shipment['total_amount'] = 21841.0; // in INR
$shipment['cod_amount'] = '21841.0'; // amount to be collected, required for COD
$shipment['add'] = 'M25, Nelson Marg, GBP City Phase 1'; // consignee address
$shipment['city'] = 'Gurgaon';
$shipment['state'] = 'Haryana';
$shipment['country'] = 'India';
$shipment['phone'] = '9741119727';
$shipment['pin'] = '122002';

// pickup location information //
$pickup_location['add'] = '113 Barthal, Dundahera';
$pickup_location['city'] = 'New Delhi';
$pickup_location['country'] ='India';
$pickup_location['name'] = 'client_location';  // Use client warehouse name
$pickup_location['phone'] = '011-23456245';
$pickup_location['pin'] = '110070';
$pickup_location['state'] = 'Delhi';

$shipments = array($shipment);

$package_data['shipments'] = $shipments;
$package_data['pickup_location'] = $pickup_location;
$params['format'] = 'json';
$params['data'] =json_encode($package_data);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($params));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
$result = curl_exec($ch);
print_r($result);
curl_close($ch);

?>
