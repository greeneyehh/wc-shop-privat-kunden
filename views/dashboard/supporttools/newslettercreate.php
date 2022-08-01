<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<?php $form = ActiveForm::begin(['method' => 'post','action' => ['newsletter-create']]); ?>       <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Compose New Newsletter</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                	<?= $form->field($model,'to')->label(false)->textInput(['placeholder' => "To:"]) ?>
              </div>
              <div class="form-group">
                	<?= $form->field($model,'subject')->label(false)->textInput(['placeholder' => "Subject:"]) ?>
              </div>
              <div class="form-group">
              	<?= $form->field($model, 'content')->textarea(['id' => 'editor1'])  ?>

              </div>
              <div class="form-group">
                <div class="btn btn-default btn-file">
                  <i class="fa fa-paperclip"></i> Attachment
                  <input type="file" name="attachment">
                </div>
                <p class="help-block">Max. 32MB</p>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
              </div>
              <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
<?php ActiveForm::end(); ?>
