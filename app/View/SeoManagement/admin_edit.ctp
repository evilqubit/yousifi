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

<form  type='file'  enctype="multipart/form-data"   id="PageForm" class="form-horizontal" accept-charset="utf-8" method="post" action="/admin/<?=$controllerName?>/edit/1" novalidate="novalidate">
	
	
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
			
			
			
			
			<?php echo $this->element('admin/seo-fields',array('languages'=>$languages,'model'=>"$modelName" ,"fieldId"=>1)); ?>  
			 
       		
			
			
			
       		
			
			

			<span id='databoxes'>
			
			</span>                                                            
			                                  
			                                  
			                                  
			</div>
			<div class="tab-pane" id="tab-1-2">
			<!-- seo eng fields -->
			
			<?php //echo $this->element('admin/seo-fields',array('languages'=>$languages,'model'=>"$modelName" ,"fieldId"=>$id)); ?>  
			                                      
			
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
 	
 	
   /*datepicker*/
	$("#news_date").datepicker({ changeYear: true, dateFormat: 'yy-mm-dd'});
	/*end datepicker*/
    
});
</script>
