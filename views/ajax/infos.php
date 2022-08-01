<?php foreach ($info as $infoone): ?>
    <div class="card">
        <div class="card-header "><h3 class="card-title"><?= strtoupper($infoone->titel);?></h3>
    </div>
    <div class="card-body">
           <?=$infoone->description;?>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-md-6">von </div>
            <div class="col-md-6">
                <?php
                $date=date_create($infoone->datum);
                echo date_format($date,"d.m.Y");?>
            </div>
        </div>
    </div>

</div>

<?php  endforeach; ?>