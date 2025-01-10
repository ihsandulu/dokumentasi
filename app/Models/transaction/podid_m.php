<?php

namespace App\Models\transaction;

use App\Models\core_m;

class podid_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek podid
        if ($this->request->getVar("podid_id")) {
            $podidd["podid_id"] = $this->request->getVar("podid_id");
        } else {
            $podidd["podid_id"] = -1;
        }
        $us = $this->db
            ->table("podid")
            ->getWhere($podidd);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "podid_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $podid) {
                foreach ($this->db->getFieldNames('podid') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $podid->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('podid') as $field) {
                $data[$field] = "";
            }
            $data["podid_date"] = date("Y-m-d");
        }



        //delete
        if ($this->request->getPost("delete") == "OK") {
            $podid_id =   $this->request->getPost("podid_id");
            $filePath =   $this->request->getPost("podid_document");
            if ($filePath) {        
                // Cek apakah file ada di server
                if (file_exists($filePath)) {
                    // Hapus file dari server
                    unlink($filePath);
                }
            }
            $this->db
                ->table("podid")
                ->delete(array("podid_id" => $podid_id));
            $data["message"] = "Delete Success";
        }

        $data['upload_podid_document'] = "";
        $data['upload_podid_beaatc'] = "";

        $allowedMimeTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        // Mengunggah file pertama (podid_document)
        if (isset($_FILES['podid_document']) && $_FILES['podid_document']['name'] != "") {
            $file1 = $this->request->getFile('podid_document');

            if ($file1->isValid() && !$file1->hasMoved()) {
                $type1 = $file1->getClientMimeType();

                if (in_array($type1, $allowedMimeTypes)) {
                    $direktori1 = ROOTPATH . 'images/podid_document/';
                    $name1 = date("H_i_s_") . str_replace(' ', '_', $file1->getName());

                    if ($file1->move($direktori1, $name1)) {
                        $data['upload_podid_document'] = "<i class='fa fa-check color-green'></i> Upload Dokumen Success!";
                        $input['podid_document'] = $name1;
                    } else {
                        $data['upload_podid_document'] = "<i class='fa fa-times color-red'></i> Upload Dokumen Gagal!";
                    }
                } else {
                    $data['upload_podid_document'] = "<i class='fa fa-times color-red'></i> Format File Salah!";
                }
            }
        }


        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'podid_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $builder = $this->db->table('podid');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $podid_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;

        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'podid_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $this->db->table('podid')->update($input, array("podid_id" => $this->request->getPost("podid_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
