<?php if(is_module_installed('traductions')): ?>
	<?php $this->load->helper('form'); ?>
<p>
	<?php echo form_dropdown(array('id'=>'lang', 'name'=>'lang'), array('fr'=>'Français','en'=>'Anglais','ru'=>'Russe'), $lang) ;?>
	<script type="text/javascript" data-module="trad_select"></script>
</p>
<?php endif; ?>
<p><label>Titre :</label> <input type="text" id="blog_add_message_title" name="title" value="<?php echo isset($blogpost_add_pop['title']) ? $blogpost_add_pop['title'] : '' ?>"/></p>
<p><label>Description :</label><textarea id="blogpost_add_description" data-module="custom_wysib" name="description_bb"><?php echo isset($blogpost_add_pop['description_bb']) ? $blogpost_add_pop['description_bb'] : '' ?></textarea></p>
<p><label>Image :</label><input type="file" id="blog_add_image" name="image"/></p>
<p><label>Contenu :</label><textarea id="blogpost_add_content" data-module="custom_wysib" rows="10" name="content_bb"><?php echo isset($blogpost_add_pop['content_bb']) ? $blogpost_add_pop['content_bb'] : '' ?></textarea></p>
<p class="form-group"><label>Mot clés</label><br/><textarea id="blogpost_add_keys" name="keys" rows="4" cols="50"><?php echo isset($blogpost_add_pop['keys']) ? $blogpost_add_pop['keys'] : '' ?></textarea></p>
<?php if (isset($blogpost_add_pop['id'])): ?>
	<input type="hidden" value="<?php echo $blogpost_add_pop['id'] ?>" name="id"/>
<?php endif; ?>
<input type="hidden" name="save-<?php echo $model_name ?>" value="1"/>

