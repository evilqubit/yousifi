<div class="maintitle"><?=$page_title?></div>
<div class="subtitle"><?=$page_subtitle?></div>
<?php
$modelName=$adminConfigArray["modelName"];
$controllerName=$adminConfigArray["controllerName"];

echo $this->Form->create($modelName,array('type'=>'file','url'=>"/admin/$controllerName/edit",'id'=>'PageForm','name'=>'PageForm')); 

echo $this->element("admin/seo_box",array("languages"=>$languages,"modelName"=>"$modelName","fieldId"=>0));
?>
<div class="input_row">
	<div class="submit_div"><?php echo $this->Form->submit('Save',array('class'=>'submit_btn'));?>
</div>
<?php echo $this->Form->end();?>

<script type="text/javascript">
$(document).ready(function() {
	$("#pageForm").validate();
    $(".fields_lang_tabs").tabs(".fields_lang_panes > div",{effect: 'fade'});
});
</script>