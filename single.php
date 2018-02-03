<?php
require_once "./src/model/siteGrab.php";
require_once __DIR__ . '/vendor/autoload.php';
define("sitemap_path","sitemap/");
define("path_logo","./src/images/");
$kampret = new siteGrab($__config);
$kampret->grab($data["title"]);

//$mpdf->SetHTMLHeader($kampret->headers());
//$mpdf->SetHTMLFooter($kampret->footers());
//$mpdf->WriteHTML($kampret->viewPdf());
//$mpdf->Output();

//print_r("<pre>");
//print_r($kampret->test);
//print_r("</pre>");

if($__config['mode']=='pdf'){
		header("Content-type: application/pdf");
		header("Content-Disposition: inline; filename=filename.pdf");
		$mpdf = new mPDF();
		$mpdf->SetTitle($kampret->metadata["title"]);
		$mpdf->SetAuthor($kampret->metadata["author"]);
		$mpdf->SetCreator($kampret->metadata["creator"]);
		$mpdf->SetSubject($kampret->metadata["subject"]);
		$mpdf->SetKeywords($kampret->metadata["keyword"]);
		$mpdf->WriteHTML($kampret->viewPdf());
		
		//$mpdf->SetHTMLHeader($kampret->headers());
		//$mpdf->SetHTMLFooter($kampret->footers());
		
		//cache
		if($__config['cache']==true){
			if(!file_exists("src/cache/".Url::$segment[0])){
				$mpdf->Output("src/cache/".Url::$segment[0]);
				@readfile("src/cache/".Url::$segment[0]);
			}else{
				@readfile("src/cache/".Url::$segment[0]);
			}
		}else{
			$mpdf->Output();
		}
}else{
	
		if($__config['cache']==true){
			if(!file_exists("src/cache/".Url::$segment[0])){
				$single = array(
						"result" => $kampret->result,
						"meta" => $kampret->metadata,
						"header" =>$keyword->post(false,4),
						"post" => $keyword->post(false,10),
						"sidebar" => $keyword->post(false,8),
						"bing_title"=>"",
						"footer" =>"",
					);
				$nyache = json_encode($single);
				file_put_contents("src/cache/".Url::$segment[0],$nyache);
				include "src/page/single_page.php";
				
				//print_r($single);
			}else{
				$single = json_decode(file_get_contents("src/cache/".Url::$segment[0]),true);
				include "src/page/single_page.php";
				//print_r($single);
			}
		}else{
			$single = array(
						"result" => $kampret->result,
						"meta" => $kampret->metadata,
						"header" =>$keyword->post(false,4),
						"post" => $keyword->post(false,10),
						"sidebar" => $keyword->post(false,8),
						"bing_title"=>"",
						"footer" =>"",
					);
			include "src/page/single_page.php";
			//print_r("<pre>");
			//print_r($single);
			//print_r("</pre>");
		}
	
}



?>