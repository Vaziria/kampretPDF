<?php
//config
$__config['root_dir'] = "eks/pdfkeyword/";
$__config['ekstensi_url'] = ".html";
$__config['mode'] = "html"; // "html" or "pdf"
$__config['redirect'] = false;   //redirect betul
//$__config['redirect'] = false;
$__config['landing_page'] = "http://pdf.sepoi.win/h/{title}-pdf.html";

//cache
$__config['cache'] = true;

//keyword
$__config['get_min'] = 3;
$__config['get_max'] = 200;
$__config['get_min_word'] = 1;
$__config['get_max_word'] = 10;

//keyword cek dari http referer
$__config['k_re_add'] = true;
$__config['k_cek'] = "jum"; // "jum" or "size" 
$__config['k_count'] = 500;
$__config['k_dir'] = "sitemap/";
$__config['k_name'] = "sitemap";

//keyword dari related auto sugested google
$__config["k_add"] = true;
$__config["k_jum"] = 5;
//masih dihitung kata;
$__config["k_rmin"] = 3;
$__config["k_ambil_kata"] = 2; // set null if get semua kata yg di title
$__config["k_rmax"] = 100;

//nofollow keyword --------nofollow jika jumlah keyword tertentu
$__config['nofollow_activate'] = true;
$__config['nofollow_jum'] = 2;



?>