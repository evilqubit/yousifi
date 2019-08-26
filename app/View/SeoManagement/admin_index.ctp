<div class="maintitle">SEO Management</div>
<div class="subtitle">SEO Management</div>
<?php
$edit_location="/admin/$controllerName/edit/";

$image1 = $this->Html->image('/img/admin/edit.gif', array('title'=> "Edit SEO", 'alt'=>"Edit", 'border'=> "0"), true);

$th = array (
'',
'Prepend Title',
'append Title',
'Title',
'Keywords',
'Description'
);
?>
<table border="0" width="800" cellpadding="1" cellspacing="1">
<?php	
if(!empty($data)){
	echo $html->tableHeaders($th);
	
		$bgColor="F4F4F4";
		
		$prepend_title = $data[$modelName]['prepend_title'];
		$append_title = $data[$modelName]['append_title'];
		$meta_title = $data[$modelName]['title'];
		$meta_keywords = substr(strip_tags(addslashes($data[$modelName]['keywords'])),0,100);
		$meta_desc = substr(strip_tags(addslashes($data[$modelName]['description'])),0,100);
		
		
		/////////////////BUTTONS////////////////
		$edit_link=$html->link($image1, $edit_location, array("escape"=>false), null, false);
		$edit_div='<span id="edit_div_1'.'">'.$edit_link.'</span>';
		/////////////////END - BUTTONS////////////////
	
?>
<tr style="background-color:#<?php echo  $bgColor?>;" id="row_1>">
     <td style="width:80px;padding-right:0px;"><?php echo "$edit_div";?></td>
     <td style="width:150px;padding-left:5px;text-align:left;"><?php echo $prepend_title; ?></td>
     <td style="width:150px;padding-left:5px;text-align:left;"><?php echo $append_title; ?></td>
     <td style="width:150px;padding-left:5px;text-align:left;"><?php echo $meta_title; ?></td>
     <td style="width:150px;padding-left:5px;text-align:left;"><?php echo $meta_keywords; ?></td>
     <td style="width:150px;padding-left:5px;text-align:left;"><?php echo $meta_desc; ?></td>
</tr>
<?php
	
} else {
	echo '<div style="float:left;height:20px;width:420px;padding-top:20px;" align="left">No Data Available</div>';
}
?>
</table>

<div style="margin:20px 0px 20px 0px;width:200px;text-align:left; border:solid 1px #72BF44;padding:10px 0px 10px 10px;height:auto;overflow:hidden;clear:both;float:left;">

<div style="float:left;"><img src="/img/admin/edit.gif" alt=""/></div>
<div style="float:left;width:160px;margin-top:2px;">&nbsp;&nbsp;  Edit SEO</div>

</div>
