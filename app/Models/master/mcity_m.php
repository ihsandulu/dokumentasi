<?php

namespace App\Models\master;

use App\Models\core_m;

class mcity_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek city
        if ($this->request->getVar("city_id")) {
            $cityd["city_id"] = $this->request->getVar("city_id");
        } else {
            $cityd["city_id"] = -1;
        }
        $us = $this->db
            ->table("city")
            ->getWhere($cityd);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "city_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $city) {
                foreach ($this->db->getFieldNames('city') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $city->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('city') as $field) {
                $data[$field] = "";
            }
        }



        //delete
        if ($this->request->getPost("delete") == "OK") {
            $city_id =   $this->request->getPost("city_id");
            $this->db
                ->table("city")
                ->delete(array("city_id" =>  $city_id));
            $data["message"] = "Delete Success";
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'city_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $builder = $this->db->table('city');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $city_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;

        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'city_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $this->db->table('city')->update($input, array("city_id" => $this->request->getPost("city_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
