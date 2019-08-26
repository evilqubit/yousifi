
<div class="row-fluid">


<style>
	.form-horizontal .control-label{
		margin-right: 10px;
	}
	.cke_chrome {
		margin-left: 170px;
	}
</style>


<form type='file'  enctype="multipart/form-data"    id="PageForm" class="form-horizontal" accept-charset="utf-8" method="post" action="/admin/<?=$controllerName?>/edit_section/<?=$section?>" novalidate="novalidate">
		



	
<?php //echo $this->Form->input('hashed_id', array( 'value' => $hashed_id  , 'type' => 'hidden') ); ?>

   <div style=" margin-left:-1px;" class="span12">
    <div class="box">
        <div class="box-title">
            <h3 ><i class="icon-reorder"></i>Edit <?=$page_title?> | <?php echo $this->element('admin/lang-toggle',array('languages'=>$languages)); ?></h3>
            <ul  style="margin-top:6px;" class="nav nav-tabs">
                <li class="active"><a href="#tab-1-1" data-toggle="tab">Main Data</a></li>
                <li><a href="#tab-1-2" data-toggle="tab">SEO</a></li>
               
            </ul>
        </div>

        <div class="box-content">
       
            <div class="tab-content">
			<div class="tab-pane active" id="tab-1-1">
				
			
			
			
			
			
			
			<?php if($section == 'careers' || $section == 'contact'){ ?>
				<div class="control-group"  id="page_url">
					<label class="control-label" for="JobPublish"> Notification Email Address</label>
					<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.email",array('class'=>'email',   'type'=>'text','id'=>'' , 'escape' => false,'label'=>false));?></div>
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
			
			if($section == 'contact'){
				 echo $this->Form->input("$modelName.short.".$local,array('id'=>'summary_'.$local,'class'=>'input-xlarge','type'=>'textarea',
						'style'=>'margin-bottom:20px',
						'label' => array(
				        'class' => 'control-label',
				        'text' => 'Footer Content ('.$language.')'
				    )));
			    	echo $this->Ck->load('summary_'.$local,$direction);
			}   
			 ?> 
			 <?php if($section == 'contact'){ ?>
				<div class="control-group"  id="page_url">
					<label class="control-label" for="JobPublish"> Footer Email Address</label>
					<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.footer_email",array('class'=>'email',   'type'=>'text','id'=>'' , 'escape' => false,'label'=>false));?></div>
				</div>
			 <?php } ?>
			
			 <?php //echo $this->Ck->load('content_'.$local,$direction); ?>
			<?php echo $this->Form->input("$modelName.text.".$local,array('id'=>'content_'.$local,'class'=>'input-xlarge','type'=>'textarea',
					'style'=>'margin-bottom:20px',
					'label' => array(
			        'class' => 'control-label',
			        'text' => 'Content ('.$language.')'
			    )));?> 
			
			 <?php echo $this->Ck->load('content_'.$local,$direction); ?>
			</span> 
			                     
			<?php } ?>    
			
			
			
			                                  
			
			<span id='databoxes'>
			
			</span>                                                            
			                                  
			                                  
			                                  
			</div>
			<div class="tab-pane" id="tab-1-2">			
			<?php echo $this->element('admin/seo-fields',array('languages'=>$languages,'model'=>"$modelName" ,"fieldId"=>$id));?>  			 
			</div>

                       
            </div>
        </div>
    </div>
</div>




<?php //echo $this->element('admin/media/media'); ?>


<!-- <script>
	var resizeModule = '<?=$modelName?>';
	var resizeType = 'default';
	var hashed_id = '<?php echo $hashed_id; ?>';	
</script>
<script src="/js/admin/media.js?<?php echo rand(); ?>"></script> -->


<!-- <input type="hidden" name="data[Section][hashed_id]" value="<?=$hashed_id?>" /> -->
<?php 
	
		//echo $this->element("/admin/section_upload_images",array("model_name"=>$modelName,"section"=>$section , "type"=>'default','hash_code'=>$hashed_id ,"preferred_size"=>$preferred_size ,"userFilesFolder"=>$userFilesFolder)); 
	
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
 	$("#showOnHomePgaeRadio").buttonset();
 	
   /*datepicker*/
	$("#start_date").datepicker({ changeYear: true, dateFormat: 'yy-mm-dd'});
	
	/*end datepicker*/
    
});
</script>





