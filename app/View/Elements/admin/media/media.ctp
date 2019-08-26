
<style>
	.form-horizontal .controls {
		margin-left: 0px;
	}
</style>
<div class="row-fluid">
	<div class="span7">
		<div class="box">
			<div class="box-title">
				<h3><i class="icon-play"></i> Media Gallery </h3>
				
			</div>
			<div class="box-content">
				<style>.gallery .mix{ opacity: 0; display: none;}</style>
				<ul class="gallery"  id="media-gallery">
					<?php
						if(isset($allMedia)){
							
							  
						 foreach($allMedia as $media){
						  $type=$media['Media']['type'];
						  if($type == 'image'){
						  // $media['Media'] = $media;
						  
						   echo $this->element('admin/media/image-edit',array('image'=>$media , 'userFilesFolder'=>$userFilesFolder));
						   
						  }
						   elseif($type == 'video'){
						   //$media['Media'] = $media;
						   //echo $this->element('admin/media/video-edit',array('video'=>$media));
						   
						  }
						   elseif($type == 'audio'){
						   // $media['Media'] = $media;
						  // echo $this->element('admin/media/audio-edit',array('audio'=>$media));
						   
						  }
						  
						  
						 }  
						   
						   }
						  ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="span5">
		<div class="box">
			<div class="box-title">
				<h3>
					
				</h3>
			</div>
			<div class="box-content">
				<span id='images'>
					<hr>
					<div id="queue"></div>
					<input id="file_upload" name="file_upload" type="file" multiple="true">  
					<hr>
					
					<div>Preferred image size : <?=$media_preferred_size?></div>
				</span>
				<span id='videos'>
					<a class="btn btn-inverse video-computer">Add From My Computer</a> <a class="btn btn-danger video-youtube">Add From Youtube</a>
					<span id="video-upload">
						<hr>
						<div class="control-group">
							<div class="controls" style="margin-left: 0px;">
								<div id="queue"></div>
								<input id="video_upload" name="video_upload" type="file" multiple="true">
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<a  class="btn btn-inverse" onclick="submit_video();" id="submit_video" select_video='false' select_cover='false' href="#">
								Add
								</a>
							</div>
						</div>
						<hr>
					</span>
					<span id="youtube-upload">
						<hr>
						<div class="control-group">
							<div class="controls"  style="margin-left: 0px;">
								<div class="input-prepend">
									<span class="add-on">
									<i class="icon-youtube"></i>
									</span>
									<input id='youtube-url' type="text" class="input-xlarge" placeholder="ex: http://www.youtube.com/watch?v=K8o350hQEFM&feature=share&list=PLLxmH4oyMNC4eRngnCk8eSk2q8cmcw-o8"></input>
								</div>
							</div>
						</div>
						<div class="controls"><span id="youtube-preview"></span></div>
						<div class="controls">
							<a  class="btn btn-danger" onclick="submit_youtube();" id="submit_youtube" select_video='false' select_cover='false' href="#">
							Add
							</a>
							<hr>
						</div>
					</span>
				</span>
				<span id="docs">
					<hr>
					<div class="control-group">
						<div class="controls">
							<div id="queue"></div>
							<input id="doc_upload" name="doc_upload" type="file" multiple="true">
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<a  class="btn btn-inverse" onclick="submit_doc();" id="submit_video" select_video='false' select_cover='false' href="#">
							Add
							</a>
						</div>
					</div>
					<hr>
				</span>
				<span id="audio">
					<hr>
					<div class="control-group">
						<div class="controls">
							<div id="queue"></div>
							<input id="audio_upload" name="audio_upload" type="file" multiple="true">
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<a  class="btn btn-inverse" onclick="submit_audio();" id="submit_video" select_video='false' select_cover='false' href="#">
							Add
							</a>
						</div>
					</div>
					<hr>
				</span>
			</div>
		</div>
	</div>
</div>

<div id="modal-2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel1">Cropper</h3>
	</div>
	<div class="modal-body" id='cropContainer' >
		<input id="coverid" type="hidden" value=""/>
		<input id="croptype" type="hidden" value=""/>
		<input id="corpsource" type="hidden" value=""/>
		<input id="corpx" type="hidden" value=""/>
		<input id="corpy" type="hidden" value=""/>
		<input id="corpw" type="hidden" value=""/>
		<input id="corph" type="hidden" value=""/>
		<p><img id="crop"  src="/img/utility/loader.gif"/></p>
		<script language="Javascript">
			function showCoords(c)
			{    
			$('#corpx').val(c.x);
			$('#corpy').val(c.y);
			$('#corpw').val(c.w);
			$('#corph').val(c.h);
			    // variables can be accessed here as
			    // c.x, c.y, c.x2, c.y2, c.w, c.h
			};
			
		</script>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<button id='crop-save' class="btn btn-primary" data-dismiss="modal">Save changes</button>
	</div>
</div>
<div id="modal-1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel1">Edit Video Cover</h3>
	</div>
	<div class="modal-body">
		<p> 
		<div class="control-group">
			<input id="covervideoid" type="hidden" value=""/>
			<div class="controls">
				<div id="queue"></div>
				<input id="cover_upload" name="video_upload" type="file" multiple="true">
			</div>
			
			
		</div>
		<div class="control-group">
			<div class="controls">
			</div>
		</div>
		</p>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<!-- <a  class="btn btn-primary" onclick="submit_coveredit();" id="submit_video"  href="#">
		Save changes
		</a> -->
	</div>
</div>
<div id="modal-3" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel1">Edit Media Info</h3>
	</div>
	<div class="modal-body" id='editmediainfo'>
		<p> 
		</p>
	</div>
</div>
<div id="validationModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel3">Requirment</h3>
	</div>
	<div class="modal-body">
		<p>Please fill the required fields in the Main Data section</p>
	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" data-dismiss="modal">Ok</button>
	</div>
</div>





<script>
// When the document is ready set up our sortable with it's inherant function(s) 
$(document).ready(function() {
	// fourth example
	
	
	$("#docTableContent").sortable({
		handle : '.handle',
		 zIndex: 9999,
         
        tolerance: "pointer",
        distance: 1 ,
		update : function () {
			var order = $('#docTableContent').sortable('toArray');
			order= JSON.stringify(order);
			
			 $.post('/admin/media/reorder/',{order:order}, function(data) {});
			 
			
		}
	});
}); 
</script>


