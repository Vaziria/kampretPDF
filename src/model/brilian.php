<?php
class brilian{
	function post($jum = 5,$grab = false){
		$sitemap = glob(sitemap_path."*.txt");
		$sitemap = explode("\r\n",file_get_contents($sitemap[rand(0,count($sitemap)-1)]));
		$a = 0;
		$data = array();
		while($a<$jum){
			$rr = rand(0,count($sitemap)-1);
			$sitemap[$rr] = explode("|",$sitemap[$rr]);
			if($grab==true){
				$konten = get_bing($sitemap[$rr][0],1);
			}else{
				$konten = null;
			}
			$data1 = array(
							"id" => $sitemap[$rr][0],
							"title" => $sitemap[$rr][1],
							"author" => $sitemap[$rr][2],
							"image" => $sitemap[$rr][3],
							"konten" => $konten,
							
						);
			array_push($data,$data1);
			$a++;
		}
		return $data;
	}
}


?>