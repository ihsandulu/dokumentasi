<?php

namespace App\Models\transaction;

use App\Models\core_m;

class podi_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek podi
        if ($this->request->getVar("podi_id")) {
            $podid["podi_id"] = $this->request->getVar("podi_id");
        } else {
            $podid["podi_id"] = -1;
        }
        $us = $this->db
            ->table("podi")
            ->getWhere($podid);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "podi_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $podi) {
                foreach ($this->db->getFieldNames('podi') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $podi->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('podi') as $field) {
                $data[$field] = "";
            }
            $data["podi_date"] = date("Y-m-d");
        }



        //delete
        if ($this->request->getPost("delete") == "OK") {
            $podi_id =   $this->request->getPost("podi_id");
            $this->db
                ->table("podi")
                ->delete(array("podi_id" => $podi_id, "store_id" => session()->get("store_id")));
            $data["message"] = "Delete Success";
        }

        $data['upload_podi_suratatc'] = "";
        $data['upload_podi_beaatc'] = "";

        $allowedMimeTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        // Mengunggah file pertama (podi_suratatc)
        if (isset($_FILES['podi_suratatc']) && $_FILES['podi_suratatc']['name'] != "") {
            $file1 = $this->request->getFile('podi_suratatc');

            if ($file1->isValid() && !$file1->hasMoved()) {
                $type1 = $file1->getClientMimeType();

                if (in_array($type1, $allowedMimeTypes)) {
                    $direktori1 = ROOTPATH . 'images/podi_suratatc/';
                    $name1 = date("H_i_s_") . str_replace(' ', '_', $file1->getName());

                    if ($file1->move($direktori1, $name1)) {
                        $data['upload_podi_suratatc'] = "<i class='fa fa-check color-green'></i> Upload Dokumen Success!";
                        $input['podi_suratatc'] = $name1;
                    } else {
                        $data['upload_podi_suratatc'] = "<i class='fa fa-times color-red'></i> Upload Dokumen Gagal!";
                    }
                } else {
                    $data['upload_podi_suratatc'] = "<i class='fa fa-times color-red'></i> Format File Salah!";
                }
            }
        }

        // Mengunggah file kedua (podi_beaatc)
        if (isset($_FILES['podi_beaatc']) && $_FILES['podi_beaatc']['name'] != "") {
            $file2 = $this->request->getFile('podi_beaatc');

            if ($file2->isValid() && !$file2->hasMoved()) {
                $type2 = $file2->getClientMimeType();

                if (in_array($type2, $allowedMimeTypes)) {
                    $direktori2 = ROOTPATH . 'images/podi_beaatc/';
                    $name2 = date("H_i_s_") . str_replace(' ', '_', $file2->getName());

                    if ($file2->move($direktori2, $name2)) {
                        $data['upload_podi_beaatc'] = "<i class='fa fa-check color-green'></i> Upload Berkas Bea Cukai Success!";
                        $input['podi_beaatc'] = $name2;
                    } else {
                        $data['upload_podi_beaatc'] = "<i class='fa fa-times color-red'></i> Upload Berkas Bea Cukai Gagal!";
                    }
                } else {
                    $data['upload_podi_beaatc'] = "Format File Salah!";
                }
            }
        }


        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'podi_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["user_id"] = session()->get("user_id");  
            $input["podi_date"] = date("Y-m-d");  
            $builder = $this->db->table('podi');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $podi_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;

        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'podi_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $this->db->table('podi')->update($input, array("podi_id" => $this->request->getPost("podi_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
