<?php
foreach ($tickets['result'] as $ticket):

        ?>
        <div class="card">
            <div class="card-header"><h3 class="card-title"><?=$ticket['ticketNumber']?> |
        <?= $CategoryData[$ticket['ticketCategoryId']]?> | <?=$UserData[$ticket['assignedUserId']]?> | <?= $ticket['ticketStatusName'] ;?> </h3>

        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-6">Letzte aktuallisierung</div>
                <div class="col-md-6"><?=date("d.m.y H:i:s", $ticket['lastModifiedDate']/1000) ?></div>
            </div>
        </div>

        </div>
        <?php endforeach; ?>