<?php 
	$msg = '';
	if(isset($_REQUEST['username'])){
		
		$result = query('SELECT * FROM user WHERE username=?', $_REQUEST['username']);
		$user = $result->fetch();
		
		if ($user){
			if($_REQUEST['password'] == $user['password']){
				$_SESSION['username'] = $user['password'];
				$_SESSION['group'] = $user['group'];

				header('Location: index.php');
			}
		}else{
			$msg = 'User not registered';
		}

	}
?>
<div class="container">
	<div class="row">
		<div class="col-md-3">
		</div>
		<form class="col-md-6" method="POST" action="index.php?m=login"> 
		<div class="msg"><?php echo $msg ?></div>
		  <div class="form-group">
		    <label for="username">Username</label>
		    <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="Enter email" >
		    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
		  </div>
		  <div class="form-group">
		    <label for="password">Password</label>
		    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
		  </div>
		  
		  <button type="submit" class="btn btn-primary">Login</button>
		</form>
	</div>
</div>