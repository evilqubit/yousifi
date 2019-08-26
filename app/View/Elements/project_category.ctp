
<div class="floatClass tabsContainer">
		<?php if(isset($category_list) && !empty($category_list)){?>
			<div class="floatClass" >
				<?php
				
				$empty=__('All Categories',false);
				//print_r($empty);exit;
				 echo $this->form->input("project_category_id",
				array(
				"label"=>false,
				"id"=>"category_filter",
				'name'=>'category_filter',
				"class"=>"category_filter",
				"options"=>$category_list,
				"empty"=>$empty,
				"value"=>"$cat_id",
				"onchange"=>"change_categ('$lang');",
				'escape'=>false
				)); ?>
				
			</div>
		<?php } ?>
		<div class="floatClass ajaxLoader"><img src="/img/ajax-loader.gif" width="20px" height="20px" alt=""></div>
</div>






<script type="text/javascript">
$(document).ready(function(){
	  
	
});

</script>