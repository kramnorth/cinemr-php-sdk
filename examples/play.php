<?php
/**
 * This example demonstrates how to play a video from cinemr
 */
 
//include the autoloader (not required if using Composer with your project)
require_once(dirname(dirname(__FILE__)) . '/cinemr.php');

$client = new cinemr\sdk\client(
		array(
			'account_guid' => '332928421254402048',
			'secret' => 'Ux4wa95LWfvQZV3e5py6XJqN5fadpunyXRJu14odLeE=',
			'uri' => 'http://cinemr.minds.io'
		)
	);

$list = $client::factory('media')->get();
foreach($list as $guid => $data){
	var_dump( $downloadURL = $client::factory('media')->get("$guid/transcodes/source"));
	
	exit;
}
