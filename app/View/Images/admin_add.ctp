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

<form type='file'  enctype="multipart/form-data"    id="PageForm" class="form-horizontal" accept-charset="utf-8" method="post" action="/admin/<?=$controllerName?>/add/<?=$section.'/'.$module_name.'/'.$module_id?>" novalidate="novalidate">
	
	
<?php //echo $this->Form->input('hashed_id', array( 'value' => $hashed_id  , 'type' => 'hidden') ); ?>

   <div style=" margin-left:-1px;" class="span12">
    <div class="box">
        <div class="box-title">
            <h3 ><i class="icon-reorder"></i>Add <?=$page_title?> | <?php echo $this->element('admin/lang-toggle',array('languages'=>$languages)); ?></h3>
            <ul  style="margin-top:6px;" class="nav nav-tabs">
                <li class="active"><a href="#tab-1-1" data-toggle="tab">Main Data</a></li>
                <!-- <li><a href="#tab-1-2" data-toggle="tab">SEO</a></li> -->
               
            </ul>
        </div>

        <div class="box-content">
       		
       		
			
			
			
       		
            <div class="tab-content">
			<div class="tab-pane active" id="tab-1-1">
				
				
	       		<div class="control-group">
					<label class="control-label" for="JobPublish">Visible</label>
					<div class="input_div" id="visibleRadio">
						<input type="radio" id="option0" name="data[<?php echo $modelName;?>][visible]" value="1"  checked="checked"  /><label for="option0">YES</label>
						<input type="radio" id="option1" name="data[<?php echo $modelName;?>][visible]" value="0" /><label for="option1">NO</label>
					</div>
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
			
			<!-- image 1  -->
				<div class="control-group">
					
					
						<label class="control-label" for="JobPublish">Image</label>
					
						<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.image.".$local,array('label'=>false,'class'=>'required', "type"=>"file","size"=>"43"));?>
							<div> Preferred size : <?=$preferred_size?></div>
							<div class="clear_btn input_row" onclick="clear_img_path(this);">Clear Image Path</div>
						</div>
					
					<?php if(isset($this->request->data[$modelName]["image"][$local]) && !empty($this->request->data[$modelName]["image"][$local])){ ?>
						<div class="input_row " style='float:left' >
							<div class="label">Chosen Image</div>
							<div class="input_div"><a href="/files/<?=$userFilesFolder?>/original/<?php echo $this->request->data["$modelName"]["image"][$local];?>" class='lightbox' ><img src="/files/<?=$userFilesFolder?>/thumb/<?php echo $this->request->data["$modelName"]["image"][$local];?>" alt="" border="0" /></a></div>		
						</div>
					<?php } ?>
	       		</div>	
	       		
	       		<!-- <div class="control-group">
					<label class="control-label" for="JobPublish">URL</label>
					<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.url.".$local,array('type'=>'text' , 'class'=>'url', 'escape' => false,'label'=>false));?></div>
				</div> -->
	       		
	       		
			<?php echo $this->Form->input("$modelName.title.".$local,array( 'class'=>'input-xlarge ','dir'=>$direction,
					'style'=>'margin-bottom:20px',
					'label' => array(
			        'class' => 'control-label',
			        
			        'text' => 'Title ('.$language.')'
			    )));?> 
			    
			    
			  
			<?php 
			
		
					// echo $this->Form->input("$modelName.text.".$local,array('id'=>'content_'.$local,'class'=>'input-xlarge','type'=>'textarea',
						// 'style'=>'margin-bottom:20px',
						// 'label' => array(
				        // 'class' => 'control-label',
				        // 'text' => 'Content ('.$language.')'
				    // )));
// 					
					 // echo $this->Ck->load('content_'.$local,$direction); 
				?>
			  
			  
			  
			</span> 
			                     
			<?php } ?>    
			
		  
			
			                                  
			 
			<span id='databoxes'>
			
			</span>                                                            
			                              
			                                  
			                                  
			</div>
			<div class="tab-pane" id="tab-1-2">
			<!-- seo eng fields -->
			
			<?php //echo $this->element('admin/seo-fields',array('languages'=>$languages,'model'=>"SeoManagement" , "modelName"=>$modelName, "fieldId"=>0)); ?>  
			
			                                      
			
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
    
    
    $('#bgcolor').ColorPicker({
		
		onShow: function (colpkr) {
			$(colpkr).slideDown();
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).slideUp();
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#bgcolor').css('backgroundColor', '#' + hex);
			$('#bgcolor').val(hex);
		}
	});
	
	
    
    
    
    /*tabs*/
    $(".fields_lang_tabs").tabs(".fields_lang_panes > div",{effect: 'fade'});
    $(".page_types_tabs").tabs(".page_types_panes > div",{effect: 'fade'});
    $(".lang_page_type_tabs").tabs(".lang_page_type_panes > div",{effect: 'fade'});
    /*end tabs*/
 	$("#newInRadio").buttonset();
 	$("#visibleRadio").buttonset();
 	$("#fbRadio").buttonset();
 	
 	$("#BannerTypeRadio").buttonset();
 	
 	
   /*datepicker*/
	$("#news_date").datepicker({ changeYear: true, dateFormat: 'yy-mm-dd'});
	/*end datepicker*/
    
});
</script>
