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
      <title>E-Planning @ IAINPalu</title>
    </head>

    <body>
	<div class="navbar-fixed">
		<nav>
		  <div class="nav-wrapper green darken-3">
			<a href="#" data-activates="menu_mobile" class="button-collapse"><i class="material-icons">menu</i></a>
			<ul class="hide-on-med-and-down">
				<li class="active"><a href="./beranda">Beranda</a></li>
				<li><a href="#tentang">Tentang</a></li>
			</ul>
		  </div>
		</nav>
	</div>
	<ul class="side-nav" id="menu_mobile">
		<li><a href="#">Beranda</a></li>
		<li><a href="#tentang">Tentang</a></li>
		@if (session()->get('login')==1)
			<li class="active garis"><a href="user/profil">Login sebagai {{ session()->get('username') }} kembali ke Profil</a></li>
		@else
			<li><a href="#register">Register</a></li>
			<li><a href="#form_login">Login</a></li>
		@endif	</ul>
	<div class="row">

			<div id="tentang" class="col s12 m8 19">
					<h4 class="red-text text-darken-4">Tentang E-Planning IAIN Palu</h4>
					<blockquote>
						<p class="justi">
				e-Planning atau lebih dikenal sebagai perencanaan anggaran berbasis aplikasi online Ditjen Pendidikan Islam diharapkan
				 akan mampu menggantikan sistem manual yang selama ini berjalan antara satker pusat dan daerah. Dengan e-Planning 
				 ini akan banyak memberikan manfaat bagi pengembangan proses penyusunan perencanaan anggaran program pendidikan Islam 
				 ke depannya.Berdasarkan survei yang dilakukan PBB berjudul E-Government Survey 2014, Indonesia tercatat berada di 
				 peringkat 106 dari 193 negara-negara di dunia. Dinilai Indonesia harus banyak melakukan pembenahan dan inovasi 
				 agar sistem pelayanan publik berbasis elektronik bisa mengangkat Indonesia menjadi negara yang memiliki daya saing 
				 dalam skala global. Dalam skala nasional, sistem e-government juga dapat memudahkan warga mengurus dokumen.

						</p>
					</blockquote>
			</div>
			
		<div id="form_login" class="col s12 m4 l3 samping"> 
			<form class="card-panel" autocomplete="off">
				@if (session()->get('login')==0)
				<h4 class="red-text text-darken-1">Login</h4>
				<hr>
				<label for="username">Userid</label>
				<input id="username" type="text" required placeholder="Username" title="Isikan dengan Userid">
				<label for="password">Password</label>
				<input id="password" type="password" required placeholder="Password" title="Isikan dengan password">
				
				<label for="tahun">Tahun Anggaran</label>
				<select class="browser-default" required id="tahun">
						@for($t=(date('Y'))-1;$t<=(date('Y')+1);$t++)
							<option @if($t==date('Y')) selected @endif value="{{ $t }}">{{ $t }}</option>
						@endfor
				</select>
				<br>
				<br>
				<a id="login" class="btn waves-effect waves-light orange darken-4">Login</a>
				@else
				<a class="garis" href="user/profil">Kembali ke Profil</a>
				@endif
			</form>			
		</div>
	</div>
		
	</div>
	<footer class="page-footer green darken-3">
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
            <a class="grey-text text-lighten-4 right" href="#!">Perencanaan IAIN Palu</a>
            </div>
          </div>
        </footer>
      <script type="text/javascript" src="src/js/jquery.min.js"></script>
      <script type="text/javascript" src="src/js/materialize.min.js"></script>
    </body>
  </html>
<script>
var token="{{ csrf_token() }}"
$(document).ready(function() {
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
function login()
{
	var username=$("#username").val(),password=$("#password").val(),tahun=$("#tahun").val();
	if(username==''){$("#username").focus();Materialize.toast('Username wajib diisi', 3000, 'rounded');return false;}
	if(password==''){$("#password").focus();Materialize.toast('Password wajib diisi', 3000, 'rounded');return false;}
	$.ajax({
		url		:"xlogin",
		data	:({ _token:token,username:username,password:password,tahun:tahun }),
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
				$("#tentang").html(respon)
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
