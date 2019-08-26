<!-- BEGIN Main Content -->



<?php

$add_location="/admin/$controllerName/add/$section/$module_name/$module_id/";
$edit_location="/admin/$controllerName/edit/";
$delete_location="/admin/$controllerName/delete/";
$show_location="/admin/$controllerName/show/";
$hide_location="/admin/$controllerName/hide/";
$order_location="/admin/$controllerName/order_images/";
$search_location="/admin/$controllerName/index/$section/$module_name/$module_id/";

$view_name="$page_title";


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
                           				 <?php //echo $this->Html->link('Refresh',array('action'=>'admin_index'),array('class'=>'btn')); ?>          
                                    </div>
                                </div>
                                
                                
                                
                                <div class="clearfix"></div>
                                <?php if(isset($back_url) && !empty($back_url)){ ?>
	                                <div id="info" style="width:80px; color:#ffffff; margin-bottom: 10px; font-size: 15px; padding: 10px; float:left;background-color: #b6d1f2;text-shadow: 0 1px 0 #aecef4;clear:left;">
										<a href="<?=$back_url?>" style="width: 80px; text-align: center; display: block; color: #ffffff;">Back</a>
									</div>
								<?php } ?>


                                <div id="info" style="width:550px; color:#ffffff; margin-bottom: 10px; font-size: 15px; padding: 10px;  float:left;background-color: #b6d1f2;text-shadow: 0 1px 0 #aecef4;clear:left;">Drag and drop the sections to change the order.</div>
                                
								<table class="table table-advance" id="table2">
								    
								    <!--  table header  -->
								    <thead>
								        <tr>
								           
								            <th>Image</th>
								           
								            <th>Modified</th>
								            <!-- <th>Published</th> -->
								            <th style="width:100px">Action</th>
								        </tr>
								    </thead>
								    
								    
								    
								    <!-- table body -->
								    <tbody class="table2sort">
								      
								     <?php foreach($data as $newsEntry){
								     	$id=$newsEntry["$modelName"]['id'];
								     	$title=$newsEntry["$modelName"]['title'];
								     	$modified=$newsEntry["$modelName"]['modified'];
									
									
										$visible =$newsEntry["$modelName"]['visible'];
										if(!empty($newsEntry["$modelName"]['image'])){
											$title=$newsEntry["$modelName"]['image'];
										}else{
											$title=$newsEntry["$modelName"]['title'];
										}
										
								     	
										
										
										$img="/files/images/thumb/$title";
										
										
										
										
										
										//print_r($visible);exit;
										if($visible==1){
											
											$active_div= "<span id='active_div_$id'><a class='btn btn-small show-tooltip' title='Hide' onclick='change_status(\"/admin/$controllerName/hide/$id\",\"active_div_$id\",\"archive_div_$id\");return false;' href='/admin/$controllerName/hide/$id'><i class='icon-eye-open'></i></a></span>";											
											$archived_div= "<span id='archive_div_$id' style='display:none'><a  class='btn btn-small show-tooltip' title='Show' onclick='change_status(\"/admin/$controllerName/show/$id\",\"archive_div_$id\",\"active_div_$id\");return false;' href='/admin/$controllerName/hide/$id'><i class='icon-eye-close'></i></a></span>";
											
											
										}else{
											$active_div= "<span id='active_div_$id' style='display:none'><a class='btn btn-small show-tooltip' title='Hide' onclick='change_status(\"/admin/$controllerName/hide/$id\",\"active_div_$id\",\"archive_div_$id\");return false;' href='/admin/$controllerName/hide/$id'><i class='icon-eye-open'></i></a></span>";											
											$archived_div= "<span id='archive_div_$id' ><a  class='btn btn-small show-tooltip' title='Show' onclick='change_status(\"/admin/$controllerName/show/$id\",\"archive_div_$id\",\"active_div_$id\");return false;' href='/admin/$controllerName/hide/$id'><i class='icon-eye-close'></i></a></span>";
											
										}
										
										
										
										
										$del_div="<span id='del_div_$id' ><a class='btn btn-small show-tooltip' title='Delete' onclick='delete_entry(\"/admin/$controllerName/delete/$id\",\"row_$id\",\"del_div_$id\");return false;' href='/admin/$controllerName/delete/$id'><i class='icon-remove'></i></a></span>";
										
										
					
					
										
								     	?>
								        <tr  class="table-flag-orange   " id="row_<?php echo $id;?>">
								            <!-- <td class="handle"><?php echo $title ?></td> -->
								            <?php if(!empty($newsEntry["$modelName"]['image'])){ ?>
								            <td class="handle"><img width="80" height="80" src="<?=$img?>" /></td>
								            <?php }else{
								            	?>
								            	<td class="handle"><?php echo $title ?></td>
								            	<?php 
								            } ?>
								            
								            
								            
								            <td class="handle"><?php echo $modified ?></td>
								            <td class="handle">
								                <div class="btn-group">
								                <!-- <a target="_blank" class="btn btn-small show-tooltip" title="Preview" href="http://<?php echo $_SERVER['HTTP_HOST']; ?><?php echo $this->Html->url(array('admin' => false,'action'=>'view',$newsEntry["$modelName"]['id'])); ?>"><i class="icon-zoom-in"></i></a> -->
								                <a class="btn btn-small show-tooltip" href="<?=$edit_location."/$id"?>" title="Edit"><i class="icon-edit"></i></a>
								                
								               <?=$active_div?> <?=$archived_div?> 
								                
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
    	
    	
    	$("#table2 tbody").sortable({
			handle : '.handle',
			 zIndex: 9999,
             
            tolerance: "pointer",
            distance: 1 ,
			update : function () {
				var order = $('#table2 tbody').sortable('serialize');
				console.log(order);
				$("#info").load("/admin/<?php echo $controllerName;?>/ajax_order?"+order);
			}
		});
	
	
	
     
    }); 
  
   
</script>