<?php

function __autoload($class){
    require_once($class . '.php');
}

class NtokloApi extends Curl{

    public $key;
    public $secret;
    public $endpoint = "https://api.ntoklo.com";

    public function __construct($key = null, $secret = null){
        parent::__construct();
        $this->key = $key;
        $this->secret = $secret;
    }

    public function postEvent($data){
         $resp = $this->api_request('POST', $uri = '/event', $data );
         if($resp == 0){
            return true;
         }else{
            return false;
         }
    }

    public function postProduct($data){
        $resp = $this->api_request('POST', $uri = '/products', $data );
        if($resp == 0){
            return true;
        }else{
            return false;
        }
    }

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
        return $this->response;
    }

    public function addBlacklist($productId = null){
        $param = array('productId' => $productId);
        $resp = $this->api_request('POST', $uri = '/product/blacklist?' . http_build_query($param));
        if($resp == 0){
            return true;
        }else{
            return false;
        }
    }

    public function removeBlacklist($productId = null){
        $param = array('productId' => $productId);
        $resp = $this->api_request('DELETE', $uri = '/product/blacklist?' . http_build_query($param));
        if($resp == 0){
            return true;
        }else{
            return false;
        }
    }

    public function fetchBlacklist(){
        $resp = $this->api_request('GET', $uri = '/products/blacklist');

        if($resp == 0 ){
            return $this->response;
        }else{
            return false;
        }
    }


    /**
     *
     */
    private function checkForNull($param){
        foreach($param as $key=>$value){
            if(is_null($value) || $value == '')
            unset($param[$key]);
        }
        return $param;
    }

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

        if($resp == 401){
            throw new Exception('Please check your key and secret');
        }

        return $resp;
    }

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