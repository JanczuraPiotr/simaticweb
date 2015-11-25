<?php
namespace Pjpl\lib\net;

class Curl {
	const CONNECTION_WAITING_TIMEOUT = 30;
	const CONNECTION_WORKING_TIMEOUT = 60;
	const FORMAT_OUT_PARAMS   = 1;
	const FORMAT_OUT_JSON     = 2;
	const REQUEST_METHOD_GET  = 3;
	const REQUEST_METHOD_POST = 4;
	const REQUEST_METHOD_PUT  = 5;
	/**
	 * @var array
	 */
	private $options = [
			CURLOPT_HTTPAUTH       => CURLAUTH_BASIC,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HTTPHEADER     => [
					'Accept: application/json',
					'Content-Type: application/json'
			]
	];
	/**
	 * @var bool
	 */
	private $optionsModified = true;
	/**
	 * @var string
	 */
	private $url;
	/**
	 * @var string
	 */
	private $action = '';
	/**
	 * @var string
	 */
  private $user;
	/**
	 * @var string
	 */
	private $password;
  /**
   * @var string
   */
  private $params;
  /**
   * @var curl
   */
  private $curl;
  /**
   * @var string
   */
  private $res = null;
	private $resArray = null;
  /**
   * @var boolean
   */
  private $exec;

  public function __construct($url, $user, $password){
    $this->url  = $url;
		$this->user = $user;
		$this->password = $password;

    $this->curl = curl_init();

		$this->setOptionUrl($this->url);
		$this->setOptionAuth($this->user.':'.$this->password);
//		$this->setOptionConnectionWaitingTimeout();
//		$this->setOptionConnectionWorkingTimeout();
	}
  public function __destruct() {
    curl_close($this->curl);
  }
	public function modifyOptions(){
		if( ! $this->optionsModified ){
			return ;
		}
		curl_setopt_array($this->curl, $this->options);
		$this->optionsModified = false;
	}
  protected function setOptionParams($params, $format = Curl::FORMAT_OUT_PARAMS){
    $this->exec = false;
		switch ($format){
			case static::FORMAT_OUT_PARAMS:
				$this->params = $params;
				break;
			case static::FORMAT_OUT_JSON:
				$this->params = json_encode($params/*, JSON_UNESCAPED_UNICODE*/ );
		}
		$this->options[CURLOPT_POSTFIELDS] = $this->params;
		$this->optionsModified = true;
  }
  public function exec($action = null , $params = null, $format = Curl::FORMAT_OUT_PARAMS, $method = Curl::REQUEST_METHOD_GET){
		$return = null;
    if( ! $this->exec ){
			if( $action !== NULL ){
				$this->action = $action;
				$this->setOptionUrl($this->url,$this->action);
			}
			if( $params !== null ){
				$this->setOptionParams($params,$format);
			}
			$this->setMethod($method);

			$this->modifyOptions();
      $this->res = trim(curl_exec($this->curl));
      if( curl_errno($this->curl) ){
        $this->exec = false;
      }else{
        $this->exec = true;
      }
			$return = ($this->exec ? $this->res : null);
    }
		return $return;
  }
	public function getError(){
		return curl_error($this->curl);
	}
	public function getRes(){
		$return = NULL;
    if(isset($this->exec)){
      $return = $this->res;
    }
		return $return;
  }

	public function setMethod($method){
		switch($method){
			case self::REQUEST_METHOD_GET:
				$this->setMethodGet();
				break;
			case self::REQUEST_METHOD_POST:
				$this->setMethodPost();
				break;
			case self::REQUEST_METHOD_PUT:
				$this->setMethodPut();
				break;
		}
	}

	public function setMethodPost(){
		unset($this->options[CURLOPT_PUT]);
		$this->options[CURLOPT_POST] = true;
		$this->optionsModified = TRUE;
	}
	public function setMethodPut(){
		unset($this->options[CURLOPT_POST]);
		$this->options[CURLOPT_PUT]  = true;
		$this->optionsModified = true;
	}
	public function setMethodGet(){
		unset($this->options[CURLOPT_PUT]);
		unset($this->options[CURLOPT_POST]);
		$this->optionsModified = true;
	}

	public function setOptionAuth($auth){
		$this->options[CURLOPT_USERPWD] = $auth;
		$this->optionsModified = TRUE;
	}
	public function setOptionUrl($url, $action = null){
		$this->url = $url;
		if($action !== null){
			$this->action = $action;
			$this->options[CURLOPT_URL] = $this->url.$this->action;
		}else{
			$this->action = NULL;
			$this->options[CURLOPT_URL] = $this->url;
		}
		$this->optionsModified = true;
	}
	public function setOptionConnectionWaitingTimeout($timeout = Curl::CONNECTION_WAITING_TIMEOUT){
		$this->options[CURLOPT_CONNECTTIMEOUT] = $timeout;
		$this->optionsModified = true;
	}
	public function setOptionConnectionWorkingTimeout($timeout = Curl::CONNECTION_WORKING_TIMEOUT){
		$this->options[CURLOPT_TIMEOUT] = $timeout;
		$this->optionsModified = true;
	}
	public function restart(){
    $this->exec = false;
    $this->res = null;
  }
	/**
	 * Zwraca tablicę gdy dane wejsciowe przyszły jako poprawny json
	 * @return array
	 */
	public function getArray(){
		if($this->res){
			if( ! $this->resArray){
				$this->resArray = json_decode($this->res);
			}
		}else{
			$this->resArray = null;
		}
		return $this->resArray;
	}

}