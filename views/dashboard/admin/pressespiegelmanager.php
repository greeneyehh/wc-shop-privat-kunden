<?php
//print_r($newslist);
?>
<h3 class="box-title">Pressespiegel Manager</h3>

<div class="card card-primary " style="overflow: auto">
    <div class="card-header box-header-windcloud">
        <h3 class="card-title"><i class="fa fa-reorder" aria-hidden="true"></i>Pressespiegel übersicht</h3>
    </div>
    <!-- /.box-header -->
    <div class="card-body" style="min-height: 500px" >
        <div class="row"><div class="col-10"></div><div class="col-2"> <a class="btn btn-success float-right" href="/dashboard/pressespiegel-create">Neue Pressespiegel</a></div> </div>
        <table id="News" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
            <tr role="row">
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="activate to sort column descending">ID</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="activate to sort column descending">Medium</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="activate to sort column descending">Titel</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="activate to sort column ascending">Link</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="activate to sort column ascending">Datetime</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="activate to sort column ascending">Bearbeiten / Löschen</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($pressespiegel as $presse): ?>
                    <tr role="row" class="odd">
                        <td ><?=$presse->id;?></td>
                        <td><?=$presse->medium;?></td>
                        <td><?=$presse->titel;?></td>
                        <td><?=$presse->link;?></td>
                        <td><?php
                            $date=date_create($presse->datetime);
                            echo date_format($date,"d.m.Y");?></td>
                        <td><div><a class="btn btn-warning" href="/dashboard/pressespiegel-edit?id=<?=$presse->id;?>">Bearbeiten</a>
                                <p></p><a class="btn btn-danger" href="/dashboard/pressespiegel-delete?id=<?=$presse->id;?>">Löschen</a></div>
                        </td>
                    </tr>
                <?php  endforeach; ?>
            </tbody>

        </table>

    </div>
</div>

    <div class="modal fade" id="theModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xs" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">News</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>

            </div>
        </div>
    </div>




<?php

$this->registerJs("$(function () {
oTable = $('#News').DataTable({
'order': [[ 0, 'desc' ]],
'paging': true,
'lengthChange': false,
'responsive': true,
'bFilter': true,
'ordering': true,
'fixedColumns': true,
'processing': false,
'info': true,
});
});

");


$this->registerCss("

");
?>
