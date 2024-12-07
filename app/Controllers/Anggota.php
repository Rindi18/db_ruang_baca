<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAnggota;
use App\Models\ModelAngkatan;
class Anggota extends BaseController
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
        $data = [
            'menu' => 'masteranggota',
            'submenu' => 'anggota',
            'judul' => 'Anggota',
            'page' => 'anggota/v_index',
            'anggota' => $this->ModelAnggota->AllData(),
        ];
        return view('v_template_admin',$data);
    }

    public function Verifikasi($id_anggota)
    {
        $data = [
            'id_anggota' => $id_anggota,
            'verifikasi' => '1',
        ];
        $this->ModelAnggota->EditData($data);
        session()->setFlashdata('pesan','Anggota Berhasil Di Verifikasi!');
        return redirect()->to(base_url('Anggota'));
    }

    public function AddData()
    {
        $data = [
            'menu' => 'masteranggota',
            'submenu' => 'anggota',
            'judul' => 'Tambah Data Anggota',
            'page' => 'anggota/v_adddata',
            'angkatan' => $this->ModelAngkatan->AllData(),
        ];
        return view('v_template_admin',$data);
    }

    public function SimpanData()
    {
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
                'rules' => 'required|is_unique[tbl_anggota.nim]',
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
                'rules' => 'uploaded[foto]|mime_in[foto,image/png,image/jpg,image/gif/,image/jpeg]',
                'errors' => [
                    'uploaded' => '{field} Wajib Diisi !',
                    'mime_in' => 'Format {field} Harus PNG,JPG,GIF,JPEG, !',
                ]
            ],
            
        ])){
            //jika lolos validasi
            $foto = $this->request->getFile('foto');
            $nama_file = $foto->getRandomName();
            $data = [
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
            $this->ModelAnggota->AddData($data);
            session()->setFlashdata('pesan','Data Anggota Berhasil Disimpan !');
            return redirect()->to(base_url('Anggota/AddData'));
        }else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Anggota/AddData'))->withInput('validation', \Config\Services::validation());
        }
    }

    public function EditData($id_anggota)
    {
        $data = [
            'menu' => 'masteranggota',
            'submenu' => 'anggota',
            'judul' => 'Edit Data Anggota',
            'page' => 'anggota/v_editdata',
            'angkatan' => $this->ModelAngkatan->AllData(),
            'anggota' => $this->ModelAnggota->DetailData($id_anggota),
        ];
        return view('v_template_admin', $data);
    }

    public function UpdateData($id_anggota)
    {
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
            return redirect()->to(base_url('Anggota'));
        }else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Anggota/EditData/' . $id_anggota));
        }
    }

    public function DeleteData($id_anggota)
    {
        //hapus foto lama
        $anggota = $this->ModelAnggota->DetailData($id_anggota);
        if ($anggota['foto'] <> '') {
            unlink('foto/' . $anggota['foto']);
        }

        $data = ['id_anggota' => $id_anggota];
        $this->ModelAnggota->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil Dihapus !');
        return redirect()->to(base_url('Anggota'));
    }

}
