
<div class="floatClass search_container">
	<?php
	

	
	$main_default_search_text=__('search_val',true);
	if(isset($main_search_text) && !empty($main_search_text)){
		
	}else{
		$main_search_text=$main_default_search_text;
	}
	
	$val_search_id = "SearchInputId";
	?>
	<?php echo $this->form->create("Page",array("url"=>array("controller"=>"Pages","action"=>"search") , 'id'=>'main_search')); ?>

			
	<div class="floatClass">			
		<?php 
		echo $this->form->input("search_text",
		array(
		 "escape"=>false,
		 "label"=>false,
		 "class"=>"main_search_text_area floatClass",
		 'id'=>$val_search_id,
		 
		 "onfocus"=>"change_default('$val_search_id','$main_search_text',this.value,false);",
		 "onblur"=>"change_default('$val_search_id','$main_search_text',this.value,true);",
		 "value"=>$main_search_text));?>
	
	</div>
	
	<div class="submit floatClass"><input class="search_area_button"  value="" type="submit" /> </div>
	     
	<?php echo $this->form->end();?>
</div>



<script type="text/javascript">


$(document).ready(function(){
	 
		$('#main_search').submit(function() {
		 	MainSearchInputId_text=$("#SearchInputId").val();
		 	default_text='<?=$main_default_search_text?>';
		 	if(MainSearchInputId_text == default_text){
		 		$("#SearchInputId").val('');
		 	}
		});
});

</script>