<?php 
$overview_slug=$section_slugs["overview"]['SeoManagement']['slug'];
$opening_hours_slug=$section_slugs["opening_hours"]['SeoManagement']['slug'];
$articles_slug=$section_slugs["articles"]['SeoManagement']['slug'];
$videos_slug=$section_slugs["videos"]['SeoManagement']['slug'];
$careers_slug=$section_slugs["careers"]['SeoManagement']['slug'];

$overview_url="/$lang/Sections/overview/$overview_slug/?section=overview";
$opening_hours_url="/$lang/Sections/opening_hours/$opening_hours_slug/?section=opening_hours";
$articles_url="/$lang/Sections/articles/$articles_slug/?section=articles";
$videos_url="/$lang/Sections/videos/$videos_slug/?section=videos";

$careers_url="/$lang/Sections/vacancies/?section=vacancies";
$careers_form_url="/$lang/Sections/upload_your_cv/?section=upload_your_cv";
?>

<div class="floatClass aboutus_section_title"><?=strtoupper(__("about_us",true))?></div>
<div class="floatClass aboutus_menu_box">	
	<div class="floatClass aboutus_menu_box_internal_container">
		<div class="floatClass aboutAjaxLoader" ><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
		<ul>
			<li><a class="allMenu jqaddress" onclick="get_page_content('<?=$overview_url?>','overview');return false;" id="overview" href="<?=$overview_url?>"><?=__("overview",true)?></a></li>
			<li><a  class="allMenu jqaddress"  onclick="get_page_content('<?=$opening_hours_url?>','opening_hours');return false;"  id="opening_hours" href="<?=$opening_hours_url?>"><?=__("opening_hours",true)?></a></li>
			
			
			<li style="position: relative;"><a  class="allMenu"  id="media_center" onclick="show_subMenu();return false;" href="#"><?=__("media_center",true)?>
				</a>
				<div class="aboutSubMenu">
					<ul>
						<li><a class="SuballMenu jqaddress"  onclick="get_page_content('<?=$articles_url?>','articles');return false;" id="articles" href="<?=$articles_url?>"><?=__("articles",true)?></a></li>
						<li><a class="SuballMenu jqaddress"  onclick="get_page_content('<?=$videos_url?>','videos');return false;"  id="videos" href="<?=$videos_url?>"><?=__("videos",true)?></a></li>
					</ul>
				</div>
				
			</li>
			
			
			<li  style="position: relative;"><a  class="allMenu"   onclick="show_career_subMenu();return false;"   id="careers_section" href="#" style="margin: 0px;"><?=__("careers",true)?>
				</a>
				<div class="careerSubMenu">
					<ul>
						<li><a class="SuballMenu jqaddress"  onclick="get_page_content('<?=$careers_form_url?>','careers_form');return false;" id="careers_form" href="<?=$careers_form_url?>"><?=__("Upload_your_CV",true)?></a></li>
						<li><a class="SuballMenu jqaddress"  onclick="get_page_content('<?=$careers_url?>','careers');return false;"  id="careers" href="<?=$careers_url?>"><?=__("Vacancies",true)?></a></li>
					</ul>
				</div>
				
			</li>
		</ul>
	</div>
</div>



<script type="text/javascript">
	var sec='';
	$(document).ready(function (){
		
		
		  mainPath = "";
		  
		  
	$(".jqaddress").click(function(){
		sec=$(this).attr("id");
		
	});  
	
	if($('.jqaddress').length > 0){
		$.address.init(function(event) {
			$('.jqaddress').address(function() {
//				return $(this).attr('href').replace(location.pathname, '');
				return $(this).attr('href');
			});
			
			
		}).internalChange('change', function(event) {

			// path = event.value;
// 			
			// path=path.split("?");
			// sec_f=path[1];
			// sec_f=sec_f.split('=');
			// sec=sec_f[1];
			// console.log(sec);			
			// path=path[0];
			
			var ran=Math.random();
			
			//console.log(event);
			
			// if(path != ""){
				// if(path.indexOf("?") > 0){
					// urlPath=path+'&'+ran;
				// }else{
					// urlPath=path+'?'+ran;
				// }
			// }else{
				// urlPath = path;
			// }
			
			
			//console.log(sec);

			//get_page_content(urlPath ,sec);
			//mainPath = urlPath;

		}).externalChange(function(event) {
			
			//alert('test');
			
			var windowLoc = window.location+"";
			
			//console.log(windowLoc);
			hashIndex = windowLoc.indexOf("#");

			if(hashIndex > 0){
				console.log("hashIndex");
				newLoc = windowLoc.substring(hashIndex+1);
				mainLoc = windowLoc.substring(0,hashIndex);
				if(mainLoc.indexOf("http://") > -1){
					mainLoc = mainLoc.replace("http://","");

					indexOf = mainLoc.indexOf("/");
					mainLoc = mainLoc.substring(indexOf);
				}

				mainPath = mainLoc;
				windowLoc = newLoc;
				console.log(mainPath);
				console.log(windowLoc);
			}

			if(mainPath == ""){
				mainPath = windowLoc;
			}
			
			// console.log("main Path :" + mainPath);
			// console.log("windowLoc :" + windowLoc);
			
			
			if(windowLoc != mainPath){

				var ran=Math.random();
				
				
				windowLoc=windowLoc.split("?");
				sec='';
				sec_f=windowLoc[1];
				if(sec_f){
				sec_f=sec_f.split('=');
				sec=sec_f[1];
				}
						
				windowLoc=windowLoc[0];
			
			
				if(windowLoc != ""){
					if(windowLoc.indexOf("?") > 0){
						windowLoc = windowLoc+'&'+ran;
					}else{
						windowLoc = windowLoc+'?'+ran;
					}
				}
				
				if(sec == ''){
					
				}else{
					get_page_content(windowLoc ,sec);
				}
				
	
				
			}

		}).history();
	}
	});
</script>