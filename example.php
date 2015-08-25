<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);



$data = array('version' => '1.2',
              'user' => array('user_id' => '112'),
              'product' => array("id" => "10201",
                                 "name" => "Gabardine A-line skirt",
                                 "category" => "Womens > Skirts",
                                 "currency" => "GBP",
                                 "unit_sale_price"=> 98),
              'events' => array((object)['category' => 'conversion_funnel', 'action' => 'browse' ])
              );

$data_product = array('version' => '1.2',
                      'user' => array('user_id' => '112'),
                      'product' => array("id" => "886",
                                     "name" => "KOTORI BAG",
                                     "category" => "all",
                                     "currency" => "GBP",
                                     "unit_sale_price" => 30),
                      'events' => array((object)['category' => 'conversion_funnel', 'action' => 'preview' ])
                      );

//print_r(json_encode($data));
//print_r(json_encode($_data_product));


//require 'app/NtokloApi.php';
require "vendor/autoload.php";
$api = new NtokloApi('OTNmMjlhZmUtZmQ4Yy00MjQ4LThjODAtNzBjMjJlODRjYjVh', 'YzM0OTlhNDAtZGMxZS00Yzg4LWEyZjAtOWVlMmM5NGIyZjM3');
//echo $api->postEvent($data);
//echo $api->postProduct($data_product);
//echo $api->getProduct('192');
echo $api->recommendations($userId = null, $productId = '217', $scope = null, $value = null);
//echo $api->chart($timestamp = null, $scope = null, $value = null, $action = null, $tw = 'DAILY', $maxItems = null);
//echo $api->addBlacklist("192");
//echo $api->removeBlacklist("168");
//echo $api->fetchBlacklist();


?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Api Test</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

  <link rel="stylesheet" href="css/styles.css?v=1.0">
</head>

<body>
    <p>Hello world!</p>

</body>
</html>