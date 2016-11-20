<style>
.lebar{width:300px}
</style>
<html>
    <head>
		<link type="text/css" rel="stylesheet" href="../src/css/materialize.min.css"  media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="../src/baru.css"  media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="../src/css/jquery-ui.css"  media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="../src/css/styles_jquery.css"  media="screen,projection"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Laman Admin</title>
     </head>
     <body>
		<div class="header">
			<div class="navbar-fixed">
			<nav>
			  <div class="nav-wrapper light-blue darken-4">
				<a href="#" data-activates="menu_mobile" class="button-collapse"><i class="material-icons">menu</i></a>
				<ul>
					<li>
						<a href="javascript:void(0)" class="hide-on-med-and-down dropdown-button" data-activates='dropdown1'>
							Pendaftar
						</a>
					</li>
					<li><a href="javascript:void(0)" onclick="list_pendaftar('tahapan')">Tahapan</a></li>
				</ul>
				<ul class="right hide-on-med-and-down">
					<li><a onclick="ubahpw()" class="orange accent-4">Ubah password</a></li>
					<li><a href="logout" class="orange darken-4">Logout</a></li>
				</ul>
				<ul class="side-nav" id="menu_mobile">
					<li><a href="javascript:void(0)">Pendaftar</a></li>
					<li><a href="javascript:void(0)">by Formasi</a></li>
					<li class="divider"></li>
					<li><a onclick="ubahpw()" class="orange accent-4">Ubah password</a></li>
					<li><a href="logout" class="orange darken-4">Logout</a></li>
			  </ul>
			  </div>
			</nav>
			</div>
		
		</div>
	<div id="konten"></div>
	<ul id='dropdown1' class='lebar dropdown-content'>
		<li><a href="javascript:void(0)" onclick="list_pendaftar('formasi')">by Formasi</a></li>
		<li><a href="javascript:void(0)" onclick="list_pendaftar('reg')">by Registrasi</a></li>
	</ul>
	</body>
</html>
<script type="text/javascript" src="../src/js/jquery-1.12.4.js"></script>
<script type="text/javascript" src="../src/js/jquery-ui.js"></script>
<script type="text/javascript" src="../src/js/materialize.min.js"></script>
<script>
	$(document).ready(function() {
	$(".button-collapse").sideNav({
		  menuWidth: 300, // Default is 240
		  closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
		});
});
function list_pendaftar(param)
{
	var token="<?php echo e(csrf_token()); ?>"
	$.ajax({
		url      : "list_pendaftar",
		data     : ({ _token:token,param:param}),
		type     : 'post',
		dataType : 'html',
		success  : function(respon){
				$('html, body').animate({ scrollTop: 0 }, 'slow');	
				$('#konten').html(respon);
				},
	})
}
function ubahpw()
{
	alert()
}
</script>
