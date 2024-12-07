<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;

class User extends BaseController
{
    protected $ModelUser;
    public function __construct()
    {
       helper('form');
       $this->ModelUser = new ModelUser();

    }
    public function index()
    {
        $data = [
            'menu' => 'pengaturan',
            'submenu' => 'user',
            'judul' => 'User',
            'page' => 'user/v_index',
            'user' => $this->ModelUser->AllData(),
        ];
        return view('v_template_admin',$data);
    }
    public function AddData()
    {
        $data = [
            'menu' => 'pengaturan',
            'submenu' => 'user',
            'judul' => 'Tambah Data User',
            'page' => 'user/v_adddata',
            'user' => $this->ModelUser->AllData(),
        ];
        return view('v_template_admin',$data);
    }
    public function SimpanData()
    {
        if ($this->validate([
            'nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'email' => [
                'label' => 'E-mail',
                'rules' => 'required|is_unique[tbl_user.email]',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                    'is_unique' => '{field} Sudah Digunakan, Cari E-mail Lain !',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'no_hp' => [
                'label' => 'No Handphone',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'level' => [
                'label' => 'Level',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'foto' => [
                'label' => 'Foto User',
                'rules' => 'uploaded[foto]|mime_in[foto,image/png,image/jpg,image/gif/,image/jpeg]',
                'errors' => [
                    'uploaded' => '{field} Wajib Diisi !',
                    'mime_in' => 'Format {field} Harus PNG,JPG,GIF,JPEG, !',
                ]
            ],


        ])) {
            //jika lolos validasi
            $foto = $this->request->getFile('foto');
            $nama_file = $foto->getRandomName();
            $data = [
                'nama_user' => $this->request->getPost('nama_user'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'no_hp' => $this->request->getPost('no_hp'),
                'level' => $this->request->getPost('level'),
                'foto' => $nama_file,
            ];
            //memindahkan/upload file foto ke dalam folder foto
            $foto->move('foto', $nama_file);
            $this->ModelUser->AddData($data);
            session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan !');
            return redirect()->to(base_url('User'));
        } else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('User/AddData'))->withInput('validation', \Config\Services::validation());
        }
    }

    public function EditData($id_user)
    {
        $data = [
            'menu' => 'pengaturan',
            'submenu' => 'user',
            'judul' => 'Edit Data User',
            'page' => 'user/v_editdata',
            'user' => $this->ModelUser->DetailData($id_user),
        ];
        return view('v_template_admin',$data);
    }

    public function UpdateData($id_user)
    {
        if ($this->validate([
            'nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'email' => [
                'label' => 'E-mail',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'no_hp' => [
                'label' => 'No Handphone',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'level' => [
                'label' => 'Level',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'foto' => [
                'label' => 'Foto User',
                'rules' => 'mime_in[foto,image/png,image/jpg,image/gif/,image/jpeg]',
                'errors' => [
                    'mime_in' => 'Format {field} Harus PNG,JPG,GIF,JPEG, !',
                ]
            ],


        ])) {
            //jika lolos validasi
            $foto = $this->request->getFile('foto');

            if ($foto->getError() == 4) {
                //jika tidak ganti gambar/foto
                $data = [
                    'id_user' => $id_user,
                    'nama_user' => $this->request->getPost('nama_user'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password'),
                    'no_hp' => $this->request->getPost('no_hp'),
                    'level' => $this->request->getPost('level'),
                ];
                //memindahkan/upload file foto ke dalam folder foto
                $this->ModelUser->EditData($data);
            } else {
                //hapus foto lama
                $user = $this->ModelUser->DetailData($id_user);
                if ($user['foto'] <> '') {
                    unlink('foto/' . $user['foto']);
                }
                //jika ganti gambar/foto
                $nama_file = $foto->getRandomName();
                $data = [
                    'id_user' => $id_user,
                    'nama_user' => $this->request->getPost('nama_user'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password'),
                    'no_hp' => $this->request->getPost('no_hp'),
                    'level' => $this->request->getPost('level'),
                    'foto' => $nama_file,
                ];
                //memindahkan/upload file foto ke dalam folder foto
                $foto->move('foto', $nama_file);
                $this->ModelUser->EditData($data);

            }
            session()->setFlashdata('pesan', 'Data Berhasil Diupdate !');
            return redirect()->to(base_url('User'));
        } else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('User/EditData' . $id_user));
        }
    }
    
    public function DeleteData($id_user)
    {
        //hapus foto lama
        $user = $this->ModelUser->DetailData($id_user);
        if ($user['foto'] <> '') {
            unlink('foto/' . $user['foto']);
        }

        $data = ['id_user' => $id_user];
        $this->ModelUser->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil Dihapus !');
        return redirect()->to(base_url('User'));
    }
}
