<?php
	function menu($x)
	{
		if(session()->get('menu')==$x)
		{
			echo "class='active'";
		}
	}
?>

<!DOCTYPE html>
<html>
    <head>
		<link type="text/css" rel="stylesheet" href="../src/css/materialize.min.css"  media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="../src/baru.css"  media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="../src/css/jquery-ui.css"  media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="../src/css/styles_jquery.css"  media="screen,projection"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Laman Pendaftar</title>
     </head>
     <body>
		<div class="header">
			<div class="navbar-fixed">
			<nav>
			  <div class="nav-wrapper light-blue darken-4">
				<a href="#" data-activates="menu_mobile" class="button-collapse"><i class="material-icons">menu</i></a>
				<ul id="menu_default" class="hide-on-med-and-down">
					<li id="biodata" <?php echo e(menu("biodata")); ?>><a href="javascript:void(0)" onclick="menu_biodata()">Biodata</a></li>
					<li id="keluarga" <?php echo e(menu("keluarga")); ?>><a href="javascript:void(0)">Keluarga</a></li>
					<li id="akademik" <?php echo e(menu("akademik")); ?>><a href="javascript:void(0)">Akademik</a></li>
					<li id="formasi" <?php echo e(menu("formasi")); ?>><a href="javascript:void(0)">Formasi</a></li>
					<?php if(session()->get('status')==1): ?>
						<li id="cetak" <?php echo e(menu("cetak")); ?> class="pink accent-4">
							<a href="javascript:void(0)" onclick="menu_cetak()">Cetak</a>
						</li>
					<?php endif; ?>
				</ul>
				<ul class="right hide-on-med-and-down">
					<li><a onclick="ubahpw()" class="orange accent-4">Ubah password</a></li>
					<li><a href="logout" class="orange darken-4">Logout</a></li>
				</ul>
				<ul class="side-nav" id="menu_mobile">
					<li id="biodata" <?php echo e(menu("biodata")); ?>><a href="javascript:void(0)" onclick="menu_biodata()">Biodata</a></li>
					<li id="keluarga" <?php echo e(menu("keluarga")); ?>><a href="javascript:void(0)">Keluarga</a></li>
					<li id="akademik" <?php echo e(menu("akademik")); ?>><a href="javascript:void(0)">Akademik</a></li>
					<li id="formasi" <?php echo e(menu("formasi")); ?>><a href="javascript:void(0)">Formasi</a></li>
					<?php if(session()->get('status')==1): ?>
						<li id="cetak" <?php echo e(menu("cetak")); ?> class="pink accent-4">
							<a href="javascript:void(0)" onclick="menu_cetak()">Cetak</a>
						</li>
					<?php endif; ?>
					<li><a onclick="ubahpw()" class="orange accent-4">Ubah password</a></li>
					<li><a href="logout" class="orange darken-4">Logout</a></li>
			  </ul>
			  </div>
			</nav>
			</div>
		
		</div>
	<div id="konten">
		
	</div>
</html>
<script type="text/javascript" src="../src/js/jquery-1.12.4.js"></script>
<script type="text/javascript" src="../src/js/jquery-ui.js"></script>
<script type="text/javascript" src="../src/js/materialize.min.js"></script>
<script>

$(document).ready(function() {
	if("<?php echo e(session()->get('menu')); ?>"=="")
	{
		var menu="biodata";
	}
	else
	{
		var menu="<?php echo e(session()->get('menu')); ?>";
	}
	var token="<?php echo e(csrf_token()); ?>";
	var mn="menu_";
	var m=mn.concat(menu);

		$.ajax({
			url      : m,
			data     : ({ _token:token}),
			type     : 'post',
			dataType : 'html',
			success  : function(respon){
					$('html, body').animate({ scrollTop: 0 }, 'slow');	
					$('#konten').html(respon);
					return false;
					},
		})
	
    $(".button-collapse").sideNav({
      menuWidth: 300, // Default is 240
      closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
    });
        
});
function menu_biodata()
{
	var token="<?php echo e(csrf_token()); ?>";
	$.ajax({
	url      : "menu_biodata",
	data     : ({ _token:token}),
	type     : 'post',
	dataType : 'html',
	success  : function(respon){
			$('html, body').animate({ scrollTop: 0 }, 'slow');	
			$('#konten').html(respon);
			return false;
			},
	})
}
function menu_cetak()
{
	var token="<?php echo e(csrf_token()); ?>";
	$.ajax({
	url      : "menu_cetak",
	data     : ({ _token:token}),
	type     : 'post',
	dataType : 'html',
	success  : function(respon){
			$('html, body').animate({ scrollTop: 0 }, 'slow');	
			$('#konten').html(respon);
			return false;
			},
	})
}
function ubahpw()
{
	var token="<?php echo e(csrf_token()); ?>";
	$.ajax({
	url      : "ubahpw",
	data     : ({ _token:token}),
	type     : 'post',
	dataType : 'html',
	success  : function(respon){
			$('html, body').animate({ scrollTop: 0 }, 'slow');	
			$('#konten').html(respon);
			return false;
			},
	})
}
</script>

