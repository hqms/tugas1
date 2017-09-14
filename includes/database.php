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

<<<<<<< HEAD
	// print ($sql);
	return $dbh->query($sql);
=======
	$args = func_get_args();
	$sql = $args[0];
		
	if(count($args)>1){
		array_shift($args);	
		$params = $args;
	}else{
		$params = [];
	}	
	
	$stmt = $dbh->prepare($sql);
	$stmt->execute($params);

	error_log($stmt->queryString.' '. json_encode($params));

	return $stmt;

>>>>>>> 58aaa83... add error logger
}