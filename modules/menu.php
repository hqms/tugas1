<div class="container">
	<div class="row">
		<div class="col-md-3">
			<?php include_once 'includes/sidebar.php'?>
		</div>

		<div class="col-md-9">
		<?php foreach(query('SELECT * FROM menus where id_cat=?' , (int)$_REQUEST['id']) as $v) :?>
			<div class="jumbotron">
				<div class="row">
					<div class="col-md-6"> 
					  <h1 class="display-4"><?php echo $v['name'] ?></h1>
					  <p class="lead"><?php echo $v['description'] ?></p>
					  <hr class="my-4">
					  <p>Price : Rp. <?php echo  number_format($v['price'] ,0,",","."); ?></p>			  
					</div>
					<div class="col-md-6">
						<div class="imgLiquidFill imgLiquid" style="height: 200px;">
							<img  src="<?php echo $v['image'] ?>" />
							</div>
					</div>
				</div>
			</div>
			
		<?php endforeach ?>
		</div>
	</div>
</div>