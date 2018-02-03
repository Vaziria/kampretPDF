<?php
###############################
#   Support To TYPE:v24.1.0   #
#      Load 2016-12-25        #
###############################
function url_encode($data, $pad = null) {
include 'setting.php';
if($sn==''){
	$snx ='QWERTYUIOPASDFGHJKL';
}else{
	$snx = $sn;
}
    $data = str_replace(array('+', '/'), array('-', '_'), base64_encode($data));
    if (!$pad) {
        $data = rtrim($data, '=');
    }
    return $data.$snx;
}

function url_decode($datax) {
include 'setting.php';
if($sn==''){
	$snx ='QWERTYUIOPASDFGHJKL';
}else{
	$snx = $sn;
}
$data = str_replace($snx,'',$datax);
    return base64_decode(str_replace(array('-', '_'), array('+', '/'), $data));
}

function images($code, $url){
	if ($code == 'D'){
		$data = str_replace ('http://','',$url);
		$data = str_replace ('https://','',$data);
		$data = str_replace ('/','_',$data);
	}else{
		$data = 'http://'.str_replace ('_','/',$url);
	}
	return $data;
}


function decodex($decode){
	$data = str_replace ('0','A',$decode);
	$data = str_replace ('1','C',$data);
	$data = str_replace ('2','X',$data);
	$data = str_replace ('3','J',$data);
	$data = str_replace ('4','I',$data);
	$data = str_replace ('5','H',$data);
	$data = str_replace ('6','G',$data);
	$data = str_replace ('7','F',$data);
	$data = str_replace ('8','E',$data);
	$data = str_replace ('9','B',$data);
	return $data;
}
function encodex($decode){
	$data = str_replace ('A','0',$decode);
	$data = str_replace ('C','1',$data);
	$data = str_replace ('X','2',$data);
	$data = str_replace ('J','3',$data);
	$data = str_replace ('I','4',$data);
	$data = str_replace ('H','5',$data);
	$data = str_replace ('G','6',$data);
	$data = str_replace ('F','7',$data);
	$data = str_replace ('E','8',$data);
	$data = str_replace ('B','9',$data);
	return $data;
}
function normal($content){
$data = str_replace ('http://','',$content);
$data = str_replace ('https://','',$data);
$data = str_replace ('www.','',$data);
$data1 = strlen($data) -1;
$data2 = substr($data, 0, $data1);
$kunci = str_replace ($data2,'',$data);
if ($kunci == '/'){
$out = $data2;
}else{
$out = $data ;
}
return $out;
}
// limit text
function limit($title,$long){
	$out = substr($title,0,$long);
return $out;
}
function permalink($title){
	$titles = url_title($title);
return $titles;
}
function permalinkURL($title){
	$titles = url_title($title);
return $titles;
}
//url title
function url_title($text){ 
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
  $text = trim($text, '-');
  //$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = strtolower($text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  if (empty($text))
  {
    return 'n-a';
  }
  return $text;
}
function debug($result) {
	echo '<pre>'; print_r($result); echo '</pre>';
}

function cutter($content, $start, $end) {
	if($content && $start && $end) {
		$r = explode($start, $content);
		if (isset($r[1])) {
			$r = explode($end, $r[1]);
			return $r[0];
		}
		return false;
	}
}

function baca($url, $referer = 'http://www.google.com/firefox?client=firefox-a&rls=org.mozilla:fr:official', $ua = 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.18) Gecko/20110614 Firefox/3.6.18') {
	if(function_exists('curl_exec')) {
		$curl = curl_init();
		$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
		$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
		$header[] = "Cache-Control: max-age=0";
		$header[] = "Connection: keep-alive";
		$header[] = "Keep-Alive: 300";
		$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
		$header[] = "Accept-Language: en-us,en;q=0.5";
		$header[] = "Pragma: ";
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_USERAGENT, $ua);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($curl, CURLOPT_REFERER, $referer);
		curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
		curl_setopt($curl, CURLOPT_AUTOREFERER, true);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		$content = curl_exec($curl);
		curl_close($curl);
	} else {
		ini_set('user_agent', $ua);
		$content = file_get_contents($url);
	}
	return $content;
}


function clean_character($content){
	$content = propdf_replaceSpecial($content);
	$a = array('â€', 'â€œ', 'Ã¢â‚¬Å“', 'Ã¢â‚¬Â', 'â€˜', 'Ã¢â‚¬Ëœ', 'Ã¢â‚¬', ' â„¢', 'â„¢', 'Â¦', 'Ã¢â‚¬', 'Ã‚Â½', 'ÃƒÂ©', 'Ãƒ', 'Â¢', 'â€¢', 'Ã£', 'â€”', '[', ']', 'Ã¢â‚¬â„¢', 'â€™', 'â€“', '&#8211;', '&#8230;', '&#8220;', '&#8221;', '&#8217;', '&#038;', '&#8212;', '&#8216;', '&#8242;', '&#8243;', '&#8482;', '&#174;');
	$b = array('', '', '', '', '', '', ' ', "'", "'", '', '', ' 1/2', 'e', 'a', '-', '*', 'a', '-', '', '', "'", "'", '-', '-', '...', '"', '"', "'", '', '-', "'", "'", '"', '', '');
	$content = str_replace($a, $b, $content);
	$content = preg_replace('/&#(.*?);/', ' ', $content);
	$content = htmlspecialchars_decode($content, ENT_QUOTES | ENT_HTML5);
	return $content;
}
function propdf_replaceSpecial($str){
	$chunked = str_split($str,1);
	$str = ""; 
	foreach($chunked as $chunk){
		$num = ord($chunk);
		// Remove non-ascii & non html characters
		if ($num >= 32 && $num <= 123){
				$str.=$chunk;
		}
	}   
	return $str;
}


//fungsi spintax
function spintax( $s )
{
    preg_match( "#{(.+?)}#is", $s, $m );
    if ( empty( $m) )
    {
        return $s;
    }
    $t = $m[1];
    if ( strpos( $t, "{" ) !== false )
    {
        $t = substr( $t, strrpos( $t, "{" ) + 1 );
    }
    $parts = explode( "|", $t );
    $s = preg_replace( "+{".preg_quote( $t )."}+is", $parts[array_rand( $parts )], $s, 1 );
    return spintax( $s );
}

function booksBUTTON($url,$title) {
$button = '<a href="'.$url.'/download/'.permalinkURL($title).'" ><img src="'.$url.'/images/cart/download.png" height="62" width="300"></a> <a href="'.$url.'/read-online/'.permalinkURL($title).'" ><img src="'.$url.'/images/cart/read.png" height="60" width="300"></a> ';	
return $button;	
}
function ads1($ads1) {
	$contents = baca($ads1);
	echo $contents;	
	}
function ads2($ads2) {
$contents = baca($ads2);	
	echo $contents;	
	}
function save_cache($id_file,$id_content,$kode){

if(!file_exists($id_file)) fopen($id_file,"w");
$fp = fopen($id_file,$kode) or die ("Error opening file $id_file");
fputs($fp,$id_content);
fclose($fp) or die ("Error closing file!");
}
function clearCAR($results) { 
	$chok_ren1 = str_replace('<p>', 'chokengpchokeng',$results);
	$chok_ren2 = str_replace('</p>', 'chokengpschokeng',$chok_ren1);
	$chok_ren3 = str_replace('<h3>', 'chokenghtigachokeng',$chok_ren2);
	$chok_ren4 = str_replace('</h3>', 'chokenghtigaschokeng',$chok_ren3);
	$chok_ren5 = str_replace('.', 'chokengtitikchokeng',$chok_ren4);
	$chok_ren6 = str_replace(',', 'chokengkomachokeng',$chok_ren5);
	$chok_ren7 = str_replace('<i>', 'chokengichokeng',$chok_ren6);
	$chok_ren8 = str_replace('#-#', 'chokengsretchokeng',$chok_ren7);
	$chok_ren9 = str_replace('</td>', 'choktd',$chok_ren8);
	$chok_ren10 = str_replace('<td>', 'choketd',$chok_ren9);
	$chok_ren11 = str_replace('<tr>', 'choketr',$chok_ren10);
	$chok_ren12 = str_replace('</tr>', 'choketr',$chok_ren11);
	$chok_ren13 = str_replace('<table>', 'choktbl',$chok_ren12);
	$chok_ren14 = str_replace('</table>', 'choketbl',$chok_ren13);
	$chok_ren15 = str_replace('<h1>', 'hsatu',$chok_ren14);
	$chok_ren16 = str_replace('<h2>', 'hdua',$chok_ren15);
	$chok_ren17 = str_replace('</h1>', 'enhxsatu',$chok_ren16);
	$chok_ren18 = str_replace('</h2>', 'enhxdua',$chok_ren17);
	$chok_ren19 = str_replace('<h5>', '',$chok_ren18);
	$chok_ren20 = str_replace('0', 'xxnoxx',$chok_ren19);
	$chok_ren21 = str_replace('1', 'xxsatuxx',$chok_ren20);
	$chok_ren22 = str_replace('2', 'xxduaxx',$chok_ren21);
	$chok_ren23 = str_replace('3', 'xxtigaxx',$chok_ren22);
	$chok_ren24 = str_replace('4', 'xxempatxx',$chok_ren23);
	$chok_ren25 = str_replace('5', 'xxlimaxx',$chok_ren24);
	$chok_ren26 = str_replace('6', 'xxenamxx',$chok_ren25);
	$chok_ren27 = str_replace('7', 'xxtujuhxx',$chok_ren26);
	$chok_ren28 = str_replace('8', 'xxdelapanxx',$chok_ren27);
	$chok_ren29 = str_replace('9', 'xxsembilanxx',$chok_ren28);
	$chok_ren30 = str_replace('<hr>', 'xxhrxx',$chok_ren29);
	$chok_ren31 = str_replace('<hr/>', 'xxhrsxx',$chok_ren30);
	$result = str_replace('</i>', 'chokengischokeng',$chok_ren31);
	$result = strip_tags($result);
	$result = preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $result);
	$result = preg_replace('/&.+?;/', '', $result);
	$result = preg_replace('/\s+/', ' ', $result);
	$result = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', ' ', $result);
	$result = preg_replace('|-+|', ' ', $result);
	$result = preg_replace('/&#?[a-z0-9]+;/i','',$result);
	$result = preg_replace('/[^%A-Za-z0-9 _-]/', ' ', $result);
	$result = preg_replace('/[0-9]/', ' ', $result);
	//$result = preg_replace('/\s+/', ' ', $result);
	$result = trim($result, ' ');
	$chok_mv1 = str_replace('chokengpchokeng', '<p>', $result);
	$chok_mv2 = str_replace('chokengpschokeng', '</p>', $chok_mv1);
	$chok_mv3 = str_replace('chokenghtigachokeng', '<h3>', $chok_mv2);
	$chok_mv4 = str_replace('chokenghtigaschokeng', '</h3>', $chok_mv3);
	$chok_mv5 = str_replace('chokengtitikchokeng', '.', $chok_mv4);
	$chok_mv6 = str_replace('chokengkomachokeng', ',', $chok_mv5);
	$chok_mv7 = str_replace('chokengichokeng', ' <i>', $chok_mv6);
	$chok_mv8 = str_replace('   ', ' ', $chok_mv7);
	$chok_mv9 = str_replace('  ', ' ', $chok_mv8);
	$chok_mv10 = str_replace('chokengsretchokeng', '#-#', $chok_mv9);
	$chok_mv11 = str_replace('...', '', $chok_mv10);
	$chok_mv12 = str_replace(' .. ', ' ', $chok_mv11);
	$chok_mv13 = str_replace('. .', '', $chok_mv12);
	$chok_mv14 = str_replace(' .', '.', $chok_mv13);
	$chok_mv15 = str_replace(',    .', '.', $chok_mv14);
	$chok_mv16 = str_replace(', ,', '', $chok_mv15);
	$chok_mv17 = str_replace('choktd', '</td>', $chok_mv16);
	$chok_mv18 = str_replace('choketd', '<td>', $chok_mv17);
	$chok_mv19 = str_replace('choktr', '<tr>', $chok_mv18);
	$chok_mv20 = str_replace('choketr', '</tr>', $chok_mv19);
	$chok_mv21 = str_replace('choktbl', '<table>', $chok_mv20);
	$chok_mv22 = str_replace('choketbl', '</table>', $chok_mv21);
	$chok_mv23 = str_replace('xxnoxx', '0', $chok_mv22);
	$chok_mv24 = str_replace('xxsatuxx', '1', $chok_mv23);
	$chok_mv25 = str_replace('xxduaxx', '2', $chok_mv24);
	$chok_mv26 = str_replace('xxtigaxx', '3', $chok_mv25);
	$chok_mv27 = str_replace('xxempatxx', '4', $chok_mv26);
	$chok_mv28 = str_replace('xxlimaxx', '5', $chok_mv27);
	$chok_mv29 = str_replace('xxenamxx', '6', $chok_mv28);
	$chok_mv30 = str_replace('xxtujuhxx', '7', $chok_mv29);
	$chok_mv31 = str_replace('xxdelapanxx', '8', $chok_mv30);
	$chok_mv32 = str_replace('xxsembilanxx', '9', $chok_mv31);
	$chok_mv33 = str_replace('xxhrxx', '<hr>', $chok_mv32);
	$chok_mv34 = str_replace('hsatu', '<h1>', $chok_mv33);
	$chok_mv35 = str_replace('hdua', '<h2>', $chok_mv34);
	$chok_mv36 = str_replace('enhxsatu', '</h1>', $chok_mv35);
	$chok_mv37 = str_replace('enhxdua', '</h2>', $chok_mv36);
	$chok_mv38 = str_replace('xxhrsxx', '<hr/>', $chok_mv37);
	$resultx = str_replace('chokengischokeng', '</i>', $chok_mv38);
	$resultx = preg_replace('/\s+/', ' ',$resultx);
	$resultxx = str_replace('. ', ' ',$resultx);
	$resultxx = str_replace('amazon.com', '',$resultxx);
	$resultxx = str_replace('amazon', '',$resultxx);
	$resultxx = str_replace('Amazon', '',$resultxx);
	$resultxx = str_replace('AMAZON', '',$resultxx);
	$resultxx = str_replace('more', '',$resultxx);
	return $resultxx;
}
function bingcontent($title,$total){
$titlex_all = explode(' ',$title);
$titlex_totla = count($titlex_all) -1;
if ($titlex_totla < 3){
	$titlex = $title;
}else{
	$titlex = $titlex_all[0].' '.$titlex_all[1].' '.$titlex_all[2];
}
$out_contentx = '';
$m = 1;
while ($m <= $total){
	if($total==1){
		$mx ='';
	}else{
		$mx = $m + 1;
	}
$url = 'http://www.bing.com/search?q='.str_replace(' ','+',$titlex).'&first='.$mx;
$data = file_get_contents($url);
$all_item = explode('<li class="b_algo">', $data);
$total_item = count($all_item)-1;
$out_data ='';
$c = 1;
	while ($c <= $total_item){
	$title = clearCAR(cutter($all_item[$c], '<h2>', '</a>'));
	$content = clearCAR(cutter($all_item[$c], '<p>', '</p>'));
	$out_data .= $title.' '.$content.' ';
	
	$c = $c+1;
}	
$out_content = str_replace('1', '', $out_data);
$out_content = str_replace('2', '', $out_content);
$out_content = str_replace('3', '', $out_content);
$out_content = str_replace('4', '', $out_content);
$out_content = str_replace('5', '', $out_content);
$out_content = str_replace('6', '', $out_content);
$out_content = str_replace('7', '', $out_content);
$out_content = str_replace('8', '', $out_content);
$out_content = str_replace('9', '', $out_content);
$out_content = str_replace('0', '', $out_content);
$out_content = str_replace('www.', '', $out_content);
$out_content = str_replace('.com', '', $out_content);
$out_content = str_replace('.net', '', $out_content);
$out_contentx .='<p>'. str_replace('.org', '', $out_content).'</p>';
$m = $m+1;
}
return $out_contentx;
}

function resik($in){
	$out =  preg_replace('/^\s+|\n|\r|\s+$/m', '', $in);
	return $out;
}
//bing 
function get_bing($tx,$total,$kode = NULL){

$title = str_replace(' ','-',$tx);
$in_title = explode('-',$title);
$in_total = count($in_title);
if($in_total==1){
	$tt = $in_title[0];
}elseif($in_total==2){
	$tt = $in_title[0].' '.$in_title[1];
}elseif($in_total==3){
	$tt = $in_title[0].' '.$in_title[1].' '.$in_title[2];
}elseif($in_total==4){
	$tt = $in_title[0].' '.$in_title[1].' '.$in_title[2];
}else{
	$tt = $in_title[0].' '.$in_title[1].' '.$in_title[2];
}

if ($kode=='title'){
	$total =1;
}

$out = '';
$out_contentx = '';
$m = 1;
while ($m <= $total){
	if($total==1){
		$mx ='';
	}else{
		$mx = $m + 1;
	}
$url = 'http://www.bing.com/search?q='.str_replace(' ','+',$tt).'&first='.$mx;
$data = file_get_contents($url);
$all_item = explode('<li class="b_algo">', $data);
$total_item = count($all_item)-1;
$out_data ='';
$titlex ='';
$meta_key ='';
$c = 1;
	while ($c <= $total_item){
	$title = clearCAR(cutter($all_item[$c], '<h2>', '</a>'));
	$titlez = xx(cutter($all_item[$c], '<h2>', '</a>'));
	$content = clearCAR(cutter($all_item[$c], '<p>', '</p>'));
	$out_data .= $title.' '.$content.' ';
	$titlex .= "<strong>$titlez</strong><br>
";	
	$meta_key .= " ,$titlez";
	$c = $c+1;
}
$out_content = str_replace('1', '', $out_data);
$out_content = str_replace('2', '', $out_content);
$out_content = str_replace('3', '', $out_content);
$out_content = str_replace('4', '', $out_content);
$out_content = str_replace('5', '', $out_content);
$out_content = str_replace('6', '', $out_content);
$out_content = str_replace('7', '', $out_content);
$out_content = str_replace('8', '', $out_content);
$out_content = str_replace('9', '', $out_content);
$out_content = str_replace('0', '', $out_content);
$out_content = str_replace('www.', '', $out_content);
$out_content = str_replace('.com', '', $out_content);
$out_content = str_replace('.net', '', $out_content);
$out_contentx = resik('<p>'. str_replace('.org', '', $out_content).'</p>');
if ($kode=='title'){
	$out = $titlex;
}elseif($kode=='content'){
	$out .= $out_content;
}elseif($kode=='meta_keyword'){
	$out .= $meta_key;
}else{
	$out .= $out_contentx;
}
$m = $m+1;
}
return del_site($out);
}
function del_site($site){
$array = array(' …','.blogspot','https://','http://','www.','.com','.org','.net','.int','.edu','.gov','.mil','.ac','.ad','.ae','.af','.ag','.ai','.al','.am','.an','.ao','.aq','.ar','.as','.at','.au','.aw','.ax','.az','.ba','.bb','.bd','.be','.bf','.bg','.bh','.bi','.bj','.bm','.bn','.bo','.bq','.br','.bs','.bt','.bv','.bw','.by','.bz','.bzh','.ca','.cc','.cd','.cf','.cg','.ch','.ci','.ck','.cl','.cm','.cn','.co','.cr','.cs','.cu','.cv','.cw','.cx','.cy','.cz','.dd','.de','.dj','.dk','.dm','.do','.dz','.ec','.ee','.eg','.eh','.er','.es','.et','.eu','.fi','.fj','.fk','.fm','.fo','.fr','.ga','.gb','.gd','.ge','.gf','.gg','.gh','.gi','.gl','.gm','.gn','.gp','.gq','.gr','.gs','.gt','.gu','.gw','.gy','.hk','.hm','.hn','.hr','.ht','.hu','.id','.ie','.il','.im','.in','.io','.iq','.ir','.is','.it','.je','.jm','.jo','.jp','.ke','.kg','.kh','.ki','.km','.kn','.kp','.kr','.krd','.kw','.ky','.kz','.la','.lb','.lc','.li','.lk','.lr','.ls','.lt','.lu','.lv','.ly','.ma','.mc','.md','.me','.mg','.mh','.mk','.ml','.mm','.mn','.mo','.mp','.mq','.mr','.ms','.mt','.mu','.mv','.mw','.mx','.my','.mz','.na','.nc','.ne','.nf','.ng','.ni','.nl','.no','.np','.nr','.nu','.nz','.om','.pa','.pe','.pf','.pg','.ph','.pk','.pl','.pm','.pn','.pr','.ps','.pt','.pw','.py','.qa','.re','.ro','.rs','.ru','.rw','.sa','.sb','.sc','.sd','.se','.sg','.sh','.si','.sj','.sk','.sl','.sm','.sn','.so','.sr','.ss','.st','.su','.sv','.sx','.sy','.sz','.tc','.td','.tf','.tg','.th','.tj','.tk','.tl','.tm','.tn','.to','.tp','.tr','.tt','.tv','.tw','.tz','.ua','.ug','.uk','.us','.uy','.uz','.va','.vc','.ve','.vg','.vi','.vn','.vu','.wf','.ws','.ye','.yt','.yu','.za','.zm','.zr','.zw','.academy','.accountants','.active','.actor','.adult','.aero','.agency','.airforce','.app','.archi','.army','.associates','.attorney','.auction','.audio','.autos','.band','.bar','.bargains','.beer','.best','.bid','.bike','.bio','.biz','.black','.blackfriday','.blog','.blue','.boo','.boutique','.build','.builders','.business','.buzz','.cab','.camera','.camp','.cancerresearch','.capital','.cards','.care','.career','.careers','.cash','.catering','.center','.ceo','.channel','.cheap','.christmas','.church','.city','.claims','.cleaning','.click','.clinic','.clothing','.club','.coach','.codes','.coffee','.college','.community','.company','.computer','.condos','.construction','.consulting','.contractors','.cooking','.cool','.country','.credit','.creditcard','.cricket','.cruises','.dad','.dance','.dating','.day','.deals','.degree','.delivery','.democrat','.dental','.dentist','.diamonds','.diet','.digital','.direct','.directory','.discount','.domains','.eat','.education','.email','.energy','.engineer','.engineering','.equipment','.esq','.estate','.events','.exchange','.expert','.exposed','.fail','.farm','.fashion','.feedback','.finance','.financial','.fish','.fishing','.fit','.fitness','.flights','.florist','.flowers','.fly','.foo','.forsale','.foundation','.fund','.furniture','.gallery','.garden','.gift','.gifts','.gives','.glass','.global','.gop','.graphics','.green','.gripe','.guide','.guitars','.guru','.healthcare','.help','.here','.hiphop','.hiv','.holdings','.holiday','.homes','.horse','.host','.hosting','.house','.how','.info','.ing','.ink','.institute','.insure','.international','.investments','.jobs','.kim','.kitchen','.land','.lawyer','.legal','.lease','.lgbt','.life','.lighting','.limited','.limo','.link','.loans','.lotto','.luxe','.luxury','.management','.market','.marketing','.media','.meet','.meme','.memorial','.menu','.mobi','.moe','.money','.mortgage','.motorcycles','.mov','.museum','.name','.navy','.network','.new','.ngo','.ninja','.one','.ong','.onl','.ooo','.organic','.partners','.parts','.party','.pharmacy','.photo','.photography','.photos','.physio','.pics','.pictures','.pink','.pizza','.place','.plumbing','.poker','.porn','.post','.press','.pro','.productions','.prof','.properties','.property','.qpon','.recipes','.red','.rehab','.ren','.rentals','.repair','.report','.republican','.rest','.reviews','.rich','.rip','.rocks','.rodeo','.rsvp','.sale','.science','.services','.sexy','.shoes','.singles','.social','.software','.solar','.solutions','.space','.supplies','.supply','.support','.surf','.surgery','.systems','.tattoo','.tax','.technology','.tel','.tips','.tires','.today','.tools','.top','.town','.toys','.trade','.training','.travel','.university','.vacations','.vet','.video','.villas','.vision','.vodka','.vote','.voting','.voyage','.wang','.watch','.webcam','.website','.wed','.wedding','.whoswho','.wiki','.work','.works','.world','.wtf','.xxx','.xyz','.yoga','.zone','...','..','Amazon','Scholastic','Google Books',' , , ,','.,');
$array1 = array(' …','.BLOGSPOT','HTTPS://','HTTP://','WWW.','.COM','.ORG','.NET','.INT','.EDU','.GOV','.MIL','.AC','.AD','.AE','.AF','.AG','.AI','.AL','.AM','.AN','.AO','.AQ','.AR','.AS','.AT','.AU','.AW','.AX','.AZ','.BA','.BB','.BD','.BE','.BF','.BG','.BH','.BI','.BJ','.BM','.BN','.BO','.BQ','.BR','.BS','.BT','.BV','.BW','.BY','.BZ','.BZH','.CA','.CC','.CD','.CF','.CG','.CH','.CI','.CK','.CL','.CM','.CN','.CO','.CR','.CS','.CU','.CV','.CW','.CX','.CY','.CZ','.DD','.DE','.DJ','.DK','.DM','.DO','.DZ','.EC','.EE','.EG','.EH','.ER','.ES','.ET','.EU','.FI','.FJ','.FK','.FM','.FO','.FR','.GA','.GB','.GD','.GE','.GF','.GG','.GH','.GI','.GL','.GM','.GN','.GP','.GQ','.GR','.GS','.GT','.GU','.GW','.GY','.HK','.HM','.HN','.HR','.HT','.HU','.ID','.IE','.IL','.IM','.IN','.IO','.IQ','.IR','.IS','.IT','.JE','.JM','.JO','.JP','.KE','.KG','.KH','.KI','.KM','.KN','.KP','.KR','.KRD','.KW','.KY','.KZ','.LA','.LB','.LC','.LI','.LK','.LR','.LS','.LT','.LU','.LV','.LY','.MA','.MC','.MD','.ME','.MG','.MH','.MK','.ML','.MM','.MN','.MO','.MP','.MQ','.MR','.MS','.MT','.MU','.MV','.MW','.MX','.MY','.MZ','.NA','.NC','.NE','.NF','.NG','.NI','.NL','.NO','.NP','.NR','.NU','.NZ','.OM','.PA','.PE','.PF','.PG','.PH','.PK','.PL','.PM','.PN','.PR','.PS','.PT','.PW','.PY','.QA','.RE','.RO','.RS','.RU','.RW','.SA','.SB','.SC','.SD','.SE','.SG','.SH','.SI','.SJ','.SK','.SL','.SM','.SN','.SO','.SR','.SS','.ST','.SU','.SV','.SX','.SY','.SZ','.TC','.TD','.TF','.TG','.TH','.TJ','.TK','.TL','.TM','.TN','.TO','.TP','.TR','.TT','.TV','.TW','.TZ','.UA','.UG','.UK','.US','.UY','.UZ','.VA','.VC','.VE','.VG','.VI','.VN','.VU','.WF','.WS','.YE','.YT','.YU','.ZA','.ZM','.ZR','.ZW','.ACADEMY','.ACCOUNTANTS','.ACTIVE','.ACTOR','.ADULT','.AERO','.AGENCY','.AIRFORCE','.APP','.ARCHI','.ARMY','.ASSOCIATES','.ATTORNEY','.AUCTION','.AUDIO','.AUTOS','.BAND','.BAR','.BARGAINS','.BEER','.BEST','.BID','.BIKE','.BIO','.BIZ','.BLACK','.BLACKFRIDAY','.BLOG','.BLUE','.BOO','.BOUTIQUE','.BUILD','.BUILDERS','.BUSINESS','.BUZZ','.CAB','.CAMERA','.CAMP','.CANCERRESEARCH','.CAPITAL','.CARDS','.CARE','.CAREER','.CAREERS','.CASH','.CATERING','.CENTER','.CEO','.CHANNEL','.CHEAP','.CHRISTMAS','.CHURCH','.CITY','.CLAIMS','.CLEANING','.CLICK','.CLINIC','.CLOTHING','.CLUB','.COACH','.CODES','.COFFEE','.COLLEGE','.COMMUNITY','.COMPANY','.COMPUTER','.CONDOS','.CONSTRUCTION','.CONSULTING','.CONTRACTORS','.COOKING','.COOL','.COUNTRY','.CREDIT','.CREDITCARD','.CRICKET','.CRUISES','.DAD','.DANCE','.DATING','.DAY','.DEALS','.DEGREE','.DELIVERY','.DEMOCRAT','.DENTAL','.DENTIST','.DIAMONDS','.DIET','.DIGITAL','.DIRECT','.DIRECTORY','.DISCOUNT','.DOMAINS','.EAT','.EDUCATION','.EMAIL','.ENERGY','.ENGINEER','.ENGINEERING','.EQUIPMENT','.ESQ','.ESTATE','.EVENTS','.EXCHANGE','.EXPERT','.EXPOSED','.FAIL','.FARM','.FASHION','.FEEDBACK','.FINANCE','.FINANCIAL','.FISH','.FISHING','.FIT','.FITNESS','.FLIGHTS','.FLORIST','.FLOWERS','.FLY','.FOO','.FORSALE','.FOUNDATION','.FUND','.FURNITURE','.GALLERY','.GARDEN','.GIFT','.GIFTS','.GIVES','.GLASS','.GLOBAL','.GOP','.GRAPHICS','.GREEN','.GRIPE','.GUIDE','.GUITARS','.GURU','.HEALTHCARE','.HELP','.HERE','.HIPHOP','.HIV','.HOLDINGS','.HOLIDAY','.HOMES','.HORSE','.HOST','.HOSTING','.HOUSE','.HOW','.INFO','.ING','.INK','.INSTITUTE','.INSURE','.INTERNATIONAL','.INVESTMENTS','.JOBS','.KIM','.KITCHEN','.LAND','.LAWYER','.LEGAL','.LEASE','.LGBT','.LIFE','.LIGHTING','.LIMITED','.LIMO','.LINK','.LOANS','.LOTTO','.LUXE','.LUXURY','.MANAGEMENT','.MARKET','.MARKETING','.MEDIA','.MEET','.MEME','.MEMORIAL','.MENU','.MOBI','.MOE','.MONEY','.MORTGAGE','.MOTORCYCLES','.MOV','.MUSEUM','.NAME','.NAVY','.NETWORK','.NEW','.NGO','.NINJA','.ONE','.ONG','.ONL','.OOO','.ORGANIC','.PARTNERS','.PARTS','.PARTY','.PHARMACY','.PHOTO','.PHOTOGRAPHY','.PHOTOS','.PHYSIO','.PICS','.PICTURES','.PINK','.PIZZA','.PLACE','.PLUMBING','.POKER','.PORN','.POST','.PRESS','.PRO','.PRODUCTIONS','.PROF','.PROPERTIES','.PROPERTY','.QPON','.RECIPES','.RED','.REHAB','.REN','.RENTALS','.REPAIR','.REPORT','.REPUBLICAN','.REST','.REVIEWS','.RICH','.RIP','.ROCKS','.RODEO','.RSVP','.SALE','.SCIENCE','.SERVICES','.SEXY','.SHOES','.SINGLES','.SOCIAL','.SOFTWARE','.SOLAR','.SOLUTIONS','.SPACE','.SUPPLIES','.SUPPLY','.SUPPORT','.SURF','.SURGERY','.SYSTEMS','.TATTOO','.TAX','.TECHNOLOGY','.TEL','.TIPS','.TIRES','.TODAY','.TOOLS','.TOP','.TOWN','.TOYS','.TRADE','.TRAINING','.TRAVEL','.UNIVERSITY','.VACATIONS','.VET','.VIDEO','.VILLAS','.VISION','.VODKA','.VOTE','.VOTING','.VOYAGE','.WANG','.WATCH','.WEBCAM','.WEBSITE','.WED','.WEDDING','.WHOSWHO','.WIKI','.WORK','.WORKS','.WORLD','.WTF','.XXX','.XYZ','.YOGA','.ZONE','...','..','AMAZON','SCHOLASTIC','GOOGLE BOOKS',' , , ,','.,');
$out = str_replace($array, '', $site);
$out = str_replace($array1, '', $out);
$out = trim($out, ' ');
return $out;
}
function xx($input){
$result = strip_tags($input);
$result = preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $result);
$result = trim($result, ' ');
return $result;
}


function my_bot(){
  $dari= '';
  if(isset($_SERVER['HTTP_FROM'])){
  $dari= $_SERVER['HTTP_FROM'];
  }elseif(!empty($_SERVER['HTTP_FROM'])){
  $dari= $_SERVER['HTTP_FROM'];
  }else{
  $dari= '';
  }
  return preg_match("/(googlebot|google|bingbot|microsoft.com|search.yandex.ru|yahoo)/i", $dari);
}


/////////////////////////////////////////////////////tambahan sediri ///////////////////////////////
function cut_belakang($teks,$depan,$belakang){
	$hasil = explode($belakang,$teks);
	$hasil = explode($depan,$hasil[0]);
	if(end($hasil)!="null"){
		return end($hasil);
	}else{
		return "";
	}
}







?>