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


function query(){
	global $dbh;


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

}