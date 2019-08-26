<div style="float:left;clear:both;margin-bottom:20px; width: 100%">
<div class="lang_bar" style="cursor: pointer;" onclick="toggelSeo();">SEO Management <div class="FloatClass seo_arrow_down" id="seo_arrow"></div></div>

<?php if($modelName == "SeoManagement")
	$display = "block";
else $display = "none";
?>
<div class="FloatClass" style="width:100%;display:<?php echo $display;?>" id="seo_box">
	<!--here goes the languages tabs for all the page types fields-->
		<div class="fields_lang_tabs">
			<?php foreach ($languages as $l){ 
			    $language=$l['Language']["language"];
			     $locale=$l['Language']["locale"];
				 

			?>
			<span><a href="#<?=$locale?>"><?php echo $language;?></a></span>
			<?php }?>
		</div>
		<!--end-->
		<!--here goes the multilingual fields form inputs for all the page types-->
		<div class="fields_lang_panes" style="margin-bottom:20px;">
			<?php
		 	foreach ($languages as $l){ 
			    $language=$l['Language']["language"];
		        $code=$l['Language']["code"];
		        $lang_id=$l['Language']["id"];
		        $locale=$l['Language']["locale"];
		        $dir=$l['Language']['direction'];
		        if($lang_id==1)	$required="required";
		        else	$required="input_field";
				
				
				
		    ?>
		    <div class="fields_lang_pane" >
			<?php 
			if (!isset($dir)) $dir = "ltr";
			if($locale == "eng"){
				echo $this->Form->input("SeoManagement.model_name",array('value'=>$modelName,'type'=>'hidden'));
				echo $this->Form->input("SeoManagement.field_id",array('value'=>$fieldId,'type'=>'hidden'));
				
				if(isset($this->request->data["SeoManagement"]["id"]) && !empty($this->request->data["SeoManagement"]["id"])){
					echo $this->Form->input("SeoManagement.id",array('value'=>$this->request->data["SeoManagement"]["id"],'type'=>'hidden'));
				}
			}
			
			?>
			<div class="input_row">
				<div class="label">Slug</div>
				<div class="input_div"><?php echo $this->Form->input("SeoManagement.slug.$locale",array('label'=>false,'class'=>'input_field','type'=>'text',"dir"=>$dir));?></div>
			</div>
			<div class="input_row">
				<div class="label">Prepend Title</div>
				<div class="input_div"><?php echo $this->Form->input("SeoManagement.prepend_title.$locale",array('label'=>false,'class'=>'input_field','type'=>'text',"dir"=>$dir));?></div>
			</div>
			<div class="input_row">
				<div class="label">Append Title</div>
				<div class="input_div"><?php echo $this->Form->input("SeoManagement.append_title.$locale",array('label'=>false,'class'=>'input_field','type'=>'text',"dir"=>$dir));?></div>
			</div>
			<div class="input_row">
				<div class="label">Meta Title</div>
				<div class="input_div"><?php echo $this->Form->input("SeoManagement.title.$locale",array('label'=>false,'class'=>'input_field','style'=>'height:14px;','type'=>'text',"dir"=>$dir));?></div>
			</div>
			<?php
			if(isset($this->request->data["SeoManagement"]["keywords"][$locale])){
				$this->request->data["SeoManagement"]["keywords"][$locale] = str_ireplace("\\n","\n",$this->request->data["SeoManagement"]["keywords"][$locale]);
				$this->request->data["SeoManagement"]["keywords"][$locale] = str_ireplace("\\","",$this->request->data["SeoManagement"]["keywords"][$locale]);
			}else{
				$this->request->data["SeoManagement"]["keywords"][$locale] = "";
			}
			?>
			<div class="input_row">
				<div class="label">Meta Keywords</div>
				<div class="input_div"><?php echo $this->Form->input("SeoManagement.keywords.$locale",array('label'=>false,'class'=>'input_field','type'=>'textarea','value'=>$this->request->data["SeoManagement"]["keywords"][$locale],"dir"=>$dir));?></div>
			</div>
			<?php
			if(isset($this->request->data["SeoManagement"]["description"][$locale])){
				$this->request->data["SeoManagement"]["description"][$locale] = str_ireplace("\\n","\n",$this->request->data["SeoManagement"]["description"][$locale]);
				$this->request->data["SeoManagement"]["description"][$locale] = str_ireplace("\\","",$this->request->data["SeoManagement"]["description"][$locale]);
			}else{
				$this->request->data["SeoManagement"]["description"][$locale] = "";
			}
			?>
			<div class="input_row">
				<div class="label">Meta Description</div>
				<div class="input_div"><?php echo $this->Form->input("SeoManagement.description.$locale",array('label'=>false,'class'=>'input_field','type'=>'textarea','value'=>$this->request->data["SeoManagement"]["description"][$locale],"dir"=>$dir));?></div>
			</div>
			
			</div>
			<?php }?>
		</div>
		<!--end-->
	</div>
</div>