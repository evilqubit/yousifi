<div class="maintitle">Social Media Links</div>
<div class="subtitle">Edit Social Media Links</div>

<?php echo $this->form->create("$modelName",array('url'=>array('controller'=>$controllerName,'action'=>'admin_edit',$id),'id'=>'PageForm'));?>
	<div class="input_row">Youtube URL should be in the following format: http://www.youtube.com</div>
	<div class="input_row">
		<div class="label">Facebook</div>
		<div class="input_div"><?php echo $this->form->input("facebook",array('label'=>false,'class'=>"url width_class"));?></div>
	</div>
	<div class="input_row">
		<div class="label">Twitter</div>
		<div class="input_div"><?php echo $this->form->input("twitter",array('label'=>false,'class'=>"url width_class"));?></div>
	</div>
	<div class="input_row">
		<div class="label">YouTube</div>
		<div class="input_div"><?php echo $this->form->input("youtube",array('label'=>false,'class'=>"url width_class"));?></div>
	</div>
	<div class="input_row">
		<div class="label">LinkedIn</div>
		<div class="input_div"><?php echo $this->form->input("linkedin",array('label'=>false,'class'=>"url width_class"));?></div>
	</div>
	<div class="input_row">
		<div class="label">Picasa</div>
		<div class="input_div"><?php echo $this->form->input("picasa",array('label'=>false,'class'=>"url width_class"));?></div>
	</div>
	<div class="input_row">
		<div class="label">Google Plus</div>
		<div class="input_div"><?php echo $this->form->input("google",array('label'=>false,'class'=>"url width_class"));?></div>
	</div>
	<div class="input_row">
		<div class="label">Instagram</div>
		<div class="input_div"><?php echo $this->form->input("instagram",array('label'=>false,'class'=>"url width_class"));?></div>
	</div>
	
	
<div class="input_row">
	<div class="submit_div"><?php echo $this->form->submit('Save',array('class'=>'submit_btn'));?>
</div>
<?php echo $this->form->end();?>

<script type="text/javascript">
$(document).ready(function(){
    $("#PageForm").validate();
    
});
</script>