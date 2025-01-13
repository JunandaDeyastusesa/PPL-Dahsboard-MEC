<?php

include_once './OOP/koneksi.php';

class Controller extends koneksi
{
    public function query($data)
    {
        $perintah_data = $this->koneksi->query($data);
        if (!$perintah_data) {
            die("Terjadi Kesalahan pada Prepare Statement" . $this->koneksi->error);
        }
        return $perintah_data;
    }

    public function prepare($data)
    {
        $perintah_data = $this->koneksi->prepare($data);
        if (!$perintah_data) {
            die("Terjadi Kesalahan pada Prepare Statement" . $this->koneksi->error);
        }
        return $perintah_data;
    }

    public function Add($id_siswa, $id_kelas, $tanggal, $status)
{
    // Query untuk menambahkan data
    $add_query = "INSERT INTO absensi (id_siswa,id_kelas, tanggal, status) VALUES (?, ?, ?,?)";
    $add_statement = $this->prepare($add_query); // Pastikan $this->db adalah koneksi database

    if ($add_statement) {
        // Bind parameter
        $add_statement->bind_param("ssss", $id_siswa,$id_kelas, $tanggal, $status);

        // Eksekusi query
        if ($add_statement->execute()) {
            echo "<script>alert('Data berhasil ditambahkan!');</script>";
            header("Location: indexmentor.php"); // Ganti dengan nama file tujuan Anda
            exit(); // Pastikan untuk menghentikan eksekusi setelah redirect
        } else {
            echo "<script>alert('Terjadi kesalahan saat menambahkan data.');</script>";
            $add_statement->close();
            return false;
        }
    } else {
        echo "<script>alert('Gagal menyiapkan query.');</script>";
        return false;
    }
}
    public function ViewAbsen($id){
        $member = "SELECT * 
           FROM absensi
           JOIN table_siswa 
           ON absensi.id_siswa = table_siswa.id_siswa 
           JOIN table_paket_kls
           ON absensi.id_kelas = table_paket_kls.id_kelas
           WHERE absensi.id_siswa = $id";
        $perintah = $this->query($member);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        return $perintah;
    }
    public function ViewById($data)
    {
        $id_siswa = intval($data);
        // var_dump($id_siswa);
        $ViewByid_siswa = "SELECT * FROM table_siswa WHERE id_siswa=?";
        if ($statement = $this->prepare($ViewByid_siswa)) {
            $statement->bind_param("i", $id_siswa);
            if ($statement->execute()) {
                $statement->store_result();
                $statement->bind_result($this->id_siswa, $this->nama, $this->siswa_no_telp, $this->tanggal_lahir, $this->alamat, $this->tgl_daftar);
                $statement->fetch();
                if ($statement->num_rows == 1) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        $statement->close();
    }

    public function ViewKelas()
    {
        $member = 'SELECT * FROM table_paket_kls';
        $perintah = $this->query($member);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        return $perintah;
    }

    public function ViewKelasSeleksi()
    {
        $member = 'SELECT * FROM table_paket_kls';
        $perintah = $this->query($member);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        return $perintah;
    }
    
    public function ViewAbsenById($data)
    {
        $id_siswa = intval($data);
        // var_dump($id_siswa);
        $ViewByid_siswa = "SELECT * FROM absen WHERE id_siswa=?";
        if ($statement = $this->prepare($ViewByid_siswa)) {
            $statement->bind_param("i", $id_siswa);
            if ($statement->execute()) {
                $statement->store_result();
                $statement->bind_result($this->tanggal, $this->status);
                $statement->fetch();
            }
        }
        $statement->close();
    }
}