<div class="row-fluid">


<style>
	.form-horizontal .control-label{
		margin-right: 10px;
	}
	.cke_chrome {
		margin-left: 170px;
	}
</style>

<form id="<?=$modelName?>AdminAddForm" class="form-horizontal" accept-charset="utf-8" method="post" action="/admin/<?=$controllerName?>/upload_section_images/<?=$section?>/<?=$type?>" novalidate="novalidate">
	
	
<?php //echo $this->Form->input('hashed_id', array( 'value' => $hashed_id  , 'type' => 'hidden') ); ?>

   <div style=" margin-left:-1px;" class="span12">
    <div class="box">
        <div class="box-title">
            <h3 ><i class="icon-reorder"></i>Edit <?=$page_title?> | <?php echo $this->element('admin/lang-toggle',array('languages'=>$languages)); ?></h3>
            <ul  style="margin-top:6px;" class="nav nav-tabs">
                <li class="active"><a href="#tab-1-1" data-toggle="tab">Main Data</a></li>
                <!-- <li><a href="#tab-1-2" data-toggle="tab">SEO</a></li> -->
               
            </ul>
        </div>

        <div class="box-content">
       	
            <div class="tab-content">
			<div class="tab-pane active" id="tab-1-1">
				
				
				
				<div class="control-group">
					<label class="control-label" for="JobPublish">Image Type</label>
					<div class="input_div" style='float:left' ><?php echo $this->Form->input( "$modelName.type",array(
					'onchange'=>"update_page_image_type('$section')",
					'id'=>'section_image_type_list',
					'selected'=>$type,
					'options'=>$image_types,'escape' => false,'label'=>false));?></div>
				</div>
				
				<!-- <div  class="control-group"><a style="font-size: 18px" href="/admin/Images/index/<?=$modelName?>/<?=$section?>/<?=$type?>">Click to order the Images</a></div>
			 -->
			 
			<?php 
			
			//print_R($languages);exit;
			foreach($languages as $config){
				$local=$config['Language']['locale'];
				$language=$config['Language']['language'];
				$direction=$config['Language']['direction'];
				$code=$config['Language']['code'];
				
				 ?>
			
			<span class="language <?php echo $code; ?>">
			
			
			</span> 
			                     
			<?php } ?>    

			<span id='databoxes'>
			
			</span>                                                            
			                                  
			                                  
			                                  
			</div>
			<div class="tab-pane" id="tab-1-2">
			<!-- seo eng fields -->
			
			                                     
			
			<!-- end seo ar feilds  -->
			</div>

                       
            </div>
        </div>
    </div>
</div>
 
 
<input type="hidden" name="data[Section][hashed_id]" value="<?=$hashed_id?>" />
<?php 

	if($section == 'about' || $section =='careers'){
		echo $this->element("/admin/section_upload_images",array("model_name"=>$modelName,"section"=>$section , "type"=>$type,'hash_code'=>$hashed_id ,"preferred_size"=>$preferred_size ,"userFilesFolder"=>$userFilesFolder)); 

	}

?>

	

	
	
 <div  class="form-actions">                                    
  <input id='save' style="margin-top:20px;" type="submit" class="btn btn-primary" value="Save">
</div>
 </form>
                    
                </div>
<?php //echo $this->element('Admin/media'); ?>



