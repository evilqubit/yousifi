<!--absolute & transparent-->
<div class="loginBox" style="height:580px;"></div>	
<!--absolute & not transparent-->
<div class="loginBoxContent">
	<h2 class="layerTitle"><?php echo __("edit_profile",true);?> <span class="editPwdLink">&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/users/edit_password"><?php echo __("change_pwd",true);?></a></span></h2>
		
	<div class="floatClass">
		
		
	 	<?php echo $this->form->create('User',array('id'=>"editProfileForm",'url'=>array('controller'=>'users','action'=>'edit_profile'),'inputDefaults'=>array('escape'=>false,"label"=>false,'class'=>"registerField required" ,"div"=>false)));?>
	 	
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
		
		<div class="inputRow"><?php echo $this->form->input("country_id",array("class"=>"registerField selectBoxClass","options"=>$countries,"empty"=>strtoupper(__("choose_country",true)))); ?></div>
		
		<?php $val = strtoupper(__("phone",true));?>
		<fieldset class="inputRow" style="">
			<label onclick="$(this).next().focus()"><?=$val?></label>
			<?php echo $this->form->input("phone",array("onkeypress"=>"hide_label(this)","onblur"=>"show_hide_label(this)","onfocus"=>"show_hide_label(this)"));?>
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
		
		for($y=$endYear;$y>=$startYear;$y--){
				
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
<!--				<label onclick="$(this).next().focus()"><?//=$val?></label>-->
				<?php echo $this->form->input("day",array("class"=>"selectBoxClass registerField dobField","options"=>$daysArray,"empty"=>$val));?>
			</fieldset>
			<fieldset class="dobFieldDiv">
				<?php $val = strtoupper(__("year",true));?>
<!--				<label onclick="$(this).next().focus()"><?//=$val?></label>-->
				<?php echo $this->form->input("year",array("class"=>"selectBoxClass registerField dobField","options"=>$yearsArray,"empty"=>$val));?>
			</fieldset>
		</div>
		
		<div class="inputRow" style="margin-<?php echo __("align",true);?>:80px;">
			<div class="radioBtnDiv" style="margin:0px;"><input type="radio" name="data[User][gender]" value="male" id="maleRadio" class="radioBtn" <?php if($UserInfo["User"]["gender"] == "male"){ ?>checked="checked" <?php } ?>/></div>
			<label for="maleRadio" class="radioBtnLabel"><?php echo __("male",true);?></label>
			
			<div class="radioBtnDiv"><input type="radio" name="data[User][gender]" value="female" id="femaleRadio" class="radioBtn" <?php if($UserInfo["User"]["gender"] == "female"){ ?>checked="checked" <?php } ?>/></div>
			<label for="femaleRadio" class="radioBtnLabel"><?php echo __("female",true);?></label>
		</div>
		
		
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
	
	 $('.selectBoxClass').customSelect();
	 
});
</script>