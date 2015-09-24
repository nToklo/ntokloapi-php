Usage
=====

To use the ntokloapi connector you just need to include the require path to
autoload.php and instantiate a new NtokloApi class and insert the API key and
secret into the function.
::

	require "vendor/autoload.php";
	$api = new NtokloApi( 'nToklo API key', 'nToklo API secret' );


Universal Variable
------------------

The nToklo recommendation engine uses UV(Universal Variable) objects to create
the recommendations. UV is a type of JSON object that has a specfic set of keys
to manage ecommerce entries. You can check the specification
`here <http://docs.qubitproducts.com/uv//>`_


.. note::

	The ntokloapi will automatically encode the Univerisal Variable into JSON
	if it's in PHP format. If the UV is in JSON you will need to use the PHP
	json_decoded() before posting into the API.

For example Universal Variable in JSON:

.. code-block:: php
	:linenos:

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

.. code-block:: php
	:linenos:

	$uv = array('
			"version" 	=> "1.2",
            "user" 		=> array("user_id" => "112"),
            "product" 	=> array(
              	"id" 				=> "10201",
                "name" 				=> "Gabardine A-line skirt",
                "category" 			=> "Womens > Skirts",
                "currency" 			=> "GBP",
                "unit_sale_price"	=> 98
            ),
            "events" 	=> array(
            	(object)[
            	"category" => "conversion_funnel", "action" => "browse"
            	]
            )
          );


Products
--------

To keep track of the products, you have to send them first.
**It's not a requirement** but if you have a big catalog it will allow you to
preprocess the data before starting to send events.

Example:

.. code-block:: php
	:linenos:

   	require "vendor/autoload.php";
   	$api = new NtokloApi( 'nToklo API key', 'nToklo API secret' );

   	$uv = array(
			"version" 	=> "1.2", // If this doesn't exist, the connector will assume lastest
            "product" 	=> array(
              	"id" 				=> "10201",
                "name" 				=> "Gabardine A-line skirt",
                "category" 			=> "Womens > Skirts",
                "currency" 			=> "GBP",
                "unit_sale_price"	=> 98

            )
          );

   	$response = $api->postProduct($uv);

   	echo $response;  //return true if post is successful


Events
------

An event in the nToklo recommendation system means some kind of action that has
performed by the user.

Example:

.. code-block:: php
	:linenos:

	require "vendor/autoload.php";
   	$api = new NtokloApi( 'nToklo API key', 'nToklo API secret' );

   	$uv = array('
			"version" 	=> "1.2", // If this doesn't exist, the connector will assume lastest
			"user_id" 	=> "112",
            "product" 	=> array(
              	"id" 				=> "10201",
                "name" 				=> "Gabardine A-line skirt",
                "category" 			=> "Womens > Skirts",
                "currency" 			=> "GBP",
                "unit_sale_price"	=> 98
            ),
            "events" 	=> array(
            	(object)[
            	"category" => "conversion_funnel", "action" => "browse"
            	]
            )
          );

 	$response = $api->postEvent($uv);

 	echo $response; // Return true if post is successful


Recommendations
---------------

This is the core of the system, the recommendations. This function will return
to you a JSON objects with the reommended products for your user and a temporary token.

Example:

.. code-block:: php
	:linenos:

	require "vendor/autoload.php";
   	$api = new NtokloApi( 'nToklo API key', 'nToklo API secret' );

   	$recommendation = $api->recommendations($userID = null, $productId = '10201', $scope = null, $value = null);

   	print_r( $recommendation );

It should return something like this:

.. code-block:: php
	:linenos:

	{
  		"tracker_id": "2b169680-aa86-12e5-9c37-600308a4f234",
 		"items": [
    		{
      			"id": "10242",
      			"name": "Campbell capri in wave print",
      			"currency": "GBP",
      			"unit_sale_price": 98
    		},
    		{
      			"id": "22832",
      			"name": "Andie chino",
      			"currency": "GBP",
      			"unit_sale_price": 79.5
    		},
    		{
      			"id": "12955",
      			"name": "Collection cropped trouser in antique floral",
      			"currency": "GBP",
      			"unit_sale_price": 298
    		}
  		]
	}


Blacklist
---------

The blacklist functionality allows you to add products to a blacklist so they
don't show up on the recommendations.

Example:

.. code-block:: php
	:linenos:

	require "vendor/autoload.php";
   	$api = new NtokloApi( 'nToklo API key', 'nToklo API secret' );

   	// Add one product tot he blacklist.
   	$api->addBlacklist( '12' );

   	// Remove a product from the blacklist.
   	$api->removeBlacklist( '12' );

   	//List all the currently blacklisted products
   	$api->fetchBlacklist();


Charts
------

Charts allows you to pull information regarding your analytics. It's not a
full report, for that you will have to use the `nToklo Console <http://console.ntoklo.com>`_.
Charts contains a number of options that will be useful to you for filtering the
information. Please refer to the :doc:`reference`.

Example:

.. code-block:: php
	:linenos:

	require "vendor/autoload.php";
   	$api = new NtokloApi( 'nToklo API key', 'nToklo API secret' );

   	$chart = $api->chart( $timestamp = '1364169600000', $scope = null, $value = null, $action = null , $tw = nulll , $maxItems = null );


   	print_r( $chart );

It should return something like this:

.. code-block:: php
	:linenos:

	{
	  "tracker_id": "d91a6a80-a181-12e5-9c37-600308a4f234",
	  "items": [
	    {
	      "currentPosition": 1,
	      "previousPosition": 2,
	      "peakPosition": 1,
	      "score": 58,
	      "timesOnChart": 6,
	      "product": { ... }
	    },
	    {
	      "currentPosition": 2,
	      "previousPosition": 1,
	      "peakPosition": 1,
	      "score": 45,
	      "timesOnChart": 12,
	      "product": { ... }
	    },
	   {
	      "currentPosition": 3,
	      "previousPosition": 0,
	      "peakPosition": 3,
	      "score": 39,
	      "timesOnChart": 1,
	      "product": { ... }
	    }
	  ]
	}