<?php

require_once '../koneksi.php';
require_once 'controller.php';

$obj = new controller();
$data = $obj->View();


// if (!$obj->ViewById($_GET['id_mentor'])) {
//     die("Error : id_mentor tidak ditemukan");
// }

if ($data === false) {
    die("Error: " . $koneksi->error);
}
$no = 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_mentor = $_POST['id_mentor'];
    $nama_mentor = $_POST['nama_mentor'];
    $email = $_POST['email'];
    $telp = $_POST['telp'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    if ($obj->Add($id_mentor, $nama_mentor, $email, $telp, $tgl_lahir, $alamat)) {
        echo '<meta http-equiv="refresh" content="0">';
    } else {
        // echo '<div> GAGAL </div>';
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
                                <a class="nav-link" href="../member/member.php">
                                    <img src="../../assets/ikon/Siswa.svg" alt="">Siswa
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="../peket_kelas/index.php">
                                    <img src="../../assets/ikon/active-pkt-kls.svg" alt="">Paket Kelas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="../mentor/index.php">
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
                        <h1>Data Mentor</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                        <a class="btn-add btn btn-primary" onclick="togglePopup()">Tambah</a>                    
                    </div>
                    </div>
                    <div class="popup" id="myPopup">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <h2>Silahkan Tambahkan Data</h2>
                        <label for="id_mentor">ID Mentor:</label>
                        <input type="number" id="id_mentor" name="id_mentor" required><br><br>

                        <label for="nama_mentor">Nama Mentor:</label>
                        <input type="text" id="nama_mentor" name="nama_mentor" required><br><br>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required><br><br>

                        <label for="telp">Telp:</label>
                        <input type="number" id="telp" name="telp" required><br><br>

                        <label for="tgl_lahir">Tanggal Lahir:</label>
                        <input type="date" id="tgl_lahir" name="tgl_lahir" required><br><br>

                        <label for="alamat">Alamat:</label>
                        <textarea id="alamat" name="alamat" rows="4" cols="30" required></textarea><br><br>

                        <input class="btn-add-submit" type="submit" value="Submit">
                        <button onclick="togglePopup()">Tutup Popup</button>
                    </form>
                </div>
                <div class="overlay" id="overlay"></div>
                    
                    

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-secondary">
                            
                            <tr class="text-center">
                                <th class="py-2">No</th>
                                <th class="py-2">ID Mentor</th>
                                <th class="py-2">Nama Mentor</th>
                                <th class="py-2">Email</th>
                                <th class="py-2">No Telp</th>
                                <th class="py-2">Tanggal Lahir</th>
                                <th class="py-2">Alamat</th>
                                <th class="py-2">Aksi</th>
                            </tr>
                            </thead>
                            <tbody class="table-group-divider">
                            <?php
                            while ($row = $data->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no ?></td>
                                    <td class="text-center"><?php echo $row['id_mentor']; ?></td>
                                    <td class="text-center"><?php echo $row['nama_mentor']; ?></td>
                                    <td class="text-center"><?php echo $row['email']; ?></td>
                                    <td class="text-center"><?php echo $row['telp']; ?></td>
                                    <td class="text-center"><?php echo $row['tgl_lahir']; ?></td>
                                    <td class="text-center"><?php echo $row['alamat']; ?></td>
                                    <td class="btn-aksi td-no text-center">
                                        <a class="btn btn-sm btn-outline-warning" onclick="showEditPopup(<?php echo $row['id_mentor']; ?>)">Edit</a>

                                    <a class="btn btn-sm btn-outline-danger" onclick="showDelPopup(<?php echo $row['id_mentor']; ?>)">Delete</a>

                                    </td>
                                    
                                </tr>
                                <?php $no += 1;
                        } ?>
                            </tbody>
                        </table>
                    </div>
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

        function showEditPopup(id_mentor) {
            // Mendapatkan elemen div yang digunakan untuk menampilkan konten popup
            var popupContent = document.querySelector('.popup-content');

            // Buat XMLHttpRequest untuk memuat konten dari member_edit.php
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
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
            xhr.open('GET', 'edit.php?id_mentor=' + id_mentor, true);
            xhr.send();
        }

        function showDelPopup(id_mentor) {
            // Mendapatkan elemen div yang digunakan untuk menampilkan konten popup
            var popupContentDel = document.querySelector('.popup-content-del');

            // Buat XMLHttpRequest untuk memuat konten dari member_edit.php
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
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

        logoutButton.addEventListener('click', function(event) {
            event.preventDefault();
            const confirmation = confirm('Apakah Anda yakin untuk keluar?');
            if (confirmation) {
                window.location.href = '../logout.php';
            }
        });
    </script>


</body>

</html>