
//toggle (image/video)
$('#images').show();
$('#videos').hide();
$('#docs').hide();
$('#audio').hide();

$(document).ready(function() {
    $('#imagetoggle').on('click', function(e) {
        $('#images').show();
        $('#videos').hide();
        $('#docs').hide();
        $('#audio').hide();
    });
    
    $('#videotoggle').on('click', function(e) {
         $('#images').hide();
         $('#docs').hide();
         $('#videos').show();
         $('#audio').hide();
    });
      
    $('#doctoggle').on('click', function(e) {
         $('#images').hide();
         $('#docs').show();
         $('#videos').hide();
         $('#audio').hide();
    });
    
    $('#audiotoggle').on('click', function(e) {
         $('#images').hide();
         $('#docs').hide();
         $('#videos').hide();
         $('#audio').show();
    });
    
    
});


//

//toggle between the arabic and english fields 		
 $('.ar').hide();
 $(document).ready(function() {
    $('.lang').on('click', function(e) {
        $('.ar').toggle();
        $('.en').toggle();
    });
});

// end translation 



//toggeling Video (youtube/videos)

$('#video-upload').hide();
$('#youtube-upload').hide();

 $(document).ready(function() {
    $('.video-computer').on('click', function(e) {
       $('#video-upload').show();
        $('#youtube-upload').hide();
    });
      $('.video-youtube').on('click', function(e) {
      
       $('#youtube-upload').show();
       $('#video-upload').hide();
        
    });
    
    
    
});





//End Toggeling Video 


function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}


//Image Uploadify Ini

$(function() {



if (typeof resizeType === 'undefined') {
    resizeType = 'default';
}

if (typeof resizeModule === 'undefined') {
    resizeModule = 0;
}

var random_number=makeid();

$('#file_upload').uploadify({ 
	
	
	'method': "PUT",
	'formData'     : {'hashed_id':hashed_id,'resizeModule':resizeModule , 'resizeType':resizeType , 'userFilesFolder':userFilesFolder},
	    'swf'  : '/js/jquery/uploadify/uploadify.swf?<?php echo time().rand();?>',
	    'uploader' : '/media/imageupload/kjd_kml819?'+random_number,
	    'cancelImg' : '/js/jquery/uploadify/cancel.png',
	    'auto'      : true,
	    'multi'       : true,
	    'fileTypeExts'     : '*.jpg;*.gif;*.png',
	    'button_image_url'   : '/img/admin/uploadBtn.png?www44',
	    'buttonImage'   : '/img/admin/uploadBtn.png?www44',
	    
	    'removeTimeout': '0.5',
	   'onUploadSuccess'  : function(file,data,response) {
   
 		$('.gallery').prepend(data);

     },
'onQueueComplete' : function(queueData) {
       
       setTimeout(function(){refresh();}, 500);
       
	}
	    
	    

});
});


//Refresh

function refresh(){
	//alert('New File Added To The Gallery');
	$('.gallery').sortable( "refresh" );
    $('.gallery').mixitup('remix','all');
}



// deleting an image function 
$('.gallery').on('click','.delete-image',function() {
		
		if (confirm("are you sure you want to delete the selected image?")) {
					
					 var id = $(this).attr('img-id');
					 $.post('/admin/media/delete/',{id:id}, function(data) {
												  
							if(data == 1){$('#'+id).remove();
							return false;
							} 
							else{$('.gallery').prepend(data); alert('Error While Deleting');}
							return false;                                                        
					 
					 });
					 
					 return false;
					 
		 }
	  
	   else{return false;}
		
		});

// End Delete 

// Edit Image Info 
$('body').on('click','.edit-mediainfo',function() {

		var id = $(this).attr('media-id');
	
		$("#editmediainfo").load("/admin/media/editmediainfo/"+id);

});
// End of Image Edit Info


// End Of Image 



//Video Uploadify Ini
var random_number=makeid();
$(function() {
$('#video_upload').uploadify({
'formData'     : {'hashed_id':hashed_id,'type':'video', 'resizeModule':resizeModule , 'resizeType':resizeType},
width:120,
height:30,
'swf'      : '/js/jquery/uploadify/uploadify.swf',
'uploader' : '/media/videoupload/kjd_kml819?'+random_number,
'cancelImg' : '/js/jquery/uploadify/cancel.png',
'fileTypeExts'     : '*.mpeg;*.wmv;*.flv;*.mpg;*.3gp;*.mov;*.avi;*.asf;*.mp4',
'buttonImage'   : '/img/admin/selectVideo.png?wwwww44',
// 'auto'      : false,
'multi'     : false,
'queueSizeLimit' : 1,
'onSelect' : function(file) {
           $('#video_upload').uploadify('disable', true);
           $('#submit_video').attr('select_video','true');
           
        },
'onCancel' : function(file) {
           $('#video_upload').uploadify('disable', false);
           $('#submit_video').attr('select_video','false');
        },
        
'onUploadError' : function(file, errorCode, errorMsg, errorString) {
			
           //$('#video_cover_upload').uploadify('disable', false);
           $('#video_upload').uploadify('disable', false);
 
 },
'onUploadSuccess'  : function(file,data,response) {
	
    $('#video_upload').uploadify('disable', false);
    $('.gallery').prepend(data);
    refresh();

   
   }
});
});

// End of video upload


function submit_video(){
	
	video = $('#submit_video').attr('select_video');

	
	if(video == 'true' ){$('#video_upload').uploadify('upload','*');}
	else{alert('You need to select a video before upload');}
	
	
}


//Youtube Preview 

$("#youtube-url").keyup(function(){

  url=$("#youtube-url").val();
  $.post("/admin/media/previewYoutube",{url:url},function(data){
    $("span #youtube-preview").html(data);
  });
});


// Youtube Upload


function submit_youtube(){
	
  url=$("#youtube-url").val();
  
  $.post("/admin/media/youtubeupload",{url:url,hashed_id:hashed_id},function(data){
    
     $('.gallery').prepend(data);
     refresh();
     
  });

	
}

// deleting a video function 
$('.gallery').on('click','.delete-video',function() {
			
			if (confirm("Are you sure?")) {
						 var id = $(this).attr('vid-id');
						
						 $.post('/admin/media/delete/',{id:id}, function(data) {
													  if(data == 1){$('#'+id).remove(); return false;}
													  else{$('.gallery').prepend(data); alert('Error While Deleting');}
						   
						                                                       });
						                                                        
			  return false;                  
			  }
			else{ return false; } 
			
});

// End Of video



// Init corpper

jQuery(function($) {
     		  var jcrop_api;
			  $('#crop').Jcrop({
			            onSelect:    showCoords,
			            bgColor:     'black',
			            bgOpacity:   .7,
			            setSelect:   [ 100, 100, 50, 50 ],
			            aspectRatio: 16 / 9,
								},
			    function(){jcrop_api = this;}
			    
			    );
  
$('.gallery').on('click','.crop-video',function() {
 
  $( "#crop" ).remove();
  $('#cropContainer').append('<img id="crop" src="/img/utility/loader.gif"/>');
  
 jcrop_api.destroy();
 var img = $(this).attr('data-img-crop');
 var coverid = $(this).attr('vid-id');

if(img == ''){alert('Please upload your own cover to be able to crop'); return false;}
 
 $('#corpsource').val(img);
 $('#coverid').val(coverid);
 $('#croptype').val('vid');

         setTimeout(function(){
				 $( "#crop" ).remove();
				 $('#cropContainer').append('<img id="crop" src="'+img+'"/>');
				 
				 var original = new Image();
				 original.onload = function() {
					 trueHeight = this.height;
					 trueWidth = this.width;
					
					
					$('#crop').Jcrop({
			            onSelect:    showCoords,
			            bgColor:     'black',
			            bgOpacity:   .7,
			            aspectRatio: 16 / 9,
			            trueSize: [trueWidth,trueHeight],
						},
					function(){jcrop_api = this;}
					);
					
					
				 }
				 original.src = $('#crop').attr('src');
	
				   
				 
		 },2000);
    
});


$('.gallery').on('click','.crop-img',function() {
 			 $( "#crop" ).remove();
 			 $('#cropContainer').append('<img id="crop" src="/img/utility/loader.gif"/>');
			 jcrop_api.destroy();
			 var img = $(this).attr('data-img-crop');
			
			 var id = $(this).attr('img-id');
			 
			 
			 $('#corpsource').val(img);
			 $('#coverid').val(id);
		
			 $('#croptype').val('img');
			
 
			 setTimeout(function(){
				 $( "#crop" ).remove();
				 $('#cropContainer').append('<img id="crop" src="'+img+'"/>');
				 
				 var original = new Image();
				 original.onload = function() {
					 trueHeight = this.height;
					 trueWidth = this.width;
					
					
					$('#crop').Jcrop({
			            onSelect:    showCoords,
			            bgColor:     'black',
			            bgOpacity:   .7,
			            aspectRatio: 16 / 9,
			            trueSize: [trueWidth,trueHeight],
						},
					function(){jcrop_api = this;}
					);
					
					
				 }
				 original.src = $('#crop').attr('src');
	
				   
				 
			 },2000);
			
			
			      
});

  
$('#crop-save').on('click',function() {
	
	


  x= $('#corpx').val();
  y= $('#corpy').val();
  w= $('#corpw').val();
  h= $('#corph').val();
  source = $('#corpsource').val();

  coverid = $('#coverid').val();
  type = $('#croptype').val();
  
  
  if(type == 'vid'){

			  
			 var id = coverid;
			
			 $.post('/admin/media/cropcover/',{x:x,y:y,w:w,h:h,id:id}, function(data) {
	         $("#"+id).replaceWith(data);
    	     refresh();									//$('#'+coverid).attr('src','/'+dest+'?'+rand);
				 									
			  });
			  
  }
  else{
  
  
			 var id = coverid;
			
			 $.post('/admin/media/cropimg/',{x:x,y:y,w:w,h:h,id:id}, function(data) {
	         $("#"+id).replaceWith(data);
    	     refresh();									//$('#'+coverid).attr('src','/'+dest+'?'+rand);
				 									
			  });

  
	  
  }
  
	
	 $( "#crop" ).remove();
	 $('#cropContainer').append('<img id="crop" src="/img/utility/loader.gif"/>');
});
  
    });



$(function() {
	var random_number=makeid();
$('#cover_upload').uploadify({
'formData'     : { 'video_id': '' , 'hashed_id':hashed_id,'resizeModule':resizeModule , 'resizeType':resizeType},
'swf'      : '/js/jquery/uploadify/uploadify.swf',
'uploader' : '/media/editcover/kjd_kml819?'+random_number,
'cancelImg' : '/js/jquery/uploadify/cancel.png',
'fileTypeExts'     : '*.jpg;*.jpeg;*.gif;*.png',
'buttonImage'   : '/img/admin/selectCover.png?www44',
'auto'      : true,
'multi'     : false,
'queueSizeLimit' : 1,
'onUploadStart' : function(file) {

id = $('#covervideoid').val();
$('#cover_upload').uploadify("settings", "formData",{'video_id' : id});
           
        },
'onSelect' : function(file) {
           $('#cover_upload').uploadify('disable', true);
           
        },
'onCancel' : function(file) {
           $('#cover_upload').uploadify('disable', false);
        },
        
'onUploadError' : function(file, errorCode, errorMsg, errorString) {
           //$('#video_cover_upload').uploadify('disable', false);
           $('#cover_upload').uploadify('disable', false);
 
 },
'onUploadSuccess'  : function(file,data,response) {
    $('#cover_upload').uploadify('disable', false);

  $("#"+id).replaceWith(data);
    	refresh();
    	
   }
});
});


$('.gallery').on('click','.edit-cover-video',function() {
 

 var id = $(this).attr('vid-id');
 $('#covervideoid').val(id);
 

});

function submit_coveredit(){
			
		$('#cover_upload').uploadify('upload','*');
		
}
// End Of video


//Doc Start 


//Doc Uploadify Ini

$(function() {
	var random_number=makeid();
	
$('#doc_upload').uploadify({
'formData'     : {'hashed_id': hashed_id,'type':'doc'},
'swf'      : '/js/jquery/uploadify/uploadify.swf',
'uploader' : '/media/docupload/kjd_kml819?'+random_number,
'cancelImg' : '/js/jquery/uploadify/cancel.png',
'fileTypeExts'     : '*.doc;*.docx;*.pdf;*.ppt;*.pptx;*.xls;*.xlsx;*.txt;*.rtf',
'buttonImage'   : '/img/admin/selectDoc.png?www44',
'auto'      : true,
'multi'     : false,
'queueSizeLimit' : 1,
'onSelect' : function(file) {
           $('#doc_upload').uploadify('disable', true);
          
        },
'onCancel' : function(file) {
           $('#doc_upload').uploadify('disable', false);
           
        },
        
'onUploadError' : function(file, errorCode, errorMsg, errorString) {
           //$('#video_cover_upload').uploadify('disable', false);
          $('#doc_upload').uploadify('disable', false);
 
 },
'onUploadSuccess'  : function(file,data,response) {
    $('#doc_upload').uploadify('disable', false);
    location.hash = "#docTable";
    $('#docTableContent').append(data);
        $('#docTable').attr('style','');
    location.hash = 'empty';

   
   }
});
});



function submit_doc(){

	$('#doc_upload').uploadify('upload','*');
			
}


//deleting docs

// deleting an image function 
$('#docTable').on('click','.delete-doc',function() {
if (confirm("Are you sure?")) {
 var id = $(this).attr('doc-id');
 $.post('/admin/media/delete/',{id:id}, function(data) {
	if(data == 1){
		
		  $('#'+id).remove();
			return false;
		 	/*  if( $('#docTable').closest("tbody").find("tr").length === 0 ) {$('#docTable').attr('style','display:none'); } */
		 
		  
  }
  else{ 
  $('#docTableContent').prepend(data);

		  
		  alert('Error While Deleting');}
    });
    
    return false; 
    
                                    }
else{                                                        
  
return false; 
}});



//Doc End 


//Audio Uploadify Ini

$(function() {
$('#audio_upload').uploadify({
'formData'     : {'hashed_id': hashed_id,'type':'audio'},
'swf'      : '/js/jquery/uploadify/uploadify.swf',
'uploader' : '/admin/media/audioupload',
'cancelImg' : '/js/jquery/uploadify/cancel.png',
'fileTypeExts'     : '*.mp3;*.ogg;',
'buttonImage'   : '/img/admin/selectAudio.png?www44',
'auto'      : false,
'multi'     : false,
'queueSizeLimit' : 1,
'onSelect' : function(file) {
           $('#audio_upload').uploadify('disable', true);
          
        },
'onCancel' : function(file) {
           $('#audio_upload').uploadify('disable', false);
           
        },
        
'onUploadError' : function(file, errorCode, errorMsg, errorString) {
           //$('#video_cover_upload').uploadify('disable', false);
          $('#audio_upload').uploadify('disable', false);
 
 },
'onUploadSuccess'  : function(file,data,response) {
    $('#audio_upload').uploadify('disable', false);
    $('.gallery').prepend(data);
   refresh();
   
    
   }
});
});



function submit_audio(){

	$('#audio_upload').uploadify('upload','*');
			
}


//deleting docs

// deleting an audio function 
$('.gallery').on('click','.delete-audio',function() {
 if (confirm("Are you sure?")) {

  
 var id = $(this).attr('audio-id');
 $.post('/admin/media/delete/',{id:id}, function(data) {
	  if(data == 1){
	  $('#'+id).remove();							 
	  return false;
	  }
	  else{ 
	  $('.gallery').prepend(data);

	  
	  alert('Error While Deleting');}
                                                        }); 
     return false;   
    }
 
  
return false; 
});


// When the document is ready set up our sortable with it's inherant function(s) 
    $(document).ready(function() { 
        $(".gallery").sortable({ 
        
            placeholder: "ui-sortable-placeholder",
            zIndex: 9999,
            handle : '.handle', 
            tolerance: "pointer",
            distance: 1 ,
            update : function () { 
                var order = $('.gallery').sortable('toArray'); 
                
                order= JSON.stringify(order);
                
                 $.post('/admin/media/reorder/',{order:order}, function(data) {});
            } 
        }); 
    }); 
    $(function(){$('.gallery').mixitup();});



//date picker 



