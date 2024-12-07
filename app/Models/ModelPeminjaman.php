<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPeminjaman extends Model
{
    public function AddData($data)
    {
        $this->db->table('tbl_peminjaman')->insert($data);
    }

    public function PengajuanBuku($id_anggota)
    {
        return $this->db->table('tbl_peminjaman')
            ->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjaman.id_buku', 'left')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_buku.id_kategori', 'left')
            ->join('tbl_penerbit', 'tbl_penerbit.id_penerbit = tbl_buku.id_penerbit', 'left')
            ->join('tbl_penulis', 'tbl_penulis.id_penulis = tbl_buku.id_penulis', 'left')
            ->join('tbl_rak', 'tbl_rak.id_rak = tbl_buku.id_rak', 'left')
            ->where('tbl_peminjaman.id_anggota', $id_anggota) // Filter berdasarkan id_anggota
            ->where('status_pinjam', 'Diajukan') // Filter status peminjaman
            ->orderBy('tbl_peminjaman.tgl_pengajuan', 'DESC')
            ->get()->getResultArray();
    }
    public function PengajuanBukuDiterima($id_anggota)
    {
        return $this->db->table('tbl_peminjaman')
            ->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjaman.id_buku', 'left')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_buku.id_kategori', 'left')
            ->join('tbl_penerbit', 'tbl_penerbit.id_penerbit = tbl_buku.id_penerbit', 'left')
            ->join('tbl_penulis', 'tbl_penulis.id_penulis = tbl_buku.id_penulis', 'left')
            ->join('tbl_rak', 'tbl_rak.id_rak = tbl_buku.id_rak', 'left')
            ->where('tbl_peminjaman.id_anggota', $id_anggota) // Filter berdasarkan id_anggota
            ->where('status_pinjam', 'Diterima') // Filter status peminjaman
            ->orderBy('tbl_peminjaman.tgl_pengajuan', 'DESC')
            ->get()->getResultArray();
    }
    public function PengajuanBukuDitolak($id_anggota)
    {
        return $this->db->table('tbl_peminjaman')
            ->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjaman.id_buku', 'left')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_buku.id_kategori', 'left')
            ->join('tbl_penerbit', 'tbl_penerbit.id_penerbit = tbl_buku.id_penerbit', 'left')
            ->join('tbl_penulis', 'tbl_penulis.id_penulis = tbl_buku.id_penulis', 'left')
            ->join('tbl_rak', 'tbl_rak.id_rak = tbl_buku.id_rak', 'left')
            ->where('tbl_peminjaman.id_anggota', $id_anggota) // Filter berdasarkan id_anggota
            ->where('status_pinjam', 'Ditolak') // Filter status peminjaman
            ->orderBy('tbl_peminjaman.tgl_pengajuan', 'DESC')
            ->get()->getResultArray();
    }
    public function DeleteData($data)
    {
    $this->db->table('tbl_peminjaman')
        ->where('id_pinjam', $data['id_pinjam'])
        ->delete($data);

    }

    //============bagian admin========================================================
    public function PengajuanMasuk()
    {
        return $this->db->table('tbl_peminjaman')
            ->join('tbl_anggota', 'tbl_anggota.id_anggota = tbl_peminjaman.id_anggota', 'left')
            ->join('tbl_angkatan', 'tbl_angkatan.id_angkatan = tbl_anggota.id_angkatan', 'left')
            ->where('status_pinjam', 'Diajukan')
            ->selectCount('tbl_peminjaman.id_anggota','qty')
            ->select('tbl_anggota.id_anggota,tbl_anggota.nim,tbl_anggota.nama_mahasiswa,tbl_anggota.foto,tbl_angkatan.nama_angkatan')
            ->groupBy('tbl_peminjaman.id_anggota')
            ->get()->getResultArray();
    }

    public function EditData($data)
    {
        $this->db->table('tbl_peminjaman')
            ->where('id_pinjam', $data['id_pinjam'])
            ->update($data);
    }

    public function PengajuanDiterima()
    {
        return $this->db->table('tbl_peminjaman')
            ->join('tbl_anggota', 'tbl_anggota.id_anggota = tbl_peminjaman.id_anggota', 'left')
            ->join('tbl_angkatan', 'tbl_angkatan.id_angkatan = tbl_anggota.id_angkatan', 'left')
            ->where('status_pinjam', 'Diterima')
            ->selectCount('tbl_peminjaman.id_anggota','qty')
            ->select('tbl_anggota.id_anggota,tbl_anggota.nim,tbl_anggota.nama_mahasiswa,tbl_anggota.foto,tbl_angkatan.nama_angkatan')
            ->groupBy('tbl_peminjaman.id_anggota')
            ->get()->getResultArray();
    }

    public function PengajuanDitolak()
    {
        return $this->db->table('tbl_peminjaman')
            ->join('tbl_anggota', 'tbl_anggota.id_anggota = tbl_peminjaman.id_anggota', 'left')
            ->join('tbl_angkatan', 'tbl_angkatan.id_angkatan = tbl_anggota.id_angkatan', 'left')
            ->where('status_pinjam', 'Ditolak')
            ->selectCount('tbl_peminjaman.id_anggota','qty')
            ->select('tbl_anggota.id_anggota,tbl_anggota.nim,tbl_anggota.nama_mahasiswa,tbl_anggota.foto,tbl_angkatan.nama_angkatan')
            ->groupBy('tbl_peminjaman.id_anggota')
            ->get()->getResultArray();
    }
}

