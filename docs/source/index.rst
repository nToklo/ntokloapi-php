.. ntokloapi-php documentation master file, created by
   sphinx-quickstart on Wed Sep 23 13:36:30 2015.
   You can adapt this file completely to your liking, but it should at least
   contain the root `toctree` directive.

ntokloapi-php's documentation!
=========================================

ntokloapi-php is an API connector to use the `nToklo recommendation engine <http://www.ntoklo.com/>`_ for your e-commerce site.

Requirements
------------

* PHP 5.3.3 is required but using the latest version of PHP is highly recommended

Features
--------

* Events
* Products
* Blacklists
* Recommendations
* Charts


How do I use it?
----------------

To be able to use the nToklo recommendation engine, you need to create an application in the nToklo console
so you can get an API key and API secret.

To get your API key and API secret you must follow th steps below:

Step 1 
------
`Register with nToklo <https://console.ntoklo.com/register/>`

Step 2
------
Create an application on the `nToklo console <https://console.ntoklo.com/>`. An application represent your store on nToklo platform.

Step 3
------
Get your nToklo API key and secret and put into the function.
::

	$api = new NtokloApi($key = '1112233asdZmUtZmQ4Yy00MjQ4LThjODAtNzBjMjJlODRjYjVh', $secret = 'OTNmMjlhZmUtZmQ4Yy00MjQ4LThjODAtNzBjMjJlOdadasdsa');



Contents:

.. toctree::
   :maxdepth: 2



Indices and tables
==================

* :ref:`genindex`
* :ref:`modindex`
* :ref:`search`

