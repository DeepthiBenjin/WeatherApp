<?php

/**
 * Bootstrap file for setting the ABSPATH constant.
 * 
 * The first statement every script must call is require_once to this file.
 * It will have to use it's file relative path to this file. All other includes 
 * and requires will then use application root relative file pathing and 
 * prepend ABSPATH to that. Furthermore they should test first to see if 
 * ABSPATH is defined. If it is defined then the load script has been run and 
 * it does not have to be called. If not this is the first script to be 
 * accessed and it needs to call the load fnction. This essentially creates 
 * absolute path referencing to each file but it is done dynamically at run 
 * time. This allows the application to be deployed do different servers 
 * without having to update php.ini includes.
 * 
 * @author Deepthi
 * 
 */

// Define ABSPATH to the application root
define('ABSPATH', dirname(__FILE__) . '/');

// Turn off error reporting on deprecated features. Being caused by PEAR
// Net_URL and PEAR HTTP_Request
// Turn off error reporting on strict features. Being caused by PEAR Net_URL
error_reporting(0);

?>
