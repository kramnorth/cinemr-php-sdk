<?php
/**
 * This example demonstrates how to connect using the cinemr API
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

//$items = $client::factory('media')->get();
//var_dump($items); 
//$item = $client::factory('media')->get('325999719098617856');
//var_dump($item);

/**
 * Upload our file to cinemr. You must provide a full path to the file. 
 */
$data = $client::factory('media')->put(NULL, dirname(__FILE__).'/sample_audio.wav');

//now add some metadata to this media file
/*$result = $client::factory('media')->post($data['guid'], array(
	'title' => 'My sound',
	'description' => 'this is my sound',
));*/


