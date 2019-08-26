$(document).ready(function(){
	$('.lightbox').lightBox();
});


var addLabel;

function change_status_listing_page(approve_location,original_div,new_div,output_id,row_title){

	original_content=$('#'+original_div).html();

	$('#'+original_div).html($('#loader_div').html());

	if(output_id)
	$("#title_"+output_id).html(row_title);
	$.ajax({
		url: approve_location,
		success: function(data){
			if(data==1){
				$('#'+original_div).hide();
				$('#'+original_div).html(original_content);
				$('#'+new_div).show();
			}
			else{
				$('#'+original_div).html(original_content);
			}
		}
	});
}
function change_default(id,default_text,curr_value,type){
	if(type==true){
		if(curr_value=='')
		$(id).value=default_text;
	}else{
		if(curr_value==default_text)
		$(id).value='';
	}
}
function sort_categ(controller,action){
	var index=$('#select_sort').val();
	window.location.href='/admin/'+controller+'/'+action+'/'+index;
}


function update_news_type(){
	var index=$('#new_category').val();
	window.location.href='/admin/DynamicPages/index_news/'+index;
}
function getRelatedSections(module){
	module = '/admin/security_acls/generate/'+module;
	$.ajax({
		type: 'post',
		data: '',
		url: module,
		cache: false,
		success: function(data){
			$('#related_sections').html(data);
		}
	});
}
function getRelatedMembers(urlvalue){
	module = '/admin/security_acls/generate_members/'+urlvalue;
	$.ajax({
		type: 'post',
		data: '',
		url: module,
		cache: false,
		success: function(data){
			$('#members').html(data);
		}
	});
}
function change_default(id,default_text,curr_value,type){
	if(type==true){
		if(curr_value=='')
		$(id).value=default_text;
	}else{
		if(curr_value==default_text)
		$(id).value='';
	}
}
function CheckFieldLength(fn,rn,mc) {
	var len = $("#"+fn).val().length;
	if (len > mc) {
		$("#"+fn).val($("#"+fn).val().substring(0,mc));
		len = mc;
	}
	document.getElementById(rn).innerHTML = mc - len;
}
function validChars(e,goods,field,max) {
	var key, keychar;
	key = (window.event) ? window.event.keyCode : ((e) ? e.which : null);
	if (key == null) return true;

	keychar = String.fromCharCode(key);
	keychar = keychar.toLowerCase();
	goods = goods.toLowerCase();

	if (goods.indexOf(keychar) != -1)
	return true;

	if (key==null || key==0 || key==8 || key==9 || key==13 || key==27)
	return true;

	return false;
}
function delete_entry(delete_location,row_id,del_div){
	if(window.confirm("Are you sure you want to delete this entry and all of its related data?")){
		$('#'+del_div).html($('#loader_div').html());
		$.ajax({
			url: delete_location,
			success: function(data){
				$('#'+row_id).fadeOut();
			}
		});
	}
}
function remove_entry(delete_location,row_id,del_div){
	if(window.confirm("Are you sure you want to remove it from the list?")){
		$('#'+del_div).html($('#loader_div').html());
		$.ajax({
			url: delete_location,
			success: function(data){
				$('#'+row_id).fadeOut();
			}
		});
	}
}

function change_home_status(approve_location,original_div,new_div){

	original_content=$('#'+original_div).html();
	
	
	$('#'+original_div).html($('#loader_div').html());
	
	
	var r=confirm("This is already selected one , do you want overwrite?");
	if (r==true){
	
		$.ajax({
			url: approve_location,
			success: function(data){
				if(data==1)
				{
					$('.home_icon_active').hide();
					$('.home_icon_archive').show();
					
					$('#'+original_div).hide();
					$('#'+original_div).html(original_content);
					$('#'+new_div).show();
				}
				else
				{
					
					$('#'+original_div).html(original_content);
					alert(data);
				}
			}
		});
	}
}
function change_status(approve_location,original_div,new_div,output_id,row_title){

	original_content=$('#'+original_div).html();
	//console.log(original_div);
	$('#'+original_div).html('<img src="/img/ajax-loader.gif" width="20" height="20" />');

	if(output_id)
	$("#title_"+output_id).html(row_title);
	
	$.ajax({
		url: approve_location,
		success: function(data){
			if(data==1)
			{
				
				$('#'+original_div).hide();
				$('#'+original_div).html(original_content);
				$('#'+new_div).show();
			}
			else
			{
				
				$('#'+original_div).html(original_content);
				alert(data);
			}
		}
	});
}
function change_status_with_confirm(approve_location,original_div,new_div,output_id,row_title){

	original_content=$('#'+original_div).html();

	$('#'+original_div).html($('#loader_div').html());

	if(output_id)
	$("#title_"+output_id).html(row_title);
	
	$.ajax({
		url: approve_location,
		success: function(data){
			if(data==1)
			{
				
				$('#'+original_div).hide();
				$('#'+original_div).html(original_content);
				$('#'+new_div).show();
			}
			else
			{
				var r=confirm(data);
				if (r==true)
				  {
				  	
				  	$.ajax({
					url: approve_location+'/1',
					success: function(data){
						  	$('#'+original_div).hide();
							$('#'+original_div).html(original_content);
							$('#'+new_div).show();
						}
					});
				  	
				  	
				  }
				else
				  {
				  	$('#'+original_div).html(original_content);
				  } 
				
				
			}
		}
	});
}

function change_parents_list(selectBox){
	var selected_section=$(selectBox).val();
	var loc="/admin/dynamic_pages/get_parents_list/"+selected_section;
	
	$("#parentsSelectDiv").html("<img src='/img/admin/loader2.gif' alt='loading...' />");
	$.ajax({
		url: loc,
		success: function(data){
			$("#parentsSelectDiv").html(data);
		}
	});
}
var page_type="";
var default_view="";
function change_page_type(radioBtn){
	value=$(radioBtn).val();
	checked=$(radioBtn).attr('checked');

	if(page_type==""){
		default_view=$("#pageFormDiv").html();
		page_type=$("#pageTypeField").val();
		
		loc="/admin/dynamic_pages/open_form/"+value;
		$("#pageFormDiv").html("<img src='/img/admin/loader2.gif' alt='loading...' />");
		$('#pageFormDiv').load(loc);
	}else{
		
		if(value==page_type){
			$("#pageFormDiv").remove();
			if (CKEDITOR.instances['DynamicPageTextEng']) {
			   delete CKEDITOR.instances['DynamicPageTextEng'];
			 }

			$("#pageFormContainer").html('<div class="FloatClass" style="width:100%;height:auto;overflow:hidden;" id="pageFormDiv">'+default_view+'</div>');
			if($("#cke_DynamicPageTextEng")){
				$('#cke_DynamicPageTextEng').attr('id','cke_DynamicPageTextEngTemp');
				$('#cke_DynamicPageTextEng').remove();
				$('#cke_DynamicPageTextEngTemp').attr('id','cke_DynamicPageTextEng');
			}
			
		}else{
			if (CKEDITOR.instances['DynamicPageTextEng']) {
			   delete CKEDITOR.instances['DynamicPageTextEng'];
			 }
			 
			loc="/admin/dynamic_pages/open_form/"+value;
			$("#pageFormDiv").html("<img src='/img/admin/loader2.gif' alt='loading...' />");
			$('#pageFormDiv').load(loc);
		}
	}
//	
//	$.ajax({
//		url: loc,
//		success: function(data){
//			$("#pageFormDiv").html(data);
//		}
//	});
}
function delete_image(imgId,loc){
	value=$("#pageTypeField").val();
	if(window.confirm("Are you sure you want to delete this image?")){
		$.ajax({
		url: loc,
		success: function(data){
			if(data==1){
				$("#image_container"+imgId).remove();
				if(value==page_type){
					default_view=$("#pageFormDiv").html();
				}
				
			}
			else alert(data);
		}
	});
	}
}

function open_relations_div(data_array,relate_sections,edit_id){
	
	loc="/admin/relations/generate_list/"+relate_sections+"/"+edit_id;
	$.ajax({
		url: loc,
		data:'data='+data_array,
		success: function(data){
			$("#relations_div").html(data);
			$("#relations_div").slideToggle(1000)
		}
	});
//	$('#relations_div').load(loc);
}

function select_all_entries(i){
	
	 $("#box"+i+" option").each(function(){
 		$(this).attr('selected','selected')
	 });
	$("#box"+i+" option:first").attr('selected','');
	 
}

var a = new Array();
toggle_image = function (id)
{
	text=document.getElementById('img_'+id).innerHTML;
	text3=document.getElementById('image3').innerHTML;
	text2=document.getElementById('image2').innerHTML;
	if(text==text3 || a[id]==3)
	{
		a[id]=2;
		document.getElementById('img_'+id).innerHTML=text2;
	}
	else
	{
		a[id]=3;
		document.getElementById('img_'+id).innerHTML=text3;
	}
}

function open_type_categs(){
	type_id=$("#RentVehicleVehicleType").val();
	
	loc="/admin/vehicles/open_rent_categs/"+type_id;
	$.ajax({
		url: loc,
		success: function(data){
			$("#cat_div").html(data);
		}
	});
	
}

function order_side_banners(elmt){
	value = $(elmt).val();
	
	if(value != -1)
		window.location.pathname = "/admin/banners/order/"+value;
}

var page_counter=0;
function add_page_banner(){
	var count=$ ('#banner_pages option:selected').length;
	
	selected_index = $("#banner_pages").attr("selectedIndex");
	$("#banner_pages option:selected").each(function (i) {

//		alert($ ('#banner_pages').val());
		banner_id = $(this).val(); 
		banner_name = $(this).text();
		
//		banner_id = $ ('#banner_pages').val()
//		banner_name = $ ('#banner_pages').text()
		
		$('#chosen_pages').append('<input type="hidden" value="'+selected_index+'" id="chosen_hidden_page'+banner_id+'" \/><div id="page_'+banner_id+'"  style="background-color:#CCCCCC;margin:1px"><input type="hidden" name="data[Banner][chosen_pages_ids][]" value="'+banner_id+'" /><span onclick="remove_page_banner(\''+banner_id+'\',\''+banner_name+'\');" style="cursor:pointer" >[X]</span> '+banner_name+'</div>');
		
		$("#banner_pages option[value='"+banner_id+"']").remove();
			
	});


}

function remove_page_banner(banner_id,banner_name){
	$('#page_'+banner_id).remove();
	$('#banner_pages').append($('<option></option>').val(banner_id).html(banner_name));
}

function change_type(type){
	var page_type = type.value;
	if (type.checked == true){
		if ($("#page_types_pane_"+page_type+' .page_type_disabled_layer').length){
			$("#page_types_pane_"+page_type+' .page_type_disabled_layer').remove();
		}
	}
	else if (type.checked == false){
		if (!$("#page_types_pane_"+page_type+' .page_type_disabled_layer').length){
			$("#page_types_pane_"+page_type).append("<div class='page_type_disabled_layer'></div>");
		}
	}
}

function removeImg(id ,folderName){
	if(window.confirm("Are you sure you want to delete this image?")){
		$.ajax({
			url:"/admin/images/delete/"+id,
			success: function(){
				$("#imgDiv"+id).remove();
				
			}
		});
	}
}
function removeSelectedImg(url ,id){
	if(window.confirm("Are you sure you want to delete this image?")){
		$.ajax({
			url:url,
			success: function(){
				$("#imgDiv"+id).remove();
				
			}
		});
	}
}
function removePreviewImg(id ,folderName){
	if(window.confirm("Are you sure you want to delete this image?")){
		$.ajax({
			url:"/admin/images/thumb_delete/"+id,
			success: function(){
				$("#imgDiv"+id).remove();
				url:"/admin/images/thumb_delete/"+id,
				$.ajax({
					url:"/admin/images/delete/"+id,
					success: function(){
						$("#imgDiv"+id).remove();
						$('#AddThumbImagesDiv').show();
					}
				});
				
			}
		});
	}
}

function removeThumbImg(id){
	if(window.confirm("Are you sure you want to delete this image?")){
		$.ajax({
			url:"/admin/images/thumb_delete/"+id,
			success: function(){
				$('#imgDiv'+id).children('.ThumbimgDiv').remove();
				//$("#ThumbimgDiv"+id).remove();
				$('#AddThumbImagesDiv_'+id).show();
			}
		});
	}
}
function removeThumbEditImg(id){
	if(window.confirm("Are you sure you want to delete this image?")){
		$.ajax({
			url:"/admin/images/thumb_delete/"+id,
			success: function(){
				$('#imgDiv'+id).children('.ThumbimgDiv').remove();
				//$("#ThumbimgDiv"+id).remove();
				$('#AddThumbImagesDiv_'+id).show();
				init_uploadify_3(id);
			}
		});
	}
}

function validate_image(){
	var valid = $('.AddThumbImagesDiv').is(":visible");
			
		if (valid == false){
			return true;
		}
		else{
			$('.AddThumbImagesDiv').each(function(index) {
				    
				   var valid = $(this).is(":visible");
				   if(valid == true){
				  	 $(this).parent().parent().css('border','2px solid red'); 	
				   }
				  
				});

			alert('please fill all thumb images requested');
			return false;
		}
}
// function openRelatedPages(){
	// $("#relatedEntries").css("height",'300');
	// if($('#related_pages_div').is(":visible"))
		// $('#related_pages_div').slideUp();
	// else $('#related_pages_div').slideDown();
// }


function openRelatedPages(controller, pageId , section_id){
	$("#related_pages_div").html("<img src='/img/admin/loader.gif' alt='' />");
	
	
	
	loc="/admin/"+controller+"/display_related_pages/"+pageId+'/'+section_id;
	$.ajax({
		url: loc,
		success: function(data){
			$("#related_pages_div").html(data);
			
			video_changed();
			image_changed();
		}
	});
}


function select_all_entries(){
	 $("#related_pages option").each(function(){
 		$(this).attr('selected','selected')
	 });
}

function unselect_all_entries(){
	 $("#related_pages option").each(function(){
 		$(this).removeAttr('selected')
	 });
}

function typeChanged(typeSelect){
	
	if(typeSelect.value == 'file'){
		$('#file_div').show();
		$('#server_div').hide();
		$('#youtub_div').hide();
	}
	else if(typeSelect.value == 'server'){
		$('#file_div').hide();
		$('#server_div').show();
		$('#youtub_div').hide();
	}
	else if(typeSelect.value == 'url'){
		$('#file_div').hide();
		$('#server_div').hide();
		$('#youtub_div').show();
	}
}
function ChangeType(type){
	
	if(type == 'file'){
		$('#file_div').show();
		$('#server_div').hide();
		$('#youtub_div').hide();
	}
	else if(type == 'server'){
		
		$('#file_div').hide();
		$('#server_div').show();
		$('#youtub_div').hide();
	}
	else if(type == 'url'){
		$('#file_div').hide();
		$('#server_div').hide();
		$('#youtub_div').show();
	}
}

function changeSeason(elmt){
	seasonYear = $(elmt).val();
	
	urlLoc = "/admin/seasons/list/"+seasonYear+"/1";
	
	$.ajax({
		url:urlLoc,
		success: function(data){
			$("#list").html(data);
		},
		beforeSend: function(){
			$("#list").html("<img src='/img/admin/ajax-loader.gif' alt='' />");
		}
	});
}

function generate_designers(elmt){
	brandId = $(elmt).val();
	
	urlLoc = "/collections/generate_designers/"+brandId;
	
	$.ajax({
		url:urlLoc,
		success: function(data){
			$("#designerDiv").html(data);
		},
		beforeSend: function(){
			$("#designerDiv").html("<img src='/img/admin/ajax-loader.gif' alt='' />");
		}
	});
}

function display_designer_details(){
	designerId = $("#CollectionDesignerId").val();
	
	if(designerId > 0){
		urlLoc = "/admin/designers/change_info/"+designerId;
		$.ajax({
			url:urlLoc,
			success: function(data){
				$("#designerInfoDiv").html(data);
			},
			beforeSend: function(){
				$("#designerInfoDiv").html("<img src='/img/admin/ajax-loader.gif' alt='' />");
			}
		});
	}
}

function show_hide_image_feilds(image_id , status){
	if(status == 1){
		$('#'+image_id).show();
	}else if (status == 0){
		$('#'+image_id).hide();
	}
}

function show_hide_image_upload(status){
	if(status){
		$('#new_in_image').show();
	}else{
		$('#new_in_image').hide();
	}
	
	
}

function show_hide_home_news(status){
	if(status){
		$('.new_in_image').show();
	}else{
		$('.new_in_image').hide();
	}
	
	
}
////////////////////////////////////////////////////   related items //////////////////////////////////////////////
function opne_related_category(cat_path , brand_id){
	urlPath=cat_path;
	if($('#'+brand_id).is(":empty")){
		$.ajax({
			url: urlPath,
			beforeSend:function(data){
				$('#'+brand_id).css('height','280px');
			},
			success: function(data) {
					$('#'+brand_id).html(data);
			}
			,
			complete: function(){
			}
		});
	}
}


var chosenItems = {};

function highlightRelatedImage(elmt,brand_id,cat_id){
	imageId = $(elmt).attr("id");
	imageId = imageId.replace("relateImageEntryCheck","");
	
	imageId= parseInt(imageId);

	if(!chosenItems[brand_id])
		chosenItems[brand_id] = {};
	if(!chosenItems[brand_id][cat_id])
		chosenItems[brand_id][cat_id] = [];	
	
	if($(elmt).is(":checked")){
		$("#relateImage"+imageId).css("border","solid 4px #aeaeae");
		$("#green_checkmarkDiv"+imageId).css("visibility","visible");
		chosenItems[brand_id][cat_id].push(imageId);
	}else{
		$("#relateImage"+imageId).css("border","solid 4px #efefef");
		$("#green_checkmarkDiv"+imageId).css("visibility","hidden");
		
		for (var i=0 ; i < chosenItems[brand_id][cat_id].length ; i++ ){
		   if (chosenItems[brand_id][cat_id][i] == imageId){
		   		chosenItems[brand_id][cat_id].splice(i, 1);
		   }   
		} 
	}
	//console.log(chosenItems);
}


function close_overlay(){

	var overlayObj = $("#overlay").data("overlay");
	if(overlayObj)
		overlayObj.close();
	chosenItemsJson = JSON.stringify(chosenItems);
	$("#related_items_list").val(chosenItemsJson);
}
//used with multiselect plugin
function open_related_items(elmt, path , brand_id){	
	var cat_id = $(elmt).val();
	
	if(!$(elmt).attr("checked")){
		$("#imageTooltipDiv"+brand_id+'_'+cat_id).remove();
		brand_id="brand_"+brand_id;
		cat_id="cat_"+cat_id;
		
		if(!chosenItems[brand_id]){
			chosenItems[brand_id] = {};
		}
		if(!chosenItems[brand_id][cat_id]){
			chosenItems[brand_id][cat_id] = [];
		}
		chosenItems[brand_id][cat_id] = [];
		chosenItemsJson = JSON.stringify(chosenItems);
		//console.log(chosenItemsJson);
		$("#related_items_list").val(chosenItemsJson);
		
	}else{
		 $("#overlay").overlay({
		 	top:0,
		 	oneInstance: false, 
	        mask: {
				color: '#000000', 
				loadSpeed: 200, 
				opacity: 0.5
			},
			onClose : function () {
				chosenItemsJson = JSON.stringify(chosenItems);
				$("#related_items_list").val(chosenItemsJson);
			},
			fixed:false
	    });
	    
	    
		loc=path+"/"+cat_id;
		$.ajax({
			url: loc,
			//data:{"chosenImages":chosenImagesIds,"alreadyRelatedImagesIds":alreadyRelatedImagesIds},
			success: function(data){
				$("#contentWrap").html(data);
				
				$("#contentWrap").show();
				$("#overlay").overlay().load();
			}
		});
	}
}
function open_related_items2(path){
		 $("#overlay").overlay({
		 	top:0,
		 	oneInstance: false, 
	        mask: {
				color: '#000000', 
				loadSpeed: 200, 
				opacity: 0.5
			},
			fixed:false,
			onClose : function () {
				chosenItemsJson = JSON.stringify(chosenItems);
				$("#related_items_list").val(chosenItemsJson);
			}
	    });
	    
		loc=path;
		$.ajax({
			url: loc,
			success: function(data){
				$("#contentWrap").html(data);
				$("#contentWrap").show();
				$("#overlay").overlay().load();
				
			}
		});
}






function toggelSeo(){
	$("#seo_box").slideToggle(500 , function(){
		if($('#seo_arrow').hasClass('seo_arrow_down')){
			$('#seo_arrow').removeClass('seo_arrow_down');
			$('#seo_arrow').addClass('seo_arrow_up');
		}else{
			$('#seo_arrow').removeClass('seo_arrow_up');	
			$('#seo_arrow').addClass('seo_arrow_down');
		}
			
		});
	
}

var map =
[
'\u0660','\u0661',"\u0662","\u0663","\u0664",
"\u0665","\u0666","\u0667","\u0668","\u0669"
];

function getArabicNumbers(str)
{
    var newStr = "";

    str = String(str);

    for(i=0; i<str.length; i++)
    {
        newStr += map[parseInt(str.charAt(i))];
    }

    return newStr;
}	 

function open_video(image,video){
	 $("#overlay").overlay({
		 	top:0,
		 	oneInstance: false, 
	        mask: {
				color: '#000000', 
				loadSpeed: 200, 
				opacity: 0.5
			},
			fixed:false,
			onClose : function () {
				$("#player1").remove();
			}
	    });
	    
	    
	data='<div id="player1"></div>';
	    
    $("#contentWrap").html(data);
	$("#contentWrap").show();
	$("#overlay").overlay().load();
	
	
	 jwplayer("player1").setup({
        file: "/files/videos/video_file/"+video,
        image: "/files/videos/image/"+image,
        base: "/js/jquery/jwplayer/",
        width: 684,
        height: 386
    });
	    
}

function open_song(song_file){
	 $("#overlay").overlay({
		 	top:80,
		 	oneInstance: false, 
	        mask: {
				color: '#000000', 
				loadSpeed: 200, 
				opacity: 0.5
			},
			fixed:false,
			onClose : function () {
				$("#player1").remove();
			}
	    });
	    
	    
	data='<div id="player1"></div>';
	    
	$("#overlay").css("height","100px");
	$("#contentWrap").css("height","50px");
	
    $("#contentWrap").html(data);
	$("#contentWrap").show();
	$("#overlay").overlay().load();
	
	
	
	 jwplayer("player1").setup({
        file: "/files/song/"+song_file,
        base: "/js/jquery/jwplayer/",
        width: 400,
        height: 30,
        autostart: true
    });
}
function clear_img_path (elm){
	var id=$(elm).parent().find('input').attr('id');
	
	$('#'+id).val('');
	
}


///////////////////////////// related images ///////////////////////
var chosenImages = {};
var alreadyRelatedImages = new Array();
function open_related_album(elmt){
	
	
	var chosenImagesIds = JSON.stringify(chosenImages);
	var alreadyRelatedImagesIds = JSON.stringify(alreadyRelatedImages);
	  
	if($("option:not(:selected):last",elmt)){
		
		cancelledAlbumId = $("option:not(:selected):last",elmt).val();
		delete chosenImages[cancelledAlbumId];
		
		
	}
	
	if($("option:selected:last",elmt)){
	
		albumId = $("option:selected:last",elmt).val();
		
		 $("#overlay").overlay({
		 	top:0,
		 	oneInstance: false, 
	        mask: {
				color: '#000000', 
				loadSpeed: 200, 
				opacity: 0.5
			},
			fixed:false
	    });
	    
	    
		loc="/admin/Images/display_related_images/"+albumId;
		$.ajax({
			url: loc,
			data:{"chosenImages":chosenImagesIds,"alreadyRelatedImagesIds":alreadyRelatedImagesIds},
			success: function(data){
				$("#contentWrap").html(data);
				
				$("#contentWrap").show();
				$("#overlay").overlay().load();
				
			}
		});
		
	}
	
}

function close_overlay(){

	var overlayObj = $("#overlay").data("overlay");
	
	if(overlayObj)
		overlayObj.close();
		
	
	var albums_images_val = "";
	
	chosenImagesJson = JSON.stringify(chosenImages);
	$("#albums_images").val(chosenImagesJson);
	
	
	
	
	
//	alert(chosenImagesJson);
//	$.each(chosenImages , function( albumId, albumImages ) {
//	    $.each(albumImages, function( key1, key2 ) {
//	    	
//	       alert("album : "+albumId+" image: "+key1+" / "+key2)
//	    });
//	});
//
}



function highlightRelatedImage(elmt,albumId){
	imageId = $(elmt).attr("id");
	imageId = imageId.replace("relateImageEntryCheck","");
	
	latestOpenAlbumId = 0;
	
	if(!chosenImages[albumId])
		chosenImages[albumId] = {};
		
	if($(elmt).is(":checked")){
		$(elmt).parent().css("border","solid 4px #aeaeae");
		$("#green_checkmarkDiv"+imageId).css("visibility","visible");
		chosenImages[albumId][imageId] = imageId;
	}else{
		$(elmt).parent().css("border","solid 4px #efefef");
		$("#green_checkmarkDiv"+imageId).css("visibility","hidden");
		delete chosenImages[albumId][imageId];
	}

	
}

function video_changed(){
	//set Video flag
	$("#has_video").val(0);
	$("[name^='data[PagesRelation][Video]']").each(function(){
		
		if($(this).attr("checked") == "checked"){
			$("#has_video").val(1);
		}
	});
}

function image_changed(){
	//set image flag
	$("#has_image").val(0);
	$("[name^='data[PagesRelation][Album]']").each(function(){
		
		if($(this).attr("checked") == "checked"){
			$("#has_image").val(1);
		}
	});
	
}

//used with multiselect plugin
function related_album_click(elmt){
	
	
	image_changed();
	
	
	var chosenImagesIds = JSON.stringify(chosenImages);
	var alreadyRelatedImagesIds = JSON.stringify(alreadyRelatedImages);
	
	albumId = $(elmt).val();
	
	if(!$(elmt).attr("checked")){
		$("#imageTooltipDiv"+albumId).remove();
		delete chosenImages[albumId];
	}else{
		 $("#overlay").overlay({
		 	top:0,
		 	oneInstance: false, 
	        mask: {
				color: '#000000', 
				loadSpeed: 200, 
				opacity: 0.5
			},
			fixed:false
	    });
	    
	    
		loc="/admin/Images/display_related_images/"+albumId;
		$.ajax({
			url: loc,
			data:{"chosenImages":chosenImagesIds,"alreadyRelatedImagesIds":alreadyRelatedImagesIds},
			success: function(data){
				$("#contentWrap").html(data);
				
				$("#contentWrap").show();
				$("#overlay").overlay().load();
				
			}
		});
		
	}
	
}

function display_images_tooltip(elmt){
	
	childCheckbox = $(elmt).children(":first");
	
	if($(childCheckbox).attr("checked") != "checked"){
		return false;
	}
	
	albumId = $(childCheckbox).val();
	
	
	var html = "<div class='imageTooltipDiv' id='imageTooltipDiv"+albumId+"' onclick='related_album_click(childCheckbox)'>Choose Images</div>";
	
	
	if($("#imageTooltipDiv"+albumId).length == 0)
		$(elmt).after(html);
}

function hide_images_tooltip(elmt){
	
	childCheckbox = $(elmt).children(":first");
	
	if((childCheckbox).attr("checked") != "checked"){
		return false;
	}
	
	albumId = $(childCheckbox).val();
	
	
	if (!$('#imageTooltipDiv'+albumId).is(':hover')) {
		return false;
	}
	
	$("#imageTooltipDiv"+albumId).remove();
	
}



// image croping start ///////////////////
function view_sizes(sourceModel,imgId){
	$('.image_container').hide();
	$("#main_image_container").html("<img src='/img/admin/ajax-loader.gif' alt='' />");
	$("#main_image_container").css("width","640px");
	$("#main_image_container").css("height","auto");
	
	$.ajax({
		url: "/admin/images/view_size/"+sourceModel+"/"+imgId,
		success: function(data){
			$("#main_image_container").html(data);
			
		}
	});
}
function close_view_sizes(){
	$('#uploadedPic').imgAreaSelect({remove:true});
	$("#main_image_container").html("<img src='/img/admin/ajax-loader.gif' alt='' />");
	$("#main_image_container").empty();
	$("#main_image_container").css("width","0px");
	$("#main_image_container").css("height","0px");
	
	$('.image_container').show();
	
}
function cropImg(sourceModel ,imgId , dim){
	
	$('#'+dim+"_"+imgId).html("<img src='/img/admin/ajax-loader.gif' alt='' />");

	// $('#'+dim+"_"+imgId).css("width","600px");
	// $('#'+dim+"_"+imgId).css("height","500px");
	
	$.ajax({
		url: "/admin/images/crop_image/"+sourceModel+'/'+imgId+"/"+dim,
		success: function(data){
			$('#'+dim+"_"+imgId).html(data);
			
		}
	});
}
//////////////// end of image crop //////////////////



function related_pages_changed(){
	//set Video flag
	$("#has_filter").val(0);
	$("[name^='multiselect_data[PagesRelation][Filter]']").each(function(){
		
		if($(this).attr("checked") == "checked"){
			$("#has_filter").val(1);
		}
	});
}


function update_page_image_type(section){
	var type=$("#section_image_type_list").val();
	
	window.location.href='/admin/Sections/upload_section_images/'+section+'/'+type;
}


function update_image_type_index(module,section){
	var type=$("#section_image_type_list").val();
	
	window.location.href='/admin/Images/index/'+module+'/'+section+'/'+type;
}


function category_change(url){
	
	
	var cat_id=$("#category_list").val();
	
	window.location.href=url+cat_id;
}





function udpate_main_section(shop_sub_category_id , shop_id){
	
	if(shop_sub_category_id == ''){
		shop_sub_category_id=0;
	}
	if(shop_id == ''){
		shop_id=0;
	}
	section_id=$("#shop_main_category").val();
	
	$.ajax({
		url: '/admin/Banners/get_sub_category/'+section_id+"/"+shop_sub_category_id+"/"+shop_id,
		beforeSend:function(data){
			$(".mobileAjaxLoader").show();
		},
		success: function(data) {
				$('#sub_category').html(data);
		}
		,
		complete: function(){
			udpate_sub_section(shop_id );
			$(".mobileAjaxLoader").hide();
		}
	});	
}



function udpate_sub_section( shop_id ){
	
	if(shop_id == ''){
		shop_id=0;
	}
	category_id=$("#shop_sub_category").val();
	
	$.ajax({
		url: '/admin/Banners/get_shop/'+category_id+'/'+shop_id,
		beforeSend:function(data){
			$(".mobileAjaxLoader").show();
		},
		success: function(data) {
				$('#shop_list').html(data);
		}
		,
		complete: function(){
			$(".mobileAjaxLoader").hide();
		}
	});
	
}


function update_mobile_banner_type(type){
	if(type == 'Static'){
		$("#static_section").show();
		$("#dynamic_section").hide();
		$("#sub_category").hide();
		$("#shop_list").hide();
		
		
	}else{
		$("#static_section").hide();
		$("#dynamic_section").show();
		$("#sub_category").show();
		$("#shop_list").show();
	}
}




function update_video_snapp_type(type){
	if(type ==1){
		$("#video_image").hide();
	}else{
		$("#video_image").show();
	}
}

function udpate_main_section_pro(shop_sub_category_id , shop_id){
	
	if(shop_sub_category_id == ''){
		shop_sub_category_id=0;
	}
	
	if(shop_id == ''){
		shop_id=0;
	}
	section_id=$("#shop_main_category").val();
	if(section_id == 3){
		$('#sub_category').hide();
		udpate_sub_section_pro(shop_id  , 0 );
	}else{
		$.ajax({
			url: '/admin/MapLocators/get_sub_category/'+section_id+"/"+shop_sub_category_id+"/"+shop_id,
			beforeSend:function(data){
				$(".mobileAjaxLoader").show();
			},
			success: function(data) {
					$('#sub_category').html(data);
			}
			,
			complete: function(){
				$('#sub_category').show();
				udpate_sub_section_pro(shop_id );
				$(".mobileAjaxLoader").hide();
			}
		});	
	}
	
	
}



function udpate_sub_section_pro( shop_id , category_id,section_id ){
	if(shop_id == ''){
		shop_id=0;
	}
	
	if(!shop_id){
		shop_id=0;
	}
	
	
	
	if(category_id == "0"){
		
	}else{
		if(category_id == ''){
			category_id=1;
		}else{
		category_id=$("#shop_sub_category").val();
		}
	}
	
	if(!section_id && category_id == -1){
		section_id= $("#shop_main_category").val();
	}
	
	$.ajax({
		url: '/admin/MapLocators/get_shop/'+category_id+'/'+shop_id+'/'+section_id,
		beforeSend:function(data){
			$(".mobileAjaxLoader").show();
		},
		success: function(data) {
			$('#shop_list').html(data);
		}
		,
		complete: function(){
			$(".mobileAjaxLoader").hide();
		}
	});
	
}



function update_banner_type(){
	banner_type=$("#banner_type").val();
	
	if(banner_type == 'image'){
		$("#banner_type_container").hide();
		$("#main_image").show();
	}else{
		$("#banner_type_container").show();
		$("#main_image").hide();
	}	
}

function update_video_type(type){
	
	if(type == 1){
		$("#youtube_link").show();
		$("#video_file").hide();
	}else{
		$("#youtube_link").hide();
		$("#video_file").show();
	}
}




function open_video(id){
		$('#my_popup').popup({
			  onopen: function() {
			   $.ajax({
					url: '/Sections/open_video/'+id,
					beforeSend:function(data){
					$("#layerLoader").show();
						},
						success: function(data){
								$('#my_popup_content').html(data);
							
						},
						complete: function(){
							$("#layerLoader").hide();
						}
				});
			  }
			});
			
		$('#my_popup').popup('show');
			
	}
	


function banner_open_video(id){
		$('#my_popup').popup({
			  onopen: function() {
			   $.ajax({
					url: '/Banners/open_video/'+id,
					beforeSend:function(data){
					$("#layerLoader").show();
						},
						success: function(data){
								$('#my_popup_content').html(data);
							
						},
						complete: function(){
							$("#layerLoader").hide();
						}
				});
			  }
			});
			
		$('#my_popup').popup('show');
			
	}
	
	





function get_dynamicPages_subchildren(parent_id , section){		
	if($("#sub_"+parent_id).is(":hidden")){	
		$.ajax({
			url: '/admin/DynamicPages/index_sub/'+section+'/'+parent_id+"/?"+Math.random(),
			beforeSend:function(data){				
				$("#accordAjaxLoader_"+parent_id).show();
			},
			success: function(data){
				
				$('#sub_'+parent_id).html(data);
				
				$("#table2sort_"+parent_id).css('width' , "99.4%");
				$("#table2sort_"+parent_id).css('padding-left' , "0.5%");
				
				
				
				$('#sub_'+parent_id).slideDown();
				
				
				
			},
			complete: function(){	
				$("#arrow_"+parent_id).removeClass('icon-arrow-down');
				$("#arrow_"+parent_id).addClass('icon-arrow-up');		
				$("#accordAjaxLoader_"+parent_id).hide();
				
			}
		});
	}else{		
		$('#sub_'+parent_id).slideUp();
	}
}
