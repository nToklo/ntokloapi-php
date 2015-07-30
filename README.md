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

## Authors

- Fu Hoang <fu.hoang@ntoklo.com>

## License

This library is licensed under the Apache 2.0 license. See LICENSE for more
details

## Copyright

Copyright 2015 nToklo Ltd.
