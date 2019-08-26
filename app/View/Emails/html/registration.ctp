<?php $BASE_SITE = Configure::read("WEBSITE_URL");?>

<?php echo __("greetings",true)." ".$data["fname"]." ".$data["lname"],",";?>
<br/><br/>
<?php echo __("registration_text",true)." ".__("pageTitle",true)."<br/><br/> ".__("click_to_confirm",true)."<br/>".

"<a href='".$BASE_SITE."/users/confirm/{$data['id']}/{$data['code']}'>".$BASE_SITE."/users/confirm/{$data['id']}/{$data['code']}</a><br/><br/> ".

__("paste_in_browser",true);