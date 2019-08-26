				



<div class="control-group" id="dynamic_section">
	<label class="control-label" for="JobPublish">Main Section</label>
	<div class="input_div" style='float:left' >		
		<?php
		$value=0;
		if(isset($this->request->data["$modelName"]['section_id'])){
			$value=$this->request->data["$modelName"]['section_id'];
		}
		 echo $this->Form->input("$modelName.section_id",array(
		 'value'=>$value,
		'onchange'=>'udpate_main_section_pro()','id'=>'shop_main_category',
		'label'=>false, 'options'=>$sections_list));?>
	</div>
	<div class="mobileAjaxLoader" style="display: none;"><img src="/img/ajax-loader.gif" width="20" height="20" /></div>
</div>

<div id="sub_category"></div>
<div id="shop_list"></div>

<?php
		$category_id=0;
		if(isset($this->request->data["$modelName"]['category_id'])){			
			$category_id=$this->request->data["$modelName"]['category_id'];
		}
		
		$shop_id=0;
		if(isset($this->request->data["$modelName"]['shop_id'])){
			$shop_id=$this->request->data["$modelName"]['shop_id'];
		}
		
	?>

<script type="text/javascript">	
	$("#typeRadio").buttonset();

	$(document).ready(function (){
		udpate_main_section_pro('<?=$category_id?>' , '<?=$shop_id?>');		
		
		
		
	});
	
</script>