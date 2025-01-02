<?php

namespace App\Models\transaction;

use App\Models\core_m;

class transaction_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek transaction
        if ($this->request->getVar("transaction_id")) {
            $transactiond["transaction_id"] = $this->request->getVar("transaction_id");
        } else {
            $transactiond["transaction_id"] = -1;
        }
        $us = $this->db
            ->table("transaction")
            ->getWhere($transactiond);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "transaction_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $transaction) {
                foreach ($this->db->getFieldNames('transaction') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $transaction->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('transaction') as $field) {
                $data[$field] = "";
            }
            $data["transaction_date"] = date("Y-m-d");
        }



        //delete
        if ($this->request->getPost("delete") == "OK") {
            $transaction_id =   $this->request->getPost("transaction_id");
            $this->db
                ->table("transaction")
                ->delete(array("transaction_id" => $transaction_id, "store_id" => session()->get("store_id")));
            $data["message"] = "Delete Success";
        }

        $data['upload_transaction_suratatc'] = "";
        $data['upload_transaction_beaatc'] = "";

        $allowedMimeTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        // Mengunggah file pertama (transaction_suratatc)
        if (isset($_FILES['transaction_suratatc']) && $_FILES['transaction_suratatc']['name'] != "") {
            $file1 = $this->request->getFile('transaction_suratatc');

            if ($file1->isValid() && !$file1->hasMoved()) {
                $type1 = $file1->getClientMimeType();

                if (in_array($type1, $allowedMimeTypes)) {
                    $direktori1 = ROOTPATH . 'images/transaction_suratatc/';
                    $name1 = date("H_i_s_") . str_replace(' ', '_', $file1->getName());

                    if ($file1->move($direktori1, $name1)) {
                        $data['upload_transaction_suratatc'] = "<i class='fa fa-check color-green'></i> Upload Dokumen Success!";
                        $input['transaction_suratatc'] = $name1;
                    } else {
                        $data['upload_transaction_suratatc'] = "<i class='fa fa-times color-red'></i> Upload Dokumen Gagal!";
                    }
                } else {
                    $data['upload_transaction_suratatc'] = "<i class='fa fa-times color-red'></i> Format File Salah!";
                }
            }
        }

        // Mengunggah file kedua (transaction_beaatc)
        if (isset($_FILES['transaction_beaatc']) && $_FILES['transaction_beaatc']['name'] != "") {
            $file2 = $this->request->getFile('transaction_beaatc');

            if ($file2->isValid() && !$file2->hasMoved()) {
                $type2 = $file2->getClientMimeType();

                if (in_array($type2, $allowedMimeTypes)) {
                    $direktori2 = ROOTPATH . 'images/transaction_beaatc/';
                    $name2 = date("H_i_s_") . str_replace(' ', '_', $file2->getName());

                    if ($file2->move($direktori2, $name2)) {
                        $data['upload_transaction_beaatc'] = "<i class='fa fa-check color-green'></i> Upload Berkas Bea Cukai Success!";
                        $input['transaction_beaatc'] = $name2;
                    } else {
                        $data['upload_transaction_beaatc'] = "<i class='fa fa-times color-red'></i> Upload Berkas Bea Cukai Gagal!";
                    }
                } else {
                    $data['upload_transaction_beaatc'] = "Format File Salah!";
                }
            }
        }


        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'transaction_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["cashier_id"] = session()->get("user_id");
            if (isset($_POST["transaction_surat"]) && $_POST["transaction_surat"] != "") {
                $input["transaction_surat"] = $_POST["transaction_surat"];
            } else {
                $lalu = $this->db->table("transaction")->orderBy("transaction_id", "DESC")->limit("1")->get();
                if ($lalu->getNumRows() > 0) {
                    $tdate = $lalu->getRow()->transaction_date;
                    $trdate = date("Y", strtotime($tdate));
                    // echo $trdate;die;
                    if ($trdate != date("Y")) {
                        $nomor = 1;
                    } else {
                        $transactionsurat = $lalu->getRow()->transaction_surat;
                        $nomorex = explode("/", $transactionsurat);
                        $nomor = (int) ltrim($nomorex[0], '0');
                        // echo $nomor;die;
                        $nomor += 1;
                    }
                } else {
                    $nomor = 1;
                }
                $nomor = str_pad($nomor, 3, "0",STR_PAD_LEFT);
        
                $bulanRomawi = [
                    '01' => 'I',
                    '02' => 'II',
                    '03' => 'III',
                    '04' => 'IV',
                    '05' => 'V',
                    '06' => 'VI',
                    '07' => 'VII',
                    '08' => 'VIII',
                    '09' => 'IX',
                    '10' => 'X',
                    '11' => 'XI',
                    '12' => 'XII'
                ];
                $bulan = date("m");
                $bulanRomawi = $bulanRomawi[$bulan];

                // Hasilkan format nomor surat
                $input["transaction_surat"] = $nomor . "/BC-SGI/" . $bulanRomawi . "/" . date("Y");
            }

            $builder = $this->db->table('transaction');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $transaction_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;

        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'transaction_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $this->db->table('transaction')->update($input, array("transaction_id" => $this->request->getPost("transaction_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
