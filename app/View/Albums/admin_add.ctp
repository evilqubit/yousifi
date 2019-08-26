<div class="row-fluid">


<style>
	.form-horizontal .control-label{
		margin-right: 10px;
	}
	.cke_chrome {
		margin-left: 170px;
	}
</style>

<form id="<?=$modelName?>AdminAddForm" class="form-horizontal" accept-charset="utf-8" method="post" action="/admin/<?=$controllerName?>/add" novalidate="novalidate">
	
	
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
			
			//print_R($languages);exit;
			foreach($languages as $config){
				$local=$config['Language']['locale'];
				$language=$config['Language']['language'];
				$direction=$config['Language']['direction'];
				$code=$config['Language']['code'];
				
				 ?>
			
			<span class="language <?php echo $code; ?>">
			
			<?php echo $this->Form->input("$modelName.title.".$local,array( 'class'=>'input-xlarge','dir'=>$direction,
					'style'=>'margin-bottom:20px',
					'label' => array(
			        'class' => 'control-label',
			        'text' => 'Title ('.$language.')'
			    )));?> 
			<?php echo $this->Form->input("$modelName.content.".$local,array('id'=>'content_'.$code,'class'=>'input-xlarge','type'=>'textarea',
					'style'=>'margin-bottom:20px',
					'label' => array(
			        'class' => 'control-label',
			        'text' => 'Content ('.$language.')'
			    )));?> 
			
			        <?php echo $this->Ck->load('content_'.$code,$code); ?>
			</span> 
			                     
			<?php } ?>    
			
			
			
			                                  
			
			<span id='databoxes'>
			
			</span>                                                            
			                                  
			                                  
			                                  
			</div>
			<div class="tab-pane" id="tab-1-2">
			<!-- seo eng fields -->
			
			<?php echo $this->element('admin/seo-fields',array('languages'=>$languages,'model'=>"$modelName")); ?>  
			                                      
			
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
<?php //echo $this->element('Admin/media'); ?>

<script src="/js/admin/media.js?<?php echo rand(); ?>"></script>
<script>var foreign_key = <?php if(isset($this->request->data['News']['id'])){ echo $this->request->data['News']['id']; }else{ echo 0;} ?>;</script>
<script src="/js/admin/template.js?<?php echo rand(); ?>"></script>

