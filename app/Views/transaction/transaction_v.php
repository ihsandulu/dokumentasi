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
                            $coltitle = "col-md-10";
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
                                        <button name="new" class="btn btn-warning btn-block btn-lg fa fa-cogs" value="OK" style="font-size:12px;"> Generate</button>
                                        <input type="hidden" name="transaction_id" />
                                    </h1>
                                </form>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <?php if (isset($_POST['new']) || isset($_POST['edit'])) { ?>
                        <div class="">
                            <?php if (isset($_POST['edit'])) {
                                $namabutton = 'name="change"';
                                $judul = "Update Dokumen";
                            } else {
                                $namabutton = 'name="create"';
                                $judul = "Tambah Dokumen";
                            } ?>
                            <div class="lead">
                                <h3><?= $judul; ?></h3>
                            </div>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="category_id">Category:</label>
                                    <div class="col-sm-10">
                                        <?php
                                        $category = $this->db->table("category")
                                            ->orderBy("category_name", "ASC")
                                            ->get();
                                        //echo $this->db->getLastQuery();
                                        ?>
                                        <select class="form-control select" id="category_id" name="category_id">
                                            <option value="" <?= ($category_id == "") ? "selected" : ""; ?>>Pilih Category</option>
                                            <?php
                                            foreach ($category->getResult() as $category) { ?>
                                                <option value="<?= $category->category_id; ?>" <?= ($category_id == $category->category_id) ? "selected" : ""; ?>><?= $category->category_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="transaction_date">Tgl Dokumen:</label>
                                    <div class="col-sm-10">
                                        <input type="date" autofocus class="form-control" id="transaction_date" name="transaction_date" placeholder="" value="<?= $transaction_date; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="transaction_surat">Nomor Dokumen:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="transaction_surat" name="transaction_surat" placeholder="Penomoran akan otomatis jika dikosongkan" value="<?= $transaction_surat; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="transaction_suratatc">Attachment Dokumen:</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="transaction_suratatc" name="transaction_suratatc" value="<?= $transaction_suratatc; ?>">
                                    </div>
                                </div>


                                

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="transaction_beadate">Tgl Bea Cukai:</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="transaction_beadate" name="transaction_beadate" placeholder="" value="<?= $transaction_beadate; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="transaction_bea">Nomor Bea Cukai:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="transaction_bea" name="transaction_bea" placeholder="" value="<?= $transaction_bea; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="transaction_beaatc">Attachment Bea Cukai:</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="transaction_beaatc" name="transaction_beaatc" value="<?= $transaction_beaatc; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="transaction_status">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select" id="transaction_status" name="transaction_status">
                                            <option value="Pending" <?= ($transaction_status == "Pending") ? "selected" : ""; ?>>Pending</option>
                                            <option value="Done" <?= ($transaction_status == "Done") ? "selected" : ""; ?>>Done</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="transaction_keterangan">Keterangan:</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="transaction_keterangan" name="transaction_keterangan" placeholder=""><?= $transaction_keterangan; ?></textarea>
                                    </div>
                                </div>


                                <input type="hidden" name="transaction_id" value="<?= $transaction_id; ?>" />
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $namabutton; ?> value="OK">Submit</button>
                                        <button type="button" class="btn btn-warning col-md-offset-1 col-md-5" onClick="location.href='<?= base_url("transaction"); ?>'">Back</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <script>
                            <?php if (isset($_POST['new'])) { ?>
                                $("#submit").click();
                            <?php } ?>
                        </script>
                    <?php } else { ?>
                        <?php
                        if (isset($_GET["from"]) && $_GET["from"] != "") {
                            $from = $_GET["from"];
                        } else {
                            $from = date("Y-m-d");
                        }

                        if (isset($_GET["to"]) && $_GET["to"] != "") {
                            $to = $_GET["to"];
                        } else {
                            $to = date("Y-m-d");
                        }

                        ?>
                        <form class="form-inline">
                            <label for="from">Dari:</label>&nbsp;
                            <input type="date" id="from" name="from" class="form-control" value="<?= $from; ?>">&nbsp;
                            <label for="to">Ke:</label>&nbsp;
                            <input type="date" id="to" name="to" class="form-control" value="<?= $to; ?>">&nbsp;
                            <?php if (isset($_GET["report"])) { ?>
                                <input type="hidden" id="report" name="report" class="form-control" value="<?= $this->request->getGet("report"); ?>">&nbsp;
                            <?php } ?>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                        <?php if ($message != "") { ?>
                            <div class="alert alert-info alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?= $message; ?><br /><?= $upload_transaction_suratatc; ?><br /><?= $upload_transaction_beaatc; ?></strong>
                            </div>
                        <?php } ?>

                        <div class="table-responsive m-t-40">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <!-- <table id="dataTable" class="table table-condensed table-hover w-auto dtable"> -->
                                <thead class="">
                                    <tr>
                                        <?php //if (!isset($_GET["report"])) { 
                                        ?>
                                        <th>Aksi.</th>
                                        <?php //}
                                        ?>
                                        <!-- <th>No.</th> -->
                                        <th>User</th>
                                        <th>Category</th>
                                        <th class="w50">Tgl SP</th>
                                        <th>Surat Permohonan</th>
                                        <th class="w50">Tgl Bea Cukai</th>
                                        <th>Jawaban Bea Cukai</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $currentURL = current_url();
                                    $currentURL = str_replace('/index.php', '', $currentURL);
                                    $params   = $_SERVER['QUERY_STRING'];
                                    $fullURL = urlencode($currentURL . '?' . $params);
                                    $builder = $this->db
                                        ->table("transaction")
                                        ->join("user", "user.user_id=transaction.cashier_id", "left")
                                        ->join("category", "category.category_id=transaction.category_id", "left");
                                    if (isset($_GET["from"]) && $_GET["from"] != "") {
                                        $builder->where("transaction.transaction_date >=", $this->request->getGet("from"));
                                    } else {
                                        $builder->where("transaction.transaction_date", date("Y-m-d"));
                                    }

                                    if (isset($_GET["to"]) && $_GET["to"] != "") {
                                        $builder->where("transaction.transaction_date <=", $this->request->getGet("to"));
                                    } else {
                                        $builder->where("transaction.transaction_date", date("Y-m-d"));
                                    }
                                    $usr = $builder
                                        ->orderBy("transaction.transaction_id", "ASC")
                                        ->get();
                                    // echo $this->db->getLastquery();die;
                                    $no = 1;
                                    $thargasetelahppn = 0;
                                    $tnominal = 0;
                                    foreach ($usr->getResult() as $usr) {
                                        if ($usr->category_alert == 1) {
                                            $bgcolor = "bg-danger color-white";
                                            $talert = "Wajib diisi!";
                                        } else {
                                            $bgcolor = "";
                                            $talert = "";
                                        }
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
                                                            <input type="hidden" name="transaction_id" value="<?= $usr->transaction_id; ?>" />
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
                                                            <input type="hidden" name="transaction_id" value="<?= $usr->transaction_id; ?>" />
                                                        </form>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                            <!-- <td><?= $no++; ?></td> -->
                                            <td><?= $usr->user_name; ?></td>
                                            <td><?= $usr->category_name; ?></td>
                                            <td><?= $usr->transaction_date; ?></td>
                                            <td><a target="_blank" href="<?= base_url("images/transaction_suratatc/" . $usr->transaction_suratatc); ?>" class="color-pink fa fa-download"></a>&nbsp;&nbsp;<?= $usr->transaction_surat; ?></td>
                                            <td class="<?= $bgcolor; ?>">
                                                <?php if ($usr->transaction_bea != "") { ?>
                                                    <?= $usr->transaction_beadate; ?>
                                                <?php } else {
                                                    echo $talert;
                                                } ?>
                                            </td>
                                            <td class="<?= $bgcolor; ?>">
                                                <?php if ($usr->transaction_bea != "") { ?>
                                                    <a target="_blank" href="<?= base_url("images/transaction_beaatc/" . $usr->transaction_beaatc); ?>" class="color-yellow fa fa-download"></a>&nbsp;&nbsp;<?= $usr->transaction_bea; ?>
                                                <?php } else {
                                                    echo $talert;
                                                } ?>
                                            </td>
                                            <td><?= $usr->transaction_status; ?></td>
                                            <td><?= $usr->transaction_keterangan; ?></td>
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
    var title = "<?= (isset($_GET["report"])) ? "Laporan" : ""; ?> Dokumen";
    $("title").text(title);
    $(".card-title").text(title);
    $("#page-title").text(title);
    $("#page-title-link").text(title);
</script>

<?php echo  $this->include("template/footer_v"); ?>