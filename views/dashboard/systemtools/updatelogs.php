<?php
use yii\widgets\LinkPager;
?>
		<script type="text/javascript" src="/js/json-viewer.js"></script>
		<link rel="stylesheet" type="text/css" href="/css/json-viewer.css">
		

<div class="row">
			
		<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$count;?></h3>

              <p>Updates</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
        
        
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$today;?></h3>

              <p>Updates To Day</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
       <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$tomonthly;?></h3>

              <p>Updates To Monthly</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div> 
       <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$sevendays;?></h3>

              <p>Updates Last Seven Days</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div> 
</div>
		
		<hr>
		
		
<div class="row">

<?php foreach ($updatelog as $updatelogs): ?>
	 
	 
	<div class="col-md-6"> 
	 
	<!-- Listelement -->
      <div class="box collapsed-box">

        <div class="box-header with-border">
          <h3 class="box-title" style="text-transform: uppercase;"><?php	$json = json_decode($updatelogs->commits, true);?>
					<?=$json[0]['message'];?> <span style="font-size: 12px; font-weight: normal"> <br> <?=$updatelogs->user_name;?>  ( <?=$json[0]['timestamp'];?> )</span></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-plus"></i></button>
          </div>
        </div>

        <!-- Element content -->
		<div class="box-body" style="display: none;">

		<!-- Commit Info -->
		<div class="box">

            <div class="box-header">
              <h3 class="box-title">Commit Info Title</h3>
            </div>

            <div class="box-body no-padding">
              <table class="table table-striped">
                <tbody>
                <tr>
                  <td>User Pic</td>
                  <td><img src="<?=$updatelogs->user_avatar;?>" class="img-circle" alt="User Image"/></p></td>
                </tr>
                <tr>
                  <td>User Name</td>
                  <td><?=$updatelogs->user_name;?><br></td>
                </tr>
                <tr>
                  <td>Event Name</td>
                  <td><?=$updatelogs->event_name;?><br></td>
                </tr>
                <tr>
                  <td>Event Before</td>
                  <td><?=$updatelogs->event_before;?><br></td>
                </tr>
                <tr>
                  <td>Event After</td>
                  <td><?=$updatelogs->event_after;?><br></td>
                </tr>
               <tr>
                  <td>Event Ref</td>
                  <td><?=$updatelogs->event_ref;?><br></td>
                </tr>
                <tr>
                  <td>User ID</td>
                  <td><?=$updatelogs->user_id;?><br></td>
                </tr>
               <tr>
                  <td>Project ID</td>
                  <td><?=$updatelogs->project_id;?><br></td>
                </tr>
                <tr>
                  <td>Project Name</td>
                  <td><?=$updatelogs->project_name;?><br></td>
                </tr> 
                 <tr>
                  <td>Project description</td>
                  <td><?=$updatelogs->project_description;?><br></td>
                </tr>
               	<tr>
                  <td>Project Namespace</td>
                  <td><?=$updatelogs->project_namespace;?><br></td>
                </tr>        
               	<tr>
                  <td>Project Visibility Level</td>
                  <td><?=$updatelogs->project_visibility_level;?><br></td>
                </tr>    
               	<tr>
                  <td>Project Path With_Namespace</td>
                  <td><?=$updatelogs->project_path_with_namespace;?><br></td>
                </tr>                   
               <tr>
                  <td>Project Default Branch</td>
                  <td><?=$updatelogs->project_default_branch;?><br></td>
                </tr>  
                <tr>
                  <td>Total Commits Count</td>
                  <td><?=$updatelogs->total_commits_count;?><br></td>
                </tr> 
                <tr>
                  <td>Repository Name</td>
                  <td><?=$updatelogs->repository_name;?><br></td>
                </tr> 
                                
              </tbody></table>
            </div>
		</div>
		<!-- /Commit Info -->


		<!-- request/response -->
		<div class="box box-default box-solid collapsed-box">

            <div class="box-header with-border">
              <h3 class="box-title">Commits Result</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>

            <div class="box-body" style="display: none;">
				<div id="json-commit-<?=$updatelogs->id;?>"></div>
            </div>

		</div>
		
		<!-- /request/response -->
		<!-- request/response -->
		<div class="box box-default box-solid collapsed-box">

            <div class="box-header with-border">
              <h3 class="box-title">Pull Result</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>

            <div class="box-body" style="display: none;">
<div id="json-pull-<?=$updatelogs->id;?>"></div>
            </div>

		</div>
		
		<!-- /request/response -->

		<!-- /Element content -->
        </div>

      </div>
	<!-- /Listelement -->	 




 </div>
 
 
 						<script>
						var jsonViewerPull<?=$updatelogs->id;?> = new JSONViewer();
						document.querySelector("#json-pull-<?=$updatelogs->id;?>").appendChild(jsonViewerPull<?=$updatelogs->id;?>.getContainer());
						jsonViewerPull<?=$updatelogs->id;?>.showJSON(<?php print_r($updatelogs->pull_result);?>);
						
						
						var jsonViewerCommit<?=$updatelogs->id;?> = new JSONViewer();
						document.querySelector("#json-commit-<?=$updatelogs->id;?>").appendChild(jsonViewerCommit<?=$updatelogs->id;?>.getContainer());
						jsonViewerCommit<?=$updatelogs->id;?>.showJSON(<?php print_r($updatelogs->commits);?>);
						
						</script>
 
 
 

<?php  endforeach; ?>


 <div class="col-md-12 text-center">
<?= LinkPager::widget([
    'pagination' => $pages,
]);?>
 </div>

</div>