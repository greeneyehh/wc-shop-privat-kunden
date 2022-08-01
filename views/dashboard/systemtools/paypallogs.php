<?php
use yii\widgets\LinkPager;
?>
<script type="text/javascript" src="/js/json-viewer.js"></script>
<link rel="stylesheet" type="text/css" href="/css/json-viewer.css">
Rechnungsnummer:


		<div class="row">
	    		<?php foreach ($paypallog as $paypallogs): ?>
	    		<div class="col-md-6"> 
	    			      <div class="box collapsed-box">
						   	<div class="box-header with-border">
					          <h3 class="box-title" style="text-transform: uppercase;"><?= $paypallogs->payid;?> 
					          	<span style="font-size: 12px; font-weight: normal"> <br>  <?= $paypallogs->cart;?> ( <?= $paypallogs->update_time;?> )</span>
					          	</h3>
					          <div class="box-tools pull-right">
					            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
					              <i class="fa fa-plus"></i></button>
					          </div>
					        </div>
	    			      	<div class="box-body" style="display: none;">
							<!-- Commit Info -->
						<div class="box">
							<div class="box-header">
              					<h3 class="box-title">PayPal Info</h3>
           					</div>
            <div class="box-body no-padding">
              <table class="table table-striped">
                <tbody>
                <tr>
                  <td>Payid</td>
                  <td><?= $paypallogs->payid;?></td>
                </tr>
                <tr>
                  <td>Intent</td>
                  <td><?= $paypallogs->intent;?><br></td>
                </tr>
                <tr>
                  <td>Paystate</td>
                  <td><?= $paypallogs->paystate;?><br></td>
                <tr>
                  <td>Cart</td>
                  <td><?= $paypallogs->cart;?><br></td>
                </tr>
                <tr>
                  <td>Create Time</td>
                  <td><?= $paypallogs->create_time;?><br></td>
                </tr>
               <tr>
                  <td>Update Time</td>
                  <td><?= $paypallogs->update_time;?><br></td>
                </tr>                               
              </tbody></table>
            </div>           					
           					<div class="box box-default box-solid collapsed-box">
						       <div class="box-header with-border">
						              <h3 class="box-title">PayPal Transactions</h3>
						              <div class="box-tools pull-right">
						                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
						                </button>
						              </div>
						            </div>
						
						            <div class="box-body" style="display: none;">
										<pre>
		    								<?php print_r(unserialize($paypallogs->transactions));?>
										</pre>
									</div>
							</div>
							<div class="box box-default box-solid collapsed-box">
						       <div class="box-header with-border">
						              <h3 class="box-title">PayPal Redirect Urls</h3>
						              <div class="box-tools pull-right">
						                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
						                </button>
						              </div>
						            </div>
						
						            <div class="box-body" style="display: none;">
										<div id="json-Redirect_urls-<?=$paypallogs->id;?>"></div>
									</div>
							</div>
           					<div class="box box-default box-solid collapsed-box">
						       <div class="box-header with-border">
						              <h3 class="box-title">PayPal Payer Info</h3>
						              <div class="box-tools pull-right">
						                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
						                </button>
						              </div>
						            </div>
						
						            <div class="box-body" style="display: none;">
											<div id="json-<?=$paypallogs->id;?>"></div>
									</div>
							</div>	
           					 <div class="box box-default box-solid collapsed-box">
						       <div class="box-header with-border">
						              <h3 class="box-title">PayPal Links</h3>
						              <div class="box-tools pull-right">
						                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
						                </button>
						              </div>
						            </div>
						
						            <div class="box-body" style="display: none;">
									<pre>
										<?php print_r(unserialize($paypallogs->links));?>
									</pre>
									</div>
						</div>	
						<script>
						var jsonViewer = new JSONViewer();
						document.querySelector("#json-<?=$paypallogs->id;?>").appendChild(jsonViewer.getContainer());
						jsonViewer.showJSON(<?=$paypallogs->payer;?>);
						
						var jsonViewerRedirect_urls = new JSONViewer();
						document.querySelector("#json-Redirect_urls-<?=$paypallogs->id;?>").appendChild(jsonViewerRedirect_urls.getContainer());
						jsonViewerRedirect_urls.showJSON(<?php print_r(json_encode(unserialize($paypallogs->redirect_urls)));?>);
						
						
						</script>
					</div>
				 </div>
				</div>
				 </div>
				<?php  endforeach; ?>

<div class="col-md-12 text-center">
<?= LinkPager::widget([
    'pagination' => $pages,
]);?>
 </div>

 </div>
