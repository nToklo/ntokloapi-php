<?php
namespace Ntokloapi;
require_once('Curl.php');


class NtokloApi extends Curl{

    public $key;
    public $secret;
    public $endpoint = "https://api.ntoklo.com";

    public function __construct($key = null, $secret = null){
        parent::__construct();
        $this->key = $key;
        $this->secret = $secret;
    }


    /**
     * This function will allow to post a decoded json object into the nToklo api
     * @uses array | decode json object
     * Example:
     * $data = array("version" => "1.2",
     *               "user" => array("user_id" => "112"),
     *               "product" => array("id"                => "10201",
     *                                  "name"              => "Gabardine A-line skirt",
     *                                  "category"          => "Womens > Skirts",
     *                                  "currency"          => "GBP",
     *                                  "unit_sale_price"   => 98),
     *               "events" => array((object)["category" => "conversion_funnel", "action" => "browse" ])
     *               );
     *
     * @return bool
     */
    public function postEvent($data){
         $resp = $this->api_request('POST', $uri = '/event', $data );
         if($resp == 0){
            return true;
         }else{
            return false;
         }
    }


    /**
     * This function will allow to post a decode json object into the nToklo api
     * @uses array | decode json object
     * Example:
     * $data = array("version" => "1.2",
     *               "product" => array("id"                => "10201",
     *                                  "name"              => "Gabardine A-line skirt",
     *                                  "category"          => "Womens > Skirts",
     *                                  "currency"          => "GBP",
     *                                  "unit_sale_price"   => 98
     *                                  )
     *                );
     * @return bool
     */
    public function postProduct($data){
        $resp = $this->api_request('POST', $uri = '/products', $data );
        if($resp == 0){
            return true;
        }else{
            return false;
        }
    }


    /**
     * This function will fetch the recommendations from nToklo api
     * @param string $userId optional. Uniquely identifies the user for which the recommendations are intended.
     *        The userId can be any value of string type. Examples: dan@gmail.com, 11245901, user_123
     * @param string $productId optional. The product for which to base recommendations from. The productId can be any string value. Example: 10201,prod8513
     * @param string $scope optional. A product attribute for which to scope recommendations.
     *        For example scope=category will consider the product category when returning recommendations. Supports: category, manufacturer, vendor, action.
     * @param string $value optional. The value for the recommendation scope.
     *        For example scope=category&value=shoes will consider the shoe category when returning recommendations.
     *        The value parameter can be any string value. Example: shoes, category12, nike, shoes.com
     *
     * @return Json
     */
    public function recommendations($userId = null, $productId = null, $scope = null, $value = null){

        $param = array('userId'     => $userId,
                       'productId'  => $productId,
                       'scope'      => $scope,
                       'value'      => $value);

        $param = $this->checkForNull($param);
        $resp = $this->api_request('GET', $uri = '/recommendation?' . http_build_query($param));

        if($resp == 0){
            return $this->response;
        }else{
            throw new Exception($resp . " There is problem while trying to fetch recommendations");
        }
    }

    /**
     * This function will fetch the charts from nToklo api
     * @param string $timestamp Optional. The date for which to retrieve a chart. The date should be an epoch timestamp in milliseconds, truncated to midnight Example: 1364169600000
     * @param string $scope Optional. A product attribute for which to scope recommendations.
     *        For example scope=category will consider the product category when returning recommendations. Supports: category, manufacturer, vendor, action.
     * @param string $value Optional. The value for the recommendation scope.
     *        For example scope=category&value=shoes will consider the shoe category when returning recommendations.
     *        The value parameter can be any string value. Example: shoes, category12, nike, shoes.com
     * @param string $action Optional Filters the requested chart by conversion_funnel actions. If it’s not specified then the chart returned is all actions, equivalent to action=all.
     * @param string $tw Optional. The time window for which the charts are requested. If not specified then the chart returns daily chart, equivalent to tw=DAILY. Supports: DAILY, WEEKLY.
     * @param srting $maxItems Optional. The max number of items in the charts. Default is 10. Valid range is 1-100.
     *
     * @return Json object
     */

    public function chart($timestamp = null, $scope = null, $value = null, $action = null, $tw = null, $maxItems = null){
        $param = array('date' => $timestamp,
                       'scope' => $scope,
                       'value' => $value,
                       'action' => $action,
                       'tw' => $tw,
                       'maxItems' => $maxItems
                       );

        $param = $this->checkForNull($param);
        $resp = $this->api_request('GET', $uri = '/chart?' . http_build_query($param));
        if($resp == 0){
            return $this->response;
        }else{
            throw new Exception($resp . " There is problem while trying to fetch charts");
        }
    }


    /**
     * This function will post an product id to nToklo api to blacklist
     * @param string $productId The unique identifier for the product which will added/removed from the blacklist.
     *        The productId can be any string value. In order to add/remove products in batches the productId can be specified multiple times.
     *
     * @return bool
     */
    public function addBlacklist($productId = null){
        $param = array('productId' => $productId);
        $resp = $this->api_request('POST', $uri = '/product/blacklist?' . http_build_query($param));
        if($resp == 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * This function will post an product id to nToklo api remove prodct from blacklist
     * @param string $productId The unique identifier for the product which will added/removed from the blacklist.
     *        The productId can be any string value. In order to add/remove products in batches the productId can be specified multiple times.
     *
     * @return bool
     */
    public function removeBlacklist($productId = null){
        $param = array('productId' => $productId);
        $resp = $this->api_request('DELETE', $uri = '/product/blacklist?' . http_build_query($param));
        if($resp == 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * This function will fetch all the blacklisted products
     * @param string $productId The unique identifier for the product which will added/removed from the blacklist.
     *        The productId can be any string value. In order to add/remove products in batches the productId can be specified multiple times.
     *
     * @return json object
     */
    public function fetchBlacklist(){
        $resp = $this->api_request('GET', $uri = '/products/blacklist');

        if($resp == 0 ){
            return $this->response;
        }else{
            return false;
        }
    }


    /**
     * This function will remove all the key from an array with a null value
     *
     * @return array
     */
    private function checkForNull($param){
        foreach($param as $key=>$value){
            if(is_null($value) || $value == '')
            unset($param[$key]);
        }
        return $param;
    }

    /**
     * This function will check for the http status code given back from the api
     * @param int $status status code return back from the api
     *
     * @return int
     */
    private function errorStatusCode($status){
        switch ($status) {
            case 400:
                throw new \Exception('400 Bad request');
                break;
            case 401:
                throw new \Exception('401 Unauthorized');
                break;
            case 403:
                throw new \Exception('403 Forbidden');
                break;
            case 404:
                throw new \Exception('404 Not Found');
                break;
            case 405:
                throw new \Exception('405 Method Not Allowed');
                break;
            case 500:
                throw new \Exception('500 Internal Server Error');
                break;
            default:
                return $status;
        }
    }


   /**
     * This class will take care of authentication and exceptions of the API, retuning the required codes to the functions that use it.
     *
     * @param string $method http method POST GET DELETE
     * @param string $uri
     * @param array $data post the json object to the nToklo api
     *
     * @return int status code
     */
    protected function api_request($method , $uri, $data = null){
        $url = $this->endpoint . $uri;
        $set_header= 'Authorization: NTOKLO ' . $this->key;
        $h = $set_header . ':' . $this->signature($method, $uri);

        $setContent = 'Content-Type:application/json';
        parent::setHeader(array($h, $setContent));

        if($method == 'POST'){
            $resp = parent::post($url, json_encode($data));
        }elseif($method == 'GET'){
            $resp = parent::get($url);
        }else{
            $resp = parent::delete($url);
        }

        $status = $this->errorStatusCode($resp);
        return $status;
    }

    /**
     * Get the required signature to sign the request.
     * Please check http://docs.ntoklo.com/start.php/authentication for more information.
     *
     * @param string $http_method http method POST, GET, DELETE
     * @param string $uri
     *
     * @return string containing a signed token
     */
    protected function signature($http_method, $uri){
        if(!empty($this->key) && !empty($this->secret)){
            $hmac_key   = $this->key .  "&" . $this->secret;
            $http_str    = $http_method . '&' . $this->endpoint . $uri;
            $signature  = hash_hmac('sha1', $http_str, $hmac_key);
            return $signature;
        }else{
            throw new Exception('You need to provide your key and secret');
        }
    }
}
?>