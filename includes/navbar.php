<div class="container">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="index.php">
		<span class="oi oi-lock-locked" title="icon name" aria-hidden="true"></span> VSecureApp
		</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	  <?php if(isset($_SESSION['username'])):?>
	      <li class="nav-item">
	        <a class="nav-link" href="index.php?m=menus">Menu</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="index.php?m=user">User</a>
	      </li>	      
	      <li class="nav-item active">
	        <a class="nav-link" href="index.php?m=logout">Logout </a>
	      </li>
	  <?php else: ?>
	      <li class="nav-item active">
	        <a class="nav-link" href="index.php?m=login">Login </a>
	      </li>
      <?php endif ?>
	    </ul>
	    <form class="form-inline my-2 my-lg-0" action="index.php?m=search" method="POST">
	      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="keyword">
	      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	    </form>
	  </div>
	</nav>
</div>
