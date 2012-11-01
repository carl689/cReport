<?php
/**
 * Include this file to enable cReport
 * @link github link here
 * @author Carl <carl689@gmail.com>
 */

function cReportAutoload($className) {	
	if(strncmp($className, 'cReport', 7) != 0)return; //Not looking for me
	$file = dirname(__FILE__).'/classes/'.$className.'.php';
	if(file_exists($file)){
		include_once($file);
	}
}
spl_autoload_register('cReportAutoload');
?>