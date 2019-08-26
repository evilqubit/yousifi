				



<div class="control-group" id="dynamic_section">
	<label class="control-label" for="JobPublish">Main Section</label>
	<div class="input_div" style='float:left' >		
		<?php
		$value=0;
		if(isset($this->request->data["$modelName"]['shop_main_category'])){
			$value=$this->request->data["$modelName"]['shop_main_category'];
		}
		 echo $this->Form->input("$modelName.shop_main_category",array(
		 'value'=>$value,
		'onchange'=>'udpate_main_section_pro()','id'=>'shop_main_category',
		'label'=>false, 'options'=>$mobile_main_sections));?>
	</div>
	<div class="mobileAjaxLoader" style="display: none;"><img src="/img/ajax-loader.gif" width="20" height="20" /></div>
</div>

<div id="sub_category"></div>
<div id="shop_list"></div>

<?php
		$shop_sub_category_id=0;
		if(isset($this->request->data["$modelName"]['shop_sub_category'])){
			
			$shop_sub_category_id=$this->request->data["$modelName"]['shop_sub_category'];
		}
		
		$shop_id=0;
		if(isset($this->request->data["$modelName"]['shop_id'])){
			$shop_id=$this->request->data["$modelName"]['shop_id'];
		}
		
	?>

<script type="text/javascript">	
	$("#typeRadio").buttonset();

	$(document).ready(function (){
		udpate_main_section_pro('<?=$shop_sub_category_id?>' , '<?=$shop_id?>');		
		
		
		
	});
	
</script>