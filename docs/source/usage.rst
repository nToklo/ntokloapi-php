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

.. note::
	The ntokloapi with automatically encode the Univerisal Variable into JSON if is in PHP format.
	If the UV is in JSON you will need to use the PHP json_decoded() into PHP before posting into the API.

For example Universal Variable in JSON:
::
	uv = {
		"version": 1.2, # If his doesn's exist, the connector will assume latest 
		"user": {
			"user_id": "nicole12@example.com",
			"name": "Nicole Watts",
			"username": "nicoleuser123"
		},
		"events": [
			{
				"category": "conversion_funnel",
				"action": "preview"
			}
		],
		"product":{
			"id": "1234",
			"url": "http://www.fashionbay.com/women/shoes/french_sole_flats_1021.html",
			"name": "French Sole: Classic Ballet",
			"unit_price": 99,
			"unit_sale_price": 69,
			"description": "This is beautifully soft, unstructured ballet flat is ..."
			"category": "shoes"  
		}
	}


For example Universal Variable in PHP:
::
	$uv = array('version' => '1.2',
              'user' => array('user_id' => '112'),
              'product' => array(
              		"id" => "10201",
                    "name" => "Gabardine A-line skirt",
                    "category" => "Womens > Skirts",
                    "currency" => "GBP",
                    "unit_sale_price"=> 98),
              'events' => array((object)['category' => 'conversion_funnel', 'action' => 'browse' ])
          );


Products
--------
