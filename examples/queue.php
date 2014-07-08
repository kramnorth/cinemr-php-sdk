<?php
/**
 * This example demonstrates how to communicate with the queue api
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

$stats = $client::factory('queue')->getStats();
$runner = $client::factory('queue')->run();
var_dump($stats, $runner); 

