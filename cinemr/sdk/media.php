<?php 
/**
 * Cinemr Media SDK
 */
namespace cinemr\sdk;

class media extends client{
	
	public function get($guid = NULL, $expires = NULL){
		$endpoint = '/media';
		if($guid)
			$endpoint .= '/'.$guid;
		
		$data = array();
		if($expires)
			$data['expire'] = $expires;

		return $request = $this->call($endpoint, 'GET', $data);
	}
	
	public function post($guid = NULL, $data){
		return $request = $this->call('/media/'.$guid, 'POST', $data);
	}
	
	public function delete($guid = NULL){
		
	}
	
	/**
	 * Upload a file using cinemr
	 */
	public function put($guid = NULL, $filepath){
		return $request = $this->call('/media/'.$guid, 'PUT', array('filepath'=>$filepath));
	}
	
}
