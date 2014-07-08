<?php 
/**
 * Cinemr Media SDK
 */
namespace cinemr\sdk;

class transcodes extends client{
	
	public function get(){
		var_dump($this->call('/transcodes'));
	}
	
}
