# nToklo API PHP connector

Version: 0.1 beta

This library will allow you to connect to the nToklo API and create your own applications, get tokens and the results. Full documentation of the API can be found [in the nToklo dev website](https://docs.ntoklo.com)

## Support

This connector supports PHP >=5.5.9

## Features
This is a list of the functionality that is available on this API connector:

* postEvent($args)
* postProduct($_data_product);
* recommendations($userId, $productId, $scope, $value);
* chart($timstamp, $scope, $value, $action, $tw, $maxItems);
* addBlacklist($productId);
* removeBlacklist($productId);
* fetchBlacklist();

## Basic Usage

Use new Ntokloapi\NtokloApi( 'key', 'secret' ); to create and initialize the nToklo
API, which can make request by accessing the methods and passing the required parameters.


*require the nToklo api

- require '/path/to/Ntokloapi/NtokloApi.php';

create a ntoklo apinstance and pass the key and secret for more infomation got to: http://docs.ntoklo.com/start.php

- $api = new Ntokloapi\NtokloApi( 'key', 'secret' );


* post Event to the nToklo api,
* For more info go to: http://docs.ntoklo.com/start.php/api_reference:events
* @param pass an json decode object as an args
* @return bool

$api->postEvent($data);



* post products to the nToklo api,
* For more info go to: http://docs.ntoklo.com/start.php/api_reference:products
* @param pass an json decode object as an args
* @return bool

- $api->postProduct($_data_product);



* fetch the recommendations from nToklo api
* For more info go to: http://docs.ntoklo.com/start.php/api_reference:recommendations
* @param string $userId optional.
* @param string $productId optional.
* @param string $scope optional.
* @param string $value optional.
* @return Json

- $api->recommendations($userId, $productId, $scope, $value);



*This function will fetch the charts from nToklo api
* For more info go to: http://docs.ntoklo.com/start.php/api_reference:charts
* @param string $timestamp Optional.
* @param string $scope Optional.
* @param string $value Optional.
* @param string $action Optional
* @param string $tw Optional.
* @param srting $maxItems Optional.
* @return Json object

- $api->chart($timestamp, $scope, $value, $action, $tw, $maxItems);


* Post a product id to nToklo api to blacklist
* For more info go to: http://docs.ntoklo.com/start.php/api_reference:blacklist
* @param string $productId
* @return bool

- $api->addBlacklist($product);



* Remove a product id from blacklist
* For more info go to: http://docs.ntoklo.com/start.php/api_reference:blacklist
* @param string $productId
* @return bool

- $api->removeBlacklist($productId);



* Fetch all product from blacklist
* For more info go to: http://docs.ntoklo.com/start.php/api_reference:blacklist
* @param string $productId
* @return bool

- $api->fetchBlacklist();


## Authors

- Fu Hoang <fu.hoang@ntoklo.com>

## License

This library is licensed under the Apache 2.0 license. See LICENSE for more
details

## Copyright

Copyright 2015 nToklo Ltd.
