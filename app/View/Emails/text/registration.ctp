<?php $BASE_SITE = Configure::read("WEBSITE_URL");?>

<?php echo __("greetings",true)." ".$data["fname"]." ".$data["lname"],",";?>
\n\n
<?php echo __("registration_text",true)." ".__("pageTitle",true)."\n\n ".__("click_to_confirm",true)."\n".


__("copy_paste_in_browser",true)."\n".$BASE_SITE."/users/confirm/{$data['id']}/{$data['code']}";
