
<?php 
	$checked0='checked="checked"';
	$checked1='';
	$display="display: none;";
	$type='';
	if(isset($this->request->data["Banner"]['type'])){
		if($this->request->data["Banner"]['type'] == 1){
			$checked0='checked="checked"';
			$checked1='';
			$type='Dynamic';
			
		}elseif($this->request->data["Banner"]['type'] == 0){
			$checked0='';
			$checked1='checked="checked"';
			$type='Static';
		}
	}
?>
	
	
<div class="control-group">
	<label class="control-label" for="JobPublish">Type</label>
	<div class="input_div" id="typeRadio">
		<input type="radio" onchange="update_mobile_banner_type('Dynamic')" id="option10" name="data[Banner][type]" value="1"  <?=$checked0?>  /><label for="option10">Dynamic</label>
		<input type="radio" onchange="update_mobile_banner_type('Static')" id="option11" name="data[Banner][type]" value="0" <?=$checked1?>  /><label for="option11">Static</label>
	</div>
</div>
				
<div class="control-group" id="static_section" style="display: none;">
	<label class="control-label" for="JobPublish">Main Section</label>
	<div class="input_div" style='float:left' >		
		<?php
		$value=0;
		if(isset($this->request->data['Banner']['shop_main_category'])){
			$value=$this->request->data['Banner']['shop_main_category'];
		}
		 echo $this->Form->input("Banner.shop_main_static_category",array(	
		'value'=>$value,
		'label'=>false, 'options'=>$mobile_main_static_sections));?>
	</div>
	<div class="mobileAjaxLoader" style="display: none;"><img src="/img/ajax-loader.gif" width="20" height="20" /></div>
</div>				



<div class="control-group" id="dynamic_section">
	<label class="control-label" for="JobPublish">Main Section</label>
	<div class="input_div" style='float:left' >		
		<?php
		$value=0;
		if(isset($this->request->data['Banner']['shop_main_category'])){
			$value=$this->request->data['Banner']['shop_main_category'];
		}
		 echo $this->Form->input("Banner.shop_main_category",array(
		 'value'=>$value,
		'onchange'=>'udpate_main_section()','id'=>'shop_main_category',
		'label'=>false, 'options'=>$mobile_main_sections));?>
	</div>
	<div class="mobileAjaxLoader" style="display: none;"><img src="/img/ajax-loader.gif" width="20" height="20" /></div>
</div>

<div id="sub_category"></div>
<div id="shop_list"></div>

<?php
		$shop_sub_category_id=0;
		if(isset($this->request->data['Banner']['shop_sub_category'])){
			$shop_sub_category_id=$this->request->data['Banner']['shop_sub_category'];
		}
		
		$shop_id=0;
		if(isset($this->request->data['Banner']['shop_id'])){
			$shop_id=$this->request->data['Banner']['shop_id'];
		}
		
	?>

<script type="text/javascript">	
	$("#typeRadio").buttonset();

	$(document).ready(function (){
		udpate_main_section('<?=$shop_sub_category_id?>' , '<?=$shop_id?>');		
		update_mobile_banner_type("<?=$type?>");
		
		
	});
	
</script>