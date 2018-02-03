<?php
namespace kampret;
class keyword{
	var $url;
	var $dirwork;
	var $config;
	var $g_keywords = array();
	function __construct($config,$dir = "sitemap/"){
		$this->config = $config;
		$this->dirwork = $dir;
	}
	
	
	//function sugested google
	function g_add($q,$batas = 100){
		if(isset($this->config["k_ambil_kata"])){
			$kata = $this->config["k_ambil_kata"];
		}
	
		if($kata!=null){
			$katas = explode(" ",$q);
			shuffle($katas);
			$a = 0;
			$qc = array();
			while($a<$kata){
				if($a >count($katas)-1){
					break;
				}
				array_push($qc,$katas[$a]);
				$a++;
			}
			
			$q = implode(" ",$qc);
		}
		if(isset($this->config["k_jum"])){
			$batas = $this->config["k_jum"];
		}
		
		$this->g_get($q);
		$a = 1;
		while(count($this->g_keywords)<$batas && count($this->g_keywords)!=0){
			if(!isset($this->g_keywords[$a])){
				break;
			}
			
			$this->g_get($this->g_keywords[$a]);
			
			$a++;
		}
		
	}
	
	function g_get($q){
		$endpoint = "http://suggestqueries.google.com/complete/search?";
		$query = array(
			"q" => $q,
			"client" => "chrome",
		);
		
		$query = http_build_query($query);
		$raw = file_get_contents($endpoint.$query);
		$raw = json_decode($raw);
		$hasil = array();
		
		$a = 0;
		if(count($raw[1])==0){
			return false;
		}
		
		while($a<count($raw[1])){
			
			if(!preg_match("/http/",$raw[1][$a])){
				
				if($this->k_relcek($raw[1][$a])){
					array_push($this->g_keywords,$raw[1][$a]);					
				}
			}
			
			$a++;
		}
	}
	
	
	protected function k_relcek($data){
		$datas = explode(" ",$data);
		$c = count($datas);
		if($c>=$this->config["k_rmin"] && $c<=$this->config["k_rmax"]){
			return true;
		}else{
			return false;
		}
		
	}
	
	//end sugested google
	function getword(){
		
		$min = $this->config['get_min'];
		$max = $this->config['get_max'];
		$minword = $this->config['get_min_word'];
		$maxword = $this->config['get_max_word'];
		
		if(isset($_SERVER["HTTP_REFERER"])){
			$this->url = $_SERVER["HTTP_REFERER"];
			
			//cek user agent
			if(preg_match('/archive|partner/i',$_SERVER['HTTP_USER_AGENT'])){
				return null;
			}
			
			//olah keyword
			$query_url = parse_url($this->url);
			if(isset($query_url["query"])){
				$query_url = $query_url["query"];
				parse_str($query_url,$keyword);
				if(preg_match('/google|bing/', $this->url)) { 
					$keyword = $keyword['q'];
				} 
				else if(preg_match('/yahoo/', $this->url)) {
					$keyword = $keyword['p']; 
				}
				
				//cek panjang keyword
				
				$cek = count(explode(" ",$keyword));
				if(($cek==$minword && $cek==$maxword) || ($minword == 1 && (strlen($keyword)>=$min && strlen($keyword<=$max)))){
					if(strlen($keyword)>=$min && strlen($keyword)<=$max){
						return $keyword;
					}					
				}
			}
			
		}
		
	}
	
	function addList($file = "default.list"){
		//create jika file g ada
		if(!file_exists($file)){
			file_put_contents($file,"");
		}
		
		//add to list
		$raw = file_get_contents($file);
		
		$datas = explode("\r\n",$raw);
		
		//related nya
		$change = false;
		if(count($this->g_keywords)!=0 && $this->config["k_add"]==true){
			$datas = array_unique(array_merge($datas,$this->g_keywords));
			$raw = implode("\r\n",$datas);
			$change = true;
		}
		
		$keyword = $this->getword();
		if($this->config['k_re_add']==true && ($keyword!=null && !in_array($keyword,$datas)) ){
			if($datas[0]==""){
				$raw = $keyword;				
			}else{
				$raw.="\r\n".$keyword;
			}			
			$change = true;
		}
		
		
		//check duplicate
		if($change == true){

			file_put_contents($file,$raw);
			return true;
		}
		
		return false;
	}
	
	function cek($dir,$name){
		
		$cek = $this->config['k_cek'];
		$size = $this->config['k_count'];
		
		$files = glob($dir."*.txt");
		if(count($files)==0){
			file_put_contents($dir.$name."1.txt","");
			return $dir.$name."1.txt";
		}
		
		$jum = count($files)+1;
		
		//checking jum
		if($cek=="jum"){
			$ukuran = explode("\r\n",file_get_contents(end($files)));
			$ukuran = count($ukuran);
		}else if($cek=="size"){
			$ukuran = filesize(end($files));
		}
		 
		
		if($ukuran>$size){
			$name = str_replace($dir,"",end($files));
			$name = preg_replace("/[\d]+\.txt$/","",$name);
			file_put_contents($dir.$name.$jum.".txt","");
			return $dir.$name.$jum.".txt";
		}else{
			return end($files);
		}
	}
	function post($callback =null ,$jum=10){
		$files = glob($this->dirwork."*.txt");
		$file = $files[rand(0,count($files)-1)];
		$file = explode("\r\n",file_get_contents($file));
		
		$jj = count($file);
		while($jj=0){
			$file = $file[rand(0,count($files)-1)];
			$file = explode("\r\n",file_get_contents($file));
			
		}
		
		
		
		if(count($file)<$jum){
			$jum = count($file);
		}
		shuffle($file);		
		$hasil = array();
		if(is_callable($callback)){
			$a = 0;
			while($a<$jum){
				$proc = $file[$a];
				$file[$a] = $callback($proc);
				array_push($hasil,$file[$a]);
				$a++;
			}
		}else{
			$a = 0;
			while($a<$jum){
				array_push($hasil,$file[$a]);
				$a++;
			}	
		}		
		return $hasil;
	}
}



?>