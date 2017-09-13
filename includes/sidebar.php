<nav class="nav flex-column">
	<?php foreach (listOfCategories() as $key => $value) :?>
  		<a class="nav-link" href="index.php?m=menu&a=cat_id&id=<?php echo $value['id'] ?>"><?php echo $value['category_name'] ?></a>			  
  	<?php endforeach ?>
</nav>