<?php

$sidebar = $single["sidebar"];

?>
<!-- Sidebar -->
                <aside class="col-md-4">
                    <div class="sidebar-box">
                        <h4>Popular</h4>
                        <div class="list-group list-group-root">
							<?php
							$a = 0;
							while($a<=3){
								echo '<a class="list-group-item" href="'.Url::justWord($sidebar[$a]).'">'.$sidebar[$a].'</a>';
								$a++;
							}
							
							?>
                        </div>
                    </div>

                    <div class="sidebar-box sidebar-box-bg">
                        <h4><?php echo $sidebar[0];?></h4>
                        <p><?php echo substr(get_bing($sidebar[0],1),0,150);?>. <a href="<?php echo Url::justWord($sidebar[0]);?>" class="readmore">Read More &raquo;</a></p>    
                    </div>

                    <div class="sidebar-box">
                        <h4>Search site</h4>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="text"  placeholder="Search" aria-label="Search">
                            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>

                    <div class="sidebar-box">
                        <h4>Related Article</h4>
                        <ul>
						<?php
							$a = 4;
							while($a<=7){
								echo '<li><a href="'.Url::justWord($sidebar[$a]).'" title="'.$sidebar[$a].'">'.$sidebar[$a].'</a></li>';
								$a++;
							}
							
						?>
                        </ul>
                    </div>
                </aside>