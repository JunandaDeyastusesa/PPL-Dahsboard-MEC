<?php

require_once '../koneksi.php';
require_once 'controller.php';

$obj = new controller();
$data = $obj->ViewSiswa();

if ($data === false) {
    die("Error: " . $koneksi->error);
}
$no = 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_siswa = $_POST['id_siswa'];
    $nama = $_POST['nama'];
    $siswa_no_telp = $_POST['siswa_no_telp'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $tgl_daftar = $_POST['tgl_daftar'];
    if ($obj->AddSiswa($id_siswa, $nama, $siswa_no_telp, $tanggal_lahir, $alamat, $tgl_daftar)) {
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
    <title>Kelas</title>
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Data Kelas</title>
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../../assets/style.css">
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <nav class="col-md-2 col-lg-2 d-md-block sidebar">
                    <div class="sidebar-menu position-sticky pt-3">
                        <div class="text-center mb-4">
                            <img src="../../assets/ikon/Logo-MEC.png" alt="Logo" class="img-fluid" style="max-width: 120px; padding-top: 30px">
                        </div>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="../../index.php">
                                    <img src="../../assets/ikon/Dashboard.svg" alt="">Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../index.php">
                                    <img src="../../assets/ikon/list-check.svg" alt="">Absensi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../pembayaran/index.php">
                                    <img src="../../assets/ikon/payment.svg" alt="">Pembayaran
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="../member/member.php">
                                    <img src="../../assets/ikon/Siswa.svg" alt="">Siswa
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../peket_kelas/index.php">
                                    <img src="../../assets/ikon/active-pkt-kls.svg" alt="">Paket Kelas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../mentor/index.php">
                                    <img src="../../assets/ikon/Mentor.svg" alt="">Mentor
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../jadwal/index_jadwal.php">
                                    <img src="../../assets/ikon/Jadwal.svg" alt="">Jadwal
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../fasilitas/index.php">
                                    <img src="../../assets/ikon/fasilitas.svg" alt="">Fasilitas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link log-out-btn">
                                    <img src="../../assets/ikon/logout.svg" alt="">Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <!-- Main Content -->
                <main class="content col-md-10 ms-sm-auto col-lg-10 px-md-4">
                    <div class="title-page d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3 mb-3">
                        <h1>Data Siswa</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKelasModal">
                                Tambah
                            </button>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                    <table class="table table-hover">
                            <thead class="table-secondary">
                                <tr>
                                    <th class="py-2">No</th>
                                    <th class="py-2">ID Member</th>
                                    <th class="py-2">Tanggal Daftar</th>
                                    <th class="py-2">Nama Siswa</th>
                                    <th class="py-2">No. Telepon</th>
                                    <th class="py-2">Tgl Lahir</th>
                                    <th class="py-2">Alamat</th>
                                    <th class="py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">

                            <?php
                            while ($row = $data->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no; ?></td>
                                    <td class="text-center"><?php echo $row['id_siswa']; ?></td>
                                    <td class="text-center"><?php echo $row['tgl_daftar']; ?></td>
                                    <td class="text-center"><?php echo $row['nama']; ?></td>
                                    <td class="text-center"><?php echo $row['siswa_no_telp']; ?></td>
                                    <td class="text-center"><?php echo $row['tanggal_lahir']; ?></td>
                                    <td class="text-center"><?php echo $row['alamat']; ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-warning me-2" onclick="showEditPopup(<?php echo $row['id_siswa']; ?>)">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="showDelPopup(<?php echo $row['id_siswa']; ?>)">Hapus</button>
                                    </td>
                                    <?php $no += 1;
                            } ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>

        <!-- Tambah Kelas Modal -->
        <div class="modal fade modal-add" id="tambahKelasModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
                            <div class="mb-3">
                                <label for="id_siswa" class="form-label">ID Siswa:</label>
                                <input type="number" class="form-control" id="id_siswa" name="id_siswa" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_daftar" class="form-label">Tanggal Daftar:</label>
                                <input type="date" class="form-control" id="tanggal_daftar" name="tgl_daftar" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama:</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_telepon" class="form-label">No Telepon:</label>
                                <input type="number" class="form-control" id="no_telepon" name="siswa_no_telp" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir:</label>
                                <input type="date" class="form-control" id="kapasitas_kelas" name="tanggal_lahir" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat:</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4 mt-3">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Kelas Modal -->
        <div class="myPopupEdit" id="EditSiswa">
                <div class="Edit" id="popup">
                    <div class="popup-content">
                    </div>
                </div>
            </div>

            <div class="myPopupDel" id="DelSiswa">
                <div class="Del" id="popup">
                    <div class="popup-content-del">
                    </div>
                </div>
            </div>

        <script>
        function togglePopup() {
            var popup = document.getElementById("myPopup");
            var overlay = document.getElementById("overlay");
            if (popup.style.display === "block") {
                popup.style.display = "none";
                overlay.style.display = "none";
            } else {
                popup.style.display = "block";
                overlay.style.display = "block";
            }
        }

        function showEditPopup(id_siswa) {
            var popupContent = document.querySelector('.popup-content');

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        popupContent.innerHTML = xhr.responseText;
                        document.getElementById('editPopup').style.display = 'block';
                    } else {
                        console.error('Error: ' + xhr.status);
                    }
                }
            };
            xhr.open('GET', 'member_edit.php?id_siswa=' + id_siswa, true);
            xhr.send();
        }

        function showDelPopup(id_siswa) {
            var popupContentDel = document.querySelector('.popup-content-del');

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        popupContentDel.innerHTML = xhr.responseText;
                        document.getElementById('editPopup').style.display = 'block';
                    } else {
                        console.error('Error: ' + xhr.status);
                    }
                }
            };
            xhr.open('GET', 'member_delete.php?id_siswa=' + id_siswa, true);
            xhr.send();
        }

        //KONFIRMASI LOGOUT
        const logoutButton = document.querySelector('.log-out-btn');

        logoutButton.addEventListener('click', function(event) {
            event.preventDefault();
            const confirmation = confirm('Apakah Anda yakin untuk keluar?');
            if (confirmation) {
                window.location.href = '../logout.php';
            }
        });
    </script>

        <!-- Bootstrap 5 JS and Popper.js -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    </body>

    </html>

</body>

</html>