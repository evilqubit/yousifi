<?php

if(!isset($menuFlag))
$menuFlag=0;

$menu="<table cellspacing='0' cellpadding='0' border='0' width='200'>
              <tr>
              <td width='200' class='logo_cell' align='left'>
       ";
if(isset($level)){
	$menu.="
              	<img src=\"/img/admin/grey_arrow.gif\" alt=\"\" width=\"11\" height=\"11\" border=\"0\" align=\"middle\" /> <a href=\"/admin/administrators/\">Home</a><br/>
              	<img src=\"/img/admin/grey_arrow.gif\" alt=\"\" width=\"11\" height=\"11\" border=\"0\" align=\"middle\" /> <a href=\"/admin/administrators/editpassword\">Edit Account</a><br/>
	<img src=\"/img/admin/grey_arrow.gif\" alt=\"\" width=\"11\" height=\"11\" border=\"0\" align=\"middle\" /> <a href=\"/administrators/logout/\" onclick=\"return confirm('Are you sure you want to logout of the system?');\">Logout</a>
	<br/><br/>
	<br/>";
}
//// When you want to add a new menu flag just increment the $i	//////
for($i=1;$i<=45;$i++){
	$menu_weight="font_weight{$i}";
	$menu_display="display{$i}";
	
	//main menu class
	$class_name="sub_menu_{$i}";

	$$menu_weight="normal";
	$$menu_display="none";
	$$class_name="current_sub_menu_{$i}";
}

$menu_flag="font_weight{$flag}";
$menu_display="display{$flag}";
$$menu_flag="bold";
$$menu_display="block";

/////////////SEO Management/////////////////
$menuId="seo_management";
$menuFont=$font_weight1;

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/seo_management/edit'><span style='font-weight:$menuFont;'>SEO Management</span></a><br/>";



$menu .= "<br/><span style='font-size:14px;font-weight:bold;color:#72BF44;cursor: pointer;' onclick='$(\"#home_menu\").slideToggle(500);return false;'>Home Page</span><br/>";
$menu .= "<div style='display:none;' id='home_menu'>";

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Backgrounds/backgrounds_edit/DynamicPage/home_page'>Backgrounds</a><br/>";


/////////////Home Page/////////////////
// $menuId="seasons";
// $menuDisplay=$display2;
// $menuFont=$font_weight2;
// 
// $menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/brands/index' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'>Seasons</span></a><br />
		// <div id='{$menuId}_menu' class='menu_list current_sub_menu_3' style='display:$menuDisplay;'>
			// <div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/general_settings/edit/Seasons'>Seasons Settings</a></div><br/>
			// <div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/seasons/list'>List Seasons</a></div>
			// <div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/seasons/add'>Add Season</a></div><br/>
// 			
		// </div>
// ";

$menu .= "</div>";


////////////////////////////////////////////////////////////////////////////////////
/////////////About/////////////////
$menu .= "<br/><span style='font-size:14px;font-weight:bold;color:#72BF44;cursor: pointer;' onclick='$(\"#about_menu\").slideToggle(500);return false;'>ABOUT HBKU</span><br/>";
$menu .= "<div style='display:none;' id='about_menu'>";

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/MenuTitles/edit/about_hbku'>Menu Title</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Backgrounds/backgrounds_edit/DynamicPage/about_hbku'>List Backgrounds</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Albums/index'>List Albums</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Videos/index'>List Videos</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/DynamicPages/edit_introduction/about_hbku'>Introduction Page</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/RelatedInformations/index_section/about_hbku'>Related Information for Introduction Page</a><br/>";

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/PagesRelations/index_by_section/DynamicPage/about_hbku'>Order Introduction Page Images And Videos</a><br/>";



/////////////about Section/////////////////
$menuId="about_list";
$menuDisplay=$display2;
$menuFont=$font_weight2;

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/administrators/index/' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'>About HBKU</span></a><br />
		<div id='{$menuId}_menu' class='menu_list current_sub_menu_2' style='display:$menuDisplay;'>
			
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/DynamicPages/index/about_hbku'>List About HBKU </a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/DynamicPages/add/about_hbku/0'>Add About HBKU </a></div><br/>
			
		</div>
";



$menu .= "</div>";
////////////////////////////////////////////////////////////////////////////////////
/////////////  Colleges /////////////////
$menu .= "<br/><span style='font-size:14px;font-weight:bold;color:#72BF44;cursor: pointer;' onclick='$(\"#colleges_menu\").slideToggle(500);return false;'>COLLEGES</span><br/>";
$menu .= "<div style='display:none;' id='colleges_menu'>";

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/MenuTitles/edit/colleges'>Menu Title</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Backgrounds/backgrounds_edit/DynamicPage/colleges'>Backgrounds</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Albums/index'>List Albums</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Videos/index'>List Videos</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/DynamicPages/edit_introduction/colleges'>Introduction Page</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/RelatedInformations/index_section/colleges'>Related Information for Introduction Page</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/PagesRelations/index_by_section/DynamicPage/colleges'>Order Introduction Page Images And Videos</a><br/>";


/////////////	Colleges Section - related pages/////////////////
$menuId="colleges_related_pages";
$menuDisplay=$display18;
$menuFont=$font_weight18;

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/administrators/index/' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'>Related Pages</span></a><br />
		<div id='{$menuId}_menu' class='menu_list current_sub_menu_18' style='display:$menuDisplay;'>
			
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/RelatedPages/index/colleges'>List Pages</a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/RelatedPages/add/colleges'>Add Page</a></div><br/>
			
		</div>
";

/////////////	Colleges Section/////////////////
$menuId="colleges_list";
$menuDisplay=$display8;
$menuFont=$font_weight8;

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/administrators/index/' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'>Colleges</span></a><br />
		<div id='{$menuId}_menu' class='menu_list current_sub_menu_8' style='display:$menuDisplay;'>
			
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/DynamicPages/index/colleges'>List Colleges</a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/DynamicPages/add/colleges/0'>Add Colleges</a></div><br/>
			
		</div>
";



$menu .= "</div>";
////////////////////////////////////////////////////////////////////////////////////
/////////////   Admissions & Aid /////////////////
$menu .= "<br/><span style='font-size:14px;font-weight:bold;color:#72BF44;cursor: pointer;' onclick='$(\"#admissions_aid_menu\").slideToggle(500);return false;'> ADMISSIONS & AID</span><br/>";
$menu .= "<div style='display:none;' id='admissions_aid_menu'>";

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/MenuTitles/edit/admissions_aid'>Menu Title</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Backgrounds/backgrounds_edit/DynamicPage/admissions_aid'>Backgrounds</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Albums/index'>List Albums</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Videos/index'>List Videos</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/DynamicPages/edit_introduction/admissions_aid'>Introduction Page</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/RelatedInformations/index_section/admissions_aid'>Related Information for Introduction Page</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/PagesRelations/index_by_section/DynamicPage/admissions_aid'>Order Introduction Page Images And Videos</a><br/>";

/////////////	Admissions & Aid Section/////////////////
$menuId="admissions_aid_list";
$menuDisplay=$display9;
$menuFont=$font_weight9;

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/administrators/index/' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'>Admissions & Aid</span></a><br />
		<div id='{$menuId}_menu' class='menu_list current_sub_menu_9' style='display:$menuDisplay;'>
			
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/DynamicPages/index/admissions_aid'>List Admissions & Aid</a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/DynamicPages/add/admissions_aid/0'>Add Admissions & Aid</a></div><br/>
			
		</div>
";



$menu .= "</div>";
////////////////////////////////////////////////////////////////////////////////////
/////////////   Campus Life  /////////////////
$menu .= "<br/><span style='font-size:14px;font-weight:bold;color:#72BF44;cursor: pointer;' onclick='$(\"#campus_life_menu\").slideToggle(500);return false;'>CAPMUS LIFE</span><br/>";
$menu .= "<div style='display:none;' id='campus_life_menu'>";

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/MenuTitles/edit/campus_life'>Menu Title</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Backgrounds/backgrounds_edit/DynamicPage/campus_life'>Backgrounds</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Albums/index'>List Albums</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Videos/index'>List Videos</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/DynamicPages/edit_introduction/campus_life'>Introduction Page</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/RelatedInformations/index_section/campus_life'>Related Information for Introduction Page</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/PagesRelations/index_by_section/DynamicPage/campus_life'>Order Introduction Page Images And Videos</a><br/>";

/////////////	campus life  	/////////////////
$menuId="campus_life_list";
$menuDisplay=$display10;
$menuFont=$font_weight10;

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/administrators/index/' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'>Campus Life</span></a><br />
		<div id='{$menuId}_menu' class='menu_list current_sub_menu_10' style='display:$menuDisplay;'>
			
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/DynamicPages/index/campus_life'>List Campus Life</a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/DynamicPages/add/campus_life/0'>Add Campus Life</a></div><br/>
			
		</div>
";



$menu .= "</div>";
////////////////////////////////////////////////////////////////////////////////////
/////////////   INSTITUTES AND CENTERS  institutes_centers /////////////////
$menu .= "<br/><span style='font-size:14px;font-weight:bold;color:#72BF44;cursor: pointer;' onclick='$(\"#institutes_centers_menu\").slideToggle(500);return false;'>INSTITUTES & CENTERS</span><br/>";
$menu .= "<div style='display:none;' id='institutes_centers_menu'>";

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/MenuTitles/edit/institutes_centers'>Menu Title</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Backgrounds/backgrounds_edit/DynamicPage/institutes_centers'>Backgrounds</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Albums/index'>List Albums</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Videos/index'>List Videos</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/DynamicPages/edit_introduction/institutes_centers'>Introduction Page</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/RelatedInformations/index_section/institutes_centers'>Related Information for Introduction Page</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/PagesRelations/index_by_section/DynamicPage/institutes_centers'>Order Introduction Page Images And Videos</a><br/>";

/////////////	institutes_centers/////////////////
$menuId="institutes_centers_list";
$menuDisplay=$display12;
$menuFont=$font_weight12;

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/administrators/index/' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'>Institutes & Centers</span></a><br />
		<div id='{$menuId}_menu' class='menu_list current_sub_menu_12' style='display:$menuDisplay;'>
			
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/DynamicPages/index/institutes_centers'>List Institutes & Centers</a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/DynamicPages/add/institutes_centers/0'>Add Institutes & Centers</a></div><br/>
			
		</div>
";



$menu .= "</div>";
////////////////////////////////////////////////////////////////////////////////////
/////////////  special programs /////////////////
$menu .= "<br/><span style='font-size:14px;font-weight:bold;color:#72BF44;cursor: pointer;' onclick='$(\"#special_programs_menu\").slideToggle(500);return false;'>SPECIAL PROGRAMS</span><br/>";
$menu .= "<div style='display:none;' id='special_programs_menu'>";

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/MenuTitles/edit/special_programs'>Menu Title</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Backgrounds/backgrounds_edit/DynamicPage/special_programs'>Backgrounds</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Albums/index'>List Albums</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Videos/index'>List Videos</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/DynamicPages/edit_introduction/special_programs'>Introduction Page</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/RelatedInformations/index_section/special_programs'>Related Information for Introduction Page</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/PagesRelations/index_by_section/DynamicPage/special_programs'>Order Introduction Page Images And Videos</a><br/>";

/////////////	special programs/////////////////
$menuId="special_programs_list";
$menuDisplay=$display13;
$menuFont=$font_weight13;

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/administrators/index/' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'>Special Programs</span></a><br />
		<div id='{$menuId}_menu' class='menu_list current_sub_menu_13' style='display:$menuDisplay;'>
			
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/DynamicPages/index/special_programs'>List Special Programs</a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/DynamicPages/add/special_programs/0'>Add Special Programs</a></div><br/>
			
		</div>
";



$menu .= "</div>";
////////////////////////////////////////////////////////////////////////////////////

/////////////   News & Events  /////////////////
$menu .= "<br/><span style='font-size:14px;font-weight:bold;color:#72BF44;cursor: pointer;' onclick='$(\"#news_events_menu\").slideToggle(500);return false;'>NEWS & EVENTS</span><br/>";
$menu .= "<div style='display:none;' id='news_events_menu'>";

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/MenuTitles/edit/news'>Menu Title</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Backgrounds/backgrounds_edit/News/news'>Backgrounds</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Albums/index'>List Albums</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Videos/index'>List Videos</a><br/>";

/////////////	 News/////////////////
$menuId="news_list";
$menuDisplay=$display11;
$menuFont=$font_weight11;

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/administrators/index/' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'> News</span></a><br />
		<div id='{$menuId}_menu' class='menu_list current_sub_menu_11' style='display:$menuDisplay;'>
			
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/News/index'>List News</a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/News/add'>Add News</a></div><br/>
			
		</div>
";



$menu .= "</div>";
////////////////////////////////////////////////////////////////////////////////////
/////////////  Jobs /////////////////
$menu .= "<br/><span style='font-size:14px;font-weight:bold;color:#72BF44;cursor: pointer;' onclick='$(\"#job_menu\").slideToggle(500);return false;'>JOBS</span><br/>";
$menu .= "<div style='display:none;' id='job_menu'>";

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Backgrounds/backgrounds_edit/DynamicPage/job'>Backgrounds</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/DynamicPages/edit_job'>Job Introduction</a><br/>";
// $menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Albums/index'>List Albums</a><br/>";
// $menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Videos/index'>List Videos</a><br/>";
// $menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/DynamicPages/edit_introduction/special_programs'>Introduction Page</a><br/>";

/////////////	institutes_centers/////////////////
$menuId="jobs_list";
$menuDisplay=$display14;
$menuFont=$font_weight14;

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/administrators/index/' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'>Jobs</span></a><br />
		<div id='{$menuId}_menu' class='menu_list current_sub_menu_14' style='display:$menuDisplay;'>
			
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Jobs/index/index'>List Jobs</a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Jobs/add/add'>Add Job</a></div><br/>
			
		</div>
";



$menu .= "</div>";
////////////////////////////////////////////////////////////////////////////////////

/////////////  Executive Maste /////////////////
$menu .= "<br/><span style='font-size:14px;font-weight:bold;color:#72BF44;cursor: pointer;' onclick='$(\"#executive_master_menu\").slideToggle(500);return false;'>Executive Master E & R</span><br/>";
$menu .= "<div style='display:none;' id='executive_master_menu'>";


$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/RelatedInformations/index_section/executive_master'>Related Tabs</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/DynamicPages/edit_introduction/executive_master'>Executive Master E & R</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/HomeBoxes/edit_introduction/executive_master'>Homepage Box</a><br/>";

// $menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Albums/index'>List Albums</a><br/>";
// $menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Videos/index'>List Videos</a><br/>";
// $menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/DynamicPages/edit_introduction/special_programs'>Introduction Page</a><br/>";

/////////////	informative files	  /////////////////
$menuId="Informative_files_list";
$menuDisplay=$display16;
$menuFont=$font_weight16;

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/administrators/index/' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'>Informative Files</span></a><br />
		<div id='{$menuId}_menu' class='menu_list current_sub_menu_16' style='display:$menuDisplay;'>
			
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Documents/index_2/executive_master/informative_files'>List Informative Files</a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Documents/add_2/executive_master/informative_files'>Add Informative Files</a></div><br/>
			
		</div>
";

/////////////	application  files	  /////////////////
$menuId="application_files_list";
$menuDisplay=$display17;
$menuFont=$font_weight17;

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/administrators/index/' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'>Application  Files</span></a><br />
		<div id='{$menuId}_menu' class='menu_list current_sub_menu_17' style='display:$menuDisplay;'>
			
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Documents/index_2/executive_master/application_files'>List Application Files</a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Documents/add_2/executive_master/application_files'>Add Application Files</a></div><br/>
			
		</div>
";


$menu .= "</div>";
////////////////////////////////////////////////////////////////////////////////////






///////////// HBKU employee /////////////////
$menu .= "<br/><span style='font-size:14px;font-weight:bold;color:#72BF44;cursor: pointer;' onclick='$(\"#hbku_employee_menu\").slideToggle(500);return false;'>HBKU Employee</span><br/>";
$menu .= "<div style='display:none;' id='hbku_employee_menu'>";


//$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/RelatedInformations/index_section/executive_master'>Related Tabs</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/MenuTitles/edit/hbku_employee'>Menu Title</a><br/>";
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/DynamicPages/edit_introduction/hbku_employee'>HBKU Employee Page</a><br/>";
//$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/HomeBoxes/edit_introduction/executive_master'>Homepage Box</a><br/>";

// $menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Albums/index'>List Albums</a><br/>";
// $menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/Videos/index'>List Videos</a><br/>";
// $menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/DynamicPages/edit_introduction/special_programs'>Introduction Page</a><br/>";

/////////////	informative files	  /////////////////
$menuId="hbkuEmployelist";
$menuDisplay=$display19;
$menuFont=$font_weight19;

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/administrators/index/' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'>Files</span></a><br />
		<div id='{$menuId}_menu' class='menu_list current_sub_menu_19' style='display:$menuDisplay;'>
			
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Documents/index_2/hbku_employee/informative_files'>List Files</a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Documents/add_2/hbku_employee/informative_files'>Add Files</a></div><br/>
			
		</div>
";


/////////////	informative files	  /////////////////
$menuId="Userselist";
$menuDisplay=$display21;
$menuFont=$font_weight21;

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/administrators/index/' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'>Users</span></a><br />
		<div id='{$menuId}_menu' class='menu_list current_sub_menu_21' style='display:$menuDisplay;'>
			
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Users/index'>List Users</a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Users/add'>Add Users</a></div><br/>
			
		</div>
";


$menu .= "</div>";
////////////////////////////////////////////////////////////////////////////////////












////////////////////////////////				General page 				////////////////////////////////////////////////////
$menu .= "<br/><span style='font-size:14px;font-weight:bold;color:#72BF44;cursor: pointer;'  onclick='$(\"#general_menu\").slideToggle(500);return false;'>General Pages</span><br/>";
$menu .= "<div style='display:none;' id='general_menu'>";

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/SocialMedias/edit'>Social Media Links</a><br/>";



////////////Splash Message//////////////
$menuId="splash";
$menuDisplay=$display15;
$menuFont=$font_weight15;

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/administrators/index/' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'>Key messages </span></a><br />
		<div id='{$menuId}_menu' class='menu_list current_sub_menu_15' style='display:$menuDisplay;'>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/DynamicPages/index_splash'>List Key messages </a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/DynamicPages/add_splash'>Add Key messages </a></div>
		</div>
";


///////////////////   Banners    ///////////////////
$menuId="Backgrounds";
$menuDisplay=$display1;
$menuFont=$font_weight1;
// 
// <div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Banners/index/0/right'>List Side Banners</a></div>
			// <div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Banners/add/right'>Add Side Banner</a></div>
$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/administrators/index/' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'>Backgrounds</span></a><br />
		<div id='{$menuId}_menu' class='menu_list current_sub_menu_1' style='display:$menuDisplay;'>	
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Backgrounds/index'>List Backgrounds</a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Backgrounds/add'>Add Backgrounds</a></div><br/>
			
			
		</div><br/>
";
/////////////////////////////

///////////////// album /////////////////////
$menuId="album";
$menuDisplay=$display4;
$menuFont=$font_weight4;

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/administrators/index/' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'>Album</span></a><br />
		<div id='{$menuId}_menu' class='menu_list current_sub_menu_4' style='display:$menuDisplay;'>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Albums/index'>List Albums</a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Albums/add/'>Add Album</a></div><br/>
			
		</div>
";

///////////////// home album /////////////////////
$menuId="home_album";
$menuDisplay=$display20;
$menuFont=$font_weight20;

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/administrators/index/' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'>Home Album</span></a><br />
		<div id='{$menuId}_menu' class='menu_list current_sub_menu_20' style='display:$menuDisplay;'>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Albums/index/home'>List Albums</a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Albums/add/home'>Add Album</a></div><br/>
			
		</div>
";


///////////////// Videos /////////////////////
$menuId="video";
$menuDisplay=$display5;
$menuFont=$font_weight5;

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/administrators/index/' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'>Videos</span></a><br />
		<div id='{$menuId}_menu' class='menu_list current_sub_menu_4' style='display:$menuDisplay;'>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Videos/index'>List Videos</a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Videos/add/'>Add Videos</a></div><br/>
			
		</div>
";

////////////Contact Us//////////////
$menuId="contact_us";
$menuDisplay=$display7;
$menuFont=$font_weight7;

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/administrators/index/' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'>Contact Us</span></a><br />
		<div id='{$menuId}_menu' class='menu_list current_sub_menu_9' style='display:$menuDisplay;'>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/Backgrounds/backgrounds_edit/Contact/contact'>Backgrounds</a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/DynamicPages/edit_contact'>Contact Us Address</a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/contacts/index'>Contacts</a></div>
		</div>
";
////////////Contact Us Department//////////////
$menuId="contact_us_department";
$menuDisplay=$display16;
$menuFont=$font_weight16;

$menu .= "<img src='/img/admin/grey_arrow.gif' alt='' width='11' height='11' border='0' align='middle' /> <a href='/admin/administrators/index/' onclick='$(\"#{$menuId}_menu\").slideToggle(500);return false;'><span style='font-weight:$menuFont;'>Contact Us Departments</span></a><br />
		<div id='{$menuId}_menu' class='menu_list current_sub_menu_16' style='display:$menuDisplay;'>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/ContactDepartments/index'>List Contact Us departments</a></div>
			<div class='menuRow'><img src='/img/admin/black_arrow.gif' alt='' />&nbsp;<a href='/admin/ContactDepartments/add'>Add Contact us department</a></div>
		</div>
";
$menu .= "</div>";

	
$menu_flag="font_weight{$flag}";
$menu_display="display{$flag}";
$$menu_flag="bold";
$$menu_display="block";



$menu .= "<br/>";
$menu .= "</td></tr></table><br/>
<br/>";


echo $menu;
?>


<script type="text/javascript">

$(document).ready(function(){
	var id=$('.current_sub_menu_<?=$flag?>').parent().attr('id');
	$('#'+id).show();
	
	<?php 
	if(isset($menuSectionId)){?>
			$('#<?=$menuSectionId?>').show();
		
	<?php }
	 ?>
});
	
</script>