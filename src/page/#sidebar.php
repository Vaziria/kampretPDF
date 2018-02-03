<?php

$post = $single["sidebar"];

?>
<div id="sidebar" class="four columns">

   			<div class="widget widget_search">
                  <h3>Search</h3> 
                  <form action="#">

                     <input type="text" value="Search here..." onblur="if(this.value == '') { this.value = 'Search here...'; }" onfocus="if (this.value == 'Search here...') { this.value = ''; }" class="text-search">
                     <input type="submit" value="" class="submit-search">

                  </form>
               </div>

   			<div class="widget widget_categories group">
   				<h3>Top Post.</h3> 
   				<ul>
						<?php
						$a = 0;
						while($a<4){
						echo '<li><a href="'.Url::justWord($post[$a]).'" title="'.$post[$a].'">'.$post[$a].'</a></li>';
							
							$a++;
						}
						
						?>				
					</ul>
				</div>

				<div class="widget widget_text group">
					<h3>Pop Text.</h3>

   				<p><?php echo substr(get_bing($post[$a],1),0,200); ?>.</p>

   			</div>

   			<div class="widget widget_tags">
               <h3>Post Tags.</h3>

               <div class="tagcloud group">
					<?php
						$a = 0;
						while($a<rand(0,10)){
							$aa = explode(" ",$post[rand(0,count($post)-1)]);
							echo '<a href="#">'.$aa[0].'</a>';
							
							$a++;
						}
					?>
               </div>
                  
            </div>

            <div class="widget widget_popular">
               <h3>Related Post.</h3>

               <ul class="link-list">
			   <?php
						$a = 4;
						while($a<7){
						echo '<li><a href="'.Url::justWord($post[$a]).'" title="'.$post[$a].'">'.$post[$a].'</a></li>';
							
							$a++;
						}
				?>                     
               </ul>
                  
            </div>
   			
   		</div> <!-- end sidebar -->