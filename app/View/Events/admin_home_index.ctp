<div class="maintitle"><?php echo $page_title;?></div>
<div class="subtitle">Edit <?php echo $page_sub_title;?></div>

<?php 

//print_r($paginator);exit;
$add_location="/admin/$controllerName/add/";
$edit_location="/admin/$controllerName/edit/";
$delete_location="/admin/$controllerName/delete/";
$show_location="/admin/$controllerName/show/";
$hide_location="/admin/$controllerName/hide/";
$order_location="/admin/$controllerName/ajax_order/";
$homepage_location="/admin/$controllerName/show_on_homepage/";

$images_location="/admin/PagesRelations/index/$modelName/";

$view_name="News";

$th = array (
'',
$this->paginator->sort('title','Title'),
$this->paginator->sort('date','Date'),
$this->paginator->sort('modified','Last Modified'),
);

$image1 = $this->html->image('/img/admin/edit.gif', array('title'=> "Edit $view_name", 'alt'=>"Edit", 'border'=> "0"), true);
$image2 = $this->html->image('/img/admin/delete.gif', array('title'=> "Delete $view_name", 'alt'=>"Delete", 'border'=> "0"), true);
$image3 = $this->html->image('/img/admin/add.gif', array('title'=> "Add $view_name", 'alt'=>"Add",'style'=>'margin-left:10px;margin-bottom:-5px;' , 'border'=> "0"), true);
$image5 = $this->Html->image('/img/admin/greenlight.gif', array('title'=> __("admin_visible",true)." $view_name", 'alt'=>"visible" , 'border'=> "0",'style'=>'margin-top:1px;'), true);
$image6 = $this->Html->image('/img/admin/redlight.gif', array('title'=> __("admin_hidden",true)."$view_name", 'alt'=> __("admin_hidden",true)."$view_name", 'border'=> "0",'style'=>'margin-top:1px;'), true);
$image7 = $this->html->image('/img/admin/arrow.png', array('title'=> "Order $view_name", "class"=>"handle", 'alt'=>"Order",'style'=>'margin-right:10px;cursor:move' , 'border'=> "0"), true);
$image8 = $this->html->image('/img/admin/order.gif', array('title'=> "Click to order of images  in $view_name ", "class"=>"handle", 'alt'=>"Add",'style'=>'margin-right:10px; margin-bottom:8px; cursor:pointer' , 'border'=> "0"), true);

$image11 = $this->html->image('/img/admin/on_home_off.gif', array('title'=> "Show $modelName on homepage", 'alt'=>"Show",'style'=>'margin-right:10px; cursor:pointer;' , 'border'=> "0"), true);
$image10 = $this->html->image('/img/admin/on_home.gif', array('title'=> "Hide  $modelName from homepage", 'alt'=>"Show",'style'=>'margin-right:10px; cursor:pointer;' , 'border'=> "0"), true);

?>


<div id="info" style="width:550px;float:left;margin-top:10px;clear:left;"> The first news according the ordering will be set as latest news , the second one will be set as events</div>
<div id="info" style="width:550px;float:left;margin-top:10px;clear:left;">Drag and drop the sections with &nbsp; <img src="/img/admin/arrow.png" alt=""/> &nbsp; to change the order.</div>
<button class="FloatClass submit_btn" style="clear:both;margin-bottom:10px;" onclick="window.location='/admin/<?=$controllerName?>/index/1'">Order all entries</button>

	<table border="0" width="700" cellpadding="1" cellspacing="1" class="FloatClass" id="sortable_list">
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
					$output_date=$this->time->format('F j, Y',$output[$modelName]['modified']);
					$output_post_date=$this->time->format('F j, Y',$output[$modelName]['date']);
					$output_status=$output[$modelName]["visible"];
					$output_homepage=$output[$modelName]['homepage'];
					
					
					
					$image_link=$this->Html->link($image8, $images_location.$output_id, array("escape"=>false), null, false);
    				$image_div='<span id="image_div_'.$output_id.'" >'.$image_link.'</span>';
					/////////////////BUTTONS////////////////
					$edit_link=$this->html->link($image1, $edit_location.$output_id, array("escape"=>false), null, false);
					$edit_div='<span id="edit_div_'.$output_id.'" >'.$edit_link.'</span>';

					$del_link=$this->html->link($image2, $delete_location.$output_id, array("escape"=>false,"onClick"=>"delete_entry('$delete_location$output_id','row_$output_id','del_div_$output_id');return false;"),null, false);
					$del_div='<span id="del_div_'.$output_id.'">'.$del_link.'</span>';
					/////////////////////////// homepage ///////////////////////////////
					$homepage_on = $this->Html->link($image10, $homepage_location . $output_id, array("onclick" => "change_status('$homepage_location$output_id','homepage_on_div_$output_id','homepage_off_div_$output_id');return false;", "escape" => false), null, false);
		            $homepage_off = $this->Html->link($image11, $homepage_location . $output_id, array("onclick" => "change_status('$homepage_location$output_id','homepage_off_div_$output_id','homepage_on_div_$output_id');return false;", "escape" => false), null, false);
		            if ($output_homepage == 1) {
		                $homepage_on_div = "<span id='homepage_on_div_$output_id' class='FloatClass' style='float: none'>$homepage_on</span>";
		                $homepage_off_div = "<span id='homepage_off_div_$output_id' style='display:none; float: none' class='FloatClass'>$homepage_off</span>";
		            } else {
		                $homepage_on_div = "<span id='homepage_on_div_$output_id'  style='display:none; float: none' class='FloatClass' >$homepage_on</span>";
		                $homepage_off_div = "<span id='homepage_off_div_$output_id' class='FloatClass' style='float: none'>$homepage_off</span>";
		            }
					/////////////////////////////////////////////////////
					
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
			     <td style="width:180px;padding-right:0px;"><?php echo "$image7 $homepage_on_div  $homepage_off_div";?></td>
			     <td style="width:250px;text-align:center;"><?php echo $output_title; ?></td>
			     <td style="width:150px;text-align:center;"><?php echo $output_post_date; ?></td>
			     <td style="width:150px;text-align:center;"><?php echo $output_date; ?></td>
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
	
<div class="legendBar">
	
	<div style="float:left;clear:both;margin-bottom:10px;">
		<div style="float:left;margin-top:20px;"><img src="/img/admin/on_home_off.gif" alt=""/><img src="/img/admin/on_home.gif" alt=""/></div>
		<div style="float:left;width:140px;margin-top:20px;">&nbsp;&nbsp;  unset/set as home news</div>
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