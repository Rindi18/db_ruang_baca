<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAnggota;
use App\Models\ModelAngkatan;

class DashboardAnggota extends BaseController
{
    protected $ModelAnggota;
    protected $ModelAngkatan;
    public function __construct()
    {
       helper('form');
       $this->ModelAnggota = new ModelAnggota();
       $this->ModelAngkatan = new ModelAngkatan();

    }
    public function index()
    {
        $id_anggota = session()->get('id_anggota');
        $data = [
            'menu' => 'dashboard',
            'submenu' => '',
            'judul' => 'Profile Anggota',
            'page' => 'v_dashboard_anggota',
            'anggota' => $this->ModelAnggota->ProfileAnggota($id_anggota),
        ];
        return view('v_template_anggota',$data);
    }
    public function EditProfil()
    {
        $id_anggota = session()->get('id_anggota');
        $data = [
            'menu' => 'dashboard',
            'submenu' => '',
            'judul' => ' Edit Profile Anggota',
            'page' => 'v_edit_profile_anggota',
            'anggota' => $this->ModelAnggota->ProfileAnggota($id_anggota),
            'angkatan' => $this->ModelAngkatan->AllData(),
        ];
        return view('v_template_anggota',$data);
    }

    public function UpdateProfile()
    {
        $id_anggota = session()->get('id_anggota');
        if ($this->validate([
            'angkatan' => [
                'label' => 'Angkatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Belum Dipilih !',
                ]
            ],
            'nim' => [
                'label' => 'NIM',
                'rules' => 'required',
                'errors' =>[
                    'required' => '{field} Masih Kosong !',
                    'is_unique' => '{field} Sudah Terdaftar !',
                ]
            ],
            'nama_mahasiswa' => [
                'label' => 'Mahasiswa',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Masih Kosong !',
                ]
            ],
            'jenis_kelamin' => [
                'label' => 'Jenis Kelamin',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Belum Dipilih !',
                ]
            ],
            'no_hp' => [
                'label' => 'No Handphone',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Masih Kosong !',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Masih Kosong !',
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Masih Kosong !',
                ]
            ],
            'foto' => [
                'label' => 'Foto Anggota',
                'rules' => 'mime_in[foto,image/png,image/jpg,image/gif/,image/jpeg]',
                'errors' => [
                    'mime_in' => 'Format {field} Harus PNG,JPG,GIF,JPEG, !',
                ]
            ],
            
        ])){
            //jika lolos validasi
            $foto = $this->request->getFile('foto');
            if ($foto->getError() == 4) {
                //jika tidak mengganti gambar
                $data = [
                    'id_anggota' => $id_anggota,
                    'id_angkatan' => $this->request->getPost('angkatan'),
                    'nim' => $this->request->getPost('nim'),
                    'nama_mahasiswa' => $this->request->getPost('nama_mahasiswa'),
                    'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                    'no_hp' => $this->request->getPost('no_hp'),
                    'password' => $this->request->getPost('password'),
                    'alamat' => $this->request->getPost('alamat'),
                    'verifikasi' => '1',
                ];
                $this->ModelAnggota->EditData($data);

            }else {
                //hapus foto lama
                $anggota = $this->ModelAnggota->DetailData($id_anggota);
                if ($anggota['foto'] <> '') {
                    unlink('foto/' . $anggota['foto']);
                }
                //jika mengganti foto
                $nama_file = $foto->getRandomName();
                $data = [
                'id_anggota' => $id_anggota,
                'id_angkatan' => $this->request->getPost('angkatan'),
                'nim' => $this->request->getPost('nim'),
                'nama_mahasiswa' => $this->request->getPost('nama_mahasiswa'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'no_hp' => $this->request->getPost('no_hp'),
                'password' => $this->request->getPost('password'),
                'alamat' => $this->request->getPost('alamat'),
                'verifikasi' => '1',
                'foto' => $nama_file,
             ];
            $foto->move('foto', $nama_file);
            $this->ModelAnggota->EditData($data);

            }
            session()->setFlashdata('pesan','Data Anggota Berhasil Diupdate !');
            return redirect()->to(base_url('DashboardAnggota/EditProfil'));
        }else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('DashboardAnggota/EditProfil'));
        }
    
    }
}
