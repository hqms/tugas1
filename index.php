<?php 
session_start();

//include function library
include_once 'includes/functions.php';

//database library
include_once 'includes/database.php';
include_once 'includes/head.php';

//search for module
if(isset($_REQUEST['m'])){
	include_once 'modules/'.$_REQUEST['m'].'.php';
}else{
	
	include_once 'modules/home.php';
}


if($_REQUEST['init']){
	global $dbh;

	$dump = file_get_contents('./data.sql');
	$dbh->exec($dump);
}

include_once 'includes/foot.php';
