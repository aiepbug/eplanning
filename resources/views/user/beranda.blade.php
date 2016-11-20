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
		<title>Laman User</title>
     </head>
     <body>
		<div class="header">
			<div class="navbar-fixed">
			<nav>
			  <div class="nav-wrapper light-blue darken-4">
				<a href="#" data-activates="menu_mobile" class="button-collapse"><i class="material-icons">menu</i></a>
				<ul id="menu_default" class="hide-on-med-and-down">
					<li id="data"><a href="javascript:void(0)" class="dropdown-button" data-activates="dropdown-tahun"><i class="material-icons left">list</i> Data</a></li>
					<li id="cetak"><a href="javascript:void(0)" onclick="menu_cetak('tahun1')"><i class="large material-icons left">print</i> Cetak</a></li>
				</ul>
				<ul class="right hide-on-med-and-down">
<!--
					<li><a onclick="ubahtahun()">Tahun anggaran {{ session()->get('tahun') }} </a></li>
-->
					<li><a onclick="ubahpw()">Ubah password</a></li>
					<li><a href="logout" class="orange darken-4">Logout</a></li>
				</ul>
				<ul class="side-nav" id="menu_mobile">
					<li id="biodata" {{ menu("biodata") }}><a href="javascript:void(0)" onclick="menu_biodata()">Menu 1</a></li>

					<li><a onclick="ubahpw()" class="orange accent-4">Ubah password</a></li>
					<li><a href="logout" class="orange darken-4">Logout</a></li>
			  </ul>
			  </div>
			</nav>
			</div>
		
		</div>
	<div id="konten">
		<h3><blockquote>Selamat datang, anda login sebagai :<br>{{ session()->get('nama') }}</blockquote></h3>
	</div>
	<ul id='dropdown-tahun' class='dropdown-content'>
		<li><a href="#!" onclick="input_data({{ (date('Y'))-1 }})">{{ (date('Y'))-1 }}</a></li>
		<li><a href="#!" onclick="input_data({{ (date('Y')) }})">{{ (date('Y')) }}</a></li>
		<li><a href="#!" onclick="input_data({{ (date('Y'))+1 }})">{{ (date('Y'))+1 }}</a></li>
  </ul>
        
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

function input_data(tahun)
{
	var token="{{ csrf_token() }}";
	$.ajax({
	url      : "input_data",
	data     : ({ _token:token,tahun:tahun}),
	type     : 'post',
	dataType : 'html',
	success  : function(respon){
			$('html, body').animate({ scrollTop: 0 }, 'slow');	
			$('#konten').html(respon);
			return false;
			},
	})
}
function menu_cetak(param)
{
	var token="{{ csrf_token() }}";
	$.ajax({
	url      : "menu_cetak",
	data     : ({ _token:token,param:param}),
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
	var token="{{ csrf_token() }}";
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

