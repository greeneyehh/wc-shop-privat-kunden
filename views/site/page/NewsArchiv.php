<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
    <div class="container">
        <div class="membership margin-b z-index" style="padding-top: 2rem;">
            <h2 class="vary">Newsarchiv</h2>
        </div>
        <div class="newsarchiv">
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
        </div>
</div>
    <?php
    $this->registerCssFile("/css/cms/style-news-archiv.css");
$this->registerJs("$(document).on('click','.pagination a',function(e){
    e.preventDefault();
    var url=$(this).attr('href');
    $.get(url,function(msg){
       $('.newsarchiv').html(msg);  
    });
});", \yii\web\View::POS_END);
    ?>
