


<div class="control-group">
	<label class="control-label" for="JobPublish">
		<?php 
		$title='document';

		echo $title;
?>
		</label>

	<div class="input_div" style='float:left' >
		<?php echo $this->Form->input("$modelName.epi_data",array(  'id'=>'epi_data_file', 'label'=>false,"type"=>"file","size"=>"43"));?>
		<!-- <div class="clear_btn input_row" style="clear: both;" onclick="clear_img_path(this);">Clear Document Path</div> -->
	</div>
	
	

<?php if(isset($this->request->data[$modelName]["epi_data"]) && !empty($this->request->data[$modelName]["epi_data"])){ ?>
	<div class="input_row " style='float:left' >
		<div class="label">Chosen File :</div>
		<div class="input_div"><?php echo $this->data["$modelName"]["epi_data"];?></div>		
	</div>
<?php } ?>
</div>	