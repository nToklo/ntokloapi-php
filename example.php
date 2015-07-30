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

$_data_product = array('version' => '1.2',
                       'product' => array("id" => "10201",
                                     "name" => "Gabardine A-line skirt",
                                     "category" => "Womens > Skirts",
                                     "currency" => "GBP",
                                     "unit_sale_price" => 98)
                       );

//print_r(json_encode($data));
//print_r(json_encode($_data_product));


require('ntokloapi/NtokloApi.php');
$api = new Ntokloapi\NtokloApi('YzBlYmIzYWMtZDg0Zi00MTc0LWEyZTgtMzNiMGU3ZmU1MTA3', 'OGNmZDkwZGMtNTdlMi00ZWNmLWFjNzAtMmE3MTU4YjQ2MzM2' );
echo $api->postEvent($data);
echo $api->postProduct($_data_product);
//echo $api->recommendations('1', '10201', null, null);
//echo $api->chart(null, null, null, null, 'DAILY');
//echo $api->addBlacklist('10201');
//echo $api->removeBlacklist('10201');
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