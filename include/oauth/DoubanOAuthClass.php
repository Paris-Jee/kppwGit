<?php
class DoubanOAuthClass extends OAuthBase {
	const OAUTH_AUTHORIZE_URL = 'https://www.douban.com/service/auth2/auth';//请求用户授权Token 
	const OAUTH_ACCESS_TOKEN_URL = 'https://www.douban.com/service/auth2/token';//获取授权过的Access Token 
	const OAUTH_API_URL = 'https://api.douban.com';//授权信息查询接口 
	private $client_id; // 申请应用时分配的AppKey。
	private $client_secret; // 申请应用时分配的AppSecret。
	private $redirect_uri; // 回调地址，需需与注册应用里的回调地址一致。
	private $grant_type; // 请求的类型，填写authorization_code
	private $access_token; // 用于调用access_token，接口获取授权后的access token。
	private $code; // 调用authorize获得的code值。
	private $scope; // 申请scope权限所需参数，可一次申请多个scope权限，用逗号分隔。
	private $state; // 用于保持请求和回调的状态，在回调时，会在Query
	                // Parameter中回传该参数。开发者可以用这个参数验证请求有效性，也可以记录用户请求授权页前的位置。这个参数可用于防止跨站请求伪造（CSRF）攻击
	                
	private $userId;//用户OAuth授权之后获取用户UID	
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
			'response_type' => 'code',
			'client_id' => $this->client_id,
			'redirect_uri' => $this->redirect_uri,
			'scope' => 'douban_basic_common,shuo_basic_r',
			'state' => 'douban'
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
			'grant_type' => 'authorization_code',
			'code' => $code,
			'client_id' => $this->client_id,
			'client_secret' => $this->client_secret,
			'redirect_uri' => $this->redirect_uri
		);
		$response = $this->http_post($this->combineURL(self::OAUTH_ACCESS_TOKEN_URL, $keysArr));
		$token = json_decode($response, true);
		if ( is_array($token) && isset($token['access_token']) && $token['access_token'] ) {
			$this->access_token = $token['access_token'];
			$this->userId = $token['douban_user_id'];
		} else {
			exit("get access token failed." . $token['error']);
		}
		return $token;
	}
	/**
	  * 获取用户信息
	  * @param unknown_type $userId
	  * @return boolean|mixed
	  * @example
	  * <code>
	  * </code>
	  * @author fuzuchang <fuhaojunsf@gmail.com>
	  * @time 2015-3-18下午1:19:29
	 */
	
	public function getAccountInfo($access_token=''){
		if($access_token){
			$this->access_token = $access_token;
		}
		$keysArr = array(
				"access_token" => $this->access_token
		);
// 		$headers[] = 'Authorization: Bearer ' . $this->access_token;
// 		$headers[] = 'User-Agent: Douban.PHP(piscdong.com)';
// 		$response = $this->http_post(self::OAUTH_API_URL.'/v2/user/'.$this->userId,null,$header);
		$response = $this->http_get(self::OAUTH_API_URL.'/v2/user/'.$this->userId);
		$json = json_decode($response, true);
		if ( is_array($json) && $json['id']) {
			return $json;
		} else {
			exit("get userId failed.非法的测试用户，无法调用接口。" . $json['error']['code']);
		}
		
	}

}

?>