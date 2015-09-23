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

$api = new NtokloApi('nToklo API key', 'nToklo API secret');

```

### Examples

#### Events

Events API allows customers to send nToklo user activity.
[Click here for more info on Events](http://docs.ntoklo.com/start.php/api_reference:events)

``` php
$api->postEvent( $array );

```

#### Add Products

Add a new product to the Ntoklo API
[Click here for more info on posting product](http://docs.ntoklo.com/start.php/api_reference:products)

``` php
$api->postProduct( $array );

```

#### Get product

Get a product by ID
[Click here for more info on getting product by Id](http://docs.ntoklo.com/start.php/api_reference:products)

``` php
$api->getProduct( $productId );

```

#### Recommendations

Recommendations API allows customers to retrieve recommendations based on user history and product attributes
[Click here for more info on recommendations](http://docs.ntoklo.com/start.php/api_reference:recommendations)

``` php
$api->recommendations( $userId, $productId, $scope, $value );

```


#### Charts

Charts API allows customers to retrieve a list of popular products. Charts represents a rolling time window (daily or weekly) and can be scoped by product attributes and filtered by action.
[Click here for more info on charts](http://docs.ntoklo.com/start.php/api_reference:charts)

``` php
$api->chart( $timestamp, $scope, $value, $action, $tw, $maxItems );

```


#### Add to blacklist

Add to blacklist
[Click here for more info on adding product to blacklist](http://docs.ntoklo.com/start.php/api_reference:blacklist)

``` php
$api->addBlacklist($productId);

```

#### Remove from blacklist

Remove from blacklist
[Click here for more info on removing product from blacklist](http://docs.ntoklo.com/start.php/api_reference:blacklist)

``` php
$api->removeBlacklist($productId);

```


#### Get blacklist product

Gettin all blacklisted product
[Click here for more info on getting blacklisted products](http://docs.ntoklo.com/start.php/api_reference:blacklist)

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
