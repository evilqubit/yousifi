<!--absolute & transparent-->
<div class="loginBox" style="height:300px;"></div>	
<!--absolute & not transparent-->
<div class="loginBoxContent">
	<h2 class="layerTitle"><?php echo strtoupper(__("forgot_pwd",true));?></h2>
		
	<div class="floatClass">
		
	 	<?php echo $this->form->create('Forgot',array('id'=>"forgotPwdForm",'url'=>array('controller'=>'users','action'=>'forgot_pwd'),"onsubmit"=>"return on_submit()",'inputDefaults'=>array('escape'=>false,'class'=>"registerField required" ,"div"=>false,"label"=>false)));?>
	 	
	 	<div class="formMsg" id="forgotFormMsg" onclick="$(this).fadeOut();" style="display:none;"></div>
	 	
	 
		<?php $val = strtoupper(__("email",true));?>
			<fieldset class="inputRow" style="">
			<label onclick="$(this).next().focus()"><?=$val?></label>
			<?php echo $this->form->input("email",array('class'=>"registerField required email","onkeypress"=>"hide_label(this)","onblur"=>"show_hide_label(this)","onfocus"=>"show_hide_label(this)"));?>
		</fieldset>
					
	 	
		<div class="newsletterSubmitDiv">
			<?php echo $this->form->submit(" ",array("class"=>"proceedBtn","escape"=>false,"div"=>array("id"=>"formSubmitDiv")));?>
			<div class="floatRevClass" id="formLoaderDiv" style="display:none"><img src="/img/loader.gif" alt="" /></div>
		</div>
	
	 <?php echo $this->form->end(); ?>
	 
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$("#forgotPwdForm").validate();
	
	$("#forgotPwdForm input").each(function(){
		show_hide_label(this);
	});
	

	
});

function on_submit(){
	if(!$("#forgotPwdForm").valid()){
		$("#formSubmitDiv").show();
		$("#formLoaderDiv").hide();
		return false;
	}
	
	$("#formSubmitDiv").hide();
	$("#formLoaderDiv").show();
	
	return true;
}
</script>