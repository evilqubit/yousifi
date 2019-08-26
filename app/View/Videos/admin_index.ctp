<div class="maintitle">Videos</div>
<div class="subtitle">List Videos</div>

<?php 

//print_r($paginator);exit;
$add_location="/admin/$controllerName/add/";
$edit_location="/admin/$controllerName/edit/";
$delete_location="/admin/$controllerName/delete/";
$show_location="/admin/$controllerName/show/";
$hide_location="/admin/$controllerName/hide/";
$order_location="/admin/$controllerName/ajax_order/";

$view_name="Video";

$th = array (
'',
$this->paginator->sort('Title','title'),
$this->paginator->sort('Last Modified','modified'),
);

$image1 = $this->html->image('/img/admin/edit.gif', array('title'=> "Edit $view_name", 'alt'=>"Edit", 'border'=> "0"), true);
$image2 = $this->html->image('/img/admin/delete.gif', array('title'=> "Delete $view_name", 'alt'=>"Delete", 'border'=> "0"), true);
$image3 = $this->html->image('/img/admin/add.gif', array('title'=> "Add $view_name", 'alt'=>"Add",'style'=>'margin-left:10px;margin-bottom:-5px;' , 'border'=> "0"), true);
$image5 = $this->html->image('/img/admin/greenlight.gif', array('title'=> "Click to Hide $view_name", 'alt'=>"Click to Hide $view_name" , 'border'=> "0",'style'=>'margin-top:1px;'), true);
$image6 = $this->html->image('/img/admin/redlight.gif', array('title'=> "Click to Show $view_name", 'alt'=>"Click to Show $view_name", 'border'=> "0",'style'=>'margin-top:1px;'), true);
$image7 = $this->html->image('/img/admin/arrow.png', array('title'=> "Order $view_name", "class"=>"handle", 'alt'=>"Order",'style'=>'margin-right:10px;cursor:move' , 'border'=> "0"), true);
$image8 = $this->html->image('/img/admin/order.gif', array('title'=> "Click to order of images  in $view_name ", "class"=>"handle", 'alt'=>"Add",'style'=>'margin-right:10px;cursor:pointer' , 'border'=> "0"), true);
?>

<div class="add_page" style="width:500px; float:left; height:35px;margin:0;"><?php echo $this->html->link($image3." Add $view_name", "$add_location", array("escape"=>false,'style'=>'text-decoration:none;'), null, false);?></div>
<div id="info" style="width:550px;float:left;margin-top:10px;clear:left;">Drag and drop the sections with &nbsp; <img src="/img/admin/arrow.png" alt=""/> &nbsp; to change the order.</div>
<button class="FloatClass submit_btn" style="clear:both;margin-bottom:10px;" onclick="window.location='/admin/<?=$controllerName?>/index/1'">Order all entries</button>
	<table border="0" width="500" cellpadding="1" cellspacing="1" class="FloatClass" id="sortable_list">
			<?php	
			if(!empty($data)){
				echo "<thead>".$this->html->tableHeaders($th)."</thead>";
				$i=0;
				foreach ($data as $output)
				{
					if($i%2==0){
						$bgColor="F4F4F4";
					}
					else{
						$bgColor="FFFFFF";
					}
										
					$output_id = $output[$modelName]['id'];
					$output_title = $output[$modelName]['title'];
					$output_date=$this->time->niceShort($output[$modelName]['modified']);
					$output_status=$output[$modelName]["visible"];
					
					/////////////////BUTTONS////////////////
					$edit_link=$this->html->link($image1, $edit_location.$output_id, array("escape"=>false), null, false);
					$edit_div='<span id="edit_div_'.$output_id.'">'.$edit_link.'</span>';

					$del_link=$this->html->link($image2, $delete_location.$output_id, array("escape"=>false,"onClick"=>"delete_entry('$delete_location$output_id','row_$output_id','del_div_$output_id');return false;"),null, false);
					$del_div='<span id="del_div_'.$output_id.'">'.$del_link.'</span>';
					
					
					
					$active=$this->html->link($image5, $hide_location.$output_id, array("onClick"=>"change_status('$hide_location$output_id','active_div_$output_id','archive_div_$output_id');return false;",'escape'=>false), null, false);
					$archived=$this->html->link($image6, $show_location.$output_id, array("onClick"=>"change_status('$show_location$output_id','archive_div_$output_id','active_div_$output_id');return false;",'escape'=>false), null, false);
					
					if($output_status==1){
						$active_div="<span id='active_div_$output_id'>$active</span>";
						$archived_div="<span id='archive_div_$output_id' style='display:none'>$archived </span>";
					}else{
						$active_div="<span id='active_div_$output_id'  style='display:none'>$active</span>";
						$archived_div="<span id='archive_div_$output_id'>$archived </span>";
					}
					
					/////////////////END - BUTTONS////////////////
				
			?>
			<tr style="background-color:#<?php echo $bgColor?>;" id="row_<?php echo $output_id;?>">
			     <td style="width:120px;padding-right:0px;"><?php echo "$image7 $edit_div $del_div $active_div $archived_div";?></td>
			     <td style="width:185px;text-align:center;"><?php echo $output_title; ?></td>
			     <td style="width:185px;text-align:center;"><?php echo $output_date; ?></td>
			</tr>
			<?php
				$i++;
				}
			} else {
				
				echo '<div style="float:left;height:20px;width:500px;padding-top:20px;clear:both;" align="left">No Data Available</div>';
			}
			?>
	</table>
	
	<?php if($list_all == 0){?>
		<div class="pagination_container" style="width:500px;">
			<?php echo $this->element('admin/paginator');?>
		</div>
	<?php }?>
	
<div style="margin:20px 0px 20px 0px;width:560px;text-align:left; border:solid 1px #72BF44;padding:10px 0px 10px 10px;height:auto;overflow:hidden;clear:both;float:left;">
	<div style="float:left;clear:both;margin-bottom:10px;">
		<div style="float:left;"><img src="/img/admin/edit.gif" alt=""/></div>
		<div style="float:left;width:160px;margin-top:2px;">&nbsp;&nbsp;  Edit  <?php echo $view_name;?></div>
		
		<div style="float:left;"><img src="/img/admin/delete.gif" alt=""/></div>
		<div style="float:left;width:160px;margin-top:2px;">&nbsp;&nbsp;  Delete  <?php echo $view_name;?></div>
	</div>
	<div style="float:left;">
		<div style="float:left;"><img src="/img/admin/arrow.png" alt=""/></div>
		<div style="float:left;width:160px;margin-top:2px;">&nbsp;&nbsp; Order <?php echo $view_name;?></div>
	</div>
</div>

<script type="text/javascript"> 
$(document).ready(function() {
	$("#sortable_list tbody").sortable({
		handle : '.handle',
		update : function () {
			var order = $('#sortable_list tbody').sortable('serialize');
			$("#info").load("/admin/<?php echo $controllerName;?>/ajax_order?"+order);
		}
	});
});
</script>