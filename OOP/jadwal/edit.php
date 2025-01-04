<?php

require_once '../koneksi.php';
require_once 'controller.php';

$obj = new controller();

if (!$obj->ViewById($_GET['id_jadwal'])) {
    die("Error : id_jadwal Mahasiswa Tidak Ada");
}

$_ViewKelas = $obj->ViewKelas();
$_ViewMentor = $obj->ViewMentor();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_jadwal = $_POST['id_jadwal'];
    $nama_mentor = $_POST['nama_mentor'];
    $nama_kelas = $_POST['nama_kelas'];
    $no_ruangan = $_POST['no_ruangan'];
    $hari = $_POST['hari'];
    $jam_kelas = $_POST['jam_kelas'];
    if ($obj->Edit($id_jadwal, $nama_kelas, $nama_mentor, $no_ruangan, $hari, $jam_kelas)) {
        // echo '<div> SUKSES </div>';
        echo '<meta http-equiv="refresh" content="0">';
    } else {
        echo '<div> GAGAL </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/style.css">
    <title>Jadwal</title>
</head>

<body>
    <div class="container">
        <section class="Out-Edit-Siswa">
            <div class="overlay-edit"></div>
            <div class="EditSiswa">
                <h2>Edit Siswa</h2>
                <div class="PopUpEdit" id="popupEdit">
                    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                        <div class="mb-3">
                            <label for="id_jadwal" class="form-label">ID Jadwal:</label>
                            <input type="text" class="form-control bg-light" id="id_jadwal" name="id_jadwal" value="<?php echo $obj->id_jadwal; ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="nama_mentor" class="form-label">Mentor:</label>
                            <select name="nama_mentor" class="form-select">
                                <?php
                                if ($_ViewMentor) {
                                    while ($data_mentor = mysqli_fetch_array($_ViewMentor)) {
                                        $selected = ($obj->id_mentor == $data_mentor['id_mentor']) ? 'selected' : '';
                                        echo '<option value="' . $data_mentor['id_mentor'] . '" ' . $selected . '>' . $data_mentor['nama_mentor'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama_kelas" class="form-label">Nama Kelas:</label>
                            <select name="nama_kelas" class="form-select">
                                <?php
                                if ($_ViewKelas) {
                                    while ($data_kelas = mysqli_fetch_array($_ViewKelas)) {
                                        $selected = ($obj->id_kelas == $data_kelas['id_kelas']) ? 'selected' : '';
                                        echo '<option value="' . $data_kelas['id_kelas'] . '" ' . $selected . '>' . $data_kelas['nama_kelas'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="no_ruangan" class="form-label">Ruangan:</label>
                            <input type="number" class="form-control" id="no_ruangan" name="no_ruangan" value="<?php echo $obj->no_ruang; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="hari" class="form-label">Hari:</label>
                            <select class="form-select" id="hari" name="hari">
                                <option value="Senin" <?php echo ($obj->hari == 'Senin') ? 'selected' : ''; ?>>Senin</option>
                                <option value="Selasa" <?php echo ($obj->hari == 'Selasa') ? 'selected' : ''; ?>>Selasa</option>
                                <option value="Rabu" <?php echo ($obj->hari == 'Rabu') ? 'selected' : ''; ?>>Rabu</option>
                                <option value="Kamis" <?php echo ($obj->hari == 'Kamis') ? 'selected' : ''; ?>>Kamis</option>
                                <option value="Jumat" <?php echo ($obj->hari == 'Jumat') ? 'selected' : ''; ?>>Jumat</option>
                                <option value="Sabtu" <?php echo ($obj->hari == 'Sabtu') ? 'selected' : ''; ?>>Sabtu</option>
                                <option value="Minggu" <?php echo ($obj->hari == 'Minggu') ? 'selected' : ''; ?>>Minggu</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="jam_kelas" class="form-label">Jam Kelas:</label>
                            <input type="time" class="form-control" id="jam_kelas" name="jam_kelas" value="<?php echo $obj->jam_kelas; ?>">
                        </div>

                        <div class="d-flex">
                            <input class="btn btn-primary" type="submit" value="Submit">
                            <a class="btn btn-outline-secondary ms-auto" href="index_jadwal.php">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>

</html>