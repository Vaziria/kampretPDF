<?php
require_once "./config.php";
require_once "./src/helper/psugeng_function.php";
require_once "./src/helper/kampret_function.php";
require_once "./src/helper/simple_html_dom.php";
require_once "./src/model/Url.php";
require_once "./src/model/keyword.php";

//set base url
Url::set("http://",$_SERVER["HTTP_HOST"]."/".$__config['root_dir'],$_GET["URI"],$__config['ekstensi_url']);

$single_pattern = '/^([a-zA-Z0-9\-\_]+)'.$__config["ekstensi_url"].'$/';


//bagian single
if(preg_match($single_pattern,Url::$segment[0])){
	
	
	//olah title
	$title = str_replace("_"," ",Url::$segment[0]);
	$title = str_replace($__config['ekstensi_url'],"",$title);
	
	
	//checking keyword user
	$keyword = new kampret\keyword($__config);
	
	if($__config["k_add"] == true || $__config["k_re_add"] == true){
		if($__config["k_add"] == true){
			$keyword->g_add($title);
		}
		
		$keyword->addList($keyword->cek($__config['k_dir'],$__config['k_name']));
		
	}
	
	$data = array( 
			"title" =>$title,
		);
		
///////////////////////////////////////////////////////////////redirect////////////////////////////////////////////////////////////
	

	$url_title = str_replace($__config['ekstensi_url'],"",Url::$segment[0]);

	if(!my_bot() && $__config['redirect']==true){
				$header_send==1;
				$sendkey = str_replace('{title}',$url_title,$__config['landing_page']);
						
								if($header_send==1){
												echo '<meta http-equiv="refresh" content="1; url='.$sendkey.'" />';
								}else{
												header('location:'.$sendkey);
								}
								
										
			exit;		
	}else{
		if(count(explode("_",Url::$segment[0]))<=$__config['nofollow_jum'] && $__config['nofollow_activate']==true){
			header("X-Robots-Tag: noindex, nofollow", true);			
		}
	}




/////////////////////////////////////////////////////////////auto load halaman/////////////////////////////////////////////////////
	
	include "single.php";
	
}else if(Url::$segment[0]==null || Url::$segment[0]=="index.php" || Url::$segment[0]=="home"){
	include "src/page/index.php";
	
	
}else if(preg_match("/^([a-zA-Z0-9\-\_]+)\.xml$/",Url::$segment[0])){
	if(Url::$segment[0]=="sitemap.xml"){
		$data = array(
				"level" => "parent",
				"status" =>"",
			);		
		include "sitemap.php";
	}else{
		$data = array(
				"level" => "child",
				"name" => str_replace(".xml","",Url::$segment[0]),
				"status" =>"",
			);
		include "sitemap.php";
	}
	
}else if(Url::$segment[0]=="full" && preg_match("/^([a-zA-Z0-9\-\_]+)\.xml$/",Url::$segment[1])){
	//sitemap
	
	if(Url::$segment[1]=="sitemap.xml"){
		$data = array(
				"level" => "parent",
				"status" =>"full",
			);		
		include "sitemap.php";
	}else{
		$data = array(
				"level" => "child",
				"name" => str_replace(".xml","",Url::$segment[1]),
				"status" =>"full",
			);
		include "sitemap.php";
	}
	
	
}else if(preg_match("/^google([a-zA-Z0-9]+)\.htmlx$/",Url::$segment[0])){
	$file = substr(Url::$segment[0],0,-1);
	//verif
	if(!file_exists($file)){
		file_put_contents($file,"google-site-verification: ".$file);
		echo file_get_contents($file);
	}else{
		echo file_get_contents($file);
	}
	
}else if(preg_match("/^google([a-zA-Z0-9]+)\.html$/",Url::$segment[0])){
	echo file_get_contents(Url::$segment[0]);
	
}else if(Url::$segment[0]=="css"){
	header("Content-Type: text/css");
	echo file_get_contents("./src/page/css/".Url::$segment[1]);
	
}else if(Url::$segment[0]=="js"){
	echo file_get_contents("./src/page/js/".Url::$segment[1]);
	
}else if(Url::$segment[0]=="test"){
	include "test.php";
}else{
	header("HTTP/1.0 404 Not Found");
	echo '<h1 align="center" style="margin: 100 0 0 0;font-size:50px;">:) Not Found.......</h1>';
	
}




?>