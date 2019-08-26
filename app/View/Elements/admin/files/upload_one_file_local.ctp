


<div class="control-group">
	<label class="control-label" for="JobPublish">
		<?php 
		
		$file_name='';
		if(isset($this->request->data["$modelName"]["file"]["$local"])){
			$file_name=$this->request->data["$modelName"]["file"]["$local"];
			$full_path="/files/$userFilesFolder/document/$file_name";
		}
		
		
		
		if(isset($path) ){
			$full_path="$path".$file_name;
		}
		
		$title='document';
		if(isset($language) && !empty($language)){
			$title="Document ($language)";
		}

		echo $title;
?>
		</label>

	<div class="input_div" style='float:left' >
		<?php echo $this->Form->input("$modelName.file.".$local,array(  'id'=>'current_file', 'label'=>false,"type"=>"file","size"=>"43"));?>
		<!-- <div class="clear_btn input_row" style="clear: both;" onclick="clear_img_path(this);">Clear Document Path</div> -->
	</div>
	
	

<?php if(isset($this->request->data[$modelName]["file"][$local]) && !empty($this->request->data[$modelName]["file"][$local])){ ?>
	<div class="input_row " style='float:left' >
		<div class="label">Chosen File :</div>
		<div class="input_div"><a href='<?=$full_path?>' target="_blank" ><?php echo $this->data["$modelName"]["file"]["$local"];?></a></div>		
	</div>
<?php } ?>
</div>	