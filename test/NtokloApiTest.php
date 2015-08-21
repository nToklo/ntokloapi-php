<?php
class NtokloApiTest extends PHPUnit_Framework_TestCase {

    public function testPostEvent()
    {

        $data = array('version' => '1.2',
              'user' => array('user_id' => '112'),
              'product' => array("id" => "10201",
                                 "name" => "Gabardine A-line skirt",
                                 "category" => "Womens > Skirts",
                                 "currency" => "GBP",
                                 "unit_sale_price"=> 98),
              'events' => array((object)['category' => 'conversion_funnel', 'action' => 'browse' ])
              );
        $api = new NtokloApi('OTNmMjlhZmUtZmQ4Yy00MjQ4LThjODAtNzBjMjJlODRjYjVh', 'YzM0OTlhNDAtZGMxZS00Yzg4LWEyZjAtOWVlMmM5NGIyZjM3');
        $this->assertEquals(true, $api->postEvent($data));

    }
}