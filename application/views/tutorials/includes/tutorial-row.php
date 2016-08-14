<div class="wiki-row">
	<div class="img">
		<img src="<?php echo base_url($tutorial->image); ?>" alt="Image du bookmark <?php echo $tutorial->title; ?>"/> 
	</div>
	<div class="infos">
		<h2>
			<?php echo $tutorial->title; ?>
		</h2>
		<div class="desc">
			<p>
				<?php echo $tutorial->description; ?>
			</p>
		</div>
		<div class="authoring">
			<p class="author">
				Auteur : <span class="name"><?php echo $tutorial->author; ?></span>
			</p>
			<p class="date">
				Dernière modification <?php echo zero_date($tutorial->update_time); ?>
			</p>
		</div>
		<div class="actions">
			<a href="<?php echo base_url('tutorials/see/' . $tutorial->id); ?>" title="lire ce bookmark">Lire</a>
			<?php if(user_can('update', 'post', $tutorial->id)): ?>
			<a href=<?php echo base_url("tutorials/edit/$tutorial->id"); ?>>Modifier</a>
			<a href=<?php echo base_url("tutorials/delete/$tutorial->id"); ?>>Supprimer</a>
			<?php endif; ?>
		</div>
		<?php if(isset($tutorial->matchings)): ?>
		<div class="result-details">
			<span class="matching">Pertinence : <span class="value"><?php echo $tutorial->matchings; ?></span></span>
		</div>
		<?php endif; ?>
	</div>
</div>
