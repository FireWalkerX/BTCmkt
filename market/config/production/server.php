<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Name of the server
|--------------------------------------------------------------------------
|
| The name of the server where the Bitcoin daemon is listening, it can be
| 'localhost' or any other server name.
|
| Avoid trailing slashes or 'http(s)://' part of the URI. It cannot contain
| the port number.
|
*/
$config['server_name']	= ''; //TODO

/*
|--------------------------------------------------------------------------
| Port for the connection
|--------------------------------------------------------------------------
|
| The port where the Bitcoin daemon is listening. Usually 8332.
|
*/
$config['server_port']	= 8332; //TODO

/*
|--------------------------------------------------------------------------
| Use SSL connection?
|--------------------------------------------------------------------------
|
| Wether to use SSL connection or not when connecting with the Bitcoin
| daemon.
|
*/
$config['server_is_ssl']	= FALSE; //TODO

/*
|--------------------------------------------------------------------------
| User for the server
|--------------------------------------------------------------------------
|
| The user to use in the connection with the Bitcoin daemon.
|
*/
$config['server_user']	= ''; //TODO

/*
|--------------------------------------------------------------------------
| Password for the server
|--------------------------------------------------------------------------
|
| The password to use in the connection with the Bitcoin daemon.
|
*/
$config['server_pass']	= ''; //TODO


/* End of file server.php */
/* Location: ./market/config/production/server.php */