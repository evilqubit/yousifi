<?php
$model_name='Contact';
$view_name='Contact Form';
$view_plural_name='Contact Forms';
$page_title='Contact Forms';
$page_subtitle="List $view_plural_name";
$delete_location='/admin/contacts/delete/';
$view_location='/admin/contacts/view/';
$search_submit='/admin/contacts/index/';

$th = array (
'',
$this->Paginator->sort('name','Name'),
$this->Paginator->sort('email','Email'),
$this->Paginator->sort('contact_department_id','Department'),

$this->Paginator->sort('created','Added'),
);
$image2 = $this->Html->image('/img/admin/delete.gif', array('title'=> "Delete $view_name", 'alt'=>"Delete $view_name", 'border'=> "0"), true);
$image6 = $this->Html->image('/img/admin/view.gif', array('title'=> "View Form", 'alt'=>"View Form", 'border'=> "0",'style'=>'margin-top:1px;'), true);
$image4 = $this->Html->image('/img/admin/greenlight.gif', array('title'=> "Viewed Form", 'alt'=>"Viewed Form" , 'border'=> "0",'style'=>'margin-top:1px;'), true);
$image5 = $this->Html->image('/img/admin/redlight.gif', array('title'=> "Not Viewed Form", 'alt'=>"Not Viewed Form", 'border'=> "0",'style'=>'margin-top:1px;'), true);
?>
<?php if(!isset($is_ajax)){ ?>
<div class="maintitle"><?=$page_title?></div>
<div class="subtitle"><?=$page_subtitle?></div>
<?php } ?>
<div id="page_content" class="list_page">
	<div style="width:750px; color:#666666; margin:0;  font-size:10px; float:left; ">
	
		<div class="search_div">
			<?php 
			if(!isset($search_phrase))
			$search_phrase="";
		
			echo $this->Form->create("Search",array("type"=>"GET","url"=>"$search_submit"));
			echo "<div class='FloatClass'>".$this->Form->input("s",array("label"=>false,"class"=>"input_field","style"=>"height:12px;","value"=>$search_phrase))."</div>";
			echo "<div class='FloatClass'>".$this->Form->submit("search",array("label"=>false,"class"=>"submit_btn"))."</div>";
			echo $this->Form->end();
			?>
		
		</div>
		
		<div style="width:830px; float:left; margin:0;">
		<table border="0" width="830px" cellpadding="0" cellspacing="1">
		<?php	
		if(empty($id)){
			$id ='n';
		}
		if(!empty($data)){
			echo $this->Html->tableHeaders($th);
			$counter=0;
			foreach ($data as $output)
			{
				if($counter%2==0){
					$bgColor="F4F4F4";
				}
				else{
					$bgColor="FFFFFF";
				}
				$counter++;
				$output_id = $output[$model_name]['id'];
				$output_name = $output[$model_name]['name'];
				$output_email=$output[$model_name]['email'];
				$department=$output['ContactDepartment']['title'];
				
				$entry_date=$output[$model_name]["created"];
				$output_status=$output[$model_name]["read_flag"];
				$entry_date=$this->Time->niceShort($entry_date);
				
				// $output_text=$this->Text->truncate(strip_tags($output_text),60);
				
				/////////////////BUTTONS////////////////
				$view_link=$this->Html->link($image6, $view_location.$output_id, array('escape'=>false,'onclick'=>"window.open('$view_location$output_id','_blank','width=700,height=600,resizable=yes,scrollbars=yes');$('#archive_div_$output_id').hide();$('#active_div_$output_id').show();return false;return false;"),null, false);
				$view_div='<div class="FloatClass" id="view_div_'.$output_id.'">'.$view_link.'</div>';
				
				$del_link=$this->Html->link($image2, $delete_location.$output_id, array('escape'=>false),"Are you sure you want to delete this form?", false);
				$del_div='<div class="FloatClass" id="del_div_'.$output_id.'">'.$del_link.'</div>';
				
				if($output_status==1){
					$active_div="<div id='active_div_$output_id' class='FloatClass'>$image4</div>";
					$archived_div="<div id='archive_div_$output_id' style='display:none' class='FloatClass'>$image5</div>";
				}else{
					$active_div="<div id='active_div_$output_id'  style='display:none' class='FloatClass'>$image4</div>";
					$archived_div="<div id='archive_div_$output_id' class='FloatClass'>$image5 </div>";
				}
				
			
				/////////////////END - BUTTONS////////////////
		?>
		<tr style="background-color:#<?= $bgColor?>;" id="row_<?php echo $output_id;?>">
		     <td style="width:80px;text-align:left;"><?php echo "$view_div $del_div $active_div $archived_div";?></td>
		     <td style="width:200px;text-align:left;overflow:hidden;"><?php echo $output_name; ?></td>
		     <td style="width:200px;text-align:left;overflow:hidden;"><?php echo $output_email; ?></td>
		     <td style="width:200px;text-align:left;overflow:hidden;"><?php echo $department; ?></td>
		     
		     <td style="width:150px;text-align:left;"><?=$entry_date?></td>
		</tr>
		<?php
			}
		} else {
			
			echo '<div style="float:left;height:20px;width:500px;padding-top:20px;" align="left">There are currently no '.$view_plural_name.'.</div>';
		}
		?>
		</table>
		</div>
		<div style="width:830px;">
		<?php
			echo $this->element('admin/paginator');
			echo $this->Js->writeBuffer();
		?>
		</div>
		
<div style="margin:20px 0px 20px 0px;width:800px;text-align:left; border:solid 1px #72BF44;padding:10px 0px 10px 10px;height:auto;overflow:hidden;clear:both;float:left;">


<div style="float:left;"><img src="/img/admin/delete.gif" /></div>
<div style="float:left;width:160px;margin-top:2px;">&nbsp;&nbsp;  Delete  <?php echo $view_name;?></div>


<div style="float:left;"><img src="/img/admin/view.gif" /></div>
<div style="float:left;width:160px;margin-top:2px;">&nbsp;&nbsp;  View  <?php echo $view_name;?></div>

</div>

</div>
</div>
<script type="text/javascript">
$(function() {
		$( "a.lightbox" ).lightBox();
	});
</script>