<?php 
class Contact extends AppModel {
	var $name = "Contact";
	var $useTable = 'contacts';
	var $actsAs = array("Containable");
	var $locale = "ara";
	var $cacheFolder = "contacts";



	var $belongsTo = array(
	'ContactDepartment'=>array('className'=>'ContactDepartment','foreignKey'=> 'contact_department_id')
	
	
	);
}
?>