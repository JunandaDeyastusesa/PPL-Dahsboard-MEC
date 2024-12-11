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

    public function View()
    {
        $member = 'SELECT * FROM table_paket_kls';
        $perintah = $this->query($member);
        if (!$perintah) {
            die("Error : " . $this->koneksi->error);
        }
        return $perintah;
    }

    public function Add($id_kelas , $nama_kelas, $kapasitas_kelas, $harga)
    {
        $check_query = "SELECT id_kelas  FROM table_paket_kls WHERE id_kelas  = ?";
        $check_statement = $this->prepare($check_query);
        $check_statement->bind_param("s", $id_kelas );
        $check_statement->execute();
        $check_statement->store_result();

        if ($check_statement->num_rows > 0) {
            echo "<script> alert('Maaf, Id Sudah ada'); </script>";
            return false;
        } else {
            // If id_kelas  doesn't exist, proceed with insertion
            $_Add = "INSERT INTO table_paket_kls (id_kelas , nama_kelas, kapasitas_kelas, harga) VALUES (?, ?, ?, ?)";

            if ($_statement = $this->prepare($_Add)) {
                $_statement->bind_param("ssss", $param_id_kelas , $param_nama_kelas, $param_kapasitas_kelas, $param_harga);

                $param_id_kelas  = $id_kelas ;
                $param_nama_kelas = $nama_kelas;
                $param_kapasitas_kelas = $kapasitas_kelas;
                $param_harga = $harga;

                if ($_statement->execute()) {
                    echo "<script> alert('Data berhasil ditambahkan!'); </script>";
                    $_statement->close();
                    return true;
                } else {
                    $_statement->close();
                    return false;
                }
            } else {
                return false;
            }
        }
    }
}
