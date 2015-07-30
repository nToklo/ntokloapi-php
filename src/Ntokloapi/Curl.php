<?php
namespace Ntokloapi\classes;

class Curl{

	private $_cookies = array();
    private $_headers = array();

    public $curl;

    public $error = FALSE;
    public $error_code = 0;
    public $error_message = NULL;

    public $curl_error = FALSE;
    public $curl_error_code = 0;
    public $curl_error_message = NULL;

    public $http_error = FALSE;
    public $http_status_code = 0;
    public $http_error_message = NULL;

    public $request_headers = NULL;
    public $response_headers = NULL;
    public $response = NULL;

	const USER_AGENT = '';
	public function __construct(){
		if(!extension_loaded('curl')){
			throw new ErrorException('cURL library is not loaded');
		}

		$this->curl = curl_init();
		$this->setUserAgent(self::USER_AGENT);
		$this->setopt(CURLINFO_HEADER_OUT, TRUE);
		$this->setopt(CURLOPT_HEADER, TRUE);
        $this->setopt(CURLOPT_RETURNTRANSFER, TRUE);
	}

	function get($url){
		//echo $url . '?' . http_build_query($data);
		$this->setOpt(CURLOPT_URL, $url);
		$this->setOpt(CURLOPT_HTTPGET, TRUE);
		return $this->_exec();
	}

	function post($url, $data = array() ){
		$this->setOpt(CURLOPT_URL, $url);
		$this->setOpt(CURLOPT_POST, TRUE);
		$this->setOpt(CURLOPT_POSTFIELDS, $this->_postfields($data));
		return $this->_exec();
	}

	function put($url, $data = array() ){
		$this->setOpt(CURLOPT_URL, $url . '?' . http_build_query($data));
		$this->setOpt(CURLOPT_CUSTOMREQUEST, 'PUT');
		$this->_exec();
	}


	function delete($url){
		$this->setOpt(CURLOPT_URL, $url);
		$this->setOpt(CURLOPT_CUSTOMREQUEST, 'DELETE');
        $this->_exec();
	}

	function setBasicAuthentication($username, $password){
		$this->setOpt(CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		$this->setOpt(CURLOPT_USERPWD, $username . ':' . $password);
	}

	function setHeader($header){

		$this->setOpt(CURLOPT_HTTPHEADER, array_values($header));
	}

	function setUserAgent($user_agent){
		$this->setOpt(CURLOPT_USERAGENT, $user_agent);
	}


	function setOpt($option, $value){
		return curl_setopt($this->curl, $option, $value);
	}

	function verbose($on = TRUE){
		$this->setOpt(CURLOPT_VERBOSE, $on);
	}

	function close(){
		curl_close($this->curl);
	}

	function _postfields($data){
		if(is_array($data)){
			$data = json_encode($data);
		}
		return $data;
	}

	function _exec(){
		$this->response = curl_exec($this->curl);

		$this->curl_error_code = curl_errno($this->curl);
		$this->curl_error_message = curl_error($this->curl);

		$this->curl_error = !($this->curl_error_code === 0);
		$this->http_status_code = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

		$this->http_error = in_array(floor($this->http_status_code / 100), array(4,5));

		$this->error = $this->curl_error || $this->http_error;
		$this->error_code = $this->error ? ($this->curl_error ? $this->curl_error_code : $this->http_status_code) : 0;

		$this->request_headers = preg_split('/\r\n/', curl_getinfo($this->curl, CURLINFO_HEADER_OUT), NULL, PREG_SPLIT_NO_EMPTY);
		$this->response_header = '';

		if(!(strpos($this->response, "\r\n\r\n") === FALSE)){
			list($response_header, $this->response ) = explode("\r\n\r\n", $this->response, 2);
			if($response_header === 'HTTP/1.1.100 Continue'){
				list($response_header, $this->response) = explode("\r\n\r\n", $this->response, 2);
			}
			$this->response_headers = preg_split('/\r\n/', $response_header, NULL, PREG_SPLIT_NO_EMPTY);
		}
		$this->http_error_message = $this->error ? (isset($this->response_headers['0']) ? $this->response_headers['0'] : '') : '';
        $this->error_message = $this->curl_error ? $this->curl_error_message : $this->http_error_message;

        return $this->error_code;

	}

	function __destruct(){
		$this->close();
	}

}
?>