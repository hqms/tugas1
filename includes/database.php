<?php


$dsn = 'mysql:host=127.0.0.1;dbname=tugas1';

if(isset($_SESSION['group']) && $_SESSION['group'] == 'admin'){
	$username = 'admin';
	$password = 'adminpassword';
}else{
	$username = 'user';
	$password = 'userpassword';
}

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 

$dbh = new PDO($dsn, $username, $password, $options);


function query($sql){
	global $dbh;

	return $dbh->query($sql);
}