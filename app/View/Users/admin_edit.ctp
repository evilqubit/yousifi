<div class="maintitle">Users</div>
<div class="subtitle">Edit Users</div>

<?php 
echo $this->Form->create("$modelName",array("type"=>"file","url"=>array("controller"=>"$controllerName","action"=>"admin_edit"),"inputDefaults"=>array("class"=>"input_field"),"id"=>"pageForm"));
?>


<!-- <div class="input_row">
	<div class="label"> Name</div>
	<div class="input_div"><?php echo $this->Form->input("$modelName.name",array('label'=>false,"class"=>"required"));?></div>
</div> -->

<!-- <div class="input_row">
	<div class="label">Last Name</div>
	<div class="input_div"><?php echo $this->Form->input("$modelName.lname",array('label'=>false,"class"=>"required"));?></div>
</div> -->
			
	<div class="input_row">
		<div class="label">Email</div>
		<div class="input_div"><?php echo $this->form->input("$modelName.email",array('label'=>false,'class'=>"required email email_duplicate"));?></div>
	</div>


<div class="input_row">
	<div class="label">Password</div>
	<div class="input_div"><?php echo $this->form->input("$modelName.new_password",array('label'=>false, 'type'=>'password', 'class'=>"required" ,'value'=>'','empty'=>'','autocomplete'=>"off"));?></div>
</div>


<div class="input_row">
	<div class="label">Repeat Password</div>
	<div class="input_div"><?php echo $this->form->input("$modelName.repeat_password",array('label'=>false, 'type'=>'password', 'class'=>"required" ,'value'=>'','empty'=>'','autocomplete'=>"off"));?></div>
</div>

<!-- <div class="input_row">
	<div class="label">Phone</div>
	<div class="input_div"><?php echo $this->Form->input("$modelName.phone",array('label'=>false,"class"=>"required"));?></div>
</div>

<div class="input_row">
	<div class="label">Gender</div>
	<div class="input_div"><?php echo $this->Form->input("$modelName.gender",array('label'=>false,"class"=>"required","options"=>array("male","female")));?></div>
</div>

<div class="input_row">
	<div class="label">Country</div>
	<div class="input_div"><?php echo $this->Form->input("$modelName.country_id",array('label'=>false,"class"=>"required","options"=>$country_list));?></div>
</div> -->

<?php
	// $month_array=array("01"=>'January',"02"=>'February',"03"=>'March',"04"=>'April',"05"=>'May',"06"=>'June',"07"=>'July',"08"=>'August',"09"=>'September',"10"=>'October',"11"=>'November',"12"=>'December');
// 	
	// $daysArray = array();
// 		
	// for($d=1;$d<=31;$d++){
		// if($d < 10)
			// $d = "0$d";
		// $daysArray[$d] = $d;
	// }
// 	
	// $yearsArray = array();
	// $currYear = date("Y");
// 	
	// $endYear = $currYear - 12;
	// $startYear = $currYear - 80;
// 	
	// for($y=$endYear;$y>=31;$y--){
		// $yearsArray[$y] = $y;
	// }
		
		
?>
<!-- <fieldset class="dobFieldDiv" style="clear:both;width:540px;">
	<legend>Birthday</legend>
	
	<div class="dobFieldDiv" style="margin-bottom:5px;">
		<div class="label">Month</div>
		<?php echo $this->form->input("month",array("class"=>"input_field",'options'=>$month_array,"label"=>false));?>
	</div>
	
	<div class="dobFieldDiv" style="margin-bottom:5px;">
		<div class="label">Day</div>
		<?php echo $this->form->input("day",array("class"=>"input_field","options"=>$daysArray,"label"=>false));?>
	</div>
	<div class="dobFieldDiv" style="">
		<div class="label">Year</div>
		<?php echo $this->form->input("year",array("class"=>"input_field","options"=>$yearsArray,"label"=>false));?>
	</div>
</fieldset> -->
		



<div class="input_row">
	<div class="input_div"><?php echo $this->Form->submit("Submit",array("class"=>"submit_btn"));?></div>
</div>
<?php
echo $this->Form->end();
?>

<script type="text/javascript">
$(document).ready(function() {
	$("#pageForm").validate();
});
</script>