<div class="row-fluid">


<style>
	.form-horizontal .control-label{
		margin-right: 10px;
	}
	.cke_chrome {
		margin-left: 170px;
	}
</style>

<form id="<?=$modelName?>AdminAddForm" class="form-horizontal" accept-charset="utf-8" method="post" action="/admin/<?=$controllerName?>/edit_section/<?=$section?>" novalidate="novalidate">
	
	
<?php //echo $this->Form->input('hashed_id', array( 'value' => $hashed_id  , 'type' => 'hidden') ); ?>

   <div style=" margin-left:-1px;" class="span12">
    <div class="box">
        <div class="box-title">
            <h3 ><i class="icon-reorder"></i>Edit <?=$page_title?> | <?php echo $this->element('admin/lang-toggle',array('languages'=>$languages)); ?></h3>
            <ul  style="margin-top:6px;" class="nav nav-tabs">
            	
            	
            	<?php  
            	
				$active_data='';
				$active_seo='';
            	
            	if($section == 'opening_hours' || $section == 'articles' ||  $section == 'videos' ) {
            		$active_seo='active';
            		?>
            		
            		<li class="active"><a href="#tab-1-2" data-toggle="tab">SEO</a></li>
            		<?php 
            	}else{
            		$active_data='active';
            		?>
            		
            		<li class="active"><a href="#tab-1-1" data-toggle="tab">Main Data</a></li>
               		 <li><a href="#tab-1-2" data-toggle="tab">SEO</a></li>
            		<?php 
            	}?>
            	
                
               
            </ul>
        </div>

        <div class="box-content">
       	
            <div class="tab-content">
			<div class="tab-pane <?=$active_data?>" id="tab-1-1">
				
				
				
				
				<?php if($section == 'careers'){
					
					?>
					<div class="control-group">
						<label class="control-label" for="JobPublish">Default email</label>
						<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.default_email",array('type'=>'text', 'escape' => false,'label'=>false));?></div>
					</div>
					<?php 
				} ?>
				
				<?php
				
				
				if($section == 'get_here' || $section == 'contact'){
					?>
					
					<div class="control-group">
						<label class="control-label" for="JobPublish">Google Map X Coordinate</label>
						<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.x_coordinate",array('type'=>'text', 'escape' => false,'label'=>false));?></div>
					</div>
					<div class="control-group">
						<label class="control-label" for="JobPublish">Google Map Y Coordinate</label>
						<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.y_coordinate",array('type'=>'text', 'escape' => false,'label'=>false));?></div>
					</div>
					<?php 
				}
				
				 ?>
				
				<!-- <?php
				if($section == 'shopping' || $section == 'beauty' || $section == 'cafes_and_restaurants'){
				
				 ?>
				
				<div class="control-group">
					<label class="control-label" for="JobPublish">User Interface Template</label>
					
					
					
					<div class="input_div" style='float:left' >
						<?php 
						
						$selected_template=$this->request->data["$modelName"]['template_id'];
						echo $this->element("/admin/user_interface_templates", array("templates"=>$templates ,"selected_template"=>$selected_template));
					
					?>
						<?php //echo $this->Form->input("$modelName.tempalte_id",array('options'=>$templates,'escape' => false,'label'=>false));?></div>
				</div>
				
				<?php } ?> -->
			
			
			
			<!-- <div class="control-group">
					<label class="control-label" for="JobPublish">Color</label>
					<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.color",array('type'=>'text', 'escape' => false,'label'=>false));?></div>
				</div> -->
				
			<?php 
			
			//print_R($languages);exit;
			foreach($languages as $config){
				$local=$config['Language']['locale'];
				$language=$config['Language']['language'];
				$direction=$config['Language']['direction'];
				$code=$config['Language']['code'];
				
				 ?>
			
			<span class="language <?php echo $code; ?>">
			
			
			
			<!-- <?php echo $this->form->input("$modelName.title.".$local,array( 'class'=>'input-xlarge','dir'=>$direction,
					'style'=>'margin-bottom:20px',
					'label' => array(
			        'class' => 'control-label',
			        'text' => 'Section Title ('.$language.')'
			    )));?> --> 
			    
			    
			
			<?php 
			
			if($section != 'overview' && $section != 'opening_hours' && $section != 'articles' && $section != 'videos' && $section != 'careers' ){
			echo $this->form->input("$modelName.internal_title.".$local,array('class'=>'input-xlarge','dir'=>$direction,
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
			
			if ($section == 'shop' || $section == 'contact' || $section == 'dine'  || $section == 'entertain'  || $section == 'privacy'  || $section == 'terms_conditions' || $section == 'home_opening_hours' || $section == 'overview' || $section =='careers'  || $section == 'services' || $section == 'get_here'){
						
					
				
			echo $this->Form->input("$modelName.text_1.".$local,array('id'=>'content_'.$local,'class'=>'input-xlarge','type'=>'textarea','dir'=>$direction,
					'style'=>'margin-bottom:20px',
					'label' => array(
			        'class' => 'control-label',
			        'text' => 'Content  ('.$language.')'
			    )));
			    echo $this->Ck->load('content_'.$local,$code); 
			} 
			
			
			if ($section == 'about'  ){
			echo $this->Form->input("$modelName.text_2.".$local,array('id'=>'content2_'.$local,'class'=>'input-xlarge','type'=>'textarea','dir'=>$direction,
					'style'=>'margin-bottom:20px',
					'label' => array(
			        'class' => 'control-label',
			        'text' => 'Second Content  ('.$language.')'
			    )));
			    echo $this->Ck->load('content2_'.$local,$code); 
			} 
			
			    
			    ?>
			</span> 
			                     
			<?php } ?>    

			<span id='databoxes'>
			
			</span>                                                            
			                                  
			                                  
			                                  
			</div>
			<div class="tab-pane <?=$active_seo?>" id="tab-1-2">
			<!-- seo eng fields -->
			
			<?php 
			
			
			
			if(
			
			$section =='store_locator'|| $section == 'services' ||  $section == 'get_here'||
			$section == 'shop' ||$section == 'dine' ||$section == 'entertain' || $section == 'overview' || $section == 'opening_hours' || $section == 'articles' ||  $section == 'videos' || $section == 'sitemap'  || $section == 'terms_conditions' || $section == 'privacy'   || $section == 'contact' || $section == 'careers'){
				
				echo $this->element('admin/seo-fields',array('languages'=>$languages,'model'=>"SeoManagement" , "modelName"=>$modelName, "fieldId"=>$id)); 
			
			}
			?>  
			                                      
			
			<!-- end seo ar feilds  -->
			</div>

                       
            </div>
        </div>
    </div>
</div>
 
 
<input type="hidden" name="data[Section][hashed_id]" value="<?=$hashed_id?>" />
<?php 

	if($section == 'test'){
		echo $this->element("/admin/section_upload_images",array("model_name"=>$modelName,"section"=>$section ,'hash_code'=>$hashed_id ,"preferred_size"=>$preferred_size ,"userFilesFolder"=>$userFilesFolder)); 

	}

?>

	

	
	
 <div  class="form-actions">                                    
  <input id='save' style="margin-top:20px;" type="submit" class="btn btn-primary" value="Save">
</div>
 </form>
                    
                </div>
<?php //echo $this->element('Admin/media'); ?>



