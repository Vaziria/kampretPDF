<?php
   $header = $single["header"];
   $body = $single["result"];
   $metadata = $single["meta"];
   $sidebar = $single["sidebar"];
   
   $judul =  $kampret->gen("judul");
   
   
   
   //cek
   
   
   //acak deskripsi
   $deskripsi = array();
		$databing = get_bing($kampret->result["title"],1,"title");
		$depanparaf = '<b>'.$kampret->result["title"]." - </b>";
		
		
		$postawal = rand(0,1);
		$dp = "";
		if($postawal!=0){
			$dp = $depanparaf;
			$depanparaf = "";
		}
		
		$a = 0;
		while($a<strlen($kampret->result["desc"])){
			$cc = rand(100,500);
			if($a==0){
				array_push($deskripsi,'<p align="justify">'.$dp.substr($kampret->result["desc"],$a,$cc)."</p>");
			}else{				
				array_push($deskripsi,'<p align="justify">'.substr($kampret->result["desc"],$a,$cc)."</p>");
			}
			$a = $a + $cc;
		}
		
		
		$bingparaf = '<p align="justify">'.$depanparaf.$kampret->keyword_filter(get_bing($kampret->result["title"],1,"title"),"<br>",".")."</p>";
		
		//add acak paragraf bing
		array_splice($deskripsi,$postawal,0,$bingparaf);
		
		//add related keyword di paragraf
		$keyparaf = '<p align="justify"><b>'."#####dari related google#####".arrayToParagraf($keyword->g_keywords,5,10).'####</b></p>';
		array_splice($deskripsi,2,0,$keyparaf);
		
		//title bing add to deskripsi
		$bingtitles = explode("<br>",preg_replace("/\<\/strong\>|\<strong\>/","",$databing));
		$bingtitle = "<h3>Related Post</h3><ul>";
		foreach($bingtitles as $dd){
			$bingtitle .= '<li><a href="'.Url::justWord($dd).'">'.$dd.'</a></li>';
		}
		$bingtitle .= "</ul>";
		
		//add bing title di posisi acak
		array_splice($deskripsi,rand(3,count($deskripsi)-1),0,$bingtitle);
		
		
		//add related di posisi acak acak
		$related = "";
		foreach($kampret->result["related"] as $dd){
			$related .= '<li><a href="'.Url::justWord($dd).'">'.$dd.'</a></li>';
		}
		
		$relateds = '<ul>'.$related.'</ul>';	
		array_splice($deskripsi,rand(3,count($deskripsi)-1),0,$relateds);
		
		
		//add top post di posisi acak acak
		$toppost = "";
		foreach($kampret->result["topPost"] as $da){
			$toppost .= '<li><a href="'.Url::justWord($dd).'">'.$da.'</a></li>';
		}
		
		$topposts = '<ul>'.$toppost.'</ul>';	
		array_splice($deskripsi,rand(3,count($deskripsi)-1),0,$topposts);
		
		
		
		
		
		
		$deskripsi = implode("",$deskripsi);
   
   
?>
<!doctype html>
<html lang="en">
	<head>
        <title><?php echo $judul;?>.</title>
		<meta name="keyword" content="<?PHP echo $metadata['keyword'];?>">
		<meta name="author" content="<?PHP echo $metadata['author'];?>">
		<meta property="og:title" content="<?PHP echo $metadata['title'];?>">
		<meta property="og:url" content="<?PHP echo Url::justWord($judul);?>">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


        <!-- Main CSS --> 
        <link rel="stylesheet" href="css/style.css">

        <!-- Font Awesome -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
  
    <body>

        <?php include "header.php"; ?>

        <!-- Main content area -->
        <main class="container">
            <div class="row">
                
                <!-- Main content -->
                <div class="col-md-8">
                    <article>
                        <h2 class="article-title"><?php echo $judul;?>.</h2>

                        <p class="article-meta">Posted on <time><?php echo date("d M");?></time></p>

                        <?php 
						
						echo $deskripsi;
						
						?>
						
						
                    </article>

                   


                    <!-- Example pagination Bootstrap component -->

                </div>

                
               
                
				<?php include "sidebar.php";?> 
                
            </div> 
        </main>


        <!-- Footer -->
        <?php include "footer.php";?> 



        <!-- Bootcamp JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    </body>
</html>