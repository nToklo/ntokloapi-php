Installation
============

To install the nToklo API connector you can do it through composer:
::
	$ composer require ntoklo/ntokloapi-php

Or if you want you can install the latest version from the git respository:
::
	$ git clone https:://github.com/nToklo/ntokloapi-php.git


Once you have installed it, you will need to include the require path to autoload.php
and instantiate a new NtokloApi class and insert the API key and secret into the function.
::
	require "vendor/autoload.php";
	$api = new NtokloApi( 'nToklo API key', 'nToklo API secret' );


Then you can access the functionality like this:
::
	$api->postEvent( $array );