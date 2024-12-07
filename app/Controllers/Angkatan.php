<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAngkatan;

class Angkatan extends BaseController
{
    protected $ModelAngkatan;
    public function __construct()
    {
       helper('form');
       $this->ModelAngkatan = new ModelAngkatan();

    }
    public function index()
    {
        $data = [
            'menu' => 'masteranggota',
            'submenu' => 'angkatan',
            'judul' => 'Angkatan',
            'page' => 'v_angkatan',
            'angkatan' => $this->ModelAngkatan->AllData(),
        ];
        return view('v_template_admin',$data);
    }
    public function AddData()
    {
        $data = [
            'nama_angkatan' => $this->request->getPost('nama_angkatan'),
        ];
        $this->ModelAngkatan->AddData($data);
        session()->setFlashdata('pesan','Data Berhasil Ditambahkan');
        return redirect()->to(base_url('Angkatan'));
    }

    public function EditData($id_angkatan)
    {
        $data = [
            'id_angkatan' => $id_angkatan,
            'nama_angkatan' => $this->request->getPost('nama_angkatan'),
        ];
        $this->ModelAngkatan->EditData($data);
        session()->setFlashdata('pesan','Data Berhasil Di Update !');
        return redirect()->to(base_url('Angkatan'));
    }

    public function DeleteData($id_angkatan)
    {
        $data = ['id_angkatan' => $id_angkatan];
        $this->ModelAngkatan->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil Dihapus !');
        return redirect()->to(base_url('Angkatan'));
    }
}
