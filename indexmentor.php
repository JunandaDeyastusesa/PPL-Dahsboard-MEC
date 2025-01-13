<?php

session_start();

// Cek apakah pengguna sudah login, jika tidak, redirect ke halaman login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ./OOP/login.php");
    exit;
}
$no = 1;

require_once './OOP/koneksi.php';
// require_once './OOP/controller.php';
require_once './OOP/member/controller.php';

$obj = new controller();

$data = $obj->ViewSiswa();

// Proses login saat formulir dikirim
// $objekController = new Controller(); // Ubah "controller()" menjadi "Controller()"

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="icon" href="../../assets/ikon/Logo-MEC.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Mentor</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 col-lg-2 d-md-block sidebar">
                <div class="sidebar-menu position-sticky pt-3">
                    <div class="text-center mb-4">
                        <img class="logo" src="./assets/ikon/Logo-MEC.png" alt="">
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="indexmentor.php">
                                <img src="./assets/ikon/Dashboard.svg" alt="">Dashboard
                            </a>
                        </li>

                        <li class="nav-item" stye="cursonr:pointer">
                            <a class="nav-link log-out-btn">
                                <img src="./assets/ikon/logout.svg" alt="">Logout
                            </a>
                        </li>


                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="content col-md-10 ms-sm-auto col-lg-10 px-md-4">
                <div class="content">


                    <div class="operplow">
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">ID Member</th>
                                    <th class="text-center">Tgl Daftar</th>
                                    <th class="text-center">Nama Siswa</th>
                                    <th class="text-center">No Telp</th>
                                    <th class="text-center">Tanggal Lahir</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                while ($row = $data->fetch_assoc()) {
                                    ?>
                                    <tr class="">
                                        <td class="td-no">
                                            <?php echo $no; ?>
                                        </td>
                                        <td class="td-no">
                                            <?php echo $row['id_siswa']; ?>
                                        </td>
                                        <td class="td-no">
                                            <?php echo $row['tgl_daftar']; ?>
                                        </td>
                                        <td class="nama">
                                            <?php echo $row['nama']; ?>
                                        </td>
                                        <td class="td-no">
                                            <?php echo $row['siswa_no_telp']; ?>
                                        </td>
                                        <td class="td-no">
                                            <?php echo $row['tanggal_lahir']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['alamat']; ?>
                                        </td>
                                        <td class="btn-aksi text-center">
                                        <a href="indexabsensipersiswa.php?id_siswa=<?php echo $row['id_siswa']; ?>" class=" btn btn-sm btn-transparent" style="border: 0.7px solid #410075; "
                                                >Detail Absensi</a>
                                            <a class="btn btn-sm btn-outline-warning" onclick="showEditPopup(<?php echo $row['id_siswa']; ?>)">
                                                Absensi
                                            </a>
                                        </td>
                                        <?php $no += 1;
                                } ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- <div class="Edit" id="popup">
                    <div class="popup-content">
                    </div>
                </div> -->
                <div class="myPopupEdit" id="EditSiswa">
                    <div class="Edit" id="popup">
                        <div class="popup-content">
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
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
            // Mendapatkan elemen div yang digunakan untuk menampilkan konten popup
            var popupContent = document.querySelector('.popup-content');

            // Buat XMLHttpRequest untuk memuat konten dari member_edit.php
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Isi konten dari member_edit.php ke dalam popup
                        popupContent.innerHTML = xhr.responseText;
                        // Tampilkan popup
                        document.getElementById('editPopup').style.display = 'block';
                    } else {
                        console.error('Error: ' + xhr.status);
                    }
                }
            };

            // Kirim permintaan untuk member_edit.php dengan id_mentor yang dipilih
            xhr.open('GET', 'absenfunc.php?id_siswa=' + id_siswa, true);
            xhr.send();
        }

        function showDelPopup(id_mentor) {
            // Mendapatkan elemen div yang digunakan untuk menampilkan konten popup
            var popupContentDel = document.querySelector('.popup-content-del');

            // Buat XMLHttpRequest untuk memuat konten dari member_edit.php
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Isi konten dari member_edit.php ke dalam popup
                        popupContentDel.innerHTML = xhr.responseText;
                        // Tampilkan popup
                        document.getElementById('editPopup').style.display = 'block';
                    } else {
                        console.error('Error: ' + xhr.status);
                    }
                }
            };

            // Kirim permintaan untuk member_edit.php dengan id_mentor yang dipilih
            xhr.open('GET', 'delete.php?id_mentor=' + id_mentor, true);
            xhr.send();
        }

        //KONFIRMASI LOGOUT
        const logoutButton = document.querySelector('.log-out-btn');

        logoutButton.addEventListener('click', function (event) {
            event.preventDefault();
            const confirmation = confirm('Apakah Anda yakin untuk keluar?');
            if (confirmation) {
                window.location.href = './OOP/logout.php';
            }
        });
    </script>


</body>

</html>