<div class="row-fluid">


<style>
	.form-horizontal .control-label{
		margin-right: 10px;
	}
	.cke_chrome {
		margin-left: 170px;
	}
</style>

<form   type='file'  enctype="multipart/form-data"  id="<?=$modelName?>AdminAddForm" class="form-horizontal" accept-charset="utf-8" method="post" action="/admin/<?=$controllerName?>/edit_section/<?=$section?>" novalidate="novalidate">
	
	
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
					<label class="control-label" for="JobPublish">URL</label>
					<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.url_1",array('type'=>'text', 'escape' => false,'label'=>false));?></div>
				</div>
				
				
				<!-- image 1  -->
				<div class="control-group">
					<label class="control-label" for="JobPublish">Image</label>
						<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.image",array('label'=>false,"type"=>"file","size"=>"43"));?>
							<div> Preferred size : <?=$preferred_size?></div>
							<div class="clear_btn input_row" onclick="clear_img_path(this);">Clear Image Path</div>
						</div>
					
					<?php if(isset($this->request->data[$modelName]["image"]) && !empty($this->request->data[$modelName]["image"])){ ?>
						<div class="input_row " style='float:left' >
							<div class="label">Chosen Image</div>
							<div class="input_div"><a href="/files/<?=$userFilesFolder?>/original/<?php echo $this->request->data["$modelName"]["image"];?>" class='lightbox' ><img src="/files/<?=$userFilesFolder?>/thumb/<?php echo $this->request->data["$modelName"]["image"];?>" alt="" border="0" /></a></div>		
						</div>
					<?php } ?>
	       		</div>	
	       		
	       		
			
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
			
			if($section == 'explore_overview' || $section =='enjoy_static_banner'){
				echo $this->form->input("$modelName.title.".$local,array( 'class'=>'input-xlarge','dir'=>$direction,
						'style'=>'margin-bottom:20px',
						'label' => array(
				        'class' => 'control-label',
				        'text' => 'Title ('.$language.')'
				    )));
			    
			}
			    ?> 
			    
			    
			    <?php 
			    // if($section == 'test'){
				    // echo $this->form->input("$modelName.internal_title.".$local,array( 'class'=>'input-xlarge','dir'=>$direction,
						// 'style'=>'margin-bottom:20px',
						// 'label' => array(
				        // 'class' => 'control-label',
				        // 'text' => 'Title ('.$language.')'
				    // )));
// 			    
			    // }
			    ?> 
			<?php 
			
			if ($section == 'explore_overview' || $section == 'enjoy_static_banner' ){
			echo $this->Form->input("$modelName.text.".$local,array('id'=>'content_'.$local,'class'=>'input-xlarge','type'=>'textarea',
					'style'=>'margin-bottom:20px',
					'label' => array(
			        'class' => 'control-label',
			        'text' => 'First Content  ('.$language.')'
			    )));
			    echo $this->Ck->load('content_'.$local,$code); 
			} 
  
			    ?>
			</span> 
			                     
			<?php } ?>    

			<span id='databoxes'>
			
			</span>                                                            
			                                  
			                                  
			                                  
			</div>
			<div class="tab-pane" id="tab-1-2">
			<!-- seo eng fields -->
			
			<?php //echo $this->element('admin/seo-fields',array('languages'=>$languages,'model'=>"SeoManagement" , "modelName"=>$modelName, "fieldId"=>$id)); ?>  
			                                      
			
			<!-- end seo ar feilds  -->
			</div>

                       
            </div>
        </div>
    </div>
</div>
 
 

<?php 



?>

	

	
	
 <div  class="form-actions">                                    
  <input id='save' style="margin-top:20px;" type="submit" class="btn btn-primary" value="Save">
</div>
 </form>
                    
                </div>
<?php //echo $this->element('Admin/media'); ?>



