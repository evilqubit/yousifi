<?php
App::uses('Component', 'Controller');
class StringManipulationComponent extends Component {

	function slug($string,$options=array()){
		$defaultOptions = array("ending"=>"","separator"=>"-");
		
		$options = array_merge($defaultOptions,$options);
		
		extract($defaultOptions);
		
		$string = strtolower($string);
		
//		$string = preg_replace("/[\W]/","$separator",$string);
		$string = preg_replace("/&amp;/","-",$string);
		$string = preg_replace("/[ \[\]\/\\'\":<>|,;!?#$%^&*()+={}@]/","$separator",$string);
		$string = preg_replace("/[-]+/","-",$string);
		
		
		$string.= $ending;
		
		return $string;
		
	}
}
?>