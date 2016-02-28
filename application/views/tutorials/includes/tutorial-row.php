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
		</div>
	</div>
</div>
