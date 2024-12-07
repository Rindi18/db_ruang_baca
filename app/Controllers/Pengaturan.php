<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPengaturan;

class Pengaturan extends BaseController
{
    protected $ModelPengaturan;
    public function __construct()
    {
       helper('form');
       $this->ModelPengaturan = new ModelPengaturan();

    }
    public function Web()
    {
        
        $data = [
            'menu' => 'pengaturan',
            'submenu' => 'web',
            'judul' => 'Pengaturan WEB',
            'page' => 'v_pengaturan_web',
            'web' => $this->ModelPengaturan->DetailWeb(),
        ];
        return view('v_template_admin',$data);
    }
    public function UpdateWeb()
    {
        if ($this->validate([
            'nama_fakultas' => [
                'label' => 'Nama Fakultas',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'kecamatan' => [
                'label' => 'Kecamatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'kab_kota' => [
                'label' => 'Kabupaten / Kota',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'kode_pos' => [
                'label' => 'Kode Pos',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'kontak' => [
                'label' => 'Kontak',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],

            'sejarah' => [
                'label' => 'Sejarah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],

            'visi' => [
                'label' => 'Visi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],

            'misi' => [
                'label' => 'Misi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'logo' => [
                'label' => 'Logo Fakultas',
                'rules' => 'mime_in[logo,image/png,image/jpg,image/gif/,image/jpeg]',
                'errors' => [
                    'mime_in' => 'Format {field} Harus PNG,JPG,GIF,JPEG, !',
                ]
            ],


        ])) {
            //jika lolos validasi
            $logo = $this->request->getFile('logo');

            if ($logo->getError() == 4) {
                //jika tidak ganti gambar/foto
                $data = [
                    'id_web' => '1',
                    'nama_fakultas' => $this->request->getPost('nama_fakultas'),
                    'alamat' => $this->request->getPost('alamat'),
                    'kecamatan' => $this->request->getPost('kecamatan'),
                    'kab_kota' => $this->request->getPost('kab_kota'),
                    'kode_pos' => $this->request->getPost('kode_pos'),
                    'kontak' => $this->request->getPost('kontak'),
                    'sejarah' => $this->request->getPost('sejarah'),
                    'visi' => $this->request->getPost('visi'),
                    'misi' => $this->request->getPost('misi'),
                ];
                //memindahkan/upload file foto ke dalam folder foto
                $this->ModelPengaturan->UpdateWeb($data);
            } else {
                //hapus foto lama
                $web = $this->ModelPengaturan->DetailWeb();
                if ($web['logo'] <> '') {
                    unlink('logo/' . $web['logo']);
                }
                //jika ganti gambar/foto
                $nama_file = $logo->getRandomName();
                $data = [
                    'id_web' => '1',
                    'nama_fakultas' => $this->request->getPost('nama_fakultas'),
                    'alamat' => $this->request->getPost('alamat'),
                    'kecamatan' => $this->request->getPost('kecamatan'),
                    'kab_kota' => $this->request->getPost('kab_kota'),
                    'kode_pos' => $this->request->getPost('kode_pos'),
                    'kontak' => $this->request->getPost('kontak'),
                    'sejarah' => $this->request->getPost('sejarah'),
                    'visi' => $this->request->getPost('visi'),
                    'misi' => $this->request->getPost('misi'),
                    'logo' => $nama_file,
                ];
                //memindahkan/upload file foto ke dalam folder foto
                $logo->move('logo', $nama_file);
                $this->ModelPengaturan->UpdateWeb($data);

            }
            session()->setFlashdata('pesan', 'Data Web Berhasil Diupdate !');
            return redirect()->to(base_url('Pengaturan/web'));
        } else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Pengaturan/web'));
        }
    }

    public function Slider()
    {
        $data = [
            'menu' => 'pengaturan',
            'submenu' => 'slider',
            'judul' => 'Data Slider',
            'page' => 'v_slider',
            'slider' => $this->ModelPengaturan->Slider(),
        ];
        return view('v_template_admin',$data);
    }

    public function EditSlider($id_slider)
    {
        if ($this->validate([
            'slider' => [
                'label' => ' Gambar Slider',
                'rules' => 'uploaded[slider]|mime_in[slider,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'mime_in' => 'Format {field} Harus PNG,JPG,JPEG, !',
                ]
            ],


        ])) {
            //jika lolos validasi
            $slider = $this->request->getFile('slider');
            //hapus foto lama
            $file = $this->ModelPengaturan->DetailSlider($id_slider);
            if ($file && isset($file['slider']) && $file['slider'] !== ''){
                unlink('slider/' . $file['slider']);
            }
            //jika ganti gambar/foto
            $nama_file = $slider->getRandomName();
            $data = [
                'id_slider' => $id_slider,
                'slider' => $nama_file,
            ];
            //memindahkan/upload file foto ke dalam folder foto
            $slider->move('slider', $nama_file);
            $this->ModelPengaturan->UpdateSlider($data);

            session()->setFlashdata('pesan', 'Slider Berhasil Diganti !');
            return redirect()->to(base_url('Pengaturan/Slider'));
        } else {
            //jika tidak lolos validasi
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Pengaturan/Slider'));
        }
    }
    
}
