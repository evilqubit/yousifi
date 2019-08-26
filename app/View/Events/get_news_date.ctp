<div class="floatClass search_field_element" >
	<label class="floatClass field_title "><?=__('By Year',true)?></label>
	<?php
	 echo $this->form->input("year",
	array(
	"label"=>false,
	"id"=>"year_filter",
	"name"=>"year_filter",
	"class"=>"date_selectBoxClass",
	"options"=>$years_list,
	"empty"=>__('-All-',true),
	"value"=>"all",
	'escape'=>false,
	"onchange"=>"check_year_selection(this);"
	)); ?>
</div>
<div class="floatClass search_field_element" style="display: none;"  id="month_container">
	<label class="floatClass field_title "><?=__('By Month',true)?></label>
	<?php
	 echo $this->form->input("month",
	array(
	"label"=>false,
	"id"=>"month_filter",
	"name"=>"month_filter",
	"class"=>"date_selectBoxClass",
	"options"=>$month_list,
	"empty"=>__('-All-',true),
	"value"=>"",
	'escape'=>false,
	)); ?>
</div>

<script type="text/javascript">


$(document).ready(function(){
	 $('.date_selectBoxClass').customSelect();

		
});

</script>