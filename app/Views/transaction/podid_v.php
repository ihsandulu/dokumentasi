<?php echo $this->include("template/header_v"); ?>
<style>
    .color-green {
        color: green;
        text-shadow: black 1px 1px 1px;
    }

    .color-red {
        color: red;
        text-shadow: black 1px 1px 1px;
    }

    .color-yellow {
        color: yellow;
        text-shadow: black 1px 1px 1px;
    }

    .color-pink {
        color: pink;
        text-shadow: black 1px 1px 1px;
    }

    .color-white {
        color: white !important;
        text-shadow: rgba(0, 0, 0, 0.5) 1px 1px 1px;
    }

    .color-black {
        color: black !important;
    }

    th {
        text-align: center;
    }

    .w50 {
        width: 100px;
    }

    td {
        padding: 1px;
    }
</style>
<div class='container-fluid'>
    <div class='row'>
        <div class='col-12'>
            <div class="card">
                <div class="card-body">


                    <div class="row">
                        <?php if (!isset($_GET['user_id']) && !isset($_POST['new']) && !isset($_POST['edit'])) {
                            $coltitle = "col-md-8";
                        } else {
                            $coltitle = "col-md-8";
                        } ?>
                        <div class="<?= $coltitle; ?>">
                            <h4 class="card-title"></h4>
                            <!-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> -->
                        </div>

                        <?php if (!isset($_POST['new']) && !isset($_POST['edit']) && !isset($_GET['report'])) { ?>
                            <?php if (isset($_GET["user_id"])) { ?>
                                <form action="<?= site_url("user"); ?>" method="get" class="col-md-2">
                                    <h1 class="page-header col-md-12">
                                        <button class="btn btn-warning btn-block btn-lg" value="OK" style="">Back</button>
                                    </h1>
                                </form>
                            <?php } ?>
                            <?php
                            if (
                                (
                                    isset(session()->get("position_administrator")[0][0])
                                    && (
                                        session()->get("position_administrator") == "1"
                                        || session()->get("position_administrator") == "2"
                                    )
                                ) ||
                                (
                                    isset(session()->get("halaman")['18']['act_create'])
                                    && session()->get("halaman")['18']['act_create'] == "1"
                                )
                            ) { ?>
                                <form method="post" class="col-md-2">
                                    <h1 class="page-header col-md-12">
                                        <button name="new" class="btn btn-primary btn-block btn-lg fa fa-cogs" value="OK" style="font-size:12px;"> New</button>
                                        <input type="hidden" name="podid_id" />
                                    </h1>
                                </form>
                            <?php } ?>

                            <form action="<?= base_url("podi"); ?>" method="post" class="col-md-2">
                                <h1 class="page-header col-md-12">
                                    <button class="btn btn-warning btn-block btn-lg fa fa-angle-double-left " value="OK" style="font-size:12px;"> Back</button>
                                </h1>
                            </form>
                        <?php } ?>
                    </div>
                    <?php if (isset($_POST['new']) || isset($_POST['edit'])) { ?>
                        <div class="">
                            <?php if (isset($_POST['edit'])) {
                                $namabutton = 'name="change"';
                                $judul = "Update POD Import";
                            } else {
                                $namabutton = 'name="create"';
                                $judul = "Tambah POD Import";
                            } ?>
                            <div class="lead">
                                <h3><?= $judul; ?></h3>
                            </div>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">


                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podid_name">Nama Dokumen:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="podid_name" name="podid_name" placeholder="" value="<?= $podid_name; ?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podid_document">Upload Dokumen:</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="podid_document" name="podid_document" value="<?= $podid_document; ?>">
                                    </div>
                                </div>



                                <input type="hidden" name="podid_id" value="<?= $podid_id; ?>" />
                                <input type="hidden" name="podi_id" value="<?= $_get["podi_id"]; ?>" />
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $namabutton; ?> value="OK">Submit</button>
                                        <button type="button" class="btn btn-warning col-md-offset-1 col-md-5" onClick="location.href='<?= base_url("podid"); ?>'">Back</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } else { ?>
                        <?php if ($message != "") { ?>
                            <div class="alert alert-info alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?= $message; ?><br /><?= $upload_podid_document; ?><br /><?= $upload_podid_beaatc; ?></strong>
                            </div>
                        <?php } ?>

                        <div class="table-responsive m-t-40">
                            <table id="podid" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <!-- <table id="dataTable" class="table table-condensed table-hover w-auto dtable"> -->
                                <thead class="">
                                    <tr>
                                        <?php //if (!isset($_GET["report"])) { 
                                        ?>
                                        <th>Aksi.</th>
                                        <?php //}
                                        ?>
                                        <!-- <th>No.</th> -->
                                        <th>Nama Dokumen</th>
                                        <th>Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $currentURL = current_url();
                                    $currentURL = str_replace('/index.php', '', $currentURL);
                                    $params   = $_SERVER['QUERY_STRING'];
                                    $fullURL = urlencode($currentURL . '?' . $params);
                                    $builder = $this->db
                                        ->table("podid");
                                    $usr = $builder
                                        ->where("podi_id", $_GET["podi_id"])
                                        ->orderBy("podid.podid_id", "DESC")
                                        ->get();
                                    // echo $this->db->getLastquery();die;
                                    $no = 1;
                                    foreach ($usr->getResult() as $usr) {
                                    ?>
                                        <tr>
                                            <td style="padding-left:0px; padding-right:0px;">
                                                <?php if (!isset($_GET["report"])) { ?>
                                                    <?php
                                                    if (
                                                        (
                                                            isset(session()->get("position_administrator")[0][0])
                                                            && (
                                                                session()->get("position_administrator") == "1"
                                                                || session()->get("position_administrator") == "2"
                                                            )
                                                        ) ||
                                                        (
                                                            isset(session()->get("halaman")['18']['act_update'])
                                                            && session()->get("halaman")['18']['act_update'] == "1"
                                                        )
                                                    ) { ?>
                                                        <form method="post" class="btn-action" style="">
                                                            <button class="btn btn-sm btn-warning " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                            <input type="hidden" name="podid_id" value="<?= $usr->podid_id; ?>" />
                                                        </form>
                                                    <?php } ?>
                                                <?php } ?>

                                                <?php if (!isset($_GET["report"])) { ?>
                                                    <?php
                                                    if (
                                                        (
                                                            isset(session()->get("position_administrator")[0][0])
                                                            && (
                                                                session()->get("position_administrator") == "1"
                                                                || session()->get("position_administrator") == "2"
                                                            )
                                                        ) ||
                                                        (
                                                            isset(session()->get("halaman")['18']['act_delete'])
                                                            && session()->get("halaman")['18']['act_delete'] == "1"
                                                        )
                                                    ) { ?>
                                                        <form method="post" class="btn-action" style="">
                                                            <button class="btn btn-sm btn-danger delete" onclick="return confirm(' you want to delete?');" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                            <input type="hidden" name="podid_id" value="<?= $usr->podid_id; ?>" />
                                                        </form>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                            <!-- <td><?= $no++; ?></td> -->

                                            <td><?= $usr->podid_name; ?></td>
                                            <td><a target="_blank" href="<?= base_url("images/podid_document/" . $usr->podid_document); ?>" class="color-pink fa fa-download"></a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.select').select2();
    var title = "<?= (isset($_GET["report"])) ? "Laporan" : ""; ?> POD Import";
    $("title").text(title);
    $(".card-title").text(title);
    $("#page-title").text(title);
    $("#page-title-link").text(title);

    /*  $(document).ready(function() {
         $('#podid').DataTable({
             dom: 'Bfrtip',
             buttons: [{
                 extend: 'excelHtml5',
                 text: 'Export to Excel',
                 exportOptions: {
                     columns: ':not(:first-child)', // Ekspor hanya kolom yang terlihat
                     format: {
                         body: function(data, row, column, node) {
                             // Hapus tag HTML
                             return $('<div>').html(data).text();
                         }
                     }
                 }
             }]
         });
     }); */
</script>

<?php echo  $this->include("template/footer_v"); ?>