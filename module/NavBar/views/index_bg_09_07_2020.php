 <?php
    use yii\helpers\Html;
?>
<div class="container">
    		<nav class="navbar navbar-expand-lg navbar-light">
                <div id="menu-shadow">
                    <div class="d-flex justify-content-between align-items-center flex-grow-1 flex-lg-grow-0 menu-container">
                        <button class="navbar-toggler collapsed burger" type="button" data-toggle="collapse" data-target="#menu-main-dropdown" aria-controls="menu-main-dropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
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
				<ul id="menu-main" class="navbar-nav d-flex justify-content-between menu-container">



					<?php
						$pageId = "/".Yii::$app->getRequest()->getPathInfo();
						foreach($mainMenu as $menuItem) {

						    if($menuItem->dropdown == '' OR $menuItem->dropdown == null){
						    ?>

							<li id="CloseAll" id="menu-item-<?= $menuItem->id ?>" class="col-auto text-center nav-item">
								<a class="nav-link <?php if ($pageId == $menuItem->url) { echo "active";} ?>" href="<?= $menuItem->url ?>" title="<?=$menuItem->linkname ?>" >
									<span><?=$menuItem->linkname ?></span>
								</a>
							</li>


							<?php
                                }
						    elseif ($menuItem->dropdown != '' OR $menuItem->dropdown != null){
						    ?>
                            <li class="dropdown col-auto text-center nav-item">
                                <a href="#" id="CloseAll" data-toggle="collapse" data-target="#bs-example-navbar-collapse-<?=$menuItem->id;?>" aria-expanded="true" class="nav-link"><?=$menuItem->linkname ?></a>
                                <ul class="dropdown-menu menu-container">
                                    <div class="container">
                                        <li><a href="#">Inbox</a></li>
                                    </div>
                                </ul>
                            </li>

                            <?php
                            }
						}
					?>





					<li class="col-auto text-center nav-item">
						<a class="nav-link total-count" href="/cart"><i class="fa fa-shopping-basket"></i></a>
                    </li>
                    <li class="col-auto text-center nav-item d-lg-none">
                        <a class="nav-link" href="/dashboard">Login</a>
                    </li>
				</ul>

			</div>
                <ul  class="navbar-nav">
                    <li class="col-auto text-center nav-item"> <a class="d-none d-lg-inline contact border" href="/kontakt">Kontakt</a></li>
                </ul>
                <ul  class="navbar-nav" style="float: right;">
                    <li class="col-auto text-center nav-item" style="float: right;"> <a class="d-none d-lg-inline contact border" href="/dashboard">Login</a></li>
                </ul>
		</nav>
    </div>
 <div id="accordion">
 <?php
 foreach($mainMenu as $menuItem) {
     if ($menuItem->dropdown != '' or $menuItem->dropdown != null){

         ?>
         <nav class="navbar navbar-light collapse navbar-collapse navbar-addon" id="bs-example-navbar-collapse-<?=$menuItem->id;?>">
             <div class="container">
                 <a class="navbar-brand" href="#"><?=$menuItem->linkname ?></a>
             </div>
         </nav>

         <?php
     }
 }
 ?>
 </div>
 <?php
 $this->registerCssFile("/css/cms/style-navbar.css");
 $this->registerJs(" 
$(document).ready(function() {
    $(\"#CloseAll\").on('click', function() {
        $(\".collapse\").removeClass(\"show\");
    });
});");

 ?>