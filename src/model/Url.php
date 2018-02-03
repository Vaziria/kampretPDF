<?php

class Url{
	static $base;
	static $segment;
	static $eks;
	public static function set($pro,$bas,$uri,$ek = ".html"){
		self::$base = $pro.$bas;
		self::$segment = explode("/",$uri);
		self::$eks = $ek;
		
	}
	public static function singleUrl($id,$title){
		$title = str_replace("'", "", $title);
		$title = preg_replace('/[^\p{L}\p{N}]/u', '_', $title);
		$title = str_replace("__","",$title);
		return self::$base.$id."/".$title.self::$eks;
	}
	
	public static function justWord($title){
		$title = str_replace("'", "", $title);
		$title = preg_replace('/[^\p{L}\p{N}]/u', '_', $title);
		$title = str_replace("__","",$title);
		return self::$base.$title.self::$eks;
	}
	
}



?>