 <?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>

 <nav class="navbar navbar-expand-lg navbar-light" role="navigation">
     <div class="container-fluid">
         <div id="menu-shadow">
             <div class="d-flex justify-content-between align-items-center flex-grow-1 flex-lg-grow-0 menu-container">
                 <button class="navbar-toggler collapsed burger" type="button" data-toggle="collapse" data-target="#menu-main" aria-controls="menu-main" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                 </button>
                 <div class="">
                     <a href="/"><img class="logo" src="<?= Url::to('@web/image/windcloud-logo-web.svg');?>" alt="windcloud-logo-web"></a>
                 </div>
                 <a class="d-lg-none" href="/kontakt">
                     <img src="<?= Url::to('@web/image/icon-contact.svg');?>" alt="Kontakt">
                 </a>
             </div>
         </div>
         <div id="menu-main" class="collapse navbar-collapse justify-content-lg-center">

             <ul class="navbar-nav">



                      <?php
						$pageId = "/".Yii::$app->getRequest()->getPathInfo();
						foreach($mainMenu as $menuItem) {
                            if($menuItem->enabled == 1 ){
						        if($menuItem->dropdown == '' OR $menuItem->dropdown == null){
						    ?>

                          <li id="menu-item-<?= $menuItem->id ?>" class="col-auto text-center nav-item">
                              <a class="nav-link <?php if ($pageId == $menuItem->url) { echo "active";} ?>" href="<?= $menuItem->url ?>" title="<?=$menuItem->linkname ?>"><?=$menuItem->linkname ?></a>
                          </li>

							<?php
                                }
                                  elseif ($menuItem->dropdown != '' OR $menuItem->dropdown != null)
                                {
                            ?>


                        <li class="nav-item dropdown text-center position-static">
                         <a data-hover="dropdown" data-toggle="dropdown" <?php if ($menuItem->click == 1) { echo 'data-click="'.$menuItem->url.'"';}  ?> href="<?php if ($menuItem->url == "") { echo "javascript:void(0);";} else { echo $menuItem->url;} ?>" class="nav-link" ><?=$menuItem->linkname ?></a>
                         <ul  class="dropdown-menu text-center"  style="width: 100%;margin-top: -2rem;">
                                 <div class="subnav">
                                     <div class="subnav-back">
                                         <div class="container text-center" style="text-align: center;">
                                    <?php
                                    $someArray = json_decode($menuItem->dropdown, true);
                                    foreach($someArray as $query){
                                  ?>
                                        <li class="col-auto text-center nav-item">
                                            <a class="nav-link <?php if ($pageId == $query["url"]) { echo "active";} ?>"  href="<?= $query["url"] ?>" title="<?=$query["name"] ?>"><span><?=$query["name"] ?></span></a>
                                        </li>

                                  <?php
                                      }
                                    ?>
                                         </div>
                                     </div>
                                 </div>
                             </ul>
                             </li>

                           <?php
                            }
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
         <ul class="nav navbar-nav navbar-right">
             <ul class="navbar-nav">
                 <li class="col-auto text-center nav-item"> <a class="d-none d-lg-inline contact border" href="/kontakt">Kontakt</a></li>
             </ul>
             <ul class="navbar-nav" style="float: right;">
                 <li class="col-auto text-center nav-item" style="float: right;"> <a class="d-none d-lg-inline contact border" href="/dashboard">Login</a></li>
             </ul>
         </ul>
     </div>
 </nav>
 <?php
 $this->registerCssFile("/css/cms/style-navbar.css");

 $this->registerJs("$(document).on('click', \"[data-click]\", function() {
     document.location.href = $(this).data('click');
});");

 ?>