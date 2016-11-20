<!DOCTYPE html>
<html>
    <head>
<!--
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
-->
<?php
	function menu($x)
	{
		if(session()->get('menu')==$x)
		{
			echo "class='active'";
		}
	}
?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>User</title>
     </head>
     <body>
		<div class="header">
			<div class="navbar-fixed">
			<nav>
			  <div class="nav-wrapper light-blue darken-4">
				<ul>
					<li <?php echo e(menu("biodata")); ?>><a href="#">Biodata</a></li>
					<li <?php echo e(menu("keluarga")); ?>><a href="#tentang">Keluarga</a></li>
					<li <?php echo e(menu("akademik")); ?>><a href="#tentang">Akademik</a></li>
					<li <?php echo e(menu("formasi")); ?>><a href="#tentang">Formasi</a></li>
				</ul>
				<ul class="right hide-on-med-and-down">
					<li><a href="logout" class="orange darken-4 btn-large"><i class="material-icons left">lock</i> Logout</a></li>
				</ul>
			  </div>
			</nav>
			</div>
		
		</div>
			<?php echo $__env->yieldContent('konten'); ?>
<!--
		<div class="footer page-footer light-blue darken-2">Laman pendaftaran</div>
-->
     </body>
     <footer>
<!--
		<script type="text/javascript" src="../src/js/jquery.min.js"></script>
-->

     </footer>
</html>
