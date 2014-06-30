<?php

error_reporting (E_ALL ^ E_NOTICE);
ini_set('display_errors','On');

$config['db']['host'] = 'localhost';
$config['db']['name'] = 'StudentsPlatform';
$config['db']['user'] = 'root';
$config['db']['password'] = '';

$db_connection = mysql_connect($config['db']['host'], $config['db']['user'], $config['db']['password']);
if (!$db_connection) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db($config['db']['name'], $db_connection);

