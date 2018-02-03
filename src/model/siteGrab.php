<?php
require_once "brilian.php";
require_once "bing.php";


class siteGrab extends brilian{
	var $rawkon;
	var $webpath;
	var $result;
	var $landing;
	var $books;
	var $keyword;
	var $metadata;
	var $format;
	var $test;
	var $config;
	function __construct($config,$path = "./"){
		//file keyword
		$this->keyword = explode("\r\n",file_get_contents($path."src/keyword.list"));
		$this->format = array(
				"judul" =>"{Free|Ebook|[isbn]|Second}[title]",
		
		);
		$this->config = $config;
		
	}
	
	
	function gen($arg1){
		$hasil = $this->format[$arg1];
		preg_match_all( "/\[([a-zA-Z0-9]+)\]/",$this->format[$arg1],$m);
		if(!empty($m)){
			$a=0;
			while($a<count($m[0])){
				$hasil = str_replace($m[0][$a],$this->result[$m[1][$a]],$hasil);
				$a++;
			}
		}
		return spintax($hasil);
	}
	
	function Grab($title){
		//keyword
		$keyword = new kampret\keyword("sitemap/");
		//set result
		$this->result = array(

				"title" => " ".$title,
				"images" => "",
				"author" => "",
				"format" => "",
				"page_books" => "",
				"isbn" => "",
				"desc" => strip_tags(get_bing($title,2)),
				"topPost" => $keyword->post(false,20),
				"related" => $keyword->post(false,20),

		);
		
		//related
		
		//set metadata
		$this->metadata = array(
							"title" =>$this->keywords(1," ").$this->result["title"],
							"author"=>$keyword->post(false,1)[0]." Creator",
							"creator"=>$keyword->post(false,1)[0]." Production",
							"subject"=>$this->keywords(1," ").$this->result["title"],
							"keyword"=>implode(",",$keyword->post(false,10)),
						);
		
		
		
		//olah judul
		$jdul = trim($this->result["title"])."_By_".$this->result["author"];
		$jdul = str_replace(" ","_",$jdul);
		$jdul = preg_replace("/[^a-zA-Z0-9_]+/","", $jdul);
		$jdul = strtolower(str_replace("__","",$jdul));
		
		//jdul link
		$jdul2 = trim($this->result["title"]);
		$jdul2 = str_replace(" ","-",$jdul2);
		$jdul2 = preg_replace("/[^a-zA-Z0-9_()-]+/","", $jdul2);
		$jdul2 = str_replace("--","",$jdul2);
		
		$this->books["name"] = $jdul.".pdf";
		//$this->landing = "http://pdf.sepoi.win/h/".$id."-".$jdul2."-pdf.html";

	}
	
	function keyword_filter($keyword,$deli,$new = ","){
		$keyword = explode($deli,$keyword);
		$a = 0;
		while($a<count($keyword)){
			$keyword[$a] = trim(strip_tags($keyword[$a]));
			$a++;
		}
		$keyword = implode($new,$keyword);
		
		return $keyword;
	}
	
	function related(){
		$relat = explode('<div class="js-tooltipTrigger tooltipTrigger"',cutter($this->rawkon,'<div class="js-dataTooltip" data-use-wtr-tooltip=','<div class="moreLink">'));
		
		$this->result["related"] = array();
		
		$a = 0;
		while($a<count($relat)){
			
			$data = array(
						"id" => cutter($relat[$a],"data-resource-id='","'"),
						"title" => cutter($relat[$a],'title="','"'),
						"image" => cutter($relat[$a],'src="','"'),
					);
			array_push($this->result["related"],$data);
			$a++;
		}
		
	}
	
	
	function logos(){
		$images = glob(path_logo."*");
		return $images[rand(0,count($images)-1)];
	}
	
	function keywords($jum,$del){
		$a = 0;
		$konten = "";
		$c = count($this->keyword)-1;
		while($a<$jum){
			$konten .= ucwords($this->keyword[rand(0,$c)]).$del;
			$a++;
		}
		return $konten;
	}
	
	function headers(){
		$konten= '
		<div style="text-align: right;">
				<p style="font-weight:bold;color:blue;"><span style="color:black;font-size:18px;">'.$this->result["title"].'</span><br><span style="font-size:10px;">'.$this->keywords(6,", ").'</span></p>
			<hr>
		</div>
		';
		
		return $konten;
	}
	
	function viewPdf(){
		
		$deskripsi = array();
		$databing = get_bing($this->result["title"],1,"title");
		$depanparaf = '<b>'.$this->result["title"]." - </b>";
		
		
		$postawal = rand(0,1);
		$dp = "";
		if($postawal!=0){
			$dp = $depanparaf;
			$depanparaf = "";
		}
		
		$a = 0;
		while($a<strlen($this->result["desc"])){
			$cc = rand(100,500);
			if($a==0){
				array_push($deskripsi,'<p align="justify">'.$dp.substr($this->result["desc"],$a,$cc)."</p>");
			}else{				
				array_push($deskripsi,'<p align="justify">'.substr($this->result["desc"],$a,$cc)."</p>");
			}
			$a = $a + $cc;
		}
		
		
		$bingparaf = '<p align="justify">'.$depanparaf.$this->keyword_filter(get_bing($this->result["title"],1,"title"),"<br>",".")."</p>";
		
		//add acak paragraf bing
		array_splice($deskripsi,$postawal,0,$bingparaf);
		
		
		
		//title bing add to deskripsi
		$bingtitles = explode("<br>",preg_replace("/\<\/strong\>|\<strong\>/","",$databing));
		$bingtitle = "<h3>Related Post</h3><ul>";
		foreach($bingtitles as $dd){
			$bingtitle .= '<li><a href="'.Url::justWord($dd).'">'.$dd.'</a></li>';
		}
		$bingtitle .= "</ul>";
		
		//add bing title di posisi acak
		array_splice($deskripsi,rand(2,count($deskripsi)-1),0,$bingtitle);
		
		
		//add related di posisi acak acak
		$related = "";
		foreach($this->result["related"] as $dd){
			$related .= '<li><a href="'.Url::justWord($dd).'">'.$dd.'</a></li>';
		}
		
		$relateds = '<ul>'.$related.'</ul>';	
		array_splice($deskripsi,rand(2,count($deskripsi)-1),0,$relateds);
		
		
		//add top post di posisi acak acak
		$toppost = "";
		foreach($this->result["topPost"] as $da){
			$toppost .= '<li><a href="'.Url::justWord($dd).'">'.$da.'</a></li>';
		}
		
		$topposts = '<ul>'.$toppost.'</ul>';	
		array_splice($deskripsi,rand(2,count($deskripsi)-1),0,$topposts);
		
		
		
		
		
		
		$deskripsi = implode("",$deskripsi);
		
		
		
		
		//mulai writing
		$konten = '
		
		<html>
			<head>
			<style>
			a{
				text-decoration: none;
			}
			.btn a{
				color: #ffffff;
				text-decoration: none;
			}
			.btn {
				  background: #3498db;
				  background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
				  background-image: -moz-linear-gradient(top, #3498db, #2980b9);
				  background-image: -ms-linear-gradient(top, #3498db, #2980b9);
				  background-image: -o-linear-gradient(top, #3498db, #2980b9);
				  background-image: linear-gradient(to bottom, #3498db, #2980b9);
				  -webkit-border-radius: 28;
				  -moz-border-radius: 28;
				  border-radius: 28px;
				  font-family: Georgia;
				  font-size: 28px;
				  padding: 10px 20px 10px 20px;
				}

				.btn:hover {
				  background: #3cb0fd;
				  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
				  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
				  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
				  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
				  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
				  text-decoration: none;
				}
			</style>
			</head>
			<body>
				<h1>'.$this->gen("judul").' </h1>';
		
		//deskripsi
		$konten .= $deskripsi;
				
		$konten .= '
				
			</body>
		
		</html>';
		
		return $konten;
	}
	
	function footers(){
		$konten = '
			<hr>
			<table width="100%">
				<tr>
					<td width="33%">'.$this->result["author"].'</td>
					<td width="33%" align="center">'.$this->result["title"].'</td>
					<td width="33%" style="text-align: right;">{PAGENO}/{nbpg}</td>
				</tr>
			</table>';
		
		return $konten;
	}
	
	function addlink($text,$jum){
		$tex = explode(" ",$text);
		$c = count($tex)-1;
		$a = 0;
		while($a<$jum){
			$in = rand(0,$c);
			$tex[$in] = '<a href="'.$this->landing.'">'.$tex[$in]."</a>";
			$a++;
		}
		return implode(" ",$tex);
	}
	
	function potong($asd,$bat1,$bat2){
		$asd = explode($bat1,$asd);
		$asd = $asd[1];
		$asd = explode($bat2,$asd);
		$asd = $asd[0];
		return $asd;
	}
	
}


?>