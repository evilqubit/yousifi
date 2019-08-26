
<div class="floatClass search_container">
	
	<div class="search_header_container">
		<div class="floatClass search_header"><?__('Advanced Search',true)?></div>
		<div class="floatRevClass album_CloseBtn"  onclick="$('#photoOverlay').overlay().close();"></div>
	</div>
	
	<?php
	$section_list=array('all'=>"All",'News'=>'News','Job'=>'Jobs');
	if(isset($lang2))	
		$lang = $lang2;

	$val_search=__('search_val',true);
	$val_search_id = "SearchInputId";
	?>
	<?php echo $this->form->create("Page",array("url"=>array("controller"=>"Pages","action"=>"search"))); ?>
	
	
	<div class="floatClass" >
		<?php echo $this->form->input("collection_id",
		array(
		"label"=>false,
		"id"=>"section_filter",
		"name"=>"section_filter",
		"class"=>"selectBoxClass",
		"options"=>$section_list,
		"empty"=>__('-All-',true),
		"value"=>"all",
		'escape'=>false,
		"onchange"=>"change_shoes_bags_collection('/$lang/SeoManagement/get_selected_slug/brand/','$locale',this,'$lang')")); ?>
	</div>
	
	<div class="floatClass" id="date_section"></div>
	
			
	<div class="floatClass">
			
		<?php 
		echo $this->form->input("search_text",
		array(
		 "escape"=>false,
		 "label"=>false,
		 "class"=>"search_text_area floatClass",
		 'id'=>$val_search_id ,
		 "onfocus"=>"change_default('$val_search_id','$val_search',this.value,false);",
		 "onblur"=>"change_default('$val_search_id','$val_search',this.value,true);",
		 "value"=>$val_search));?>
	
	</div>
	
	<div class="submit floatClass search_area_button"><input type="image" src="/img/<?php echo $lang;?>/search.png" name="image" ></div>
	     
	<?php echo $this->form->end();?>
</div>



<script type="text/javascript">


$(document).ready(function(){
	 $('.selectBoxClass').customSelect();

		
});

</script>