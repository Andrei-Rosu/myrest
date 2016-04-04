<?php $this->load->view('includes/add_tutorial'); ?>
<?php $this->load->view('includes/search_tutorial'); ?>

<?php $this->load->helper('readabledate'); ?>
<?php echo Modules::run('flashmessages/flashmessages/basicstyle'); ?>
<?php if(isset($tutorials) && $tutorials): ?>
<div id="wiki-list" class="card">
		<?php foreach($tutorials as $tutorial): ?>
		<?php $this->load->view('tutorials/includes/tutorial-row', array('tutorial'=>$tutorial)); ?>
		<?php endforeach; ?>
	<?php echo pagination('searched-tutos', current_url()); ?>
</div>
<?php endif; ?>