<?php
require_once "brilian.php";

class home extends brilian{
	var $homeResult;
	function __construct($batas){
		$this->homeResult = $this->post($batas,true);
		
	}
}


?>