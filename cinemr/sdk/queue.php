<?php 
/**
 * Cinemr Queue SDK
 */
namespace cinemr\sdk;

class queue extends client{
	
	/**
	 * Run the queue (this is usually done automatically via the system..)
	 */
	public function run(){
		return $request = $this->call("/queue/run");
	}
	
	public function getStats(){
		return $this->get(array('stats'));
	}
	
	public function get($args = NULL){
		if(!isset($args[0]))
			$args[0] = 'new';
	
		return $request = $this->call("/queue/".$args[0]);
	}
	
	public function post($guid = NULL, $data){
	}
	
	public function delete($guid = NULL){
	}
	
	
	public function put($guid = NULL, $filepath){
	}
	
}
