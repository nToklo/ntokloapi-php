# nToklo API PHP connector

Version: 0.1 beta

This library will allow you to connect to the nToklo API and create your own applications, get tokens and the results. Full documentation of the API can be found [in the nToklo dev website](https://docs.ntoklo.com)

## Installation

###Composer

``` bash
$ composer require ntoklo/ntokloapi-php

```


### Usage

Include the require path to autoload.php and instantiate a new NtokloApi class and pass through the nToklo api key and secret.

``` php
require "vendor/autoload.php";

$api = $api = new NtokloApi('nToklo API key', 'nToklo API secret');

```

### Examples

Events API allows customers to send nToklo user activity.
[click here for more info on Events](http://docs.ntoklo.com/start.php/api_reference:events)

``` php
$api->postEvent( $array );

```



``` php
$api->postProduct( $array );

```

``` php
$api->getProduct( $productId );

```

``` php
$api->recommendations( $userId, $productId, $scope, $value );

```

``` php
$api->chart( $timestamp, $scope, $value, $action, $tw, $maxItems );

```

``` php
$api->addBlacklist($productId);

```

``` php
$api->removeBlacklist($productId);

```

```php
$api->fetchBlacklist();

```


## Features

This is a list of the functionality that is available on this API connector:

* postEvent($date);
* postProduct($data_product);
* getProduct($productId);
* recommendations($userId = null, $productId = null, $scope = null, $value = null);
* chart($timestamp = null, $scope = null, $value = null, $action = null, $tw = null, $maxItems = null);
* addBlacklist($productId);
* removeBlacklist($productId);
* fetchBlacklist();


## Authors

- Fu Hoang <fu.hoang@ntoklo.com>

## License

This library is licensed under the Apache 2.0 license. See LICENSE for more
details

## Copyright

Copyright 2015 nToklo Ltd.
