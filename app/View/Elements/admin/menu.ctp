
 <?php
 

	$general_display='';
	$general_active_menu='';
	if(isset($menuSectionId)){
		if($menuSectionId == 'general'){
		 	$general_display='block !important';
			$general_active_menu='active';
		 }	
	}
	
	
	$contact_display='';
	$contact_menu='';
	if(isset($menuSectionId)){
		if($menuSectionId == 'contact'){
		 	$contact_display='block !important';
			$contact_menu='active';
		 }	
	}
	
	$header_display='';
	$header_active_menu='';
	if(isset($menuSectionId)){
		if($menuSectionId == 'header'){
		 	$header_display='block !important';
			$header_active_menu='active';
		 }	
	}
	
	$about_display ='';	
	$about_active_menu='';
	if(isset($menuSectionId)){
		if($menuSectionId == 'about_us'){
		 	$about_display='block !important';
			$about_active_menu='active';
		 }
	}
	
	$our_business_display ='';	
	$our_business_menu='';
	if(isset($menuSectionId)){
		if($menuSectionId == 'our_business'){
		 	$our_business_display='block !important';
			$our_business_menu='active';
		 }
	}
	
	$our_brands_display ='';	
	$our_brands_menu='';
	if(isset($menuSectionId)){
		if($menuSectionId == 'our_brands'){
		 	$our_brands_display='block !important';
			$our_brands_menu='active';
		 }
	}
	
	
	$news_events_display ='';	
	$news_events_menu='';
	if(isset($menuSectionId)){
		if($menuSectionId == 'news_events'){
		 	$news_events_display='block !important';
			$news_events_menu='active';
		 }
	}
	
	$careers_display ='';	
	$careers_menu='';
	if(isset($menuSectionId)){
		if($menuSectionId == 'careers'){
		 	$careers_display='block !important';
			$careers_menu='active';
		 }
	}
 
  ?>
 <div id="sidebar" class="nav-collapse">
            <!-- BEGIN Navlist -->
            <ul id='sidebar-list' class="nav nav-list">
        
				
				<!--///////// HomePage 	/////////////////  -->
				
				<li class="">
					<a href="/admin/Administrators/dashboard">
						<i class="icon-th-list"></i>
						<span>Dashboard</span>
					</a>
				</li>


				<li data-id='14' class='<?=$header_active_menu?>'>
					<a  href="#" class="dropdown-toggle bundle20">
					<i class="icon-desktop"></i>
					<span>Home Page</span>
					<b class="arrow icon-angle-right"></b>
					</a>
					<ul class="submenu"  style="display:<?=$header_display?>" >
						
						
						
						
						<li class=""  ><a data-id='1' href="/admin/Banners/index/home">Header Banners List</a></li>
						</br>
						
						
						<li class=""  ><a data-id='1' href="/admin/Banners/index/middle">Middle Banners List</a></li>
						</br>
						
						<li class=""  ><a data-id='1' href="/admin/Banners/index/categories">Right Side Banners List</a></li>
						</br>
						
						<!-- <li class=""  ><a data-id='1' href="/admin/Banners/index/sister_companies">Sister Companies Banners List</a></li>
						</br> -->
						
						
						
						
						
						
					</ul>
				</li>
				
				
				
				
				
				
				<!--///////// about lemall 	/////////////////  -->
				<li data-id='7' class='<?=$about_active_menu?>'>
					<a  href="#" class="dropdown-toggle bundle20">
					<i class="icon-cloud"></i>
					<span>About Us</span>
					<b class="arrow icon-angle-right"></b>
					</a>
					<ul class="submenu"  style="display:<?=$about_display?>" >
						
						<li class=""  ><a data-id='1' href="/admin/Banners/index/about_us">Header Banner List</a></li>
						</br>
						
						<li class=""  ><a data-id='1' href="/admin/DynamicPages/index/about_us">About US Section Details</a></li></br>
						
					</ul>
				</li>
				
				
				
				<!--///////// services 	/////////////////  -->
				<li data-id='11' class='<?=$our_business_menu?>'>
					<a  href="#" class="dropdown-toggle bundle20">
					<i class="icon-book"></i>
					<span>Our Business</span>
					<b class="arrow icon-angle-right"></b>
					</a>
					<ul class="submenu"  style="display:<?=$our_business_display?>" >
						<li class=""  ><a data-id='1' href="/admin/Banners/index/our_business">Header Banner List</a></li>
						
						
						<li class=""  ><a data-id='1' href="/admin/DynamicPages/index_2/our_business_local">Our Business local Details</a></li>
						<li class=""  ><a data-id='1' href="/admin/DynamicPages/index_2/our_business_international">Our Business International Details</a></li>
						<li class=""  ><a data-id='1' href="/admin/DynamicPages/index_order">Order homepage entries</a></li>
						
					</ul>
				</li>
				
				
			
				
				
				<!--///////// services 	/////////////////  -->
				<li data-id='11' class='<?=$our_brands_menu?>'>
					<a  href="#" class="dropdown-toggle bundle20">
					<i class="icon-bookmark-empty"></i>
					<span>Our Brands</span>
					<b class="arrow icon-angle-right"></b>
					</a>
					<ul class="submenu"  style="display:<?=$our_brands_display?>" >
						<li class=""  ><a data-id='1' href="/admin/Banners/index/our_brands">Header Banner List</a></li>						
						<li class=""  ><a data-id='1' href="/admin/DynamicPages/index_2/our_brands">Our Brands Details</a></li>						
					</ul>
				</li>
				
				
				<!--///////// services 	/////////////////  -->
				<li data-id='11' class='<?=$news_events_menu?>'>
					<a  href="#" class="dropdown-toggle bundle20">
					<i class="icon-bullhorn"></i>
					<span>News & Events</span>
					<b class="arrow icon-angle-right"></b>
					</a>
					<ul class="submenu"  style="display:<?=$news_events_display?>" >
						<li class=""  ><a data-id='1' href="/admin/Banners/index/news_events">Header Banner List</a></li>
						<li class=""  ><a data-id='1' href="/admin/Categories/index">News & Events Categories</a></li>						
						<li class=""  ><a data-id='1' href="/admin/DynamicPages/index_news">News & Events List</a></li>						
					</ul>
				</li>
			
				
				<!--///////// services 	/////////////////  -->
				<li data-id='11' class='<?=$careers_menu?>'>
					<a  href="#" class="dropdown-toggle bundle20">
					<i class="icon-suitcase"></i>
					<span>Careers</span>
					<b class="arrow icon-angle-right"></b>
					</a>
					<ul class="submenu"  style="display:<?=$careers_display?>" >
						<li class=""  ><a data-id='1' href="/admin/Banners/index/careers">Header Banner List</a></li>
						<li class=""  ><a data-id='1' href="/admin/DynamicPages/edit_section/careers">Careers Details</a></li>						
						<li class=""  ><a data-id='1' href="/admin/Jobs/index">Jobs list</a></li>						
					</ul>
				</li>
			
				
				<!--///////// contact lemall 	/////////////////  -->
				<li data-id='10' class='<?=$contact_menu?>'>
					<a  href="#" class="dropdown-toggle bundle20">
					<i class="icon-comment-alt"></i>
					<span>Contact Us</span>
					<b class="arrow icon-angle-right"></b>
					</a>
					<ul class="submenu"  style="display:<?=$contact_display?>" >
						<li class=""  ><a data-id='1' href="/admin/Banners/index/contact">Header Banner List</a></li>
						<li class=""  ><a data-id='1' href="/admin/DynamicPages/edit_section/contact">Contact Us Details</a></li>
						<li class=""  ><a data-id='1' href="/admin/DynamicPages/index_contact">Contact Us Branches List</a></li>												
						<li class=""  ><a data-id='1' href="/admin/Contacts/index/">List Contacts</a></li>
						
						
						<!-- <li class=""  ><a data-id='1' href="/admin/ContactDepartments/index/">List enquiries</a></li> -->
						
						
						
						
						<!-- <li class=""  ><a data-id='1' href="/admin/Jobs/add/">Add Album</a></li> -->
					</ul>
				</li>
				
				
				
				
				
				
				
				
				
				
				
				
				
			
				
				<!--///////// General setting 	/////////////////  -->
				<li data-id='14' class='<?=$general_active_menu?>'>
					<a  href="#" class="dropdown-toggle bundle20">
					<i class="icon-cog"></i>
					<span>General Settings</span>
					<b class="arrow icon-angle-right"></b>
					</a>
					<ul class="submenu"  style="display:<?=$general_display?>" >
						<li class=""  ><a data-id='1' href="/admin/administrators/editpassword">Admin Change Password</a></li>
						<li class=""  ><a data-id='1' href="/admin/Settings/edit/1">Site Configuration</a></li>
						
						<li class=""  ><a data-id='1' href="/admin/SeoManagement/edit/1">Seo Managament</a></li>
						<li class=""  ><a data-id='1' href="/admin/SocialMedias/edit/1">Social Media Channel</a></li>
						<li class=""  ><a data-id='1' href="/admin/SocialMedias/shop_online/1">Shop Online Link</a></li></br>
						
						<!-- <li class=""  ><a data-id='1' href="/admin/Branches/index/">List Branches</a></li> -->
						
						
						
					</ul>
				</li>
				
				
				
				<!--///////// Branche 	/////////////////  -->
				<!-- <li class="" >
	                <a href="/admin/Branches/index/">	                	
	                    <i class="icon-bookmark"></i>
	                    <span>Branches</span>
	                </a>
				</li> -->
				
				

           </ul>

    
                
    <!-- END Navlist -->

    <!-- BEGIN Sidebar Collapse Button -->
    <div id="sidebar-collapse" class="visible-desktop">
        <i class="icon-double-angle-left"></i>
    </div>
    <!-- END Sidebar Collapse Button -->
</div>