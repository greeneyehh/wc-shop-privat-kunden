<?php
use yii\helpers\Url;
use app\widgets\Newsletter\NewsletterWidget;
?>



<footer id="footer" class="box-shadow">
  <div class="container">
    <div class="row mb-4">
      <div class="col-12 col-sm-6 col-lg-3 text-center text-sm-left">
        <a href="/"> <img class="logo" src="/img/windcloud-logo-web-white.svg" alt="windcloud-logo-web-white"/></a>
			<ul id="menu-footer-left" class="menu">
				<li id="menu-item-34" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-34"><a href="/produkte">Produkte</a></li>
				<li id="menu-item-34" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-34"><a href="/unternehmen/oekosystem">Ökosystem</a></li>
				<li id="menu-item-38" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-38"><a href="/sicherheit">Sicherheit</a></li>
				<li id="menu-item-36" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-36"><a href="/unternehmen/ueber-uns">Über uns</a></li>
			</ul>
        <a class="presse" href="<?= Url::toRoute('site/presse'); ?>">Presse</a>
      </div>

      <div class="col-12 col-sm-6 col-lg-3 text-center text-sm-left">
        <h4 class="contact"><span><span>Kontakt</span></span></h4>
        <a href="<?= Url::toRoute('site/kontakt'); ?>">Kontaktieren Sie uns</a><br/>
        <a href="tel:+4946626148590">04662 / 6148590</a><br/>
        <a href="mailto:moin@windcloud.de">moin@windcloud.de</a><br/>
        <a class="social" href="https://twitter.com/windcloud__" target="_blank"><img src="/img/icon-twitter.svg" alt="icon-twitter" /></a>
        <a class="social" href="https://www.facebook.com/windcloud4.0" target="_blank"><img src="/img/icon-facebook.svg" alt="icon-facebook"/></a>
        <a class="social" href="https://de.linkedin.com/company/windcloud" target="_blank"><img src="/img/icon-linkedin.svg" alt="icon-linkedin" /></a>
      </div>

      <div class="col-12 col-sm-6 col-lg-3 text-center text-sm-left">
        <h4><span><span>Rechtliches</span></span></h4>
			<ul id="menu-footer-right" class="menu"><li id="menu-item-41" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-41"><a href="/agb">AGB</a></li>
				<li id="menu-item-42" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-privacy-policy menu-item-42"><a href="/datenschutzerklaerung">Datenschutzerklärung</a></li>
                <li id="menu-item-44" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-44"><a href="/kundeninformationen">Kundeninformationen</a></li>
				<li id="menu-item-44" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-44"><a href="/impressum">Impressum</a></li>
			</ul>
      </div>

      <div class="col-12 col-sm-6 col-lg-3 text-center text-sm-left">
		<?= NewsletterWidget::widget() ?>
      </div>

    </div>






      <div  class="d-flex flex-wrap mt-5 justify-content-sm-end float-right footer-copyright align-items-center">
          <div id="copy" class="col-auto float-right footer-copyright-text">
        <p>Copyright &copy; <?= date('Y') ?> Windcloud 4.0 GmbH</p>
      </div>
      <div id="iso" class="col-auto pr-0 float-right">
        <img src="/img/logo-iso-27001.png" alt="logo-iso-27001" />
      </div>
    </div>




  </div>


</footer>

<?php
$this->registerCssFile("/css/cms/style-footer.css");
?>