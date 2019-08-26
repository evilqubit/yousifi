<div class="row-fluid">


<style>
	.form-horizontal .control-label{
		margin-right: 10px;
	}
	.cke_chrome {
		margin-left: 170px;
	}
	
	.input  label.error{
		margin-left: 170px;
	}
</style>

<form  type='file'  enctype="multipart/form-data"   id="PageForm" class="form-horizontal" accept-charset="utf-8" method="post" action="/admin/<?=$controllerName?>/edit/<?=$id?>" novalidate="novalidate">
	
	
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
			
			
			
			
			<?php 
				$checked0=0;
				$checked1=0;
				$display="display: none;";
				if($this->request->data["$modelName"]['visible'] == 1){
					$checked0='checked="checked"';
					$checked1='';
					
				}elseif($this->request->data["$modelName"]['visible'] == 0){
					$checked0='';
					$checked1='checked="checked"';
					
					
				}
				
			?>


       		<div class="control-group">
				<label class="control-label" for="JobPublish">Visible</label>
				<div class="input_div" id="visibleRadio">
					<input type="radio" id="option0" name="data[<?php echo $modelName;?>][visible]" value="1"  <?=$checked0?>  /><label for="option0">YES</label>
					<input type="radio" id="option1" name="data[<?php echo $modelName;?>][visible]" value="0"  <?=$checked1?> /><label for="option1">NO</label>
				</div>
			</div>
			
			
				<?php 
				$checked2=0;
				$checked3='checked="checked"';
				$display="display: none;";
				
				if(isset($this->request->data["$modelName"]['push_notification'])){
					if($this->request->data["$modelName"]['push_notification'] == 1){
						$checked2='checked="checked"';
						$checked3='';
						
					}elseif($this->request->data["$modelName"]['push_notification'] == 0){
						$checked2='';
						$checked3='checked="checked"';
						
						
					}
				}
				
				
			?>


       		<div class="control-group">
				<label class="control-label" for="JobPublish">Push Notification</label>
				<div class="input_div" id="push_notificationRadio">
					<input type="radio" id="option2" name="data[<?php echo $modelName;?>][push_notification]" value="1"  <?=$checked2?>  /><label for="option2">YES</label>
					<input type="radio" id="option3" name="data[<?php echo $modelName;?>][push_notification]" value="0"  <?=$checked3?> /><label for="option3">NO</label>
				</div>
			</div>
			
			
			
			
       		<div class="control-group">
				<label class="control-label" for="JobPublish">Start Date</label>
				<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.start_date",array('type'=>'text','id'=>'start_date' , 'escape' => false,'label'=>false));?></div>
			</div>
			<div class="control-group">
				<label class="control-label" for="JobPublish">End Date</label>
				<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.end_date",array('type'=>'text','id'=>'end_date' , 'escape' => false,'label'=>false));?></div>
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
			
				<?php echo $this->Form->input("$modelName.title.".$local,array( 'class'=>'input-xlarge required','dir'=>$direction,
					'style'=>'margin-bottom:20px',
					'label' => array(
			        'class' => 'control-label',
			        
			        'text' => 'Title ('.$language.')'
			    )));?> 
				<?php 
				
				
				echo $this->Form->input("$modelName.short.".$local,array('id'=>'short_'.$local,'class'=>'input-xlarge','type'=>'textarea',
					'style'=>'margin-bottom:20px',
					'label' => array(
			        'class' => 'control-label',
			        'text' => 'Short ('.$language.')'
			    )));
				
				 //echo $this->Ck->load('content_'.$local,$direction); 
				 
				 
				echo $this->Form->input("$modelName.text.".$local,array('id'=>'content_'.$local,'class'=>'input-xlarge','type'=>'textarea',
					'style'=>'margin-bottom:20px',
					'label' => array(
			        'class' => 'control-label',
			        'text' => 'Content ('.$language.')'
			    )));
				
				 echo $this->Ck->load('content_'.$local,$code); 
				 
				 
				?>
			
			
			</span> 
			                     
			<?php } ?>    

			<span id='databoxes'>
			
			</span>                                                            
			                                  
			                                  
			                                  
			</div>
			<div class="tab-pane" id="tab-1-2">
			<!-- seo eng fields -->
			
			<?php echo $this->element('admin/seo-fields',array('languages'=>$languages,'model'=>"$modelName" ,"fieldId"=>$id)); ?>  
			                                      
			
			<!-- end seo ar feilds  -->
			</div>

                       
            </div>
        </div>
    </div>
</div>
 <div  class="form-actions">                                    
  <input id='save' style="margin-top:20px;" type="submit" class="btn btn-primary" value="Save">
</div>
 </form>
</div>

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
 	
 	$("#push_notificationRadio").buttonset();
 	
   /*datepicker*/
	$("#news_date").datepicker({ changeYear: true, dateFormat: 'yy-mm-dd'});
	/*end datepicker*/
    
});
</script>

