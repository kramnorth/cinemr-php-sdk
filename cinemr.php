<?php 
/**
 * Cinemr PHP SDK
 * 
 * @copyright 2014 Kramnorth LIMITED
 * 
 * Licensed under the Apache License, Version 2.0 (the "License"): you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */
function cinemr_sdk_autoload($class){
    $file = dirname(__FILE__) . '/'. str_replace('\\', '/', $class) . '.php'; 
	if(file_exists($file)){
		require_once $file;
		return true;
	}
}
spl_autoload_register('cinemr_sdk_autoload');
