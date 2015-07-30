<?php

use Ntokloapi\classes\NtokloApi as NtokloApi;

//require the nToklo api
//require('./src/Ntokloapi/NtokloApi.php');
require_once __DIR__ . '/vendor/autoload.php';
$data = array('version' => '1.2',
              'user' => array('user_id' => '112'),
              'product' => array("id" => "10201",
                                 "name" => "Gabardine A-line skirt",
                                 "category" => "Womens > Skirts",
                                 "currency" => "GBP",
                                 "unit_sale_price"=> 98),
              'events' => array((object)['category' => 'conversion_funnel', 'action' => 'browse' ])
              );

// create a ntoklo pai instance and pass the key and secret for more infomation got to: http://docs.ntoklo.com/start.php
$api = new NtokloApi( 'YzBlYmIzYWMtZDg0Zi00MTc0LWEyZTgtMzNiMGU3ZmU1MTA3', 'OGNmZDkwZGMtNTdlMi00ZWNmLWFjNzAtMmE3MTU4YjQ2MzM2' );


/**
 * post Event to the nToklo api,
 * For more info go to: http://docs.ntoklo.com/start.php/api_reference:events
 * @param pass an json decode object as an args
 * @return bool
 */
echo $api->postEvent($data);


/**
 * post products to the nToklo api,
 * For more info go to: http://docs.ntoklo.com/start.php/api_reference:products
 * @param pass an json decode object as an args
 * @return bool
 */
//$api->postProduct($_data_product);


/**
 * fetch the recommendations from nToklo api
 * For more info go to: http://docs.ntoklo.com/start.php/api_reference:recommendations
 * @param string $userId optional.
 * @param string $productId optional.
 * @param string $scope optional.
 * @param string $value optional.
 * @return Json
 */
//$api->recommendations($userId, $productId, $scope, $value);


/**
 *This function will fetch the charts from nToklo api
 * For more info go to: http://docs.ntoklo.com/start.php/api_reference:charts
 * @param string $timestamp Optional.
 * @param string $scope Optional.
 * @param string $value Optional.
 * @param string $action Optional
 * @param string $tw Optional.
 * @param srting $maxItems Optional.
 * @return Json object
 */
//$api->chart($timestamp, $scope, $value, $action, $tw, $maxItems);


 /**
  * Post a product id to nToklo api to blacklist
  * For more info go to: http://docs.ntoklo.com/start.php/api_reference:blacklist
  * @param string $productId
  * @return bool
  */
//$api->addBlacklist($product);


 /**
  * Remove a product id from blacklist
  * For more info go to: http://docs.ntoklo.com/start.php/api_reference:blacklist
  * @param string $productId
  * @return bool
  */
//$api->removeBlacklist($productId);


 /**
  * Fetch all product from blacklist
  * For more info go to: http://docs.ntoklo.com/start.php/api_reference:blacklist
  * @param string $productId
  * @return bool
  */
//$api->fetchBlacklist();

?>