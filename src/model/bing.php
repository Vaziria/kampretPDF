<?php

class bing{
	const endpoint = "http://www.bing.com/";
	static $model = array(
			"news" =>array(
				"end" =>"news/search?q=",
				"selector"=>'div[class="snippet"]',
				"count" => 'div[class="rc"]',
				
			),
			"all" => array(
				"end" =>"search?q=",
				"selector" =>'p',
				"count" => 'span[class="sb_count"]',
			),
			"images" => array(
				"end" =>"images/search?q=",
				"selector" =>'img[class="mimg rms_img"]',
			),
		);
	
	public static function grab($key,$aw = 1,$ak = 1,$sel = null){
		//keyword
		$exword = explode(" ",trim($key));
		$a = 0;
		$keyword = "";
		$c = 4;
		if(count($exword)<4){
			$c = count($exword);
		}
		while($a<rand(1,$c)){
			$keyword .= $exword[$a]." ";
			$a++;
		}
		
		$keyword = str_replace("  ","",trim($keyword));
		$keyword = str_replace(" ","+",$keyword);
		$keyword = preg_replace("/[^a-zA-Z\+]+/","",$keyword);
		//selector
		if($sel==null){
			$sel = array_keys(self::$model);
			$sel = $sel[rand(0,count($sel)-1)];
		}
		
		$hasil = array();
		
		//get content
		$a = $aw;
		while($a<=$ak){
			$konten = file_get_contents(self::endpoint.self::$model[$sel]["end"].$keyword.$a);	
			$konten = str_get_html($konten)->find(self::$model[$sel]["selector"]);
			echo $konten[0]->src;
			foreach($konten as $data){
				//$hasil .= preg_replace("/\.[a-z0-9A-Z]+|[a-z]+\:\/\/|www\./","",substr(ucfirst(strtolower($data->plaintext)), 0, -3));
				if($sel=="images"){
					$data = $data->src;
					print_r($data);
					array_push($hasil,substr(ucfirst(strtolower($data)), 0, -3));
				}else{
					array_push($hasil,substr(ucfirst(strtolower($data->plaintext)), 0, -3));
				}
			}
			
			
			
			$a++;
		}
		
		if($sel=="images"){
			return $hasil;
		}

		$hasil = implode(".",$hasil);
		return $hasil;
		
	}
}

?>