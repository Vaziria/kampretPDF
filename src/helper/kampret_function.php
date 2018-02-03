<?php

function arrayToParagraf($data,$min,$max){
	$hasil = "";
	$a = 0;
	while($a<count($data)){
		$b = 0;
		$kata = array();
		$c = rand($min,$max);
		
		while($b<$c){
			$w = $a + $b;
			if($w>count($data)-1){
				break;
			}
			
			array_push($kata,$data[$w]);
			$b++;
		}
		$kata = implode(" ",$kata);
		$hasil .= ucfirst($kata);
		$hasil .= ". ";
		$a = $a+$c;
	}
	
	return $hasil;
}


?>