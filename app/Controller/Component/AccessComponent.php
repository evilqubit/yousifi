<?php
App::uses('Component', 'Controller');
class AccessComponent extends Component {
	var $components = array('Session', 'Cookie');
	function check($controller, $action, $level = null){
		if(isset($level)){
			if (!$this->Session->read('Admin.admin_name')){
				return false;
			}
			if($level == 1){
				
				$allowed_array = array(
				"Administrators"=>array("login","logout","admin_index","admin_editpassword" ,"admin_dashboard" ,"admin_getstats"),
				"Settings"=>array("admin_edit" ,"admin_simple_encrypt","admin_simple_decrypt","admin_encrypt_data","admin_decrypt_data"),
				
				"SeoManagement"=>array("admin_edit","admin_index"),
				
				"DynamicPages"=>array("admin_index_order", 'admin_ajax_order2', 'admin_index_news','admin_edit_section','admin_index_contact',
				
				"admin_index_2","admin_add_2","admin_edit_2","admin_index_sub",
				"admin_get_parent_tree",'admin_get_subpage_tree',
				"admin_index","admin_add","admin_edit","admin_delete","admin_ajax_order","admin_show","admin_hide" ),
				
				"Categories"=>array(				
				"admin_index","admin_add","admin_edit","admin_delete","admin_ajax_order","admin_show","admin_hide" ),
				
				"SocialMedias"=>array("admin_edit" , 'admin_shop_online'),
				"Jobs"=>array( 'admin_order_all_entries', "admin_cvs","admin_view","admin_delete_cv" ,"admin_download", "admin_index","admin_add","admin_edit","admin_delete","admin_ajax_order","admin_show","admin_hide" ,"admin_show_on_homepage"),
				"Sections"=>array("admin_upload_section_images", "admin_edit_section","admin_index","admin_add","admin_edit","admin_delete","admin_ajax_order","admin_show","admin_hide" ,"admin_show_on_homepage"),
				"Banners"=>array("admin_get_sub_category" ,"admin_get_shop","admin_edit_section", "admin_index","admin_add","admin_edit","admin_delete","admin_ajax_order","admin_show","admin_hide" ,"admin_display_related_pages"),
				
				
				"Contacts"=>array("admin_index","admin_view","admin_delete"),
				"ContactDepartments"=>array("admin_index","admin_add","admin_edit","admin_ajax_order","admin_delete","admin_show","admin_hide"),
			
				 
				); 
				
			}else{
				$allowed_array = array("Administrator"=>array("login","logout"));
			}
		}
		
		if((isset($allowed_array[$controller]) && in_array($action, $allowed_array[$controller])) || ($controller == 'CakeError')){
			return true;
		}else{
			return false;
		}
		return true;
	}
}
?>