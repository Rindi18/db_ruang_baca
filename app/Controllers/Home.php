<?php

namespace App\Controllers;
use App\Models\ModelPengaturan;
use App\Models\ModelBuku;
class Home extends BaseController
{
    protected $ModelPengaturan;
    protected $ModelBuku;
    public function __construct()
    {
       helper('form');
       $this->ModelPengaturan = new ModelPengaturan();
       $this->ModelBuku = new ModelBuku();

    }
    public function index(): string
    {
        $data = [
            'judul' => 'Home',
            'page' => 'v_home',
            'slider' => $this->ModelPengaturan->Slider(),
            'buku' => $this->ModelBuku->BukuBaru(),
        ];
        return view('v_template',$data);
    }

    public function Sejarah()
    {
        $data = [
            'judul' => 'Sejarah',
            'page' => 'v_sejarah',
            'profile' => $this->ModelPengaturan->DetailWeb(),
        ];
        return view('v_template',$data);
    }

    public function VisiMisi()
    {
        $data = [
            'judul' => 'Visi & Misi',
            'page' => 'v_visi_misi',
            'profile' => $this->ModelPengaturan->DetailWeb(),
        ];
        return view('v_template',$data);
    }
    public function GalleryBuku()
    {
        $data = [
            'judul' => 'Gallery Buku',
            'page' => 'v_gallery_buku',
            'buku' => $this->ModelBuku->AllData(),
        ];
        return view('v_template',$data);
    }
    public function DetailBuku()
    {
        $data = [
            'judul' => 'Gallery Buku',
            'page' => 'v_gallery_buku',
            'buku' => $this->ModelBuku->AllData(),
        ];
        return view('v_template',$data);
    }
}
