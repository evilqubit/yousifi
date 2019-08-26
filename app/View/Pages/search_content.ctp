
<div class="floatClass search_container">
	
	<div class="search_header_container">
		<div class="floatClass search_header"><?=__('Advanced Search',true)?></div>
		<div class="floatRevClass search_close_btn"  onclick="$('#photoOverlay').overlay().close();"></div>
	</div>
	<div class="floatClass search_options_container">
		<div class="floatClass search_top_title"><?=__('Select one or more criteria',true);?></div>
		<div class="floatClass select_container">
			<?php
			$all=__('-All-',true);
			$news=__('News',true);
			$jobs=__('Jobs',true);
			$section_list=array('all'=>"$all", 'News'=>"$news",'Job'=>"$jobs");
			if(isset($lang))	
				$lang = $lang;
		
			$val_search=__('keywords',true);
			$val_search_id = "SearchInputId";
			$send=__('search',true);
			?>
			<?php echo $this->form->create("Page",array("url"=>array("controller"=>"Pages","action"=>"search"),"id"=>"searchForm")); ?>
			
			
			<div class="floatClass search_field_element" >
				<label class="floatClass field_title "><?=__('include',true)?></label>
				<?php echo $this->form->input("section_filter",
				array(
				"label"=>false,
				"id"=>"section_filter",
				"name"=>"section_filter",
				"class"=>"selectBoxClass",
				"options"=>$section_list,
				//"empty"=>__('-All-',true),
				'value'=>'all',
				'escape'=>false,
				"onchange"=>"get_year_month_container(this ,'$lang')")); ?>
			</div>
			
			<div class="floatClass" id="date_section"></div>
			
					
			<div class="floatClass search_field_element">
				<label class="floatClass field_title "><?=__('By Keyword(s)',true)?></label>
				<div style="width: 204px;" class="floatClass">
				<?php 
				echo $this->form->input("search_text",
				array(
				 "escape"=>false,
				 "label"=>false,
				 "class"=>"search_text_area floatClass defaultInvalid",
				 'id'=>$val_search_id ,
				 "name"=>"search_text",
				 "onfocus"=>"change_default('$val_search_id','$val_search',this.value,false);",
				 "onblur"=>"change_default('$val_search_id','$val_search',this.value,true);",
				 "value"=>$val_search));?>
				</div>
			</div>
			<div class="floatClass search_field_element">
				<label class="floatClass field_title " style="padding-top: 0px;"><?=__('includes',true)?></label>
				<?php 
				echo $this->form->input("images",
				array(
				 "escape"=>false,
				 "label"=>'Image',
				 "name"=>"images",
				 "type"=>"checkbox",
				 "class"=>"floatClass"
				 ));?>
				 <?php 
				echo $this->form->input("videos",
				array(
				 "escape"=>false,
				 "label"=>'Videos',
				 "name"=>"videos",
				 "type"=>"checkbox",
				 "class"=>"floatClass"
				 ));?>
			
			</div>
			<div class="floatRevClass"><?php echo $this->form->input($send, array('class'=>'search_area_button floatRevClass' , 'type'=>'submit' ,'label'=>false , 'escape'=>false));  ?></div>
		</div>
		
		<!-- <div class="submit floatClass search_area_button"><input type="image" src="/img/<?php echo $lang;?>/search.png" name="image" ></div> -->
	</div>
	
	     
	<?php echo $this->form->end();?>
</div>



<script type="text/javascript">
function validation(){
	var text='<?=__('This field is required',true)?>';
	jQuery.validator.addMethod("defaultInvalid", function(value, element) {
		return value != element.defaultValue;
	}, text );
	
	return $('#searchForm').valid();
}
	
	
$(document).ready(function() {
	
	$('.selectBoxClass').customSelect();
	
	$("#searchForm").submit(function (e) {
	    var valid = validation();
					if (valid == 1){
						return true;
					}
					else{
						 e.preventDefault();
					}
	});
});	
</script>
