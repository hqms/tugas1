<?php 
	if(!isset($_SESSION['username'])){
		header('Location: index.php');
	}
?>

<div class="container">
<div class="row">
<?php
$header = ['username'=>'Name', 'password'=>'Password', 'group'=> ['admin'=>'Administrator', 'user'=>'User']];
$act = null;
if(isset($_REQUEST['act'])){
	$act = $_REQUEST['act'];
}

switch($act) { 
  case 'update':

  	foreach ($header as $key => $value) {
  		$data[] = sprintf('`%s`="%s"', $key, $_REQUEST[$key]);
  	}
  	query(sprintf('UPDATE user SET %s WHERE id=%s', implode(',', $data), (int)$_REQUEST['id']));
  	header('Location: index.php?m=user');

  break;
  case 'edit':
  	
	$q = query('SELECT * FROM user WHERE id='.(int)$_REQUEST['id']);
	$data = $q->fetch();

  	print '<div class="col-md-3"></div><div class="col-md-6">';
  	generateForm($header, 'index.php?m=user&act=update', $_REQUEST['id'], $data);
  	print '</div>';

  break;
  case 'save':  
  	foreach ($header as $key => $value) {
  		$data[] = sprintf('`%s`="%s"', $key, $_REQUEST[$key]);
  	}
  	
  	query('INSERT INTO user SET '.implode(',', $data));
  	header('Location: index.php?m=user');
  break;
  case 'new': 
  	
  	print '<div class="col-md-3"></div><div class="col-md-6">';
  	generateForm($header, 'index.php?m=user&act=save');
  	print '</div>';

  break; 

  case 'delete':
  	query('DELETE FROM user where id='.(int)$_REQUEST['id']);
	header('Location: index.php?m=user' );
  break;
  default: 
  	array_pop($header);
  	generateTable(
  					$header,
  					query('SELECT * FROM user') ,
  					'index.php?m=user'
  					);

  	print('<a href="index.php?m=user&act=new">Add new</a>');
 }

 ?>
 </div>
 </div>