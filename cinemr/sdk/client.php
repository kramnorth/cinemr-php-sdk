<?php 
/**
 * Cinemr SDK client
 */
namespace cinemr\sdk;

class client{
	
	static private $account_guid;
	static private $secret;
	static private $uri;
	
	/**
	 * Initialises the cinemr api connection
	 * 
	 * @param array $params - expects 'account_guid' and 'secret'
	 */
	public function __construct(array $params = array()){
		if(!self::$account_guid)
			self::$account_guid = $params['account_guid'];
		if(!self::$secret)
			self::$secret = $params['secret'];
		if(!self::$uri)
			self::$uri = $params['uri'];
	}
	
	public function call($endpoint, $method = 'GET', $data = array()){

		$data['account_guid'] = self::$account_guid;
		
		//we must construct our signature
		$signature = $this->createSignature($method, self::$secret, $endpoint, $data);
		//$data['signature'] = $signature;

		$ch = curl_init();
		//$data = http_build_query($data);
		switch (strtolower($method)) {
		    case 'post':
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				break;
		    case 'delete':
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE'); // Override request type
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				break;
		    case 'put':
				
				$fp = fopen($data['filepath'], "r");
				//important
				curl_setopt($ch, CURLOPT_PUT, 1); 
				//curl_setopt($ch, CURLOPT_HEADER, false); 
				curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
				curl_setopt($ch, CURLOPT_INFILE, $fp);	
				curl_setopt($ch, CURLOPT_INFILESIZE, filesize($data['filepath']));	
				
				if (strpos($endpoint, '?') !== false) {
				    $endpoint .= '&' . http_build_query($data);
				} else {
				    $endpoint .= '?' . http_build_query($data);
				}		
				break;
		    case 'get':
		    default:
				curl_setopt($ch, CURLOPT_HTTPGET, true);
				if (strpos($endpoint, '?') !== false) {
				    $endpoint .= '&' . http_build_query($data);
				} else {
				    $endpoint .= '?' . http_build_query($data);
				}
				break;
		}
		echo "sent signature: $signature";
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('AUTH-SIGNATURE: ' . $signature));
		
		curl_setopt($ch, CURLOPT_URL, self::$uri.$endpoint);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 360);
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		//curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, "cinemr-php-sdk v.0.1");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		
		$result = curl_exec($ch);
		$errors = curl_error($ch);
	
		error_log('CINEMR-SDK-ERROR:'.$errors);
		
		return json_decode($result, true);
	}

	private function createSignature($method, $secret, $endpoint, $data, $body = ""){
		$string = $secret . $method . $endpoint; 
		$keys = $this->sortKeys($data); 
		foreach ($keys as $key) {
			 $string .= $key . "=" . $data[$key]; 
		} 
		$string .= $body; 
		
		$hash = hash("sha256", $string,true); 
		$signature = base64_encode($hash); 
		$signature = substr($signature,0,43); 
		$signature = urlencode($signature); 
		
		return $signature; 
	}
	
	private function sortKeys($params){
		$keys = array();
		$i=0; 
		foreach ($params as $key => $val) {
			$keys[$i++] = $key; 
		} 
		sort($keys); 
		
		return $keys;
	}
	
	public static function factory($service){
		$service = __NAMESPACE__ . "\\$service";
		if (class_exists($service)) {
            return new $service();
        }
	}
	
}
