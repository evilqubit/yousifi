function update_brand(url){
	
	window.location.href=url;
}


function update_search_section(){
	var section_filter=$("#section_filter").val();
	
	if( section_filter == ''){
		$('#search_category_filter').html('');
		
	}else{
		
		
		
		$.ajax({
			url: '/Pages/section_filter/'+section_filter,
			beforeSend:function(data){
				$('#searchLoader').show();
			},
			success: function(data){
				// videoEmbed = '<iframe id="ytplayer" type="text/html" width="449" height="314" src="'+vURL+'?autoplay=1" frameborder="0"></iframe>';
				$("#search_category_filter").show();
				
				$('#search_category_filter').html(data);
				
				
				  
				//$('.photo_gallery_video_element').html(videoEmbed);
				
			},
			complete: function(){
				$('#searchLoader').hide();
				
				
			}
		});
	
	
	}
}
