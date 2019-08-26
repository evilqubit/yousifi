<div class="control-group" id="dynamic_section">
	<label class="control-label" for="JobPublish">Section</label>
	<div class="input_div" style='float:left' >		
		<?php
		$value=0;
		if(isset($this->request->data["$modelName"]['section_id'])){
			$value=$this->request->data["$modelName"]['section_id'];
		}
		 echo $this->Form->input("$modelName.section_id",array(
		 'value'=>$value,		
		'label'=>false, 'options'=>$sections));?>
	</div>
	<div class="mobileAjaxLoader" style="display: none;"><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
</div>