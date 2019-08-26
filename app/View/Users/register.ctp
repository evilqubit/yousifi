<!--absolute & transparent-->
<div class="loginBox" style="height:880px;"></div>	
<!--absolute & not transparent-->
<div class="loginBoxContent">
	<h2 class="layerTitle"><?php echo strtoupper(__("register",true));?></h2>
		
	<div class="floatClass">
		
	 	<?php echo $this->form->create('User',array('id'=>"registrationForm",'url'=>array('controller'=>'users','action'=>'register'),"onsubmit"=>"return on_submit()",'inputDefaults'=>array('escape'=>false,'class'=>"registerField required" ,"div"=>false,"label"=>false)));?>
	 	
	 	<div class="formMsg" id="loginFormMsg" onclick="$(this).fadeOut();" style="display:none;"></div>
	 	
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
					
	 	<div class="inputRow"><?php echo $this->form->input("country_id",array("class"=>"registerField selectBoxClass","options"=>$countries,"empty"=>strtoupper(__("choose_country",true)))); ?></div>
	 	
	 	<?php $val = strtoupper(__("phone",true));?>
		<fieldset class="inputRow" style="">
			<label onclick="$(this).next().focus()"><?=$val?></label>
			<?php echo $this->form->input("phone",array("onkeypress"=>"hide_label(this)","onblur"=>"show_hide_label(this)","onfocus"=>"show_hide_label(this)"));?>
		</fieldset>
		
		<?php $val = strtoupper(__("pwd",true));?>
		<fieldset class="inputRow" style="">
			<label onclick="$(this).next().focus()"><?=$val?></label>
			<?php echo $this->form->input("password",array("type"=>"password","onkeypress"=>"hide_label(this)","onblur"=>"show_hide_label(this)","onfocus"=>"show_hide_label(this)"));?>
		</fieldset>
		
		<?php $val = strtoupper(__("conf_pwd",true));?>
		<fieldset class="inputRow" style="">
			<label onclick="$(this).next().focus()"><?=$val?></label>
			<?php echo $this->form->input("confirm_password",array("type"=>"password","onkeypress"=>"hide_label(this)","onblur"=>"show_hide_label(this)","onfocus"=>"show_hide_label(this)"));?>
		</fieldset>
		<?php
		
		if($locale=="ara"){
			$month_array = array("01"=>"&#1603; &#1634;","02"=>"&#1588;&#1576;&#1575;&#1591;","03"=>"&#1570;&#1584;&#1575;&#1585;","04"=>"&#1606;&#1610;&#1587;&#1575;&#1606;","05"=>"&#1571;&#1610;&#1575;&#1585;","06"=>"&#1581;&#1586;&#1610;&#1585;&#1575;&#1606;","07"=>"&#1578;&#1605;&#1608;&#1586;","08"=>"&#1570;&#1576;","09"=>"&#1571;&#1610;&#1604;&#1608;&#1604;","10"=>"&#1578; &#1633;",11=>"&#1578; &#1634;",12=>"&#1603; &#1633;");
			
		}else{
			$month_array=array("01"=>'January',"02"=>'February',"03"=>'March',"04"=>'April',"05"=>'May',"06"=>'June',"07"=>'July',"08"=>'August',"09"=>'September',"10"=>'October',"11"=>'November',"12"=>'December');
		}
		
		$daysArray = array();
		
		for($d=1;$d<=31;$d++){
			if($d < 10)
				$d = "0$d";
				
			$dayName = $this->Arabic->transliterate_numbers($d,0,$locale);
			$daysArray[$d] = $dayName;
		}
		
		$yearsArray = array();
		$currYear = date("Y");
		
		$endYear = $currYear - 12;
		$startYear = $currYear - 80;
		
		for($y=$endYear;$y>=31;$y--){
				
			$yearVal = $this->Arabic->transliterate_numbers($y,0,$locale);
			$yearsArray[$y] = $yearVal;
		}
		
		?>
		<div class="inputRow">
			<label class="dobLabel"><?php echo __("birthday",true);?></label>
			<fieldset class="dobFieldDiv" style="">
				<?php $val = strtoupper(__("month",true));?>
<!--				<label onclick="$(this).next().focus()"><?//=$val?></label>-->
				<?php echo $this->form->input("month",array("class"=>"selectBoxClass registerField dobField",'options'=>$month_array,"empty"=>$val));?>
			</fieldset>
			<fieldset class="dobFieldDiv">
				<?php $val = strtoupper(__("day",true));?>
<!--				<label onclick="$(this).next().focus()"><?=$val?></label>-->
				<?php echo $this->form->input("day",array("class"=>"selectBoxClass registerField dobField","options"=>$daysArray,"empty"=>$val));?>
<!--				"onkeypress"=>"hide_label(this);return validChars(event,'1234567890','');","onblur"=>"show_hide_label(this)","onfocus"=>"show_hide_label(this)"-->
			</fieldset>
			<fieldset class="dobFieldDiv">
				<?php $val = strtoupper(__("year",true));?>
<!--				<label onclick="$(this).next().focus()"><?=$val?></label>-->
				<?php echo $this->form->input("year",array("class"=>"selectBoxClass registerField dobField","options"=>$yearsArray,"empty"=>$val));?>
			</fieldset>
		</div>
		
		<div class="inputRow" style="margin-<?php echo __("align",true);?>:80px;">
			<div class="radioBtnDiv" style="margin:0px;"><input type="radio" name="data[User][gender]" value="male" id="maleRadio" class="radioBtn" checked="checked" /></div>
			<label for="maleRadio" class="radioBtnLabel"><?php echo __("male",true);?></label>
			
			<div class="radioBtnDiv"><input type="radio" name="data[User][gender]" value="female" id="femaleRadio" class="radioBtn"/></div>
			<label for="femaleRadio" class="radioBtnLabel"><?php echo __("female",true);?></label>
		</div>
		
		<div class="inputRow" id="captchaDiv" style="display:none;"><?php echo $this->element("recaptcha",array("className"=>"registerField","width"=>"545px;")); ?></div>
			
		<div class="registerSubmitDiv">
			<div class="floatClass"><?php echo __("login_info",true);?></div>
			<?php echo $this->form->submit(" ",array("class"=>"registerBtn","escape"=>false,"div"=>array("id"=>"formSubmitDiv")));?>
			<div class="floatRevClass" id="formLoaderDiv" style="display:none"><img src="/img/loader.gif" alt="" /></div>
		</div>
	
	 <?php echo $this->form->end(); ?>
	 
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$("#registrationForm").validate();
	
	$("#registrationForm input").each(function(){
		show_hide_label(this);
	});
	
	 $('.selectBoxClass').customSelect();
	 
//	 var options = {
//		beforeSubmit :function(){
//			return on_submit();
////			return false;
//		},
//		success : function(data){ registration_done(data) }
//	};
//	$('#registrationForm').ajaxForm(options);
	
	
});

function on_submit(){
	if(!$("#registrationForm").valid()){
		$("#formSubmitDiv").show();
		$("#formLoaderDiv").hide();
		return false;
	}
	
	if($("#captchaDiv").css("display") == "none"){
		$("#captchaDiv").slideDown();
		return false;
	}
	
	$("#formSubmitDiv").hide();
	$("#formLoaderDiv").show();
	
	return true;
}
</script>