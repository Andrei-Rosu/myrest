<form action="<?php echo base_url('tutorials/search'); ?>">
	<label>Rechercher un wiki : </label><input type="text" name="search" id="InputSearchTuto">
	<button type="submit">Effectuer une recherche</button>
</form>
<?php $this->load->helper('readabledate'); ?>
<?php echo Modules::run('flashmessages/flashmessages/basicstyle'); ?>
<?php if(isset($tutorials) && $tutorials): ?>
<div id="wiki-list">
		<?php foreach($tutorials as $tutorial): ?>
		<?php $this->load->view('tutorials/includes/tutorial-row', array('tutorial'=>$tutorial)); ?>
		<?php endforeach; ?>
	<?php echo pagination('searched-tutos', current_url()); ?>
</div>
<?php endif; ?>