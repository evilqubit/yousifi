function bindArabicParser(){
	$(".numberEvent").bind("keyup",function(){parse_arabic_numbers(this)});

	$(".numberEvent").css("direction","ltr");
	$(".numberEvent").css("text-align","right");

	$(".numberEvent").bind("change",function(){parse_arabic_numbers(this)});
}
function parse_arabic_numbers(elmt){
	if(!$(elmt).hasClass("email") && !$(elmt).hasClass("domain") &&  !$(elmt).hasClass("recaptcha_response_field") &&  !$(elmt).hasClass("textArea")  ){ //email fieds can contain english numbers
		
		inputContent = $(elmt).val();
		
		
		arabicNbs = ["\u0660","\u0661","\u0662","\u0663","\u0664","\u0665","\u0666","\u0667","\u0668","\u0669"];
		
		for(var i=0; i < inputContent.length; i++){
			var digit = inputContent[i];
			
			if(!isNaN(digit) && digit.length == 1 && digit!= ' ' && Number(digit) >=0 && Number(digit)<=9 ){
				inputContent = inputContent.replace(digit, arabicNbs[digit]);
//				 console.log(arabicNbs[digit]);			
			}			
		}
		
		$(elmt).val(inputContent);
		
		return false;
	}
}
function parse_arabic_numbers1(elmt){

	if(!$(elmt).hasClass("email") && !$(elmt).hasClass("domain")){ //email fieds can contain english numbers
		inputContent = $(elmt).val();
	
		arabicNbs = ["\u0660","\u0661","\u0662","\u0663","\u0664","\u0665","\u0666","\u0667","\u0668","\u0669"];
		//	arabicNbs = ["&#1633;"];
	
		for(i=9;i>=0;i--){
			//inputContent = inputContent.replace(new RegExp(i, 'g'),$("#number"+i).val());
			
			inputContent = inputContent.replace(new RegExp(i),arabicNbs[i]);
					
		}
		
		$(elmt).val(inputContent);
	}
}


function parse_arabic_numbers_(elmt){
    // inputContent = $(elmt).val();
	//alert(elmt);
     arabicNbs =["\u0660","\u0661","\u0662","\u0663","\u0664","\u0665","\u0666","\u0667","\u0668","\u0669"];
     //    arabicNbs = ["&#1633;"];

     for(i=0;i<=9;i++){
         //        inputContent = inputContent.replace(new RegExp(i, 'g'),$("#number"+i).val());
        // inputContent = elmt.replace(new RegExp(i, 'g'),arabicNbs[i]);
         
         if(i ==elmt )
         inputContent=arabicNbs[i]
     }
	
	return inputContent;
     //$(elmt).val(inputContent);
}

function open_splash_section(section , logo){

		
	if($('#'+section).is(':hidden')){
		$('.close_btn').show();
		$.when($('.splash_section_text').slideUp()).done(function(){ 
			$('.splash_section_logo').hide();
			$('#'+logo).show();
			
			$('#'+section).slideToggle(); 
			$('html, body').animate({scrollTop: $("#"+section).offset().top}, 1500);
		});
		
	}
}


function openMenuContent(url){

	$.ajax({
		url: url,
		beforeSend:function(data){
			$('#contentLoader').show();
		},
		success: function(data){
			// videoEmbed = '<iframe id="ytplayer" type="text/html" width="449" height="314" src="'+vURL+'?autoplay=1" frameborder="0"></iframe>';

			$('#tabsContent').html(data);
			
			//$('.photo_gallery_video_element').html(videoEmbed);
			
		},
		complete: function(){
			$('#contentLoader').hide();
			$('.lightbox').lightBox();
			//$('.ajaxLoader').hide();
		}
	});
}
function close_splash_msg(){
	$('.splash_section_text').slideUp();
	$('.close_btn').hide();
	$('.splash_section_logo').hide();
	$('#stander').show();
}

function embed_video(title,id){
	// if(vURL  != "" ){
		// videoEmbed = '<iframe id="ytplayer" type="text/html" width="449" height="314" src="http://'+vURL+'?autoplay=1" frameborder="0"></iframe>';
		// $('#photoOverlay').html(videoEmbed);
		// $("#photoOverlay").overlay().load();
	// }
	
	
	loc="/Videos/view_video/"+id+'/'+title;
	$.ajax({
		url: loc,
		beforeSend:function(data){
			//$('.ajaxLoader').show();
		},
		success: function(data){
			// videoEmbed = '<iframe id="ytplayer" type="text/html" width="449" height="314" src="'+vURL+'?autoplay=1" frameborder="0"></iframe>';

			$('#photoOverlay').html(data);
			$("#photoOverlay").overlay().load();
			//$('.photo_gallery_video_element').html(videoEmbed);
			
		},
		complete: function(){
			scroll_window();
			//$('.ajaxLoader').hide();
		}
	});
}


function close_image_video_overlay(){
	$('#photoOverlay').overlay().close();
	 $('#photoOverlay').html('');
}

function scroll_window(){
	$('html, body').animate({
			    scrollTop: 400,
			    scrollLeft: 0
			}, 1000);

}


function open_home_album(url){
		loc=url;
		$.ajax({
			url: loc,
			beforeSend:function(data){
				//$('.ajaxLoader').show();
			},
			success: function(data){
				$('#home_album_overlay').html(data);
				$("#home_album_overlay").overlay().load();
			},
			complete: function(){
				scroll_window();
				//$('.ajaxLoader').hide();
			}
		});
}



function open_service_overlay(url){
	
		
		loc=url;
		$.ajax({
			url: loc,
			beforeSend:function(data){
				//$('.ajaxLoader').show();
			},
			success: function(data){
				$('#photoOverlay').html(data);
				$("#photoOverlay").overlay().load();
			},
			complete: function(){
				scroll_window();
				//$('.ajaxLoader').hide();
			}
		});
}
function open_search_overlay(url){
	
		
		loc=url;
		$.ajax({
			url: loc,
			beforeSend:function(data){
				//$('.ajaxLoader').show();
			},
			success: function(data){
				$('#photoOverlay').html(data);
				$("#photoOverlay").overlay().load();
			},
			complete: function(){
				
				//$('.ajaxLoader').hide();
			}
		});
}
function open_comming_soon_overlay(url){
	
		
		loc=url;
		$.ajax({
			url: loc,
			beforeSend:function(data){
				//$('.ajaxLoader').show();
			},
			success: function(data){
				$('#photoOverlay').html(data);
				$("#photoOverlay").overlay().load();
			},
			complete: function(){
				
				//$('.ajaxLoader').hide();
			}
		});
}

function check_year_selection(elemnt){
	var current_year=$('#year_filter').val();
	if(current_year == ''){
		$('#month_filter').val('');
		$('#month_container').hide();
	}else{
		$('#month_container').show();
	}
	
}

function get_year_month_container(elemnt,lang){
	var current_section=$('#section_filter').val();
	
	if(current_section == "News"){
		loc='/'+lang+"/News/get_news_date/";
		$.ajax({
			url: loc,
			beforeSend:function(data){
				//$('.ajaxLoader').show();
			},
			success: function(data){
				$('#date_section').html(data);
				
			},
			complete: function(){
				
				//$('.ajaxLoader').hide();
			}
		});
	}else{
		$('#date_section').html('');
	}
	
	
	
}
function open_section(section){

	if($('#'+section).is(":hidden")){
		$.when($('.section_text').slideUp()).done(function(){ 
			$('#'+section).slideToggle(); 
			$('html, body').animate({scrollTop: $("#"+section).offset().top-100}, 1500);
			});
	}
}




// function open_service_category(elem , right , down){
	// var red_right_arrow=$(elem).parent().find('.'+right);
	// var red_dwon_arrow=$(elem).parent().find('.'+down);
// 	
	// var next =$(elem).next();
	// if($(next).is(":hidden")){
		// // $.when($('.inner_section_text').slideUp()).done(function(){ 
			// $('.inner_section_text').slideUp()
			// $(next).slideToggle(); 
			// //red_down_arrow
// 			
			// $('.'+down).hide();
			// $('.'+right).show();
// 			
			// $(red_right_arrow).hide();
			// $(red_dwon_arrow).show();
// 			
			// $('html, body').animate({scrollTop: $(next).offset().top-100}, 1500);
			// //});
	// }
// 	
// 	
// }


// function get_other_section(lang,section){
// 	
// 
	// if($('#'+section+'_section').length  == 0){
// 		
		// loc="/"+lang+'/DynamicPages/get_service/'+section;
		// $.ajax({
			// url: loc,
			// beforeSend:function(data){
				// $('.ajaxLoader').show();
			// },
			// success: function(data){
				// $('.section_container').hide();
				// $('.services_sections_text_container').append(data);
				// $('#'+section+'_section').show();
			// },
			// complete: function(){
				// $('.services_sections_logo').hide();
				// $('#'+section+'_active_container').show();
// 				
				// $('.ajaxLoader').hide();
			// }
		// });
	// }else{
		// $('.services_sections_logo').hide();
		// $('#'+section+'_active_container').show();
// 		
		// $('.section_container').hide();
// 		
		// $('#'+section+'_section').show();
	// }
// 	
// }




function paginationComplete(){
	$('.PaginationAjaxLoader').hide();
	
}

function pagination_start(){
	$('.PaginationAjaxLoader').show();
}


////////////////////////////
function show_news_details(url){
		//loc="/News/list_social_media/"+id+'/'+title+'/'+fb_like+'/'+page_id;
		$.ajax({
			url: url,
			beforeSend:function(data){
				$('#tabsContent').append("<div class='tabsContentLayer'>&nbsp;</div>");
				$('.tabsContentLoader').show();
			},
			success: function(data){
				$('#tabsContent').html(data);

			},
			complete: function(){
				$('.tabsContentLoader').hide();
				
				// var addthis_url = "http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-514af642790763f7";
				// if (window.addthis) {
				    // window.addthis = null;
				    // window._adr = null;
				    // window._atc = null;
				    // window._atd = null;
				    // window._ate = null;
				    // window._atr = null;
				    // window._atw = null
				// }
				// $.getScript(addthis_url);


				//FB.XFBML.parse();
				//addthis.init();

			}
		});
}

function show_news_short(id  , fb_like , page_id ){
	
	var top =$('#news_'+id).css('top');
	var current_top=top.split('px');
	
	if(current_top[0] > 0){
		$('#news_'+id).animate({top: '0px'},
		 1200,
		  function() {
		  	
			}

			);
		
		$('#arrow_'+id).removeClass('news_up_arrow').addClass('news_down_arrow');
		  	
			loc="/News/list_social_media/"+id+'/'+page_id+'/'+fb_like;
			$.ajax({
				url: loc,
				beforeSend:function(data){
					
				},
				success: function(data){
					$('#news_inner_social_media_'+id).html(data);
	
				},
				complete: function(){
					// var addthis_url = "http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-514af642790763f7";
					// if (window.addthis) {
					    // window.addthis = null;
					    // window._adr = null;
					    // window._atc = null;
					    // window._atd = null;
					    // window._ate = null;
					    // window._atr = null;
					    // window._atw = null
					// }
					// $.getScript(addthis_url);
	
	
					//FB.XFBML.parse();
					
	
				}
			});

		
	}else{
		
		$('#news_'+id).animate({top: '180px'}, 1200, function(){
			$('#arrow_'+id).removeClass('news_down_arrow').addClass('news_up_arrow');
		});
	}
	
}

function update_filter_year(){
	var year=$("#articleYearList").val();
	
	$(".articleMonthListContainer").hide();
	
	
//	var month_element= 'articleMonthListContainer_'+year;
//	$("#"+month_element).show();
}

function articleFind(loc){
	
	var year=$("#articleYearList").val();
//	var month_element= 'articleMonthList_'+year;
	var month_element= 'articleMonthList';
	
	var month=$("#"+month_element).val();
	
	
	if(year == ''){
		year=$("#first_year").val();
	}
	if( month == ''){
		month=$("#first_month").val();
	}
	
	
	
	if(!year) year = 0
	if(!month) month = 0
	
	
	$.ajax({
		url: loc+"/"+year+"/"+month,
		beforeSend:function(data){
			$(".filterAjax").show();
		},
		success: function(data){
			$('#paginatedContent').html(data);

		},
		complete: function(){
			$(".filterAjax").hide();

		}
	});
}

function change_default(id,default_text,curr_value,type){
	
	if(type==true)
	{
		if(curr_value=='')
		$("#"+id).val(default_text);
	}else{
		if(curr_value==default_text)
		$("#"+id).val("");
	}
}

function file_chosen(elmt , id){
	fileName = $(elmt).val();
	
	slashIndex = fileName.lastIndexOf("\\");
	
	if(slashIndex > 0){
		fileName = fileName.substring(slashIndex+1,fileName.length);
	}
	
	//check if path is // or \\
	$('#fileField_'+id).html(fileName);

}

function form_reset(id){

	$('#'+id).resetForm();

}

function openRelatedInfo(id){
	 
	
	 
	
	// $('#relatedInfo_'+id).slideToggle('fast', function() {
	    // Animation complete.
	  if($('#relatedInfo_'+id).is(':hidden')){
	  	 $('.infoElementTextWithoutMenu').slideUp();
		 $('.infoElementText').slideUp();
		 
		 $('.bottomBlackArrow').hide();
		 $('.rightBlackArrow').show();
	  	$('#relatedInfo_'+id).slideDown();
	  	if($('#rightBlackArrow_'+id).is(":hidden")){
	    	$('#bottomBlackArrow_'+id).hide();
	    	$('#rightBlackArrow_'+id).show();
	    	
	    }else{
	    	$('#rightBlackArrow_'+id).hide();
	    	$('#bottomBlackArrow_'+id).show();
	    	
	    }
	  }  
	    
	  //});

	
}




function getWindowWidth() {
  var myWidth = 0;
  if( typeof( window.innerWidth ) == 'number' ) {
    //Non-IE
    myWidth = window.innerWidth;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    //IE 6+ in 'standards compliant mode'
    myWidth = document.documentElement.clientWidth;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    //IE 4 compatible
    myWidth = document.body.clientWidth;
  }
  return myWidth;
}


function select_job(id){	
	$('#job_list').val(id).attr("selected", "selected");
	var val=$("#job_list option:selected").text();	
	$("#mainJobList").find('.customSelectInner').html(val);
}



function get_shops_of_selected_category(loc , id){
	
	$.ajax({
		url: loc,
		beforeSend:function(data){
			$("#categoryAjaxLoader_"+id).show();
			$(".allCategoryTitle").removeClass("active_category");
		},
		success: function(data){
			$('#paginatedContent').html(data);
		},
		complete: function(){
			$("#Cat_"+id).addClass("active_category");
			$("#categoryAjaxLoader_"+id).hide();
		}
	});
}

function view_shop (loc){
	
	$('#my_popup').popup({
		  onopen: function() {
		   $.ajax({
				url: loc,
				beforeSend:function(data){
					$("#layerLoader").show();
					$('#my_popup_content').html('');
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


function show_subMenu(){
	if($(".aboutSubMenu").is(":hidden")){
		$(".aboutSubMenu").show();
	}else{
		$(".aboutSubMenu").hide();
	}
	return false;
}

function show_career_subMenu(){
	if($(".careerSubMenu").is(":hidden")){
		$(".careerSubMenu").show();
	}else{
		$(".careerSubMenu").hide();
	}
	return false;
}

function show_shop_map(shop_id , id){
	position=$('#tool_tip_'+shop_id+"_"+id).css('top');
	position=position.split('px');
	
	cur_p=position[0];
	cur_p=parseInt(cur_p)+400;
		
	 $('html, body').animate({
        scrollTop: cur_p+'px'
    }, 1000);
	
		
	$('#area_'+shop_id+"_"+id).trigger('click');	
}


function close_tool_tip(){
	$('area').mapster('deselect');
	$('.tool_tip').hide();
}


function switch_floor(id){
	$(".MapContent").hide();
	$(".mapFloor").removeClass("floorHeaderTitleActive");
	$("#mapFloor_"+id).addClass("floorHeaderTitleActive");
	
	$("#map_"+id).show();
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
			  },
			   onclose: function (){
			  	$('#my_popup_content').html('');
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
			  },
			  
			  onclose: function (){
			  	$('#my_popup_content').html('');
			  }
			  
			  
			});
			
		$('#my_popup').popup('show');
			
	}
	


function get_sub_content(loc , section_id , parent_id){
	 $.ajax({
			url: loc,
			beforeSend:function(data){
				$("#ajaxLoader_"+section_id).show();
			},
			success: function(data){
				$('.internalContent').html(data);
				
			},
			complete: function(){
				$(".leftMenuAjaxLoader").hide();

				$(".SubLeftMenuRow").removeClass("SubLeftMenuRowActive");
				$(".sub_leftMenu_"+section_id).addClass('SubLeftMenuRowActive');
				
				
				$(".leftMenuRow").removeClass("activeLeftMenu");
				$(".leftMenu_"+parent_id).addClass('activeLeftMenu');

			}
		});		  
}


function get_content(loc , section_id){
	 $.ajax({
			url: loc,
			beforeSend:function(data){
				$("#ajaxLoader_"+section_id).show();
			},
			success: function(data){
				$('.internalContent').html(data);
				
			},
			complete: function(){
				$(".leftMenuAjaxLoader").hide();

				$(".leftMenuRow").removeClass("activeLeftMenu");
				$(".leftMenu_"+section_id).addClass('activeLeftMenu');

			}
		});		  
}
function get_internal_content(loc , id){
	 $.ajax({
			url: loc,
			beforeSend:function(data){
				$(".backAjaxLoader").show();
			},
			success: function(data){
				$('#paginatedContent').html(data);
				
			},
			complete: function(){
				$(".backAjaxLoader").hide();
			}
		});		  
}


function get_brand_content(loc , id){
	 $.ajax({
			url: loc,
			beforeSend:function(data){
				$("#internalContentAjaxLoader_"+id).show();
			},
			success: function(data){
				$('#paginatedContent').html(data);
				
			},
			complete: function(){
				$("#internalContentAjaxLoader_"+id).hide();
			}
		});		  
}



function show_news_details(loc , id){
	$('html, body').animate({scrollTop: $(".internalContent").offset().top}, 2000);
	$.ajax({
			url: loc,
			beforeSend:function(data){
				$("#newsListingAjaxLoader_"+id).show();
				
			},
			success: function(data){
				
				$('#paginatedContent').html(data);
				
				
			}, 
			complete: function(){
				$("#newsListingAjaxLoader_"+id).hide();
				
				
			}
		});
}

function show_submenu(id){
	
	if($('#submenu_'+id).is(':hidden')){
		$('#submenu_'+id).slideDown();
	}else{
		$('#submenu_'+id).slideUp();
	}
}

function remove_numbers(elmt){

	elmtVal = $(elmt).val();
	elmtVal = elmtVal.replace(/(\d+)/g,"");
	$(elmt).val(elmtVal);
}


function show_sub_content(id){
	
	
	if($("#subContent_"+id).is(":hidden")){
		$(".subSectionMenuLink").removeClass("subSectionMenuLinkActive");
		$("#subMenuElement_"+id).addClass("subSectionMenuLinkActive");
		$(".subContent").hide();
		$("#subContent_"+id).show();
	}else{
		
	}
	
	return false;
}



function show_contact_branch(type , id){
	
	if(type == 'head'){
		$(".contactHeaderTitle").removeClass("contactHeaderTitleActive");
		$("#head").addClass("contactHeaderTitleActive");
		$(".contactBranchesElement").hide();
		show_contact_sub_branch(id);
	}else{
		$(".contactHeaderTitle").removeClass("contactHeaderTitleActive");
		$("#Showrooms").removeClass("contactHeaderTitleActive");
		$(".contactBranchesElement").show();
		show_contact_sub_branch(id);
		$("#subBranchTitle_"+id).addClass('subBranchTitleActive');
	}
}


function show_contact_sub_branch(id){
	
	$('#contact_details_content').html('');	
	$.ajax({
			url: '/en/DynamicPages/branch_details/'+id,
			beforeSend:function(data){
				$("#contactBranchesLoader").show();
				$(".subBranchTitle").removeClass("subBranchTitleActive");				
			},
			success: function(data){				
				$('#contact_details_content').html(data);
				
				$("#subBranchTitle_"+id).addClass('subBranchTitleActive');			
			}, 
			complete: function(){
				
				$("#contactBranchesLoader").hide();				
			}
		});
	
	
}

function show_job_details(loc, id){
	
	
	if($("#jobDetailsTextContainer_"+id).is(":hidden")){
		
		$.ajax({
				url: loc,
				beforeSend:function(data){
					$("#jobListAjaxLoader_"+id).show();
					$(".jobListAccordTitle").removeClass("jobListAccordTitleActive");
					$("#jobListAccordTitle_"+id).addClass("jobListAccordTitleActive");	
					
					$(".jobDetailsTextContainer").html('');			
				},
				success: function(data){				
					$('#jobDetailsTextContainer_'+id).html(data);
					
					$(".jobDetailsTextContainer").slideUp();
					$("#jobDetailsTextContainer_"+id).slideDown();
					
								
				}, 
				complete: function(){
					
					$("#jobListAjaxLoader_"+id).hide();				
				}
			});
	}else{
		$(".jobDetailsTextContainer").html('');	
		$(".jobDetailsTextContainer").slideUp();
		$(".jobListAccordTitle").removeClass("jobListAccordTitleActive");
	}
	
}
function remove_alpha(elmt,e){

//	elmtVal = $(elmt).val();
//	elmtVal = elmtVal.replace(/[^0-9\.]/g,'');
//	$(elmt).val(elmtVal);
	
	if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
         // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) || 
         // Allow: home, end, left, right, down, up
        (e.keyCode >= 35 && e.keyCode <= 40) || ( e.keyCode == 107) ||  (e.shiftKey && (e.keyCode == 61))) {
             // let it happen, don't do anything
             return;
    }
    // Ensure that it is a number and stop the keypress
    
    
    
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)  ) {
        e.preventDefault();
    }
}