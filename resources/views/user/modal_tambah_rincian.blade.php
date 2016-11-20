<div class="modal-content">	
	@if(isset($rincian))
		<a href="#!" title="Hapus rincian" onclick="hapus_rincian('{{ $rincian->id }}')" class="btn-floating btn-small waves-effect waves-light red right"><i class="material-icons">delete</i></a>
	@endif

	<h4>Tambah rincian kegiatan</h4>
	<p>{{ $kegiatan->nama_kegiatan }}</p>
	<table>
		<tr><td>Harga (Rp.)</td><td colspan="3"><input type="text" id="harga" placeholder="Harga" value="{{ $rincian->harga or '' }}"></td></tr>
		<tr><td>Rincian</td><td colspan="3"><input type="text" id="keterangan" placeholder="Keterangan" value="{{ $rincian->rincian_kegiatan or '' }}"></td></tr>
		<tr><td>Jumlah I</td>
			<td></td>
			<td>
				<input type="text" id="nilai1" placeholder="Nilai I" value="{{ $rincian->jumlah1 or '' }}">
			</td>
			<td>
				<select class="browser-default" id="satuan1">
				@foreach($satuan as $s)
					<option @if(isset($rincian->satuan1)) @if($rincian->satuan1==$s->id) selected @endif @endif value="{{ $s->id }}">{{ $s->nama_satuan }}</option>
				@endforeach
				</select>
			</td>
		</tr>
		<tr><td>Jumlah II</td>
			<td>
				<div class="switch">
					<label>
					  Off
					  <input type="checkbox">
					  <span class="lever"></span>
					  On
					</label>
				  </div>
			</td>
			<td>
				<input type="text" id="nilai2" disabled placeholder="Nilai II">
			</td>
			<td>
				<select class="browser-default" id="satuan2">
					<option value=""></option>
				@foreach($satuan as $s)
					<option value="{{ $s->id }}">{{ $s->nama_satuan }}</option>
				@endforeach
				</select>
			</td>
		</tr>
		<tr><td>Jumlah III</td>
			<td>
				<div class="switch">
					<label>
					  Off
					  <input type="checkbox">
					  <span class="lever"></span>
					  On
					</label>
				  </div>
			</td>
			<td>
				<input type="text" id="nilai3" disabled placeholder="Nilai III">
			</td>
			<td>
				<select class="browser-default" id="satuan3">
					<option value=""></option>
				@foreach($satuan as $s)
					<option value="{{ $s->id }}">{{ $s->nama_satuan }}</option>
				@endforeach
				</select>
			</td>
		</tr>
	</table>
</div>
<div class="modal-footer">
	@if(isset($rincian))
		<a href="#!" onclick="simpan_rincian('update','{{ $rincian->id }}')" class="modal-action modal-close waves-effect waves-green btn-flat ">Update</a>
	@else
		<a href="#!" onclick="simpan_rincian('simpan','0')" class="modal-action modal-close waves-effect waves-green btn-flat ">Simpan</a>
	@endif
</div>
<script>
var token="{{ csrf_token() }}"
function simpan_rincian(param,id_rincian)
{
	var keterangan=$("#keterangan").val(),harga=$("#harga").val(),
		nilai1=$("#nilai1").val(),satuan1=$("#satuan1").val(),
		nilai2=$("#nilai2").val(),satuan2=$("#satuan2").val(),
		nilai3=$("#nilai3").val(),satuan3=$("#satuan3").val(),
		id="{{ $kegiatan->id }}";
	
	if(harga==''){$("#harga").focus();return false;}
	if(keterangan==''){$("#keterangan").focus();return false;}
	if(nilai1==''){$("#nilai1").focus();return false;}
	$.ajax({
		url		:"simpan_rincian",
		data	:({ _token:token,id:id,param:param,id_rincian:id_rincian,
					harga:harga,keterangan:keterangan,
					nilai1:nilai1,satuan1:satuan1,
					nilai2:nilai2,satuan2:satuan2,
					nilai3:nilai3,satuan3:satuan3
				}),
		type	:"post",
		success : function(respon)
		{
				 $('#modal1').closeModal();
				 $('#konten').html(respon);
		},
	});
}
function hapus_rincian(id)
{
	$.ajax({
		url		:"hapus_rincian",
		data	:({ _token:token,id:id}),
		type	:"post",
		success : function(respon)
		{
				 $('#modal1').closeModal();
				 $('#konten').html(respon);
		},
	});
}
</script>
