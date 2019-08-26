<!-- BEGIN Main Content -->



<?php

$add_location="/admin/$controllerName/add/";
$edit_location="/admin/$controllerName/edit/";
$delete_location="/admin/$controllerName/delete_cv/";
$show_location="/admin/$controllerName/show/";
$hide_location="/admin/$controllerName/hide/";
$order_location="/admin/$controllerName/order_images/";
$search_location="/admin/$controllerName/cvs/$job_id/";

$view_location="/admin/$controllerName/view/";

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
                                       <!-- <a class="btn btn-success" href="<?=$add_location?>">Add</a>  -->

                                    </div>

                                    <div class="btn-group">
                           				 <?php //echo $this->Html->link('Refresh',array('action'=>'admin_index'),array('class'=>'btn')); ?>
                                    </div>
                                </div>



                                <div class="clearfix"></div>
                                <div id="info" style="width:550px; color:#ffffff; margin-bottom: 10px; font-size: 15px; padding: 10px;  float:left;background-color: #b6d1f2;text-shadow: 0 1px 0 #aecef4;clear:left;">Drag and drop the sections to change the order.</div>

								<table class="table table-advance" id="table2">

								    <!--  table header  -->
								    <thead>
								        <tr>

								            <th> Name</th>

								            <!-- <th>Job</th> -->
								            <th>Submission Date</th>
								            <!-- <th>Published</th> -->
								            <th style="width:100px">Action</th>
								        </tr>
								    </thead>



								    <!-- table body -->
								    <tbody class="table2sort">
								      <?//=debug($data);die;?>
								     <?php foreach($data as $output){
								     	$id = $output[$modelName]['id'];
										$output_f_name = $output[$modelName]['first_name'];

										$output_date=$this->Time->niceShort($output[$modelName]['created']);
										$output_job_id=$output[$modelName]['job_id'];
										if($output_job_id==0)
											$output_job="N/A";
										else $output_job=$jobs['Job']['title'];




										//print_r($visible);exit;
										// if($visible==1){
//
											// $active_div= "<span id='active_div_$id'><a class='btn btn-small show-tooltip' title='Hide' onclick='change_status(\"/admin/$controllerName/hide/$id\",\"active_div_$id\",\"archive_div_$id\");return false;' href='/admin/$controllerName/hide/$id'><i class='icon-eye-open'></i></a></span>";
											// $archived_div= "<span id='archive_div_$id' style='display:none'><a  class='btn btn-small show-tooltip' title='Show' onclick='change_status(\"/admin/$controllerName/show/$id\",\"archive_div_$id\",\"active_div_$id\");return false;' href='/admin/$controllerName/hide/$id'><i class='icon-eye-close'></i></a></span>";
//
//
										// }else{
											// $active_div= "<span id='active_div_$id' style='display:none'><a class='btn btn-small show-tooltip' title='Hide' onclick='change_status(\"/admin/$controllerName/hide/$id\",\"active_div_$id\",\"archive_div_$id\");return false;' href='/admin/$controllerName/hide/$id'><i class='icon-eye-open'></i></a></span>";
											// $archived_div= "<span id='archive_div_$id' ><a  class='btn btn-small show-tooltip' title='Show' onclick='change_status(\"/admin/$controllerName/show/$id\",\"archive_div_$id\",\"active_div_$id\");return false;' href='/admin/$controllerName/hide/$id'><i class='icon-eye-close'></i></a></span>";
//
										// }




										$del_div="<span id='del_div_$id' ><a class='btn btn-small show-tooltip' title='Delete' onclick='delete_entry(\"/admin/$controllerName/delete_cv/$id\",\"row_$id\",\"del_div_$id\");return false;' href='/admin/$controllerName/delete/$id'><i class='icon-remove'></i></a></span>";





								     	?>
								        <tr  class="table-flag-orange   " id="row_<?php echo $id;?>">
								            <td class="handle"><?php echo $output_f_name ?></td>
								            <!-- <td class="handle"><?php echo $output_job ?></td> -->

								            <td class="handle"><?php echo $output_date ?></td>
								            <td class="handle">
								                <div class="btn-group">
								                <!-- <a target="_blank" class="btn btn-small show-tooltip" title="Preview" href="http://<?php echo $_SERVER['HTTP_HOST']; ?><?php echo $this->Html->url(array('admin' => false,'action'=>'view',$newsEntry["$modelName"]['id'])); ?>"><i class="icon-zoom-in"></i></a> -->
								                <!-- <a class="btn btn-small show-tooltip" href="<?=$view_location."/$id"?>" title="View CV"><i class="icon-zoom-in"></i></a> -->



								               <?=$del_div?>



								                </div>
								            </td>
								        </tr>
								      <?php } ?>
								    </tbody>
								</table>
								<div class="pagination pagination-bullet text-center">
                                    <ul>
                                    <?php echo $this->Paginator->numbers(); ?>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Main Content -->


<!-- Modal -->

<!-- <div id="modal-1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel1">Publish to Facebook</h3>
        </div>
        <div id="facebook_publish"class="modal-body">

        </div>

 </div> -->

 <!-- <div id="modal-2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel1">Publish to Twitter</h3>
        </div>
        <div id="twitter_publish"class="modal-body">

        </div>

 </div> -->

 <script>

	 $('.fb-pub').click(function(){

		 var url = $(this).attr('data-url');

		 url = encodeURIComponent(url);

		 var redirect = '<?php echo  $this->here ?>';

		 $('#facebook_publish').load('/admin/facebook/publish/?url='+url+'&&redirect='+redirect);

	 });


	  $('.tw-pub').click(function(){

		 var url = $(this).attr('data-url');

		 url = encodeURIComponent(url);

		 var redirect = '<?php echo  $this->here ?>';

		 $('#twitter_publish').load('/admin/tweets/publish/?url='+url+'&&redirect='+redirect);

	 });



 </script>











<!-- End Modal -->


<script>



// When the document is ready set up our sortable with it's inherant function(s)
    $(document).ready(function() {

//
    	// $("#table2 tbody").sortable({
			// handle : '.handle',
			 // zIndex: 9999,
//
            // tolerance: "pointer",
            // distance: 1 ,
			// update : function () {
				// var order = $('#table2 tbody').sortable('serialize');
				// console.log(order);
				// $("#info").load("/admin/<?php echo $controllerName;?>/ajax_order?"+order);
			// }
		// });




    });


</script>