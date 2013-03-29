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
$config['server_name']	= 'localhost';

/*
|--------------------------------------------------------------------------
| Port for the connection
|--------------------------------------------------------------------------
|
| The port where the Bitcoin daemon is listening. Usually 8332.
|
*/
$config['server_port']	= 8332;

/*
|--------------------------------------------------------------------------
| Use SSL connection?
|--------------------------------------------------------------------------
|
| Wether to use SSL connection or not when connecting with the Bitcoin
| daemon.
|
*/
$config['server_is_ssl']	= FALSE;

/*
|--------------------------------------------------------------------------
| User for the server
|--------------------------------------------------------------------------
|
| The user to use in the connection with the Bitcoin daemon.
|
*/
$config['server_user']	= '4k3Zm2D15e';

/*
|--------------------------------------------------------------------------
| Password for the server
|--------------------------------------------------------------------------
|
| The password to use in the connection with the Bitcoin daemon.
|
*/
$config['server_pass']	= 'wx6f7N5asN';