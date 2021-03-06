<div class="maintitle"><?php echo $page_title;?></div>
<div class="subtitle">Edit <?php echo $page_sub_title;?></div>


<?php echo $this->form->create("$modelName",array('type'=>'file','url'=>array('controller'=>"$controllerName",'action'=>'admin_edit',$section),'id'=>'PageForm'));?>






<div id="common_fields" style="float:left;clear:both;margin-top:20px;">
	<!--here goes the languages tabs for all the page types fields-->
	<div class="fields_lang_tabs">
		<?php foreach ($languages as $l){ 
		    $language=$l['Language']["language"];
	    ?>
			<span><a href="#"><?php echo $language;?></a></span>
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
	    
	    <div class="fields_lang_pane">
	    	<div class="input_row" style="clear:both">
				<div class="label">title</div>
				<div class="input_div"><?php echo $this->form->input("$modelName.title.$locale",array('label'=>false,'class'=>"$required","dir"=>"$dir"));?></div>
			</div>
			
			
		</div>
		<?php }?>
	</div>
	<!--end-->
</div>


<div class="input_row">
	<div class="submit_div"><?php echo $this->form->submit('Save',array('class'=>'submit_btn'));?>
</div>
<?php echo $this->form->end();?>

<script type="text/javascript">
$(document).ready(function(){
    $("#PageForm").validate();
    
    
    /*tabs*/
    $(".fields_lang_tabs").tabs(".fields_lang_panes > div",{effect: 'fade'});
    $(".page_types_tabs").tabs(".page_types_panes > div",{effect: 'fade'});
    $(".lang_page_type_tabs").tabs(".lang_page_type_panes > div",{effect: 'fade'});
    /*end tabs*/
 	$("#newInRadio").buttonset();
 	$("#visibleRadio").buttonset();
 	$("#fbRadio").buttonset();
 	
 	
   /*datepicker*/
	$("#news_date").datepicker({ changeYear: true, dateFormat: 'yy-mm-dd'});
	/*end datepicker*/
    
});
</script>