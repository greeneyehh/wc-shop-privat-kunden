 <?php

   	use yii\helpers\Html;
    ?>
    	<div class="container">
    		<nav class="navbar navbar-expand-lg navbar-light">
			<div id="menu-shadow">
				<div class="d-flex justify-content-between align-items-center flex-grow-1 flex-lg-grow-0 menu-container">
					<button class="navbar-toggler collapsed burger" type="button" data-toggle="collapse" data-target="#menu-main-dropdown" aria-controls="menu-main-dropdown" aria-expanded="false" aria-label="Toggle navigation">
					</button>

					<div class="">
						<a href="/"><img class="logo" src="/img/windcloud-logo-web.svg" alt="windcloud-logo-web"/></a>
					</div>

					<a class="d-lg-none" href="/kontakt">
						<img src="/img/icon-contact.svg" alt="Kontakt" />
					</a>
				</div>
			</div>
			<div id="menu-main-dropdown" class="collapse navbar-collapse justify-content-lg-center">
				<ul id="menu-main" class="navbar-nav col-lg-10 d-flex justify-content-between menu-container">
					<?php 
						//$mainMenu = wp_get_nav_menu_items('main');
						$pageId = "/".Yii::$app->getRequest()->getPathInfo();
						foreach($mainMenu as $menuItem) {
							?>
							<li id="menu-item-<?= $menuItem->id ?>" class="col-auto text-center nav-item">
								<a class="nav-link <?php if ($pageId == $menuItem->url) { echo "active";} ?>" href="<?= $menuItem->url ?>" title="<?=$menuItem->linkname ?>" >
									<span><?=$menuItem->linkname ?></span>
								</a>
							</li>
							<?php
						}
					?>
					<li class="col-auto text-center nav-item">
						<a class="nav-link total-count" href="/cart"><i class="fa fa-shopping-basket"></i> Warenkorb</a>
					</li>
				</ul>
                <ul  class="navbar-nav">
                    <li class="col-auto text-center nav-item"> <a class="d-none d-lg-inline contact border" href="/kontakt">Kontakt</a></li>
                    <li class="col-auto text-center nav-item"><a class="d-none d-lg-inline contact border" href="/dashboard">Login</a></li>
                </ul>
			</div>


		</nav>
    </div>
    
    
    
    
    
    
    
    
    
    
    

