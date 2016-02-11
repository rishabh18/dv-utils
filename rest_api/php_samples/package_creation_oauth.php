<?php
//creates a package with delhivery complaint input feed
//using oauth

include_once "oauth-php/library/OAuthStore.php";
include_once "oauth-php/library/OAuthRequester.php";

$key = 'gharpay'; // this is your consumer key
$secret = 'test123'; // this is your secret key

$options = array( 'consumer_key' => $key, 'consumer_secret' => $secret );
OAuthStore::instance("2Leg", $options );

$url = "http://test.delhivery.com/cmu/push/json/";
$method = "POST";
$params = array(); // this will contain request meta and the package feed
$package_data = array(); // package data feed
$shipments = array();

/////////////start: building the package feed/////////////////////
$shipment = array();
$shipment['name'] = 'John Kapoor'; // consignee name
$shipment['order'] = '3002199824B'; // client order number
$shipment['products_desc'] = 'Resume services';
$shipment['order_date'] = '2013-04-08T18:30:00+00:00'; // ISO Format
$shipment['payment_mode'] = 'Cash';
$shipment['total_amount'] = 21841.0; // in INR
$shipment['cod_amount'] = '21841.0'; // amount to be collected, required for COD
$shipment['add'] = 'M25, Nelson Marg, GBP City Phase 1'; // consignee address
$shipment['city'] = 'Gurgaon';
$shipment['state'] = 'Haryana';
$shipment['country'] = 'India';
$shipment['phone'] = 'xxxxxxxxxxxxxx';
$shipment['pin'] = '122002';

$shipments = array($shipment);

$package_data['shipments'] = $shipments;
/////////////end: building the package feed/////////////////////

$params['format'] = 'json'; // input data format
$params['data'] = json_encode($package_data);

try
{
        // Obtain a request object for the request we want to make
        $request = new OAuthRequester($url, $method, $params);

        // Sign the request, perform a curl request and return the results, 
        // throws OAuthException2 exception on an error
        // $result is an array of the form: array ('code'=>int, 'headers'=>array(), 'body'=>string)
        $result = $request->doRequest();
        
        $response = $result['body'];
        echo $response;
}
catch(OAuthException2 $e)
{
    echo $e;
}

?>
