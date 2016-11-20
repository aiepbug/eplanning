<input type="hidden" value="{{ $username->id }}" id="ket_username">
<input type="hidden" value="{{ $param }}" id="ket_param">
@if($param=='1')
<label for="keterangan">Keterangan</label>
<textarea id="keterangan" class="materialize-textarea">{{ $tahapan->tahap1_ket }}</textarea>
@elseif($param=='2')
<label for="keterangan">Keterangan</label>
<textarea id="keterangan" class="materialize-textarea" >{{ $tahapan->tahap2_ket }}</textarea>
@elseif($param=='3')
<label for="keterangan">Keterangan</label>
<textarea id="keterangan" class="materialize-textarea">{{ $tahapan->tahap3_ket }}</textarea>
@endif
