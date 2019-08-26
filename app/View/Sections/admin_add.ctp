<div class="row-fluid">


<style>
	.form-horizontal .control-label{
		margin-right: 10px;
	}
	.cke_chrome {
		margin-left: 170px;
	}
</style>


<form type='file'  enctype="multipart/form-data"    id="PageForm" class="form-horizontal" accept-charset="utf-8" method="post" action="/admin/<?=$controllerName?>/add/<?=$section?>" novalidate="novalidate">
	<input type="hidden" name="data[Section][hashed_id]" value="<?=$hashed_id?>" />
	
	
<?php //echo $this->Form->input('hashed_id', array( 'value' => $hashed_id  , 'type' => 'hidden') ); ?>

   <div style=" margin-left:-1px;" class="span12">
    <div class="box">
        <div class="box-title">
            <h3 ><i class="icon-reorder"></i>Add <?=$page_title?> | <?php echo $this->element('admin/lang-toggle',array('languages'=>$languages)); ?></h3>
            <ul  style="margin-top:6px;" class="nav nav-tabs">
                <li class="active"><a href="#tab-1-1" data-toggle="tab">Main Data</a></li>
                <li><a href="#tab-1-2" data-toggle="tab">SEO</a></li>
               
            </ul>
        </div>

        <div class="box-content">
       
            <div class="tab-content">
			<div class="tab-pane active" id="tab-1-1">
				
			<?php 
			if($section == 'articles' ||$section == 'videos'){
				echo $this->element("/admin/videos/upload_one_file",array("modelName"=>$modelName ));			
			}
			?>
			
			
			
			<div class="control-group">
				<label class="control-label" for="JobPublish">Visible</label>
				<div class="input_div" id="visibleRadio">
					<input type="radio" id="option0" name="data[<?php echo $modelName;?>][visible]" value="1"  checked="checked"  /><label for="option0">YES</label>
					<input type="radio" id="option1" name="data[<?php echo $modelName;?>][visible]" value="0" /><label for="option1">NO</label>
				</div>
			</div>
			
			<?php 
			if($section != 'videos' && $section != 'get_here' && $section != 'opening_hours'){?>
			
			<div class="control-group">
				<label class="control-label" for="JobPublish"> Date</label>
				<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.date",array('class'=>'required', 'type'=>'text','id'=>'start_date' , 'escape' => false,'label'=>false));?></div>
			</div>
			<?php } ?>
			
			
			
			
			
			<?php 
			
			//print_R($languages);exit;
			foreach($languages as $config){
				$local=$config['Language']['locale'];
				$language=$config['Language']['language'];
				$direction=$config['Language']['direction'];
				$code=$config['Language']['code'];
				
				 ?>
			
			<span class="language <?php echo $code; ?>">
			
			<?php
			if($section != 'videos'){
			 echo $this->element("/admin/images/upload_one_image_locale",array("preferred_size"=>$preferred_size , "modelName"=>$modelName ,"local"=>$local));	
			}
			?>
			<?php 
			if($section == 'articles'){
				echo $this->element("/admin/files/upload_one_file_local",array("userFilesFolder"=>$userFilesFolder , "modelName"=>$modelName ,"local"=>$local));			
			}
			?>	
			
			
			
			
			
			<?php echo $this->Form->input("$modelName.title.".$local,array( 'class'=>'input-xlarge','dir'=>$direction,
					'style'=>'margin-bottom:20px',
					'label' => array(
			        'class' => 'control-label',
			        'text' => 'Title ('.$language.')'
			    )));?> 
			<?php echo $this->Form->input("$modelName.text_1.".$local,array('id'=>'content_'.$local,'class'=>'input-xlarge','type'=>'textarea',
					'style'=>'margin-bottom:20px',
					'label' => array(
			        'class' => 'control-label',
			        'text' => 'Content ('.$language.')'
			    )));?> 
			
			        <?php echo $this->Ck->load('content_'.$local,$code); ?>
			</span> 
			                     
			<?php } ?>    
			
			
			
			                                  
			
			<span id='databoxes'>
			
			</span>                                                            
			                                  
			                                  
			                                  
			</div>
			<div class="tab-pane" id="tab-1-2">
			<!-- seo eng fields -->
			
			<?php 
			if( $section != 'get_here'){
			echo $this->element('admin/seo-fields',array('languages'=>$languages,'model'=>"$modelName" ,"fieldId"=>''));
			}
			
			 ?>  
			 
			                                 
			
			<!-- end seo ar feilds  -->
			</div>

                       
            </div>
        </div>
    </div>
</div>



<!-- <input type="hidden" name="data[Section][hashed_id]" value="<?=$hashed_id?>" /> -->
<?php 
	if($section == 'articles'){
		
	?>
	
	
	<br />
<?php echo $this->element('admin/media/media',array("userFilesFolder"=>'images')); ?>


<script>
	var resizeModule = '<?=$modelName?>';
	var resizeType = 'default';
	var hashed_id = '<?php echo $hashed_id; ?>';
	var userFilesFolder = 'images';
	
</script>
<script src="/js/admin/media.js?<?php echo rand(); ?>"></script>





	
	<?php 	
		
		
	}
?>




 <div  class="form-actions">                                    
  <input id='save' style="margin-top:20px;" type="submit" class="btn btn-primary" value="Save">
</div>
 </form>
                    
</div>


<script type="text/javascript">
$(document).ready(function(){
    $("#PageForm").validate();
    
    
    /*tabs*/
    // $(".fields_lang_tabs").tabs(".fields_lang_panes > div",{effect: 'fade'});
    // $(".page_types_tabs").tabs(".page_types_panes > div",{effect: 'fade'});
    // $(".lang_page_type_tabs").tabs(".lang_page_type_panes > div",{effect: 'fade'});
    /*end tabs*/
 	$("#newInRadio").buttonset();
 	$("#visibleRadio").buttonset();
 	$("#fbRadio").buttonset();
 	$("#push_notificationRadio").buttonset();
 	
   /*datepicker*/
	$("#start_date").datepicker({ changeYear: true, dateFormat: 'yy-mm-dd'});
	
	/*end datepicker*/
    
});
</script>
