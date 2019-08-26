<!-- BEGIN Main Content -->



<?php

$add_location="/admin/$controllerName/add/";
$edit_location="/admin/$controllerName/edit/";
$delete_location="/admin/$controllerName/delete/";
$show_location="/admin/$controllerName/show/";
$hide_location="/admin/$controllerName/hide/";
$order_location="/admin/$controllerName/order_images/";
$search_location="/admin/$controllerName/index/";

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
											    
											    <div class="input-append">
											  	<form id="AlbumAdminIndexForm" accept-charset="utf-8" method="GET" action="<?=$search_location?>">											        
											        <?php										
													echo $this->Form->input('s', array('class'=>'input-large',"value"=>$search_phrase,'div' => false,'label' => false,));
													
													echo $this->Form->submit(__('Search'), array('class'=>'btn btn-primary','div' => false));
													echo $this->Form->end();
											    
											    
											    ?>
												
											    </div>
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
								<table class="table table-advance" id="table2">
								    <thead>
								        <tr>
								           
								            <th>Title</th>
								            <!-- <th>Created</th> -->
								            <th>Modified</th>
								            <!-- <th>Published</th> -->
								            <th style="width:100px">Action</th>
								        </tr>
								    </thead>
								    <tbody class="table2sort">
								      
								     <?php foreach($data as $newsEntry){
								     	$id=$newsEntry["$modelName"]['id'];
								     	$title=$newsEntry["$modelName"]['title'];
								     	$modified=$newsEntry["$modelName"]['modified'];
								     	?>
								        <tr id="<?php echo $id  ?>" class="table-flag-orange">
								            <td><?php echo $title ?></td>
								            <!-- <td><?php echo $newsEntry["$modelName"]['created']; ?></td> -->
								            <td><?php echo $modified ?></td>
								             <!-- <td><?php if($newsEntry["$modelName"]['publish']){ echo '<span class="label label-success"> Published </span>';}else{echo '<span class="label label-warning"> Draft </span>';} ?></td>
								              -->
								
								        
								          
								            <td>
								                <div class="btn-group">
								                <!-- <a target="_blank" class="btn btn-small show-tooltip" title="Preview" href="http://<?php echo $_SERVER['HTTP_HOST']; ?><?php echo $this->Html->url(array('admin' => false,'action'=>'view',$newsEntry["$modelName"]['id'])); ?>"><i class="icon-zoom-in"></i></a> -->
								                <a class="btn btn-small show-tooltip" href="<?=$edit_location."/$id"?>" title="Edit"><i class="icon-edit"></i></a>
								                
								                  
								                <?php echo $this->Form->postLink(
								                'Delete',array('action' => "$delete_location", $id),array('confirm' => 'Are you sure?','class'=>'btn btn-small btn-danger show-tooltip'));?>
								           
								            <i class="icon-trash"></i>
								                </div>
								            </td>
								        </tr>
								      <?php } ?>
								    </tbody>
								</table>

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
        $(".table2sort").sortable({
        
          
            zIndex: 9999,
             
            tolerance: "pointer",
            distance: 1 ,
            update : function () { 
                   
                     var order = $(".table2sort").sortable('toArray'); 
                      console.log(order);
                     order= JSON.stringify(order);
                     
                     
                     $.post('<?=$order_location?>',{order:order}, function(data) {
	                     //alert($data);
                     });
            } 
        }); 
    }); 
  
   
</script>