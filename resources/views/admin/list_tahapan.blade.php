<div id="info"></div>
<table class="responsive-table bordered highlight">
	<tr class="deep-purple-text text-lighten-5 red darken-3">
		<td class="tengah" width="5%">No</td>
		<td class="tengah" width="10%">Email</td>
		<td class="tengah" width="12%">Nama</td>
		<td class="tengah" width="10%">Formasi</td>
		<td class="tengah" width="16%">Tahapan I</td>
		<td class="tengah" width="16%">Tahapan II</td>
		<td class="tengah" width="16%">Tahapan III</td>
		<td class="tengah" width="15%">Finalisasi</td>
	</tr>
	@foreach($registrasi as $r)
	<tr>
		<td class="tengah">{{ $no++ }}</td>
		<td class="tengah">{{ $reg }}{{ str_pad($r->id_formasi_detail,2,'0', STR_PAD_LEFT) }}{{ str_pad($r->id,3,'0', STR_PAD_LEFT) }}</td>
		<td>@if($r->nama=='')--belum diisi--@else{{ $r->nama }}@endif</td>
		<td class="sedang">@if($r->nama_formasi!=''){{ $r->nama_formasi }}@else --kosong--@endif</td>
		<td class="tengah">
			<div class="switch">
				<label>Tidak lolos<input onclick="cek('1','{{$r->userid}}')" id="tahap1{{$r->userid}}" @if($r->tahap1==1) checked @endif type="checkbox"><span class="lever"></span>Lolos</label>
				<a onclick="tambah_ket('1','{{$r->userid}}')" href="javascript:void(0)" class="@if($r->tahap1_ket!='') tooltipped blue-text @else grey-text @endif" data-tooltip="{{ $r->tahap1_ket }}"><i class="material-icons">chat</i></a>
			</div>
		</td>
		<td class="tengah">
			<div class="switch">
				<label>Tidak lolos<input onclick="cek('2','{{$r->userid}}')" id="tahap2{{$r->userid}}" @if($r->tahap2==1) checked @endif type="checkbox"><span class="lever"></span>Lolos</label>
				<a onclick="tambah_ket('2','{{$r->userid}}')" href="javascript:void(0)"><i class="material-icons @if($r->tahap2_ket!='') tooltipped blue-text @else grey-text @endif" data-tooltip="{{ $r->tahap2_ket }}">chat</i></a>
			</div>
		</td>
		<td class="tengah">
			<div class="switch">
				<label>Tidak lolos<input onclick="cek('3','{{$r->userid}}')" id="tahap3{{$r->userid}}" @if($r->tahap3==1) checked @endif type="checkbox"><span class="lever"></span>Lolos</label>
				<a onclick="tambah_ket('3','{{$r->userid}}')" href="javascript:void(0)"><i class="material-icons @if($r->tahap3_ket!='') tooltipped blue-text @else grey-text @endif" data-tooltip="{{ $r->tahap3_ket }}">chat</i></a>
			</div>
		</td>
		<td class="tengah"><a class="btn" href="javascript:void(0)" onclick="cetak_detail_peserta('biodata','{{ $r->username }}')">Final</a></td>
	</tr>
	@endforeach
</table>
<div id="modal_tahap" class="modal modal-fixed-footer">
	<div class="modal-content">
		<p id="isimodal"></p>
	</div>
	<div class="modal-footer">
		<a href="javascript:void(0)" onclick="simpan_ket()" class="waves-effect waves-green btn-flat">Simpan</a>
	</div>
</div>
<script>
var token="{{ csrf_token() }}";
$(document).ready(function(){
    $('.tooltipped').tooltip({delay: 50});
 });
function cek(param,userid)
{
	if ($('#tahap'+param+userid).is(':checked')) {
		var val='1';
	} else {
		var val='0';
	}
	$.ajax({
	url      : "aktif_tahapan",
	data     : ({ _token:token,userid:userid,val:val,param:param}),
	type     : 'post',
	dataType : 'html',
	success  : function(respon){

			},
	})
} 
 
function detail_formasi(id)
{
	$.ajax({
	url      : "detail_formasi",
	data     : ({ _token:token,id:id}),
	type     : 'post',
	dataType : 'html',
	success  : function(respon){
			$('html, body').animate({ scrollTop: 0 }, 'slow');	
			$('#konten').html(respon);
			return false;
			},
	})
}
function cetak_detail_peserta(param,username)
{
	$.ajax({
	url      : "cetak_detail_peserta",
	data     : ({ _token:token,username:username,param:param}),
	type     : 'post',
	dataType : 'html',
	success  : function(respon){
			$('html, body').animate({ scrollTop: 0 }, 'slow');	
			$('#info').html(respon);
			return false;
			},
	})
}

function tambah_ket(param,userid)
{
	$('#modal_tahap').openModal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      in_duration: 300, // Transition in duration
      out_duration: 200, // Transition out duration
      starting_top: '4%', // Starting top style attribute
      ending_top: '10%', // Ending top style attribute
      ready: function() { 
				$.ajax({
						url      : "lihat_tahapan_ket",
						data     : ({ _token:token,param:param,userid:userid}),
						type     : 'post',
						dataType : 'html',
						success  : function(respon){
								$('#isimodal').html(respon);
								},
				})
		     }, 
      complete: function() { $('#isimodal').html(""); }
    });
}
function simpan_ket()
{
	var userid=$("#ket_username").val()
	var param=$("#ket_param").val()
	var val=$("#keterangan").val()
	$.ajax({
						url      : "simpan_tahapan_ket",
						data     : ({ _token:token,param:param,userid:userid,val:val}),
						type     : 'post',
						dataType : 'html',
						success  : function(respon){
									 if(respon=='ok')
									 {
										 Materialize.toast('Tersimpan', 3000, 'rounded');return false;
									 }
									 else
									 {
										 Materialize.toast('Gagal menyimpan', 3000, 'rounded');return false;
									 }
								},
				})
}
</script>
