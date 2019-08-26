<div class="maintitle"><?php echo $page_title;?></div>
<div class="subtitle">Add <?php echo $page_sub_title;?></div>
<?php //echo $this->element("admin/breadCrumb") ?>


<?php echo $this->form->create("$modelName",array('type'=>'file','url'=>array('controller'=>"$controllerName",'action'=>'admin_add'),'id'=>'PageForm'));?>


<!-- <div class="input_row">
	<div class="label">Visible</div>
	<div class="input_div" id="visibleRadio">
		<input type="radio" id="option0" name="data[<?php echo $modelName;?>][visible]" value="1"  checked="checked"  /><label for="option0">YES</label>
		<input type="radio" id="option1" name="data[<?php echo $modelName;?>][visible]" value="0" /><label for="option1">NO</label>
	</div>
</div>

<div class="input_row">
	<div class="label">Show News on Homepage</div>
	<div class="input_div" id="newInRadio">
		<input type="radio" id="option3" name="data[<?php echo $modelName;?>][homepage]" value="1"  /><label for="option3">YES</label>
		<input type="radio" id="option4" name="data[<?php echo $modelName;?>][homepage]" value="0" checked="checked"  /><label for="option4">NO</label>
	</div>
</div>

<div class="input_row" >
	<div class="label">Date</div>
	<div class="input_div"><?php echo $this->form->input("$modelName.date",array('label'=>false,"type"=>"text","id"=>"news_date","class"=>"input_field","value"=>date("Y-m-d")));?></div>
</div>

<div class="input_row" >
	<div class="label">Image</div>
	<div class="input_div"><?php echo $this->form->input("$modelName.image",array('label'=>false,"type"=>"file","size"=>"43"));?>Preferred Size 266x448 (pixels)
		<div class="clear_btn input_row" onclick="clear_img_path(this);">Clear Image Path</div>
	</div>
</div> -->



	    
<div class="fields_lang_pane">
	<!-- <div class="input_row">
		<div class="label">Name</div>
		<div class="input_div"><?php echo $this->form->input("$modelName.name",array('label'=>false,'class'=>"required"));?></div>
	</div> -->
	<div class="input_row">
		<div class="label">Email</div>
		<div class="input_div"><?php echo $this->form->input("$modelName.email",array('label'=>false,'class'=>"required email email_duplicate"));?></div>
	</div>
	<!-- <div class="input_row">
		<div class="label">User Name</div>
		<div class="input_div"><?php echo $this->form->input("$modelName.username",array('label'=>false,'class'=>"$required","dir"=>"$dir"));?></div>
	</div> -->
	
	<div class="input_row">
		<div class="label">Password</div>
		<div class="input_div"><?php echo $this->form->input("$modelName.password",array('label'=>false, 'type'=>'password', 'class'=>"required" ,'value'=>'','empty'=>'','autocomplete'=>"off"));?></div>
	</div>

	
</div>




<?php //echo $this->element("admin/seo_box",array("locale"=>$locale,"modelName"=>"$modelName","fieldId"=>0,"dir"=>$dir)); ?>

<div class="input_row">
	<div class="submit_div"><?php echo $this->form->submit('Save',array('class'=>'submit_btn'));?>
</div>
<?php echo $this->form->end();?>

<script type="text/javascript">


// var email_status='';
// function validation(){
	// var text='<?=__('This email already exist , please try another email ',true)?>';
	// jQuery.validator.addMethod("email_duplicate", function(value, element) {
// 
// 		
		// $.ajax({
		// url: '/admin/Users/check_user_email_duplicate/'+value,
		// beforeSend:function(data){
			// $('#ajaxLoader').show();
		// },
		// success: function(data){
// 			
			// if(data == 1){
				// email_status = false;
			// }else{
// 				
				// email_status =true;
			// }
// 
		// },
		// complete: function(){
			// $('#ajaxLoader').hide();
		// }
		// });
// 		
		// return email_status;
	// }, text );
// 	
	// return $('#PageForm').valid();
// }



function check_emial_address(){
	
	var validate=validation();
	
	if(validate == true){
		return true;
	}else{
		return false;
	}
	//return false;
}


$(document).ready(function(){
    $("#PageForm").validate();
    
    
    /*tabs*/
    $(".fields_lang_tabs").tabs(".fields_lang_panes > div",{effect: 'fade'});
    $(".page_types_tabs").tabs(".page_types_panes > div",{effect: 'fade'});
    $(".lang_page_type_tabs").tabs(".lang_page_type_panes > div",{effect: 'fade'});
    /*end tabs*/
 	$("#newInRadio").buttonset();
 	$("#visibleRadio").buttonset();
 	
 	
   /*datepicker*/
	$("#news_date").datepicker({ changeYear: true, dateFormat: 'yy-mm-dd'});
	/*end datepicker*/
    
});
</script>