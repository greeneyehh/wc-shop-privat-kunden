 <?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
 <div class="box">
 	<div class="box-header">
      <h3 class="box-title">Shop Producte</h3>
	</div>
            <!-- /.box-header -->
            <div class="box-body">
            <?= Html::button('<span class="glyphicon glyphicon glyphicon-file"> ProduktErstellen</span>', ['value' => Url::to(['dashboard/produkte-create']), 'title' => 'View', 'class' => 'showModalButton btn btn-default']); ?>
	                
              <table id="product" class="table table-bordered table-striped display">
                <thead>
                <tr>
                <th>Product Id</th>
	                  <th>Product Name</th>
	                  <th>Product Beschreibung</th>
	                  <th>Product Steuern</th>
	                  <th>Product Preis</th>
	                  <th>Product Erweiterung</th>
	                  <th>Product Bearbeiten</th>
                </tr>
                </thead>
                <tbody>
               <?php foreach ($product as $products): ?>
                <tr>
	                <td><?= $products->id; ?></td>
	                <td><?= $products->name; ?></td>
	                <td><?= $products->description; ?></td>
	                <td><?= $products->tax; ?></td>
	                <td><?= $products->price; ?></td>
	                <td><?= $products->addons; ?></td>
	                <td>
	                	<?= Html::button('<span class="glyphicon glyphicon-eye-open"></span>', ['value' => Url::to(['dashboard/produkte-view', 'id'=>$products->id]), 'title' => 'View', 'class' => 'showModalButton btn btn-default']); ?>
	                	<?= Html::button('<span class="glyphicon glyphicon-pencil"></span>', ['value' => Url::to(['dashboard/produkte-update', 'id'=>$products->id]), 'title' => 'Edit', 'class' => 'loadMainContent showModalButton btn btn-default']); ?>
	                	<?= Html::button('<span class="glyphicon glyphicon-trash"></span>', ['value' => Url::to(['dashboard/produkte-delete', 'id'=>$products->id]), 'title' => 'Edit', 'class' => 'showModalButton btn btn-default']); ?>
					</td>
                </tr>

               <?php  endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                	<th>Product Id</th>
                 	<th>Product Name</th>
                	<th>Product Beschreibung</th>
                 	<th>Product Steuern</th>
                 	<th>Product Preis</th>
                 	<th>Product Erweiterung</th>
                 	<th>Product Bearbeiten</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

<?php
yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'header' => ' ',
    'id' => 'modal',
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);
echo "<div class='body-content'><div id='modalContent'><div style='text-align:center'><img src='/image/loader.gif'></div></div></div>";
yii\bootstrap\Modal::end();
?>			
				
