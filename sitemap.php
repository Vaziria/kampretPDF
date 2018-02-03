<?php
header('Content-Type: text/xml');
header('X-Robots-Tag: noindex,follow,noarchive,notranslate,noodp', true);

class Sitemap{
	var $sitemap;
	var $headers;
	var $body;
	var $pol;
	var $footer;
	var $config;
	var $limit;
	
	function __construct($arg){
		$this->config = $arg;
		// limit singgel di sitemap $this->limit = rand(min,max);
		$this->limit = rand(1,10);
	}
	
	function cek(){
		if($this->config["level"]=="parent"){
			$this->headers = '<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="'.Url::$base.'src/sitemap/css-sitemap-index.xsl"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
			$this->pol = '	<sitemap>
								<loc>{rname}.xml</loc>
								<lastmod>'.date('Y-m-d')."T".date('H:iP').'</lastmod>
							</sitemap>';
			
			$this->footer = '</sitemapindex>';					
			
			
			$this->sitemap = glob("sitemap/*.txt");
		}else{
			$this->headers = '<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="'.Url::$base.'src/sitemap/css-sitemap-single.xsl"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
			
			$this->footer = '</urlset>';					
			$this->pol = '<url><loc><![CDATA[{rname}]]></loc>
		<lastmod>'.date('Y-m-d')."T".date('H:iP').'</lastmod>
		<changefreq>daily</changefreq>
		<priority>0.8</priority>
	</url>';				
			
			$this->sitemap = explode("\r\n",file_get_contents("./sitemap/".$this->config["name"].".txt"));
		}
	}
	
	function getbody(){
		$a = 0;
		$jum = count($this->sitemap)-1;
		$randjum = rand(0,count($this->sitemap)-1);
		if($this->config["status"]=="full"){
			$this->limit = $jum;
		}
		while($a<count($this->sitemap)){
			if($this->config["level"]=="child"){
				if($a>=$this->limit){
					break;
				}
				if($randjum>$jum){
					$randjum = $randjum - $jum;
				}else{
					$randjum++;
				}
				$this->sitemap[$randjum] = explode("|",$this->sitemap[$randjum]);
				$url = Url::justWord($this->sitemap[$randjum][0]);
			}else{
				if($this->config["status"]=="full"){
					$pathfull = "full/";
				}else{
					$pathfull = "";
				}
				
				
				$url = Url::$base.$pathfull.$this->sitemap[$a];
				$url = str_replace("sitemap/","",$url);
				$url = str_replace(".txt","",$url);
			}
			$data = str_replace("{rname}",$url,$this->pol);
			
			echo $data;
			$a++;
		}
	}
}


$kampret = new Sitemap($data);
$kampret->cek();


echo $kampret->headers;
$kampret->getbody();
echo $kampret->footer;




//$sitemap = glob("sitemap/*.txt");

//print_r($kampret->sitemap);

?>