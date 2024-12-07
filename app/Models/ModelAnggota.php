<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAnggota extends Model
{
    public function ProfileAnggota($id_anggota)
    {
        return $this->db->table('tbl_anggota')
            ->join('tbl_angkatan', 'tbl_anggota.id_angkatan = tbl_angkatan.id_angkatan', 'left')
            ->where('id_anggota', $id_anggota)
            ->get()->getRowArray();
    }

    public function AllData()
    {
        return $this->db->table('tbl_anggota')
            ->join('tbl_angkatan', 'tbl_anggota.id_angkatan = tbl_angkatan.id_angkatan', 'left')
            ->orderBy('id_anggota', 'DESC')
            ->groupBy('tbl_anggota.id_anggota')
            ->get()->getResultArray();
    }

    public function EditData($data)
    {
        $this->db->table('tbl_anggota')
            ->where('id_anggota', $data['id_anggota'])
            ->update($data);
    }

    public function AddData($data)
    {
        $this->db->table('tbl_anggota')->insert($data);
    }
    public function DetailData($id_anggota)
    {
        return $this->db->table('tbl_anggota')
            ->join('tbl_angkatan', 'tbl_angkatan.id_angkatan = tbl_angkatan.id_angkatan', 'left')
            ->where('id_anggota', $id_anggota)
            ->get()->getRowArray();
    }

    public function DeleteData($data)
    {
        $this->db->table('tbl_anggota')
            ->where('id_anggota', $data['id_anggota'])
            ->delete($data);
    }


}
