<?php

include_once '../koneksi.php';

class Controller extends koneksi
{
    public function prepare($data)
    {
        $perintah_data = $this->koneksi->prepare($data);
        if (!$perintah_data) {
            die("Terjadi Kesalahan pada Prepare Statement" . $this->koneksi->error);
        }
        return $perintah_data;
    }

    public function query($data)
    {
        $perintah_data = $this->koneksi->query($data);
        if (!$perintah_data) {
            die("Terjadi Kesalahan pada Prepare Statement" . $this->koneksi->error);
        }
        return $perintah_data;
    }

    public function ViewSiswa()
    {
        $member = 'SELECT * FROM table_siswa';
        $perintah = $this->query($member);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        return $perintah;
    }

    public function ViewKelas()
    {
        $sqlMentor = 'SELECT * FROM table_paket_kls';
        $perintah = $this->query($sqlMentor);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        return $perintah;
    }

    public function ViewRelasiBayar()
    {
        $_ViewRelasi = "SELECT * FROM table_pembayaran 
                        INNER JOIN table_siswa ON table_pembayaran.id_siswa = table_siswa.id_siswa
                        INNER JOIN table_paket_kls ON table_pembayaran.id_kelas = table_paket_kls.id_kelas ORDER BY id_bayar ASC";
        $perintah = $this->query($_ViewRelasi);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        return $perintah;
    }
}