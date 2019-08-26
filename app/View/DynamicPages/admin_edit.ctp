
<div class="row-fluid">


<style>
	.form-horizontal .control-label{
		margin-right: 10px;
	}
	.cke_chrome {
		margin-left: 170px;
	}
</style>


<form type='file'  enctype="multipart/form-data"    id="PageForm" class="form-horizontal" accept-charset="utf-8" method="post" action="/admin/<?=$controllerName?>/edit/<?=$id?>" novalidate="novalidate">



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


			<?php if($section == 'contact_branches'){ ?>
				<div class="control-group">
					<label class="control-label" for="JobPublish">Type</label>
					<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.sub_section",array('options'=>$contact_sub_section, 'id'=>"dynamic_page_type", 'class'=>'' , 'escape' => false,'label'=>false));?></div>
				</div>

				<div class="control-group">
					<label class="control-label" for="JobPublish"> Google Map X-Coordinate</label>
					<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.x_coordinate",array('class'=>'', 'type'=>'text','id'=>'' , 'escape' => false,'label'=>false));?></div>
				</div>
				<div class="control-group">
					<label class="control-label" for="JobPublish"> Google Map Y-Coordinate</label>
					<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.y_coordinate",array('class'=>'', 'type'=>'text','id'=>'' , 'escape' => false,'label'=>false));?></div>
				</div>
			<?php } ?>





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


			<?php if($section == 'news_events'){ ?>
				<?php
					$checked4=0;
					$checked5=0;
					$display="display: none;";
					if($this->request->data["$modelName"]['show_on_home_page'] == 1){
						$checked4='checked="checked"';
						$checked5='';

					}elseif($this->request->data["$modelName"]['show_on_home_page'] == 0){
						$checked4='';
						$checked5='checked="checked"';


					}

				?>

				<div class="control-group">
					<label class="control-label" for="JobPublish">Show On home page</label>
					<div class="input_div" id="showOnHomePgaeRadio">
						<input type="radio" id="option4" name="data[<?php echo $modelName;?>][show_on_home_page]" value="1"  <?=$checked4?>  /><label for="option4">YES</label>
						<input type="radio" id="option5" name="data[<?php echo $modelName;?>][show_on_home_page]" value="0" <?=$checked5?>  /><label for="option5">NO</label>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="JobPublish"> Category</label>
					<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.category_id",array('options'=>$categories_list, 'id'=>"dynamic_page_type", 'onchange'=>"update_dynamic_page_type()", 'class'=>'' , 'escape' => false,'label'=>false));?></div>
				</div>


				<div class="control-group">
					<label class="control-label" for="JobPublish"> Date</label>
					<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.date",array('class'=>'', 'type'=>'text','id'=>'start_date' , 'escape' => false,'label'=>false));?></div>
				</div>




			<?php  } ?>

			<?php if($section != 'contact_branches'){
			 	echo $this->element("/admin/images/upload_one_image",array("preferred_size"=>$preferred_size , "modelName"=>$modelName));
			}
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

			if($section == 'news_events'){
				 echo $this->Form->input("$modelName.short.".$local,array('id'=>'summary_'.$local,'class'=>'input-xlarge','type'=>'textarea',
						'style'=>'margin-bottom:20px',
						'label' => array(
				        'class' => 'control-label',
				        'text' => 'Summary ('.$language.')'
				    )));

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





