<?php
class QqOAuthClass extends OAuthBase {
	const OAUTH_AUTHORIZE_URL = "https://graph.qq.com/oauth2.0/authorize";//请求用户授权Token
	const OAUTH_ACCESS_TOKEN_URL = 'https://graph.qq.com/oauth2.0/token';//获取授权过的Access Token
	const OAUTH_API_URL = 'https://graph.qq.com/user/get_user_info';//授权信息查询接口
	const GET_OPENID_URL = "https://graph.qq.com/oauth2.0/me";
	private $client_id; // 申请应用时分配的AppKey。
	private $client_secret; // 申请应用时分配的AppSecret。
	private $redirect_uri; // 回调地址，需需与注册应用里的回调地址一致。
	private $grant_type; // 请求的类型，填写authorization_code
	private $access_token; // 用于调用access_token，接口获取授权后的access token。
	private $code; // 调用authorize获得的code值。
	private $scope ='get_user_info'; // 申请scope权限所需参数，可一次申请多个scope权限，用逗号分隔。
	private $state; // 用于保持请求和回调的状态，在回调时，会在Query
	private $openid;
	private $format ='json';

	function __construct($type) {
		$options = $this->getOAuthConfig($type);
		$this->client_id = isset ( $options ['client_id'] ) ? $options ['client_id'] : '';
		$this->client_secret = isset ( $options ['client_secret'] ) ? $options ['client_secret'] : '';
		$this->redirect_uri = isset ( $options ['redirect_uri'] ) ? $options ['redirect_uri'] : '';
	}
	/**
	 * 请求用户授权Token
	 * @return boolean
	 * @example
	 * <code>
	 * </code>
	 * @author fuzuchang <fuhaojunsf@gmail.com>
	 * @time 2015-3-18上午11:01:11
	 */
	public function requestAuthorize() {
		$keysArr = array(
			"response_type" => "code",
			"client_id" => $this->client_id,
			"redirect_uri" => $this->redirect_uri,
			"state" => 'qq',
			"scope" => $this->scope
		);
		header('Location:'.$this->combineURL(self::OAUTH_AUTHORIZE_URL, $keysArr));
	}
	/**
	 * 获取授权过的Access Token
	 * @return boolean|mixed
	 * @example
	 * <code>
	 * </code>
	 * @author fuzuchang <fuhaojunsf@gmail.com>
	 * @time 2015-3-18上午11:10:59
	 */
	public function getAccessToken($code) {
		$keysArr = array(
			"grant_type" => "authorization_code",
			"client_id" => $this->client_id,
			"redirect_uri" => urlencode($this->redirect_uri),
			"client_secret" => $this->client_secret,
			"code" => $code
		);
		$response = $this->http_get($this->combineURL(self::OAUTH_ACCESS_TOKEN_URL, $keysArr));
		if(strpos($response, "callback") !== false){
			$lpos = strpos($response, "(");
			$rpos = strrpos($response, ")");
			$response  = substr($response, $lpos + 1, $rpos - $lpos -1);
			$msg = json_decode($response);
			if(isset($msg->error)){
				var_dump($msg->error, $msg->error_description);die;
			}
		}
		$token = array();
		parse_str($response, $token);
		if ( is_array($token) && !isset($token['error']) ) {
			$this->access_token = $token['access_token'];
		} else {
			exit("get access token failed." . $token['error']);
		}
		return $token;
	}
	/**
	  * 获取用户信息
	  * @param unknown_type $openid
	  * @return mixed
	  * @example
	  * <code>
	  * </code>
	  * @author fuzuchang <fuhaojunsf@gmail.com>
	  * @time 2015-3-19上午10:14:56
	 */
	public function getAccountInfo($openid=''){
		if($openid){
			$this->openid = $openid;
		}
		$keysArr = array(
				"oauth_consumer_key" => $this->client_id,
				"access_token" => $this->access_token,
				"openid" => $this->openid,
				"format" => $this->format
		);
		$response = $this->http_get($this->combineURL(self::OAUTH_API_URL, $keysArr));
		$json = json_decode($response, true);
		if ( is_array($json) && !isset($json['error']) ) {
			return $json;
		} else {
			exit("get userinfo failed." . $json['error']);
		}
	}
	/**
	  * OAuth授权之后获取用户openid
	  * @param unknown_type $access_token
	  * @example
	  * <code>
	  * </code>
	  * @author fuzuchang <fuhaojunsf@gmail.com>
	  * @time 2015-3-19上午10:14:38
	 */
	public function getOpenid($access_token=''){
		if($access_token){
			$this->access_token = $access_token;
		}
		$keysArr = array(
			"access_token" => $this->access_token
		);
		$response = $this->http_get($this->combineURL(self::GET_OPENID_URL, $keysArr));
		if(strpos($response, "callback") !== false){
			$lpos = strpos($response, "(");
			$rpos = strrpos($response, ")");
			$response  = substr($response, $lpos + 1, $rpos - $lpos -1);
			$msg = json_decode($response);
			if(isset($msg->error)){
				var_dump($msg->error, $msg->error_description);die;
			}
			if($msg->openid){
				$this->openid = $msg->openid;
				return $msg->openid;
			}
		}
		exit("get openid failed." . $result['error']);
	}
}

?>