<?php
# Copyright 2015 nToklo Ltd.
#
# Licensed under the Apache License, Version 2.0 (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at
#
#     http://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.

namespace App\Libraries;
require 'Curl.php';

use App\Libraries\Curl;

class NtokloApiBase extends Curl{

    public $key;
    public $secret;
    public $endpoint = "https://api.ntoklo.com";


    public function __construct($key, $secret){
        parent::__construct();
        $this->key = $key;
        $this->secret = $secret;

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
    public function api_request($method , $uri, $data = null){
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

    public function getResponse(){
        return $this->response;
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
}