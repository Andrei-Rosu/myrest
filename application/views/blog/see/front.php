<?php $this->load->helper('readabledate'); ?>
<div class="wiki">

	<div class="wiki-heading">
		<div class="wiki-img"><img alt="" src="<?php echo base_url($blogpost->image); ?>"></div>

		<h1>
			<?php echo $blogpost->title; ?>
		</h1>
	</div>

	<div class="wiki-content">
		<?php echo $blogpost->content ?>
	</div>

	<small>
		dernière mise à jour 
		<?php echo zero_date($blogpost->update_time) ?>
		par <?php echo $blogpost->author; ?>
	</small>

	<div class="actions">
		<?php if (user_can('update', 'post', $blogpost->id)): ?><a href="<?php echo base_url("tutorials/edit/$blogpost->id"); ?>">Modifier</a><?php endif; ?>
	</div>
</div>