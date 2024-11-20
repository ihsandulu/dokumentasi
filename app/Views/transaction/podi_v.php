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
    .bgsuccess{background-color: #D0F3B4!important;}
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
                                        <button name="new" class="btn btn-primary btn-block btn-lg fa fa-cogs" value="OK" style="font-size:12px;"> New</button>
                                        <input type="hidden" name="podi_id" />
                                    </h1>
                                </form>
                            <?php } ?>
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
                                    <label class="control-label col-sm-2" for="podi_aju">Nomor AJU:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="podi_aju" name="podi_aju" placeholder="" value="<?= $podi_aju; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_mbl">MBL:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="podi_mbl" name="podi_mbl" placeholder="" value="<?= $podi_mbl; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_hbl">HBL:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="podi_hbl" name="podi_hbl" placeholder="" value="<?= $podi_hbl; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_fileno">File No.:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="podi_fileno" name="podi_fileno" placeholder="" value="<?= $podi_fileno; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_style">Style No.:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="podi_style" name="podi_style" placeholder="" value="<?= $podi_style; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_item">Item :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="podi_item" name="podi_item" placeholder="" value="<?= $podi_item; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_qty">Qty :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="podi_qty" name="podi_qty" placeholder="" value="<?= $podi_qty; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_unit">Unit :</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="podi_unit" name="podi_unit">
                                            <option value="0" <?= ($podi_unit == "0") ? "selected" : ""; ?>>Pilih Unit</option>
                                            <?php $unit = $this->db->table('unit')->orderBy("unit_name", "ASC")->get();
                                            foreach ($unit->getResult() as $unit) { ?>
                                                <option value="<?= $unit->unit_id; ?>" <?= ($unit->unit_id == $podi_unit) ? "selected" : ""; ?>><?= $unit->unit_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_etd">ETD :</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="podi_etd" name="podi_etd" placeholder="" value="<?= $podi_etd; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_eta">ETA :</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="podi_eta" name="podi_eta" placeholder="" value="<?= $podi_eta; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_ata">ATA :</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="podi_ata" name="podi_ata" placeholder="" value="<?= $podi_ata; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_factin">FACT-IN :</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="podi_factin" name="podi_factin" placeholder="" value="<?= $podi_factin; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_origin">Origin :</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="podi_origin" name="podi_origin">
                                            <option value="0" <?= ($podi_origin == "0") ? "selected" : ""; ?>>Pilih Kota</option>
                                            <?php $city = $this->db->table('city')->orderBy("city_name", "ASC")->get();
                                            foreach ($city->getResult() as $city) { ?>
                                                <option value="<?= $city->city_id; ?>" <?= ($city->city_id == $podi_origin) ? "selected" : ""; ?>><?= $city->city_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_destination">Destination :</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="podi_destination" name="podi_destination">
                                            <option value="0" <?= ($podi_origin == "0") ? "selected" : ""; ?>>Pilih Kota</option>
                                            <?php $city = $this->db->table('city')->orderBy("city_name", "ASC")->get();
                                            foreach ($city->getResult() as $city) { ?>
                                                <option value="<?= $city->city_id; ?>" <?= ($city->city_id == $podi_origin) ? "selected" : ""; ?>><?= $city->city_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_shipmode">Ship Mode :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="podi_shipmode" name="podi_shipmode" placeholder="" value="<?= $podi_shipmode; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_type">Type :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="podi_type" name="podi_type" placeholder="" value="<?= $podi_type; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_vf">Vessel/Flight :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="podi_vf" name="podi_vf" placeholder="" value="<?= $podi_vf; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_container">Container :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="podi_container" name="podi_container" placeholder="" value="<?= $podi_container; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_cbm">CBM :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="podi_cbm" name="podi_cbm" placeholder="" value="<?= $podi_cbm; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_gw">GW :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="podi_gw" name="podi_gw" placeholder="" value="<?= $podi_gw; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_inv">Invoice :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="podi_inv" name="podi_inv" placeholder="" value="<?= $podi_inv; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_invdate">Invoice Date :</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="podi_invdate" name="podi_invdate" placeholder="" value="<?= $podi_invdate; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_totalfob">Total FOB :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="podi_totalfob" name="podi_totalfob" placeholder="" value="<?= $podi_totalfob; ?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="podi_document">Upload Dokumen:</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="podi_document" name="podi_document" value="<?= $podi_document; ?>">
                                    </div>
                                </div>



                                <input type="hidden" name="podi_id" value="<?= $podi_id; ?>" />
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $namabutton; ?> value="OK">Submit</button>
                                        <button type="button" class="btn btn-warning col-md-offset-1 col-md-5" onClick="location.href='<?= base_url("podi"); ?>'">Back</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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
                                <strong><?= $message; ?><br /><?= $upload_podi_document; ?><br /><?= $upload_podi_beaatc; ?></strong>
                            </div>
                        <?php } ?>

                        <div class="table-responsive tarik m-t-40">
                            <table id="podi" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
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
                                        <th class="w50">Date</th>
                                        <th>No. AJU</th>
                                        <th>MBL</th>
                                        <th>HBL</th>
                                        <th>File No.</th>
                                        <th>Style</th>
                                        <th>Item</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th class="w50">ETD</th>
                                        <th class="w50">ETA</th>
                                        <th class="w50">ATA</th>
                                        <th class="w50">FACT-IN</th>
                                        <th>Origin</th>
                                        <th>Destination</th>
                                        <th>Ship Mode</th>
                                        <th>Type</th>
                                        <th>Vessel/Flight</th>
                                        <th>Container</th>
                                        <th>CBM</th>
                                        <th>GW</th>
                                        <th>Invoice</th>
                                        <th>Invoice Date</th>
                                        <th>Total FOB</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $currentURL = current_url();
                                    $currentURL = str_replace('/index.php', '', $currentURL);
                                    $params   = $_SERVER['QUERY_STRING'];
                                    $fullURL = urlencode($currentURL . '?' . $params);
                                    $builder = $this->db
                                        ->table("podi")
                                        ->join("user", "user.user_id=podi.user_id", "left")
                                        ->join("unit", "unit.unit_id=podi.podi_unit", "left")
                                        ->join("(SELECT city_id as corigin_id, city_name as corigin_name FROM city) AS corigin", "corigin.corigin_id=podi.podi_origin", "left")
                                        ->join("(SELECT city_id as cdes_id, city_name as cdes_name FROM city) AS cdes", "cdes.cdes_id=podi.podi_destination", "left");
                                    if (isset($_GET["from"]) && $_GET["from"] != "") {
                                        $builder->where("podi.podi_date >=", $this->request->getGet("from"));
                                    } else {
                                        $builder->where("podi.podi_date", date("Y-m-d"));
                                    }

                                    if (isset($_GET["to"]) && $_GET["to"] != "") {
                                        $builder->where("podi.podi_date <=", $this->request->getGet("to"));
                                    } else {
                                        $builder->where("podi.podi_date", date("Y-m-d"));
                                    }
                                    $usr = $builder
                                        ->orderBy("podi.podi_id", "DESC")
                                        ->get();
                                    // echo $this->db->getLastquery();die;
                                    $no = 1;
                                    foreach ($usr->getResult() as $usr) {
                                        if (date("Y-m-d") == $usr->podi_eta) {
                                            $bgcolor = "bg-warning color-white";
                                            $talert = "Datang hari ini!";
                                        } else if (date("Y-m-d") > $usr->podi_eta) {
                                            if ($usr->podi_ata != "" && $usr->podi_ata != "0000-00-00") {
                                                $bgcolor = "bg-success color-white";
                                                $talert = "";
                                            } else {
                                                $bgcolor = "bg-danger color-white";
                                                $talert = "Belum Tiba!";
                                            }
                                        } else {
                                            $bgcolor = "bg-white color-black";
                                            $talert = "Belum Tiba!";
                                        }

                                        
                                        if (date("Y-m-d") >= $usr->podi_factin && $usr->podi_factin!="0000-00-00") {
                                            $tbgcolor = "bgsuccess";
                                        }else{
                                            $tbgcolor = "";
                                        }
                                    ?>
                                        <tr class="<?=$tbgcolor;?>">
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
                                                            <input type="hidden" name="podi_id" value="<?= $usr->podi_id; ?>" />
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
                                                            <input type="hidden" name="podi_id" value="<?= $usr->podi_id; ?>" />
                                                        </form>
                                                    <?php } ?>
                                                <?php } ?>

                                                <form action="<?= base_url("podid"); ?>" method="get" class="btn-action" style="">
                                                    <button class="btn btn-sm btn-primary" name="podid" value="OK">
                                                        <span class="fa fa-address-card-o" style="color:white;"></span>
                                                    </button>
                                                    <input type="hidden" name="podi_id" value="<?= $usr->podi_id; ?>" />
                                                </form>
                                            </td>
                                            <!-- <td><?= $no++; ?></td> -->

                                            <td><?= $usr->user_name; ?></td>
                                            <td><?= $usr->podi_date; ?></td>
                                            <td><?= $usr->podi_aju; ?></td>
                                            <td><?= $usr->podi_mbl; ?></td>
                                            <td><?= $usr->podi_hbl; ?></td>
                                            <td><?= $usr->podi_fileno; ?></td>
                                            <td><?= $usr->podi_style; ?></td>
                                            <td><?= $usr->podi_item; ?></td>
                                            <td><?= $usr->podi_qty; ?></td>
                                            <td><?= $usr->unit_name; ?></td>
                                            <td><?= $usr->podi_etd; ?></td>
                                            <td><?= $usr->podi_eta; ?></td>
                                            <td class="<?= $bgcolor; ?>"><?= ($usr->podi_ata != "" && $usr->podi_ata != "0000-00-00") ? $usr->podi_ata : $talert; ?></td>
                                            <td><?= $usr->podi_factin; ?></td>
                                            <td><?= $usr->corigin_name; ?></td>
                                            <td><?= $usr->cdes_name; ?></td>
                                            <td><?= $usr->podi_shipmode; ?></td>
                                            <td><?= $usr->podi_type; ?></td>
                                            <td><?= $usr->podi_vf; ?></td>
                                            <td><?= $usr->podi_container; ?></td>
                                            <td><?= $usr->podi_cbm; ?></td>
                                            <td><?= $usr->podi_gw; ?></td>
                                            <td><?= $usr->podi_inv; ?></td>
                                            <td><?= $usr->podi_invdate; ?></td>
                                            <td><?= $usr->podi_totalfob; ?></td>
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

    $(document).ready(function() {
        $('#podi').DataTable({
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
    });
</script>

<?php echo  $this->include("template/footer_v"); ?>