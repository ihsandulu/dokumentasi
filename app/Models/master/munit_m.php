<?php

namespace App\Models\master;

use App\Models\core_m;

class munit_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek unit
        if ($this->request->getVar("unit_id")) {
            $unitd["unit_id"] = $this->request->getVar("unit_id");
        } else {
            $unitd["unit_id"] = -1;
        }
        $us = $this->db
            ->table("unit")
            ->getWhere($unitd);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "unit_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $unit) {
                foreach ($this->db->getFieldNames('unit') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $unit->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('unit') as $field) {
                $data[$field] = "";
            }
        }



        //delete
        if ($this->request->getPost("delete") == "OK") {
            $unit_id =   $this->request->getPost("unit_id");
            $this->db
                ->table("unit")
                ->delete(array("unit_id" =>  $unit_id));
            $data["message"] = "Delete Success";
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'unit_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $builder = $this->db->table('unit');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $unit_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;

        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'unit_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $this->db->table('unit')->update($input, array("unit_id" => $this->request->getPost("unit_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
