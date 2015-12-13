<?php
class OAuthBase {
	/**
	  * oauth2.0配置入口
	  * @param unknown_type $type
	  * @return boolean|multitype:string unknown Ambigous <string> 
	  * @example
	  * <code>
	  * </code>
	  * @author fuzuchang <fuhaojunsf@gmail.com>
	  * @time 2015-3-20下午4:59:57
	 */
	protected function getOAuthConfig($type){
		global $basic_config;
		$config = array();
		$config['client_id'] 	 = $basic_config[strtolower($type).'_app_id'];
		$config['client_secret'] = $basic_config[strtolower($type).'_app_secret'];
		$config['redirect_uri']  = $basic_config['website_url'].'/control/oauth_redirect.php';
		if($config['client_id'] && $config['client_secret']){
			return $config;
		}
		exit(strtolower($type).'config is null');
	}
	/**
	 * GET 请求
	 * @param string $url
	 */
	protected function http_get($url){
		$oCurl = curl_init();
		if(stripos($url,"https://")!==FALSE){
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
		}
		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
		$sContent = curl_exec($oCurl);
		$aStatus = curl_getinfo($oCurl);
		curl_close($oCurl);
		return $sContent;
	}
	
	/**
	 * POST 请求
	 * @param string $url
	 * @param array $param
	 * @param boolean $post_file 是否文件上传
	 * @return string content
	 */
	protected function http_post($url,$param,$headers=array(),$post_file=false){
		$oCurl = curl_init();
		if(stripos($url,"https://")!==FALSE){
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
		}
		if (is_string($param) || $post_file) {
			$strPOST = $param;
		} else {
			$aPOST = array();
			foreach($param as $key=>$val){
				$aPOST[] = $key."=".urlencode($val);
			}
			$strPOST =  join("&", $aPOST);
		}
		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt( $oCurl,CURLOPT_HTTPHEADER, $headers );
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($oCurl, CURLOPT_POST,true);
		curl_setopt($oCurl, CURLOPT_POSTFIELDS,$strPOST);
		$sContent = curl_exec($oCurl);
		$aStatus = curl_getinfo($oCurl);
		curl_close($oCurl);
		return $sContent;
	}
	/**
	  * 拼接URL参数
	  * @param unknown_type $baseURL
	  * @param unknown_type $keysArr
	  * @return string
	  * @example
	  * <code>
	  * </code>
	  * @author fuzuchang <fuhaojunsf@gmail.com>
	  * @time 2015-3-20下午5:03:44
	 */
	function combineURL($baseURL,$keysArr){
		$combined = $baseURL."?";
		$valueArr = array();
	
		foreach($keysArr as $key => $val){
			$valueArr[] = "$key=$val";
		}
	
		$keyStr = implode("&",$valueArr);
		$combined .= ($keyStr);
	
		return $combined;
	}
	
}

?>