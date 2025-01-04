<?php

require_once './OOP/koneksi.php';
require_once './controllerAbs.php';

$obj = new controller();

if (!$obj->ViewById($_GET['id_siswa'])) {
    die("Error : id_siswa Tidak Ada");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_siswa = $_POST['id_siswa'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];
    if ($obj->Add($id_siswa, $tanggal, $status)) {
        echo '<meta http-equiv="refresh" content="0">';
    } else {
        echo '<meta http-equiv="refresh" content="0">';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/style.css">
    <title>Member</title>
</head>

<body>
    <div class="container">
        <section class="Out-Edit-Siswa">
            <div class="overlay-edit"></div>
            <div class="EditSiswa">
                <h2>Edit Siswa</h2>
                <div class="PopUpEdit" id="popupEdit">
                    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

                        <label for="nama_mentor">Nama Siswa:</label>
                        <input type="text" id="nama_mentor" name="nama"
                            value="<?php echo $obj->nama; ?>" disabled><br><br>
                        <input type="text" id="id_siswa"  name="id_siswa"
                        value="<?php echo $obj->id_siswa; ?>" hidden>

                        <label for="email">Tanggal:</label>
                        <input type="date" id="email" name="tanggal" value=""><br><br>

                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" name="status" aria-label="Floating label select example">
                                <option selected>Pilih Kehadiran</option>
                                <option value="hadir">Hadir</option>
                                <option value="tidak hadir">Tidak Hadir</option>
                            </select>
                            <label for="floatingSelect">Kehadiran</label>
                        </div>

                        <!-- <input type="submit" value="Submit"> -->
                        <button type="submit" class="btn btn-sm btn-primary px-4 mt-3">Submit</button>
                        <a class="btn-back-edit mt-3" href="./indexmentor.php">Kembali</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>

</html>