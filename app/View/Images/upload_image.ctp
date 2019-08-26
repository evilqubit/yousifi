<?php

   if($album_type == 'home'){
   		echo $this->element("admin/home_display_uploaded_image",array("data"=>$this->request->data ,"folderName"=>$folderName));
   }else{
   		echo $this->element("admin/display_uploaded_image",array("data"=>$this->request->data ,"folderName"=>$folderName));
   }
	
?>
