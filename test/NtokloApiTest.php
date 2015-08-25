<?php
class NtokloApiTest extends PHPUnit_Framework_TestCase {

    public function setup(){
        $this->api = new NtokloApi('OTNmMjlhZmUtZmQ4Yy00MjQ4LThjODAtNzBjMjJlODRjYjVh', 'YzM0OTlhNDAtZGMxZS00Yzg4LWEyZjAtOWVlMmM5NGIyZjM3');

    }

    public static function jsonData(){
        return array(
                "version"   => "1.2",
                "user"      => array("user_id" => "112"),
                "product"   => array(
                                "id"              => "10201",
                                "name"            => "Gabardine A-line skirt",
                                "category"        => "Womens > Skirts",
                                "currency"        => "GBP",
                                "unit_sale_price" => 98),
                "events"    => array((object)["category" => "conversion_funnel", "action" => "browse" ])
                );
    }


    public function testPostEvent()
    {
        $this->assertEquals(true, $this->api->postEvent($this->jsonData()));
    }

    public function testPostProduct(){
        $data_product = array("version" => "1.2",
                              "product" => array(
                                            "id"              => "886",
                                            "name"            => "KOTORI BAG",
                                            "category"        => "all",
                                            "currency"        => "GBP",
                                            "unit_sale_price" => 30)
                            );
      $this->assertEquals(true, $this->api->postProduct($data_product));
    }

    public function testGetProduct(){
        $response = $this->api->getProduct('192');
        $this->assertNotNull($response);
    }

    public function testRecommendations(){
        $response = $this->api->recommendations($userId = null, $productId = '184', $scope = null, $value = null);
        print $response;
        $this->assertNotNull($response);
    }

    public function testCharts(){
        $response = $this->api->chart($timestamp = null, $scope = null, $value = null, $action = null, $tw = 'DAILY', $maxItems = null);
        print $response;
        $this->assertNotNull($response);
    }

    public function testAddBlacklist(){
        $response = $this->api->addBlacklist('199');
        $this->assertEquals(true, $response);
    }

    public function testRemoveBlacklist(){
        $response = $this->api->removeBlacklist('199');
        $this->assertEquals(true, $response);
    }

    public function testFetchBlacklist(){
        $response = $this->api->fetchBlacklist();
        $this->assertNotNull($response);
    }
}