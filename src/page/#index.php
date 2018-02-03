<?php
require_once "src/model/home.php";
define("sitemap_path","sitemap/");
$kampret = new kampret\keyword("sitemap/");


	$single = array(
						"result" => "",
						"meta" => "",
						"header" =>$kampret->post(false,1),
						"post" => $kampret->post(false,7),
						"sidebar" => $kampret->post(false,7),
						"footer" =>"",
					);

	$body = $single["post"];
	$header = $single["header"];
	$post = $single["post"];

?>

<!DOCTYPE html>
<!--[if lt IE 8 ]><html class="no-js ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="no-js ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 8)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

   <!--- Basic Page Needs
   ================================================== -->
   <meta charset="utf-8">
	<title><?php echo $post[0]; ?>.</title>
	<meta name="description" content="">  
	<meta name="author" content="">

	<!-- mobile specific metas
   ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

   <!-- CSS
    ================================================== -->
   <link rel="stylesheet" href="css/default.css">
	<link rel="stylesheet" href="css/layout.css">  
	<link rel="stylesheet" href="css/media-queries.css"> 

   <!-- Script
   ================================================== -->
	<script src="js/modernizr.js"></script>

   <!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="favicon.png" >

</head>

<body>

<?php include "header.php";?>

   <!-- Content
   ================================================== -->
   <div id="content-wrap">

   	<div class="row">

   		<div id="main" class="eight columns">
		<?php
		$a = 1;
		while($a<count($body)){
			
			echo ' 
	   		<article class="entry">

					<header class="entry-header">

						<h2 class="entry-title">
							<a href="'.Url::justWord($body[$a]).'" title="'.$body[$a].'">'.$body[$a].'</a>
						</h2> 				 
					
						<div class="entry-meta">
							<ul>
								<li>'.date("M,d Y").'</li>
							</ul>
						</div> 
					 
					</header> 
					
					<div class="entry-content">
						<p>'.substr(get_bing($body[$a],1),0,400).'<a href="'.Url::justWord($body[$a]).'" title="'.$body[$a].'"> ...Read More</a>.</p>
					</div> 

				</article> ';
			
			$a++;
		}
		?>
						

   		</div> <!-- end main -->

   		<?php include "sidebar.php"; ?>

   	</div> <!-- end row -->

   </div> <!-- end content-wrap -->
   

   <!-- Footer
   ================================================== -->
<?php include "footer.php";?>

</body>

</html>