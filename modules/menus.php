<?php 
	if(!isset($_SESSION['username'])){
		header('Location: index.php');
	}
?>

<div class="container">
<div class="row">
<?php
$header = ['name'=>'Name', 'description'=>'Description', 'price'=>'Price', 'image'=> 'Image URL'];
$act = null;
if(isset($_REQUEST['act'])){
	$act = $_REQUEST['act'];
}

switch($act) { 
  case 'update':

  	$header['id_cat'] = 'id_cat';
  	foreach ($header as $key => $value) {
  		$data[] = sprintf('%s="%s"', $key, $_REQUEST[$key]);
  	}
  	query(sprintf('UPDATE menus SET %s WHERE id=%s', implode(',', $data), $_REQUEST['id']));
  	header('Location: index.php?m=menus');

  break;
  case 'edit':
  	$categories = [];
  	foreach (query('SELECT * FROM categories') as $key => $value) {
  		$categories[$value['id']] = $value['category_name'];
  	}
	$header['id_cat'] = $categories;

	$q = query('SELECT * FROM menus WHERE id='.$_REQUEST['id']);
	$data = $q->fetch();

  	print '<div class="col-md-3"></div><div class="col-md-6">';
  	generateForm($header, 'index.php?m=menus&act=update', $_REQUEST['id'], $data);
  	print '</div>';

  break;
  case 'save':
  	$header['id_cat'] = 'id_cat';
  	foreach ($header as $key => $value) {
  		$data[] = sprintf('%s="%s"', $key, $_REQUEST[$key]);
  	}
  	query('INSERT INTO menus SET '.implode(',', $data));
  	header('Location: index.php?m=menus');
  break;
  case 'new': 
  	$categories = [];
  	foreach (query('SELECT * FROM categories') as $key => $value) {
  		$categories[$value['id']] = $value['category_name'];
  	}

  	$header['id_cat'] = $categories;

  	print '<div class="col-md-3"></div><div class="col-md-6">';
  	generateForm($header, 'index.php?m=menus&act=save');
  	print '</div>';

  break; 

  case 'delete':
  	query('DELETE FROM menus where id='.$_REQUEST['id']);
	header('Location: index.php?m=menus' );
  break;
  default: 
  	array_pop($header);
  	generateTable(
  					$header,
  					query('SELECT * FROM menus') ,
  					'index.php?m=menus'
  					);

  	print('<a href="index.php?m=menus&act=new">Add new</a>');
 }

 ?>
 </div>
 </div>