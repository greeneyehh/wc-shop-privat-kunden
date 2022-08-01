<div class="container">
	<div id="hero" class="row">
		<div class="col col-xl-9">
			<h5 class="vary"><?php 
				$date=date_create($news->datetime);
			 echo date_format($date,"d.m.Y");?></h5>
			<h1><?=$news->titel;?></h1>
		</div>
	</div>
	
	

<div class="content margin-b">
	<?=$news->description;?>	
</div>
</div>
    <?php
    $this->registerCssFile("/css/cms/style-news.css");
    ?>