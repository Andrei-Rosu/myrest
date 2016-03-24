<div class="card">
	<h1><?php if(isset($tutorial)): ?>Édition du tutoriel "<?php echo $tutorial->title; ?>"<?php else: ?>Ajout d'un nouveau tutoriel<?php endif; ?> </h1>
	<?php echo Modules::run('blog/save/basic',isset($idTuto) ? $idTuto : null, 'tutorial', 'tutorials/see/{row:id}'); ?>
	
</div>
