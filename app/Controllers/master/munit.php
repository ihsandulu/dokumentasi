<?php

namespace App\Controllers\master;


use App\Controllers\baseController;

class munit extends baseController
{

    protected $sesi_user;
    public function __construct()
    {
        $sesi_user = new \App\Models\global_m();
        $sesi_user->ceksesi();
    }


    public function index()
    {
        $data = new \App\Models\master\munit_m();
        $data = $data->data();
        return view('master/munit_v', $data);
    }
}
