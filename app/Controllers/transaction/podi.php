<?php

namespace App\Controllers\transaction;


use App\Controllers\baseController;

class podi extends baseController
{

    protected $sesi_user;
    public function __construct()
    {
        $sesi_user = new \App\Models\global_m();
        $sesi_user->ceksesi();
    }


    public function index()
    {
        $data = new \App\Models\transaction\podi_m();
        $data = $data->data();
        return view('transaction/podi_v', $data);
    }
}
