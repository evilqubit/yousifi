	<h2 class="layerTitle"><?php echo strtoupper(__("newsletter",true));?></h2>
		
	<div class="floatClass">
		
	 	<?php echo $this->form->create('Newsletter',array('id'=>"newsletterForm",'url'=>array('controller'=>'users','action'=>'newsletter'),"onsubmit"=>"return on_submit()",'inputDefaults'=>array('escape'=>false,'class'=>"registerField" ,"div"=>false,"label"=>false)));?>
	 	
	 	<div class="formMsg" id="newsletterFormMsg" onclick="$(this).fadeOut();$('#newsletterFormElements').slideDown();" style="display:none;"></div>
	 	
	 	<div class="floatClass" id="newsletterFormElements">
		 	<?php $val = strtoupper(__("fname",true));?>
			<fieldset class="inputRow" style="">
				<label onclick="$(this).next().focus()"><?=$val?></label>
				<?php echo $this->form->input("fname",array("onkeypress"=>"hide_label(this)","onblur"=>"show_hide_label(this)","onfocus"=>"show_hide_label(this)"));?>
			</fieldset>
			
			<?php $val = strtoupper(__("lname",true));?>
			<fieldset class="inputRow" style="">
				<label onclick="$(this).next().focus()"><?=$val?></label>
				<?php echo $this->form->input("lname",array("onkeypress"=>"hide_label(this)","onblur"=>"show_hide_label(this)","onfocus"=>"show_hide_label(this)"));?>
			</fieldset>
			
			<?php $val = strtoupper(__("email",true));?>
				<fieldset class="inputRow" style="">
				<label onclick="$(this).next().focus()"><?=$val?></label>
				<?php echo $this->form->input("email",array('class'=>"registerField required email","onkeypress"=>"hide_label(this)","onblur"=>"show_hide_label(this)","onfocus"=>"show_hide_label(this)"));?>
			</fieldset>
						
		 
			<div class="newsletterSubmitDiv">
				<div class="newsletterSubscribeDiv">
					<div class="floatClass"><input type="radio" name="data[Newsletter][subscribe]" value="1" checked="checked" id="subscribeRadio" /></div>
					<div class="floatClass"><label for="subscribeRadio" class="newsletterRadioLabel"><?php echo __("subscribe",true);?></label></div>
					
					<div class="floatClass" style="margin-<?php echo __("align",true);?>:20px;"><input type="radio" name="data[Newsletter][subscribe]" value="0"  id="unsubscribeRadio" /></div>
					<div class="floatClass"><label for="unsubscribeRadio" class="newsletterRadioLabel"><?php echo __("unsubscribe",true);?></label></div>
					
					
				</div>
				<div class="newsletterSubmitBtnDiv">
					<?php echo $this->form->submit(" ",array("class"=>"registerBtn","escape"=>false,"div"=>array("id"=>"formSubmitDiv")));?>
					<div class="floatRevClass" id="formLoaderDiv" style="display:none"><img src="/img/loader.gif" alt="" /></div>
				</div>
			</div>
		</div>
	
	 <?php echo $this->form->end(); ?>
	 
	</div>
<script type="text/javascript">
$(document).ready(function() {
	$("#newsletterForm").validate();
	
	$("#newsletterForm input").each(function(){
		show_hide_label(this);
	});
	
	 var options = {
	 	resetForm: true,
		beforeSubmit :function(){
			return on_submit();
		},
		success : function(data){ newsletter_registration_done(data) }
	};
	$('#newsletterForm').ajaxForm(options);
	
	
});

function on_submit(){
	if(!$("#newsletterForm").valid()){
		$("#formSubmitDiv").show();
		$("#formLoaderDiv").hide();
		return false;
	}
	
	$("#formSubmitDiv").hide();
	$("#formLoaderDiv").show();
	
	return true;
}

function newsletter_registration_done(data){
	$("#newsletterFormMsg").html(data);
	
	$("#formSubmitDiv").show();
	$("#formLoaderDiv").hide();
	
	$("#newsletterFormElements").slideUp(500);
	setTimeout("$('#newsletterFormMsg').fadeIn()",550);
}
</script>