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
      if ($key == 'image'){
        if($_FILES['image']){
          $filepath = './images/'.$_FILES['image']['name'];
          $imageFileType = pathinfo($filepath, PATHINFO_EXTENSION);
          if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" ||  $imageFileType == "gif" ) {
            if(move_uploaded_file($_FILES['image']['tmp_name'],$filepath)){
              $data[] = sprintf('%s=?', $key);
              $datum[] = $filepath;    
            }
          }
        }
        
      }else{
        $data[] = sprintf('%s=?', $key);
        $datum[] = $_REQUEST[$key];
      }     
    }

    call_user_func_array('query', array_merge([sprintf('UPDATE menus SET %s WHERE id=%s', implode(',', $data), (int)$_REQUEST['id'])],$datum));
  	header('Location: index.php?m=menus');

  break;
  case 'edit':
  	$categories = [];
  	foreach (query('SELECT * FROM categories') as $key => $value) {
  		$categories[$value['id']] = $value['category_name'];
  	}
    $header['id_cat'] = $categories;

    $q = query('SELECT * FROM menus WHERE id=?', (int)$_REQUEST['id']);
    $data = $q->fetch();

  	print '<div class="col-md-3"></div><div class="col-md-6">';
  	generateForm($header, 'index.php?m=menus&act=update', $_REQUEST['id'], $data);
  	print '</div>';

  break;
  case 'save':
  	$header['id_cat'] = 'id_cat';
  	foreach ($header as $key => $value) {
      if ($key == 'image'){
        if($_FILES['image']){
          $filepath = './images/'.$_FILES['image']['name'];
          $imageFileType = pathinfo($filepath, PATHINFO_EXTENSION);
          if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" ||  $imageFileType == "gif" ) {
            if(move_uploaded_file($_FILES['image']['tmp_name'],$filepath)){
              $data[] = sprintf('%s=?', $key);
              $datum[] = $filepath;    
            }
          }
        }
        
      }else{
        $data[] = sprintf('%s=?', $key);
        $datum[] = $_REQUEST[$key];
      }  		
  	}

  	call_user_func_array('query', array_merge(['INSERT INTO menus SET '.implode(',', $data)],$datum));
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
    query('DELETE FROM menus where id=?', (int)$_REQUEST['id']);
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