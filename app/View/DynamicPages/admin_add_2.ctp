<div class="row-fluid">


<style>
	.form-horizontal .control-label{
		margin-right: 10px;
	}
	.cke_chrome {
		margin-left: 170px;
	}
</style>


<form type='file'  enctype="multipart/form-data"    id="PageForm" class="form-horizontal" accept-charset="utf-8" method="post" action="/admin/<?=$controllerName?>/add_2/<?=$section?>" novalidate="novalidate">



<input type="hidden" name="data[DynamicPage][hashed_id]" value="<?=$hashed_id?>" />

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





			<div class="control-group">
				<label class="control-label" for="JobPublish">Visible</label>
				<div class="input_div" id="visibleRadio">
					<input type="radio" id="option0" name="data[<?php echo $modelName;?>][visible]" value="1"  checked="checked"  /><label for="option0">YES</label>
					<input type="radio" id="option1" name="data[<?php echo $modelName;?>][visible]" value="0" /><label for="option1">NO</label>
				</div>
			</div>


			<?php if($section != 'our_brands'){ ?>


				<?php

				$display='';
				if($section == 'our_business_local' || $section == 'our_business_international'){
					$display='none';
				} ?>



				<div class="control-group" id="show_onHomePage" style="display: <?=$display?>">
					<label class="control-label" for="JobPublish">Show On home page</label>
					<div class="input_div" id="showOnHomePgaeRadio">
						<input type="radio" id="option4" name="data[<?php echo $modelName;?>][show_on_home_page]" value="1"   /><label for="option4">YES</label>
						<input type="radio" id="option5" name="data[<?php echo $modelName;?>][show_on_home_page]" value="0" checked="checked"  /><label for="option5">NO</label>
					</div>
				</div>
			<?php  } ?>


			<div id="pointer_list_section"  class="all_sections">
				<?php
				echo $this->element("/admin/jstree/jstree_single",array(
					//"parentsList"=>$parentsList,
					"model_name"=>'DynamicPage',
					"container_width"=>'1000px',
					"searchFeild_width"=>'500px',
					"feild_model"=>'DynamicPage',
					"section"=>"$section",
					"feild_name"=>"parent_id",
					"feild_id"=>'parent_id',
					"selected_id"=>'',
					'container_title'=>'Parent Page',
					'scroll_top'=>'320',
					'children_feild'=>'children',
					'is_required'=>1
					));
				?>
			</div>


			<?php





			// echo $this->element("/admin/jstree/jstree",array(
				// "parentsList"=>$parentsList,
				// "model_name"=>'DynamicPage',
				// "container_width"=>'1000px',
				// "searchFeild_width"=>'500px',
				// "feild_model"=>'DynamicPage',
				// "feild_name"=>"parent_id",
				// "feild_id"=>'dynamicParents',
				// "selected_id"=>'',
				// 'container_title'=>'Parent Page',
				// 'scroll_top'=>'320',
				// 'children_feild'=>'children',
				// 'is_required'=>0
				// ));




			?>

			<?php if($section == 'our_brands'){ ?>
				<div class="control-group"  id="page_url">
					<label class="control-label" for="JobPublish"> URL</label>
					<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.url",array('class'=>'url',   'type'=>'text','id'=>'' , 'escape' => false,'label'=>false));?></div>
				</div>
			<?php } ?>
			<!-- <div class="control-group">
				<label class="control-label" for="JobPublish"> Page Type</label>
				<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.page_type",array('options'=>$dynamic_pages_types, 'id'=>"dynamic_page_type", 'onchange'=>"update_dynamic_page_type()", 'class'=>'' , 'escape' => false,'label'=>false));?></div>
			</div> -->

			<!-- <div class="control-group" style="display: none;" id="page_url">
				<label class="control-label" for="JobPublish"> URL</label>
				<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.url",array('class'=>'url',   'type'=>'text','id'=>'' , 'escape' => false,'label'=>false));?></div>
			</div> -->

			<!-- <div class="control-group">
				<label class="control-label" for="JobPublish"> Google Map X-Coordinate</label>
				<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.x_coordinate",array('class'=>'', 'type'=>'text','id'=>'' , 'escape' => false,'label'=>false));?></div>
			</div>
			<div class="control-group">
				<label class="control-label" for="JobPublish"> Google Map Y-Coordinate</label>
				<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.y_coordinate",array('class'=>'', 'type'=>'text','id'=>'' , 'escape' => false,'label'=>false));?></div>
			</div> -->


			<!-- <div class="control-group">
				<label class="control-label" for="JobPublish"> Date</label>
				<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.date",array('class'=>'', 'type'=>'text','id'=>'start_date' , 'escape' => false,'label'=>false));?></div>
			</div> -->

			<?php

			 echo $this->element("/admin/images/upload_one_image",array("preferred_size"=>$preferred_size , "modelName"=>$modelName));
			//}
			?>


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

			<?php

			if($section == 'our_business_local' ||  $section == 'our_business_international'||  $section == 'our_brands'){
				 // echo $this->Form->input("$modelName.summary.".$local,array('id'=>'summary_'.$local,'class'=>'input-xlarge','type'=>'textarea',
						// 'style'=>'margin-bottom:20px',
						// 'label' => array(
				        // 'class' => 'control-label',
				        // 'text' => 'Summary ('.$language.')'
				    // )));


			}
			 ?>

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
			<?php echo $this->element('admin/seo-fields',array('languages'=>$languages,'model'=>"$modelName" ,"fieldId"=>''));?>
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
