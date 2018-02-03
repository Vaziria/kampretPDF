<div class="container">
            <div class="header-wrap d-none d-md-block">
                <div class="row">
                    
                    <!-- Left header box -->
                    <header class="col-6 text-left">
                        <h1><span>King Of </span> Article.</h1>
                    </header>
                    
                    <!-- Right header box -->
                    <div class="col-6 text-right">               
                        <p class="header-social-icons social-icons">
                            <a href="#"><i class="fa fa-facebook fa-2x"></i></a>
                            <a href="#"><i class="fa fa-twitter fa-2x"></i></a>
                            <a href="#"><i class="fa fa-youtube fa-2x"></i></a>
                            <a href="#"><i class="fa fa-instagram fa-2x"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
		<!-- Main navigation -->
		<div class="container navbar-container">
            <nav class="navbar navbar-expand-md navbar-light">
            
                <!-- Company name shown on mobile -->
                <a class="navbar-brand d-md-none d-lg-none d-xl-none" href="#"><span>Free Download</span> Ebooks,</a>

                <!-- Mobile menu toggle -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Main navigation items -->
                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                                <a class="nav-link" href="home">Home <span class="sr-only">(current)</span></a>
                        </li>
						<li class="nav-item">
                                <a class="nav-link" href="sitemap.xml">Sitemap</a>
                        </li>
                    </ul>
                    
                    <form class="form-inline header-search-form my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="text" size="10"  placeholder="Search" aria-label="Search">
                        <button class="btn my-2 my-sm-0 btn-primary" type="submit">Search</button>
                    </form>
                    
                </div>            
            </nav>
        </div>
		
		
		
		<!-- Jumbtron / Slider -->
        <div class="jumbotron-wrap">
            <div class="container">
                <div id="mainCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="jumbotron">
                                <h1 class="text-center"><?php echo $header[0];?></h1>
                                <p class="lead text-center"><?php echo substr(strip_tags(get_bing($header[0],1)),0,200);?>...</p>
                                <p class="lead text-center">
                                        <a class="btn btn-primary btn-lg" href="<?php echo Url::justWord($header[0]);?>" role="button"><i class="fa fa-info"></i> &nbsp; Read more</a>
                                </p>
                            </div>

                        </div>
						
						<?php
						$a = 1;
						while($a<=count($header)-1){
							echo '
						<div class="carousel-item">
                            <div class="jumbotron">
                                <h1 class="text-center">'.$header[$a].'</h1>
                                <p class="lead text-center">'.substr(strip_tags(get_bing($header[$a],1)),0,200).'.</p>
                                <p class="lead text-center">
                                        <a class="btn btn-primary btn-lg" href="'.Url::justWord($header[0]).'" role="button"><i class="fa fa-info"></i> &nbsp; Read more</a>
             
                                </p>
                            </div>

                        </div>
							
							';
							$a++;
						}
						
						?>

                        
                    </div>

                    <a class="carousel-control-prev" href="#mainCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#mainCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
	