<!-- BEGIN Main Content -->



<?php


$edit_location="/admin/$controllerName/edit/";
$delete_location="/admin/$controllerName/delete/";
$add_location="/admin/$controllerName/add/$section/";
$show_location="/admin/$controllerName/show/";
$hide_location="/admin/$controllerName/hide/";
$order_location="/admin/$controllerName/order_images/";
$search_location="/admin/$controllerName/index/$section/";


$relation_location="/admin/Roles/relation/";
$subjects_location="/admin/Roles/subject/";

//$related_images_location="/admin/Images/index/$section/Section/";


$order_all="/admin/$controllerName/index/1";


$view_name="Album";


if(!isset($search_phrase)){
	$search_phrase='';
}
 ?>
<div class="row-fluid">
    <div class="span12">
        <div class="box">

            <div class="box-title">
                <h3><i class="icon-table"></i><?=$page_title?></h3>
                <div class="box-tool">

                </div>
            </div>
          <div class="box-content">


            	<div class="btn-toolbar pull-left clearfix">
					<div class="control-group">
						<div class="controls">
							    <?=$this->element("/admin/index_search" , array("search_location"=>$search_location , "search_phrase"=>$search_phrase));?>
						 </div>
					</div>
				</div>

            	<div class="btn-toolbar pull-right clearfix">
                    <div class="btn-group">
                       <a class="btn btn-success" href="<?=$add_location?>">Add</a>
                    </div>

                    <div class="btn-group">
                        <?php echo $this->Html->link('Refresh',array('action'=>'admin_index', $menuSectionId),array('class'=>'btn')); ?>
                     </div>
                </div>








                <div class="clearfix"></div>
                <div id="info" style="width:550px; color:#ffffff; margin-bottom: 10px; font-size: 15px; padding: 10px;  float:left;background-color: #b6d1f2;text-shadow: 0 1px 0 #aecef4;clear:left;">Drag and drop the <span style='font-weight: bold; font-size:18px;' >pages</span> to change the order.</div>


                <a  style="width: 80px; display: block; color: #ffffff;" href="<?=$order_all?>">Order all</a>
             </div>

                  	<div class="tableHeaderContainer">
                  		<div class="table_headerRow" style="width: 380px;">Title</div>
                  		<div  class="table_headerRow" style="width: 200px;">Modified</div>
                  		<div  class="table_headerRow" style="width: 400px; text-align: right">Action</div>
                  	</div>





				    <!-- table body -->
				    <div class="table2sort"  id="mainList">


					     <?php
					     $index=0;
					     foreach($data as $newsEntry){
					     	$id=$newsEntry["$modelName"]['id'];
					     	$title=$newsEntry["$modelName"]['title'];
					     	$modified=$newsEntry["$modelName"]['modified'];

							$visible=$newsEntry["$modelName"]['visible'];

							$back_color='';
							if(($index%2) == 0){
								$back_color='#ffffff';
							}else{
								$back_color='#dedbdb';
							}

							$index++;

							$uniqe_id=$id;

							//print_r($visible);exit;
							if($visible==1){

								$active_div= "<span id='active_div_$id'><a class='btn btn-small show-tooltip' title='Hide' onclick='change_status(\"/admin/$controllerName/hide/$id\",\"active_div_$id\",\"archive_div_$id\");return false;' href='/admin/$controllerName/hide/$id'><i class='icon-eye-open'></i></a></span>";
								$archived_div= "<span id='archive_div_$id' style='display:none'><a  class='btn btn-small show-tooltip' title='Show' onclick='change_status(\"/admin/$controllerName/show/$id\",\"archive_div_$id\",\"active_div_$id\");return false;' href='/admin/$controllerName/hide/$id'><i class='icon-eye-close'></i></a></span>";

							}else{
								$active_div= "<span id='active_div_$id' style='display:none'><a class='btn btn-small show-tooltip' title='Hide' onclick='change_status(\"/admin/$controllerName/hide/$id\",\"active_div_$id\",\"archive_div_$id\");return false;' href='/admin/$controllerName/hide/$id'><i class='icon-eye-open'></i></a></span>";
								$archived_div= "<span id='archive_div_$id' ><a  class='btn btn-small show-tooltip' title='Show' onclick='change_status(\"/admin/$controllerName/show/$id\",\"archive_div_$id\",\"active_div_$id\");return false;' href='/admin/$controllerName/hide/$id'><i class='icon-eye-close'></i></a></span>";

							}
							//$del_div="<span id='del_div_$id' ><a class='btn btn-small show-tooltip' title='Delete' onclick='delete_entry(\"/admin/$controllerName/delete/$id\",\"row_$id\",\"del_div_$id\");return false;' href='/admin/$controllerName/delete/$id'><i class='icon-remove'></i></a></span>";
							$del_div="<a class='btn btn-small btn-danger show-tooltip' title='Delete' onclick='delete_entry(\"/admin/$controllerName/delete/$id\",\"row_$id\",\"del_div_$id\");return false;' href='/admin/$controllerName/delete/$id'>Delete</a>";

					     	?>
					     	<div class="table-flag-orange "  style="width: 100%; float: left;"   id="row_<?php echo $uniqe_id;?>">
						        <div  class="rowContainer" style="background-color: <?=$back_color?>" >
						            <div class="handle" style="width: 35%; float: left;"><?php echo $title ?></div>

						            <div class="handle"  style="width: 20%; float: left;"><?php echo $modified ?></div>



						            <div class=""  style="width: 40%; float: left; text-align: right">
						                <div class="btn-group">
						                <div class="accordAjaxLoader" id="accordAjaxLoader_<?=$uniqe_id?>" ><img src="/img/ajax-loader.gif" width="20" height="20" /></div>

						              	<?php if($section == 'asd'){ ?>
						              		<div class="btn btn-small show-tooltip btn-success" style="background-color: #b6d1f2; margin-right: 2px;" onclick="get_dynamicPages_subchildren('<?=$id?>' ,'<?=$uniqe_id?>')" title="Manage pages">Manage pages</div>
						                <?php } ?>

						               <a class="btn btn-small show-tooltip" href="<?=$edit_location."/$id"?>" title="Edit"><i class="icon-edit"></i></a>

						                <?=$active_div?> <?=$archived_div?>
						               <?php echo $del_div; ?>



						                </div>
						            </div>
						        </div>
						        <div style="display: none;" id="sub_<?=$uniqe_id?>"></div>
					        </div>
					      <?php } ?>
				    </div>


				<div class="pagination pagination-bullet text-center">
                    <ul>
                    <?php echo $this->Paginator->numbers(); ?>
                    </ul>
                </div>


        </div>
    </div>
</div>
<!-- END Main Content -->


<script>



// When the document is ready set up our sortable with it's inherant function(s)
$(document).ready(function() {
	// fourth example



	$("#mainList").sortable({
		handle : '.handle',
		 zIndex: 9999,

        tolerance: "pointer",
        distance: 1 ,
		update : function () {
			var order = $('#mainList').sortable('serialize');

			$("#info").load("/admin/<?php echo $controllerName;?>/ajax_order/<?=$section?>/page:<?=$page_number?>?"+order);
		}
	});



});
</script>
