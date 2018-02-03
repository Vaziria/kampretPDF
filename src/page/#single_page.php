<?php
   $header = $single["header"];
   $body = $single["result"];
   $metadata = $single["meta"];
   $post = $single["post"];
   
   $judul =  $kampret->gen("judul");
   
   
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
	<title><?php echo $judul;?>.</title>
    <meta name="keyword" content="<?PHP echo $metadata['keyword'];?>">
    <meta name="author" content="<?PHP echo $metadata['author'];?>">
	<meta property="og:title" content="<?PHP echo $metadata['title'];?>">
	<meta property="og:url" content="<?PHP echo Url::justWord($judul);?>">

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

<body class="single">
<?php include "header.php"; ?>

   <!-- Content
   ================================================== -->
   <div id="content-wrap">

   	<div class="row">

   		<div id="main" class="eight columns">

   			<article class="entry">

					<header class="entry-header">

						<h2 class="entry-title">
							<?php echo $judul;?>.
						</h2> 				 
				
						<div class="entry-meta">
							<ul>
								<li><?php echo date("M, d Y");?></li>
							</ul>
						</div> 
				 
					</header> 
				
					<div class="entry-content-media">
						<div class="post-thumb">
							
						</div> 
					</div>

					<div class="entry-content" align="justify">
						<?php 
						
						$bat = strlen($body['desc']);
						$a = 0;
						while($a<=$bat){
							$c = rand(300,400);
							$d = $a + $c;
							if($d>$bat){
								$c = $bat - $a;
								$c++;
							}
								echo '<p align="justify">'.substr($body['desc'],$a,$c).'</p>';
							$a= $a+$c;
						}
						
						?>
					</div>

					<p class="tags">
  			         <span>Tagged in </span>:
					 <?php
						$a = 0;
						while($a<rand(0,10)){
							$aa = explode(" ",$post[rand(0,count($post)-1)]);
							echo '<a href="#">'.$aa[0].'</a>,';
							
							$a++;
						}
					?>
  				      
  			       </p> 

  			       <ul class="post-nav group">
  			            <li class="prev"><a rel="prev" href="<?php echo Url::justWord($post[0]);?>"><strong>Previous Article</strong> <?php echo $post[0];?></a></li>
  				         <li class="next"><a rel="next" href="<?php echo Url::justWord($post[0]);?>"><strong>Next Article</strong> <?php echo $post[1];?></a></li>
  			        </ul>

				</article>

				<!-- Comments
            ================================================== -->
            <div id="comments">

               


               <!-- respond -->
              

            </div>  <!-- Comments End -->		
   			

   		</div> <!-- main End -->

   		<?php include "sidebar.php"; ?>

  		</div> <!-- end row -->

   </div> <!-- end content-wrap -->   

<?php include "footer.php";?>

</body>

</html>