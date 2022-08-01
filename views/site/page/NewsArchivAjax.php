<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<table class="table" style="border: none">
    <thead>
    <tr style="border-bottom: 2px solid #33AAAA">
        <th scope="col font-color-darkblue" style="border-top: 0px;width: 50%;border-bottom: 2px solid #33AAAA;color: #004477!important;">Titel</th>
        <th scope="col font-color-darkblue" style="border-top: 0px;width: 20%;border-bottom: 2px solid #33AAAA;color: #004477!important;">Datum</th>
        <th scope="col font-color-darkblue" style="border-top: 0px;width: 30%;border-bottom: 2px solid #33AAAA;color: #004477!important;">Link</th>
    </tr>
    </thead>
    <tbody >
    <?php foreach ($news as $model): ?>
        <tr style="border-bottom: 2px">
            <td style="border-bottom: 2px solid #33AAAA;color: #004477!important;"><?=$model->titel?></td>
            <td style="border-bottom: 2px solid #33AAAA;color: #004477!important;"><?php
                $date=date_create($model->datetime);
                echo date_format($date,"d.m.Y");?>
            </td>
            <td style="border-bottom: 2px solid #33AAAA;color: #004477!important;"><a class="border mobile-fill anim-1 show" style="width:280px" href="/news/<?=$model->slug;?>">mehr lesen</a></td>
        </tr>
    <?php  endforeach; ?>
    </tbody>
</table>
<div class="text-center font-size-4 margin-b">
    <?= LinkPager::widget([
        'pagination' => $pages,
    ]);?>
</div>
