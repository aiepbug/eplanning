<div class="row">
	<form class="col s12" autocomplete="off">
		<h2>Keluarga</h2>
		<div class="row">
			<div class="input-field col s12">
				<i class="material-icons prefix">account_circle</i>
				<input id="ibu" type="text" value="<?php if(count($kel)>0): ?> <?php echo e($kel->ibu); ?><?php endif; ?>">
				<label class="active" for="ibu">Nama ibu kandung</label>
			</div>
		</div>
		
		<div class="row">
			<div class="right input-field col s12">
				<a href="javascript:void(0)" class="right btn waves-effect waves-light" onclick="lanjut()" id="simpan_biodata">Selanjutnya
					<i class="material-icons right">send</i>
				  </a>
			</div>		
		</div>
	</form>
</div>

<script>
$(document).ready(function() {
	var menu="<?php echo e(session()->get('menu')); ?>";
	$("li").removeClass("active");
	$("#"+menu).addClass("active");
	$("title").html("Pendaftar &rarr; "+menu);
	
	if(<?php echo e(session()->get("status")); ?>>0)
	{
		$("input").prop('disabled',true);
		$("select").prop('disabled',true);
	}
})
function lanjut()
{
	var menu="<?php echo e(session()->get('menu')); ?>";
	var mn="simpan_";
	var links=mn.concat(menu);
	var token="<?php echo e(csrf_token()); ?>";
	var ibu=$("#ibu").val();
	$.ajax({
			url      : links,
			data     : ({ _token:token,ibu:ibu}),
			type     : 'post',
			dataType : 'html',
			success  : function(respon){
					$('html, body').animate({ scrollTop: 0 }, 'slow');	
					$('#konten').html(respon);
					},
		})
}
</script>
