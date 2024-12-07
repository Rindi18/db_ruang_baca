<?php

namespace App\Controllers;
use App\Models\ModelAuth;
use App\Models\ModelAngkatan;

class Auth extends BaseController
{
    protected $ModelAuth; 
    protected $ModelAngkatan;
    public function __construct()
    {
        helper('form');
        $this->ModelAuth = new ModelAuth;
        $this->ModelAngkatan = new ModelAngkatan();
    }
    public function index(): string
    {
        $data = [
            'judul' => 'Login',
            'page' => 'v_login'
        ];
        return view('v_template_login',$data);
    }

    public function LoginUser()
    {
        $data = [
            'judul' => 'Login User',
            'page' => 'v_login_user'
        ];
        return view('v_template_login',$data);

    }
    public function CekLoginUser()
    {
        if ($this->validate([
            'email' => [
                'label' => 'E-mail',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} Masih Kosong !',
                    'valid_email' => '{field} Harus Format E-mail !',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' =>[
                    'required' => '{field} Masih Kosong !',
                ]
            ]
        ])){
            //jika entry valid
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $cek_login = $this->ModelAuth->LoginUser($email, $password);
            if ($cek_login) {
                session()->set('id_user', $cek_login['id_user']);
                session()->set('nama_user', $cek_login['nama_user']);
                session()->set('email', $cek_login['email']);
                session()->set('level', $cek_login['level']);
                return redirect()->to(base_url('Admin'));
            }else{
                //jika gagal login karna password atau email salah
                session()->setFlashdata('pesan','E-mail atau Password salah !');
                return redirect()->to(base_url('Auth/LoginUser'));

            }
        }else{
            //jika entry tidak valid
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Auth/LoginUser'));

        }
        
    }
    public function LoginAnggota()
    {
        $data = [
            'judul' => 'Login Anggota',
            'page' => 'v_login_Anggota'
        ];
        return view('v_template_login',$data);
    }
    public function Logout()
    {
        session()->remove('id_user');
        session()->remove('nama_user');
        session()->remove('email');
        session()->remove('level');
        session()->setFlashdata('pesan','Logout Sukses !');
        return redirect()->to(base_url('Auth/LoginUser'));

    }

    public function LogoutAnggota()
    {
        session()->remove('id_anggota');
        session()->remove('nama_mahasiswa');
        session()->remove('level');
        session()->setFlashdata('pesan','Logout Sukses !');
        return redirect()->to(base_url('Auth/LoginAnggota'));

    }

    public function Register()
    {
        $data = [
            'judul' => 'Daftar Anggota',
            'page' => 'v_daftar_Anggota',
            'angkatan' => $this->ModelAngkatan->AllData(),
        ];
        return view('v_template_login' ,$data);
    }

    public function Daftar()
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
            'ulangi_password' => [
                'label' => 'Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} Masih Kosong !',
                    'matches' => '{field} Tidak Sama Dengan Password Sebelumnya',
                ]
            ],
        ])){
            //jika lolos validasi
            $data = [
                'id_angkatan' => $this->request->getPost('angkatan'),
                'nim' => $this->request->getPost('nim'),
                'nama_mahasiswa' => $this->request->getPost('nama_mahasiswa'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'no_hp' => $this->request->getPost('no_hp'),
                'password' => $this->request->getPost('password'),
                'verifikasi' => '0',
            ];
            $this->ModelAuth->Daftar($data);
            session()->setFlashdata('pesan','Pendaftaran Berhasil, Silahkan Login');
            return redirect()->to(base_url('Auth/Register'));
        }else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Auth/Register'))->withInput('validation', \Config\Services::validation());
        }
    }

    public function CekLoginAnggota()
    {
        if ($this->validate([
            'nim' => [
                'label' => 'NIM',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Masih Kosong !',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' =>[
                    'required' => '{field} Masih Kosong !',
                ]
            ]
        ])){
            //jika entry valid
            $nim = $this->request->getPost('nim');
            $password = $this->request->getPost('password');
            $cek_login = $this->ModelAuth->LoginAnggota($nim, $password);
            if ($cek_login) {
                //jika login berhasil
                session()->set('id_anggota', $cek_login['id_anggota']);
                session()->set('nama_mahasiswa', $cek_login['nama_mahasiswa']);
                session()->set('level', 'Anggota');
                return redirect()->to(base_url('DashboardAnggota'));
            }else{
                //jika gagal login karna password atau email salah
                session()->setFlashdata('pesan','NIM atau Password salah !');
                return redirect()->to(base_url('Auth/LoginAnggota'));

            }
        }else{
            //jika entry tidak valid
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Auth/LoginAnggota'));

        }
        
    }
}
