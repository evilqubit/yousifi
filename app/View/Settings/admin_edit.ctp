<div class="row-fluid">


<style>
	.form-horizontal .control-label{
		margin-right: 10px;
	}
	.cke_chrome {
		margin-left: 170px;
	}


	.settingConfig {
		width: 600px;
	}
</style>

<form id="PageForm" class="form-horizontal" accept-charset="utf-8" method="post" action="/admin/<?=$controllerName?>/edit/<?=$id?>" novalidate="novalidate">


<?php //echo $this->Form->input('hashed_id', array( 'value' => $hashed_id  , 'type' => 'hidden') ); ?>

   <div style=" margin-left:-1px;" class="span12">
    <div class="box">

    	<?php //echo $this->element('/admin/breadCrumb/breadCrumb1' ) ?>
        <div class="box-title">
            <h3><i class="icon-reorder"></i> Site Configuration <?php //echo $this->element('Admin/lang-toggle',array('languages'=>$languages)); ?> </h3>
            <div class="box-tool">

            </div>
        </div>

        <div class="box-content">





            <div class="tab-content">
			<div class="tab-pane active" id="tab-1-1">

			<!--		///////// facebook //////////////  -->
			<div style="width: 100%; height: 1px; background-color:#3e4349; margin-bottom: 20px; margin-top: 20px;"></div>
			<div style="width: 100%; font-family: Arial; color: #000000; font-size: 18px; margin-bottom: 10px;">Facebook Configuration</div>

			<div class="control-group">
				<label class="control-label" for="JobPublish">Facebook App Id</label>
				<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.fbAppId",array('type'=>'text' , 'class'=>'settingConfig', 'escape' => false,'label'=>false));?></div>
			</div>

			<!-- <div class="control-group">
				<label class="control-label" for="JobPublish">Facebook App Secret</label>
				<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.fbAppSecret",array('type'=>'text','class'=>'settingConfig', 'escape' => false,'label'=>false));?></div>
			</div> -->

			<div class="control-group">
				<label class="control-label" for="JobPublish">Facebook Page</label>
				<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.fbPage",array('type'=>'text','class'=>'settingConfig url', 'escape' => false,'label'=>false));?></div>
			</div>


			<!--		///////// twitter //////////////  -->
			<div style="width: 100%; height: 1px; background-color:#3e4349; margin-bottom: 20px; margin-top: 20px;"></div>
			<div style="width: 100%; font-family: Arial; color: #000000; font-size: 18px; margin-bottom: 10px;">Twitter Configuration</div>




			<div class="control-group">
				<label class="control-label" for="JobPublish">Twitter Page</label>
				<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.twPage",array('type'=>'text','class'=>'settingConfig url', 'escape' => false,'label'=>false));?></div>
			</div>

			<!-- <div class="control-group">
				<label class="control-label" for="JobPublish">Twitter App Key</label>
				<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.twAppKey",array('type'=>'text','class'=>'settingConfig', 'escape' => false,'label'=>false));?></div>
			</div>

			<div class="control-group">
				<label class="control-label" for="JobPublish">Twitter App Secret</label>
				<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.twAppSecret",array('type'=>'text','class'=>'settingConfig', 'escape' => false,'label'=>false));?></div>
			</div>

			<div class="control-group">
				<label class="control-label" for="JobPublish">Twitter Access Token</label>
				<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.twAccessToken",array('type'=>'text','class'=>'settingConfig', 'escape' => false,'label'=>false));?></div>
			</div>

			<div class="control-group">
				<label class="control-label" for="JobPublish">Twitter Access Token Secret</label>
				<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.twAccessTokenSecret",array('type'=>'text','class'=>'settingConfig', 'escape' => false,'label'=>false));?></div>
			</div> -->



			<!--		///////// Google //////////////  -->
			<!-- <div style="width: 100%; height: 1px; background-color:#3e4349; margin-bottom: 20px; margin-top: 20px;"></div>
			<div style="width: 100%; font-family: Arial; color: #000000; font-size: 18px; margin-bottom: 10px;">Google Configuration</div>



			<div class="control-group">
				<label class="control-label" for="JobPublish">Google anylatic embed Code</label>
				<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.google_embed",array('type'=>'textarea','class'=>'settingConfig', 'escape' => false,'label'=>false));?></div>
			</div>

			<div class="control-group">
				<label class="control-label" for="JobPublish">Google User Name</label>
				<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.googleUsername",array('type'=>'text','class'=>'settingConfig email', 'escape' => false,'label'=>false));?></div>
			</div>

			<div class="control-group">
				<label class="control-label" for="JobPublish">Google Password</label>
				<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.googlePassword",array('type'=>'text','class'=>'settingConfig', 'escape' => false,'label'=>false));?></div>
			</div>

			<div class="control-group">
				<label class="control-label" for="JobPublish">Google Report Id</label>
				<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.googleReportId",array('type'=>'text','class'=>'settingConfig', 'escape' => false,'label'=>false));?></div>
			</div> -->


			<span id='databoxes'>

			</span>



			</div>
			<div class="tab-pane" id="tab-1-2">
			<!-- seo eng fields -->

			<?php //echo $this->element('admin/seo-fields',array('languages'=>$languages,'model'=>"$modelName")); ?>


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

