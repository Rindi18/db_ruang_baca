<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAngkatan extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_angkatan')
            ->orderBy('id_angkatan', 'ASC')
            ->get()->getResultArray();
    }

    public function AddData($data)
    {
        $this->db->table('tbl_angkatan')->insert($data);
    }
    public function DeleteData($data)
    {
        $this->db->table('tbl_angkatan')
            ->where('id_angkatan', $data['id_angkatan'])
            ->delete($data);
    }
    public function EditData($data)
    {
        $this->db->table('tbl_angkatan')
            ->where('id_angkatan', $data['id_angkatan'])
            ->update($data);
    }
}
