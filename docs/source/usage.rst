Usage
=====

To use the ntokloapi connector you just need to include the require path to autoload.php
and instantiate a new NtokloApi class and insert the API key and secret into the function.

::
	require "vendor/autoload.php";
	$api = new NtokloApi( 'nToklo API key', 'nToklo API secret' );


Universal Variable
------------------

The nToklo recommendation engine uses UV(Universal Variable) objects to create the recommendations.
UV is a type of JSON object that has a specfic set of keys to manage ecommerce entries. You can check
the specification `here <http://docs.qubitproducts.com/uv//>`_

For example Universal Variable in JSON:

::
	uv = {
		"version": 1.2,
		"user": {
		
		}
	}
