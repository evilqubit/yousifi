<!--absolute & transparent-->
<div class="loginBox" style="height:430px;"></div>	
<!--absolute & not transparent-->
<div class="loginBoxContent">
	<h2 class="layerTitle"><?php echo __("change_pwd",true);?></h2>
	
	<div class="floatClass">
	 	<?php echo $this->form->create('User',array('id'=>"editProfileForm",'url'=>array('controller'=>'users','action'=>'edit_password'),'inputDefaults'=>array('escape'=>false,'label'=>false,'class'=>"registerField required" ,"div"=>false)));?>
	 	
	 	
	 	<?php $val = strtoupper(__("old_pwd",true));?>
		<fieldset class="inputRow" style="">
			<label onclick="$(this).next().focus()"><?=$val?></label>
			<?php echo $this->form->input("old_password",array("type"=>"password","onkeypress"=>"hide_label(this)","onblur"=>"show_hide_label(this)","onfocus"=>"show_hide_label(this)"));?>
		</fieldset>
		
		<?php $val = strtoupper(__("new_pwd",true));?>
		<fieldset class="inputRow" style="">
			<label onclick="$(this).next().focus()"><?=$val?></label>
			<?php echo $this->form->input("new_password",array("type"=>"password","onkeypress"=>"hide_label(this)","onblur"=>"show_hide_label(this)","onfocus"=>"show_hide_label(this)"));?>
		</fieldset>
		
		<?php $val = strtoupper(__("conf_pwd",true));?>
		<fieldset class="inputRow" style="">
			<label onclick="$(this).next().focus()"><?=$val?></label>
			<?php echo $this->form->input("confirm_password",array("type"=>"password","onkeypress"=>"hide_label(this)","onblur"=>"show_hide_label(this)","onfocus"=>"show_hide_label(this)"));?>
		</fieldset>
		
			
		<div class="editSubmitDiv">
			<?php echo $this->form->submit(" ",array("class"=>"saveBtn","escape"=>false,"div"=>array("id"=>"formSubmitDiv")));?>
		</div>
	
	 <?php echo $this->form->end(); ?>
	 
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$("#editProfileForm").validate();
	
	$("#editProfileForm input").each(function(){
		show_hide_label(this);
	});
	
});

</script>