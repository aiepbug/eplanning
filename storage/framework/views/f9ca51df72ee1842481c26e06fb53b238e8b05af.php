<?php $__env->startSection('konten'); ?>
	<a href="logout">Logout</a>
	<a class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>