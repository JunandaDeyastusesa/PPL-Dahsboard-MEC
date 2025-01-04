<?php

require_once '../koneksi.php';
require_once 'controller.php';

$obj = new controller();

if (!$obj->ViewById($_GET['id_kelas'])) {
    die("Error : ID Kelas Tidak Ada");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($obj->DeleteById($obj->id_kelas)) {
        echo '<div> SUKSES </div>';
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
    <title>Delete</title>
</head>

<body>
    <div class="container">
        <section class="">
            <div class="overlay-edit"></div>
            <div class="HapusSiswaByNim">
                <p class="alert-del">Yakin Mau Hapus :</p>
                <h5><?php echo $obj->nama_kelas; ?> (<?php echo $obj->id_kelas; ?> )</h5>

                <div class="Delete" id="popup">
                    <form class="Del-In" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                        <div class="d-flex justify-content-between align-items-center">
                            <button class="btn btn-danger" type="submit">Ya, Saya Yakin</button>
                            <a class="btn btn-outline-secondary" href="index.php">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>

</html>