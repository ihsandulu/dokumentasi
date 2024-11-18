<div class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar hidebar" style="overflow:auto;">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class="nav-label">Home</li>
                <li>
                    <a class="" href="<?= base_url(); ?>" aria-expanded="false">
                        <i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span>
                    </a>

                </li>
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
                        isset(session()->get("halaman")['1']['act_read'])
                        && session()->get("halaman")['1']['act_read'] == "1"
                    )
                ) { ?>
                    <li class="nav-label">Master</li>
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
                            isset(session()->get("halaman")['6']['act_read'])
                            && session()->get("halaman")['6']['act_read'] == "1"
                        )
                    ) { ?>
                        <li>
                            <a class="  " href="<?= base_url("mstore"); ?>" aria-expanded="false"><i class="fa fa-building"></i><span class="hide-menu">Perusahaan</span></a>
                        </li>
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
                            isset(session()->get("halaman")['2']['act_read'])
                            && session()->get("halaman")['2']['act_read'] == "1"
                        )
                    ) { ?>
                        <li>
                            <a class="has-arrow  " href="#" aria-expanded="false" data-toggle="collapse" data-target="#demo"><i class="fa fa-user"></i><span class="hide-menu">Manajemen User <span class="label label-rouded label-warning pull-right">2</span></span></a>
                            <ul aria-expanded="false" id="demo" class="collapse">
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
                                        isset(session()->get("halaman")['3']['act_read'])
                                        && session()->get("halaman")['3']['act_read'] == "1"
                                    )
                                ) { ?>
                                    <li><a href="<?= base_url("mposition"); ?>"><i class="fa fa-caret-right"></i> &nbsp;Posisi</a></li>
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
                                        isset(session()->get("halaman")['5']['act_read'])
                                        && session()->get("halaman")['5']['act_read'] == "1"
                                    )
                                ) { ?>
                                    <li><a href="<?= base_url("muser"); ?>"><i class="fa fa-caret-right"></i> &nbsp;User</a></li>
                                <?php } ?>
                            </ul>
                        </li>
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
                            isset(session()->get("halaman")['10']['act_read'])
                            && session()->get("halaman")['10']['act_read'] == "1"
                        )
                    ) { ?>
                        <li>
                            <a class="  " href="<?= base_url("mcategory"); ?>" aria-expanded="false"><i class="fa fa-cubes"></i><span class="hide-menu">Kategori</span></a>
                        </li>
                    <?php } ?>





                <?php } ?>




                <!-- //Transaction// -->
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
                        isset(session()->get("halaman")['9']['act_read'])
                        && session()->get("halaman")['9']['act_read'] == "1"
                    )
                ) { ?>
                    <li class="nav-label">Transaksi</li>

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
                            isset(session()->get("halaman")['13']['act_read'])
                            && session()->get("halaman")['13']['act_read'] == "1"
                        )
                    ) { ?>
                        <li>
                            <a class="  " href="<?= base_url("transaction"); ?>" aria-expanded="false"><i class="fa fa-handshake-o"></i><span class="hide-menu">Transaction</span></a>
                        </li>
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
                            isset(session()->get("halaman")['28']['act_read'])
                            && session()->get("halaman")['28']['act_read'] == "1"
                        )
                    ) { ?>
                        <li>
                            <a class="  " href="<?= base_url("podi"); ?>" aria-expanded="false"><i class="fa fa-handshake-o"></i><span class="hide-menu">POD Import</span></a>
                        </li>
                    <?php } ?>



                <?php } ?>

                <!-- //Report// -->
                <!-- <?php
                if (
                    (
                        isset(session()->get("position_administrator")[0][0])
                        && (
                            session()->get("position_administrator") == "1"
                            || session()->get("position_administrator") == "2"
                        )
                    ) ||
                    (
                        isset(session()->get("halaman")['14']['act_read'])
                        && session()->get("halaman")['14']['act_read'] == "1"
                    )
                ) { ?>
                    <li class="nav-label">Laporan</li>

                    isi

                <?php } ?> -->

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</div>