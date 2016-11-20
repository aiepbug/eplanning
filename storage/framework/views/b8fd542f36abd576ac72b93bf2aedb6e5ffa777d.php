  <!DOCTYPE html>
  <html>
    <head>
<!--
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
-->
      <link type="text/css" rel="stylesheet" href="src/css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="src/baru.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Rekrutmen @ IAINPalu</title>
    </head>

    <body>
	<div class="navbar-fixed">
		<nav>
		  <div class="nav-wrapper cyan darken-3">
			<a href="#" data-activates="menu_mobile" class="button-collapse"><i class="material-icons">menu</i></a>
			<ul class="hide-on-med-and-down">
				<li class="active"><a href="./beranda">Beranda</a></li>
				<li><a href="#tentang">Tentang</a></li>
			</ul>
			<ul id="status1" class="right hide-on-med-and-down">
				<?php if(session()->get('login')==1): ?>
					<li class="active garis"><a href="user/profil">Login sebagai <?php echo e(session()->get('username')); ?> kembali ke Profil</a></li>
				<?php else: ?>
					<li><a href="#register">Register</a></li>
					<li><a href="#form_login">Login</a></li>
				<?php endif; ?>
			</ul>
		  </div>
		</nav>
	</div>
	<ul class="side-nav" id="menu_mobile">
		<li><a href="#">Beranda</a></li>
		<li><a href="#tentang">Tentang</a></li>
		<?php if(session()->get('login')==1): ?>
			<li class="active garis"><a href="user/profil">Login sebagai <?php echo e(session()->get('username')); ?> kembali ke Profil</a></li>
		<?php else: ?>
			<li><a href="#register">Register</a></li>
			<li><a href="#form_login">Login</a></li>
		<?php endif; ?>	</ul>
	<div class="row">

		<div id="form_login" class="col s12 m4 l3 samping"> 
			<form onload="ceklogin()" class="card-panel" autocomplete="off">
				<?php if(session()->get('login')==0): ?>
				<h4 class="red-text text-darken-1">Login</h4>
				<hr>
				<label for="username1">Email</label>
				<input id="username1" type="text" required placeholder="Email" title="Isikan dengan alamat Email">
				<label for="password1">Password</label>
				<input id="password1" type="password" required placeholder="Password" title="Isikan dengan password">
				<a id="login" class="btn waves-effect waves-ligh orange darken-4">Login</a>
				<?php else: ?>
				<a class="garis" href="user/profil">Kembali ke Profil</a>
				<?php endif; ?>
			</form>
			
			<ul class="collection">
				<li class="collection-item avatar">
					<img src="src/img/default_pic.jpg" alt="" class="circle">
					<span class="title">21/09/2016</span>
					<a href="#konten"><p>Rekrutmen dosen tetap <br>non PNS 
					 IAIN Palu Tahun 2016
					</p></a>
					<a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
				</li>
			</ul>
			
		</div>
		
		<div id="konten" class="col s12 m8 l9 konten">
			<div class="pengumuman">
			<div class="card" id="news">
				<div class="card-image">
					<img class="" src="src/img/gedung1.jpg">
					<span class="card-title">
						<h3 class="bayang hide-on-med-and-down">Penerimaan dosen tetap non PNS IAIN Palu tahun 2016</h3>
					</span>
				</div>
				<div class="card-content">
					<p>						
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et ullamcorper nibh. Pellentesque pellentesque at lacus id lacinia. Sed sodales blandit eleifend. Nunc venenatis vehicula dui non tristique. Curabitur consequat, ex eget ornare accumsan, arcu est fringilla lacus, quis vehicula magna ipsum euismod augue. Etiam venenatis faucibus vehicula. Quisque fringilla hendrerit odio eu bibendum. Curabitur fringilla nec quam nec venenatis.
						<a href="#login">Login</a> jika belum daftar klik <a href="#register">register</a>
						Curabitur imperdiet nulla ut faucibus pretium. 
					</p>

				</div>
				<div class="card-action">
					<a href="#konten" onclick="news('1')" class="red-text text-darken-4">Selengkapnya &rarr;</a>
				</div>
			</div>
		</div>
		
			<?php if(session()->get('login')==0): ?>
			<div id="register" class="col s12 m12 12 card-panel">
				<p id="isireg"></p>
			</div>
			<?php endif; ?>
			<div id="tentang" class="col s12 m12 12 card-panel">
					<h4 class="red-text text-darken-4">Tentang</h4>
					<blockquote>
						<p>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et ullamcorper nibh. Pellentesque pellentesque at lacus id lacinia. Nulla nec placerat arcu, sit amet pulvinar quam. Donec vel dui nec nibh tempus aliquam. Aenean vitae auctor neque. In tristique purus at consectetur sagittis. Proin eget pretium nulla, nec vulputate purus. Sed sodales blandit eleifend. 
						</p>
					</blockquote>
			</div>
		</div>
		
	</div>
	<footer class="page-footer cyan darken-3">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text"></h5>
                <p class="grey-text text-lighten-4"></p>
              </div>
              <div class="col l4 offset-l2 s12">

              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2016
            <a class="grey-text text-lighten-4 right" href="#!">Kepegawaian IAIN Palu</a>
            </div>
          </div>
        </footer>
      <script type="text/javascript" src="src/js/jquery.min.js"></script>
      <script type="text/javascript" src="src/js/materialize.min.js"></script>
    </body>
  </html>
<script>
var token="<?php echo e(csrf_token()); ?>"
$(document).ready(function() {
	regs()
	$(".button-collapse").sideNav({
		  menuWidth: 300, // Default is 240
		  closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
	});
});
$("#login").click(function(){
	login(1)
});
$("#login2").click(function(){
	login(2)
});
function login(x)
{
	var username=$("#username"+x).val(),password=$("#password"+x).val();
	if(username==''){$("#username"+x).focus();Materialize.toast('Username/Email wajib diisi', 3000, 'rounded');return false;}
	if(password==''){$("#password"+x).focus();Materialize.toast('Password wajib diisi', 3000, 'rounded');return false;}
	$.ajax({
		url		:"xlogin",
		data	:({ _token:token,username:username,password:password }),
		type	:"post",
		success : function(respon)
				{
					if(respon=='user')
					{
						window.location.assign("user/profil")
					}
					else if(respon=='admin')
					{
						window.location.assign("admin/beranda")
					}
					else if(respon=='false')
					{
						Materialize.toast('Salah username atau password', 3000, 'rounded');return false;
					}
					else if(respon=='expired')
					{
						Materialize.toast('Masa pendaftaran berakhir', 3000, 'rounded');return false;
					}
					else
					{
						Materialize.toast('Salah username atau password', 3000, 'rounded');return false;
					}
				},
	});
}
function regs()
{
	$.ajax({
		url		:"regs",
		data	:({ _token:token }),
		type	:"post",
		success : function(respon)
		{
				$("#isireg").html(respon)
		},
	});
}
function news(id)
{
	$.ajax({
		url		:"news",
		data	:({ _token:token,id:id }),
		type	:"post",
		success : function(respon)
		{
			$('html, body').animate({ scrollTop: 0 }, 'slow');
			$("#news").html(respon)
		},
	});
}
</script>
