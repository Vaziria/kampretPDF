<?php
require_once "src/model/home.php";
define("sitemap_path","sitemap/");
$kampret = new kampret\keyword("sitemap/");


	$single = array(
						"result" => "",
						"meta" => "",
						"header" =>$kampret->post(false,4),
						"post" => $kampret->post(false,5),
						"sidebar" => $kampret->post(false,8),
						"footer" =>"",
					);

	$body = $single["post"];
	$header = $single["header"];

?>
<!doctype html>
<html lang="en">
	<head>
        <title><?php echo $body[0]; ?></title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


        <!-- Main CSS --> 
        <link rel="stylesheet" href="css/style.css">

        <!-- Font Awesome -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
  
    <body>

        <!-- Header -->
		<?php include "header.php"; ?>
        

        <!-- Main content area -->
        <main class="container">
            <div class="row">
                
                <!-- Main content -->
                <div class="col-md-8">
				<?php
				$a = 0;
				while($a<count($body)){
					
                    echo '<article>
                        <h2 class="article-title">'.$body[$a].'</h2>

                        <p class="article-meta">Posted on <time>'.date("d M").'</time></p>

                        <p>'.substr(get_bing($body[$a],1),0,400).'...</p>
						<a href="'.Url::justWord($body[$a]).'" class="btn btn-primary">Read more</a>

                    </article>';
					$a++;
				}
				
				?>


                    <!-- Example pagination Bootstrap component -->
                    <nav>
                        <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="home" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="home">1</a></li>
                                <li class="page-item"><a class="page-link" href="home">2</a></li>
                                <li class="page-item"><a class="page-link" href="home">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="home" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                        </ul>
                    </nav>
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