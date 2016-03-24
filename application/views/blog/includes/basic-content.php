<script>
	$(function () {
		var wbbOpt = {
			hotkeys: false, //disable hotkeys (native browser combinations will work)
			showHotkeys: false, //hide combination in the tooltip when you hover.
			lang: "fr",
			buttons: 'bold,italic,underline,strike,sup,sub,|,h2,h3,h4,h5,h6,|,img,video,link,|,bullist,numlist,|,fontcolor,fontsize,fontfamily,|,justifyleft,justifycenter,justifyright,|,quote,code,table,removeFormat',
			allButtons: {
				targetlink: {
					title: 'New page link',
					buttonHTML: '<span class="fonticon ve-tlb-link1">\uE007</span>',
					modal: {
						title: 'modal_link_title',
						width: "500px",
						tabs: [
							{
								input: [
									{param: "SELTEXT", title: CURLANG.modal_link_text, type: "div"},
									{param: "URL", title: CURLANG.modal_link_url, validation: '^http(s)?://'}
								]
							}
						]
					},
					transform: {
						'<a href="{URL}" target="_blank">{SELTEXT}</a>': "[urlblank={URL}]{SELTEXT}[/urlblank]",
						'<a href="{URL}" target="_blank">{URL}</a>': "[urlblank]{URL}[/urlblank]"
					}
				},
				h2: {
					title: 'h2',
					buttonText: 'h2',
					transform: {
						'<h2>{SELTEXT}</h2>': '[h2]{SELTEXT}[/h2]'
					}
				},
				h3: {
					title: 'h3',
					buttonText: 'h3',
					transform: {
						'<h3>{SELTEXT}</h3>': '[h3]{SELTEXT}[/h3]'
					}
				},
				h4: {
					title: 'h4',
					buttonText: 'h4',
					transform: {
						'<h4>{SELTEXT}</h4>': '[h4]{SELTEXT}[/h4]'
					}
				},
				h5: {
					title: 'h5',
					buttonText: 'h5',
					transform: {
						'<h5>{SELTEXT}</h5>': '[h5]{SELTEXT}[/h5]'
					}
				},
				h6: {
					title: 'h6',
					buttonText: 'h6',
					transform: {
						'<h6>{SELTEXT}</h6>': '[h6]{SELTEXT}[/h6]'
					}
				},
				myquote: {
					title: 'Insert myquote',
					buttonText: 'myquote',
					transform: {
						'<div class="myquote">{SELTEXT}</div>': '[myquote]{SELTEXT}[/myquote]'
					}
				}
			}
		}
		$("#blogpost_add_description").wysibb(wbbOpt);
		$("#blogpost_add_content").wysibb(wbbOpt);
		
	});
</script>
<?php if(is_module_installed('traductions')): ?>
	<?php $this->load->helper('form'); ?>
<p>
	<?php echo form_dropdown(array('id'=>'lang', 'name'=>'lang'), array('fr'=>'Français','en'=>'Anglais','ru'=>'Russe'), $lang) ;?>
	<script type="text/javascript">
		$('#lang').change(function(){
			window.location = "<?php echo current_url(); ?>?lang="+$(this).val();
		});
	</script>
</p>
<?php endif; ?>
<p><label>Titre :</label> <input type="text" id="blog_add_message_title" name="title" value="<?php echo isset($blogpost_add_pop['title']) ? $blogpost_add_pop['title'] : '' ?>"/></p>
<p><label>Description :</label><textarea id="blogpost_add_description" name="description_bb"><?php echo isset($blogpost_add_pop['description_bb']) ? $blogpost_add_pop['description_bb'] : '' ?></textarea></p>
<p><label>Image :</label><input type="file" id="blog_add_image" name="image"/></p>
<p><label>Contenu :</label><textarea id="blogpost_add_content" rows="10" name="content_bb"><?php echo isset($blogpost_add_pop['content_bb']) ? $blogpost_add_pop['content_bb'] : '' ?></textarea></p>
<p class="form-group"><label>Mot clés</label><br/><textarea id="blogpost_add_keys" name="keys" rows="4" cols="50"><?php echo isset($blogpost_add_pop['keys']) ? $blogpost_add_pop['keys'] : '' ?></textarea></p>
<?php if (isset($blogpost_add_pop['id'])): ?>
	<input type="hidden" value="<?php echo $blogpost_add_pop['id'] ?>" name="id"/>
<?php endif; ?>
<input type="hidden" name="save-<?php echo $model_name ?>" value="1"/>

