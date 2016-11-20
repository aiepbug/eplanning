
<div class="container">
	<h2>Ubah password</h2><div id="status"></div>
	<div class="row">
		<label>Password lama</label>
		<input type="password" id="password_lama" type="text" placeholder="Password lama">
	</div>
	<div class="row">
		<label>Password baru</label>
		<input type="password" id="password_baru" type="text" placeholder="Password baru (min.5 karakter)">
	</div>
	<div class="row">
		<label>Ulangi password baru</label>
		<input type="password" id="password_baru_r" type="text" placeholder="Ulangi password baru">
	</div>
	<button onclick="simpanpw()" class="btn" >Simpan</button>
</div>
<script>
function simpanpw()
{
	var passl=$("#password_lama").val(),passb=$("#password_baru").val(),passbr=$("#password_baru_r").val();
	if(passl==''){$("#password_lama").focus();return false;}
	else if(passb==''){$("#password_baru").focus();return false;}
	else if(passbr==''){$("#password_baru_r").focus();return false;}
	else if(passb!=passbr)
	{
		$('#status').html("<span class='red-text text-darken-1'>Password baru tidak sama!</span>");
		$("#password_baru_r").focus();return false;
	}
	else
	{
		var token="{{ csrf_token() }}"
		$.ajax({
				url      : "simpanpw",
				data     : ({ _token:token,passl:passl,passb:passb,passbr:passbr}),
				type     : 'post',
				dataType : 'html',
				success  : function(respon){
						$('#status').html(respon);
						},
			})
		
	}
}
</script>
