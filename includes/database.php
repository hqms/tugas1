<?php


$dsn = 'mysql:host=127.0.0.1;dbname=tugas1';
$username = 'root';
$password = 'mysql';
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 

$dbh = new PDO($dsn, $username, $password, $options);


function query($sql){
	global $dbh;

	//print ($sql);
	return $dbh->query($sql);
}