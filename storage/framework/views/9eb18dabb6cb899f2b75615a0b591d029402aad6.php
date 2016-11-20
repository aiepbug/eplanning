<input type="hidden" value="<?php echo e($username->id); ?>" id="ket_username">
<input type="hidden" value="<?php echo e($param); ?>" id="ket_param">
<?php if($param=='1'): ?>
<label for="keterangan">Keterangan</label>
<textarea id="keterangan" class="materialize-textarea"><?php echo e($tahapan->tahap1_ket); ?></textarea>
<?php elseif($param=='2'): ?>
<label for="keterangan">Keterangan</label>
<textarea id="keterangan" class="materialize-textarea" ><?php echo e($tahapan->tahap2_ket); ?></textarea>
<?php elseif($param=='3'): ?>
<label for="keterangan">Keterangan</label>
<textarea id="keterangan" class="materialize-textarea"><?php echo e($tahapan->tahap3_ket); ?></textarea>
<?php endif; ?>
