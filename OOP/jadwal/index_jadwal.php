<?php

require_once '../koneksi.php';
require_once 'controller.php';

$obj = new controller();
$data = $obj->ViewRelasi();

$_ViewKelas = $obj->ViewKelas();
$_ViewMentor = $obj->ViewMentor();

if ($data === false) {
    die("Error: " . $koneksi->error);
}
$no = 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_jadwal = $_POST['id_jadwal'];
    $nama_mentor = $_POST['nama_mentor'];
    $nama_kelas = $_POST['nama_kelas'];
    $no_ruangan = $_POST['no_ruangan'];
    $hari = $_POST['hari'];
    $jam_kelas = $_POST['jam_kelas'];
    if ($obj->AddJadwal($id_jadwal, $nama_kelas, $nama_mentor, $no_ruangan, $hari, $jam_kelas)) {
        // echo '<div> SUKSES </div>';
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jadwal Kelas</title>
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
                            <a class="nav-link" href="../member/member.php">
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
                            <a class="nav-link active" href="../jadwal/index_jadwal.php">
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
                    <h1>Jadwal Kelas</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKelasModal">
                            Tambah
                        </button>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead class="table-secondary">
                            <tr>
                                <th class="py-2 text-center">No</th>
                                <th class="py-2 text-center">ID Jadwal</th>
                                <th class="py-2">Nama Kelas</th>
                                <th class="py-2 text-center">No Ruangan</th>
                                <th class="py-2">Mentor</th>
                                <th class="py-2">Hari</th>
                                <th class="py-2 text-center">Jam Kelas</th>
                                <th class="py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                            while ($row = $data->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td class="td-no"><?php echo $no; ?></td>
                                    <td class="td-no"><?php echo $row['id_jadwal']; ?></td>
                                    <td><?php echo $row['nama_kelas']; ?></td>
                                    <td class="td-no"><?php echo $row['no_ruang']; ?></td>
                                    <td><?php echo $row['nama_mentor']; ?></td>
                                    <td><?php echo $row['hari'], ' '; ?></td>
                                    <td class="td-no">
                                        <?php
                                        $jam_kelas = $row['jam_kelas'];
                                        $jam_mulai = date('H:i -', strtotime($jam_kelas));
                                        echo $jam_mulai;

                                        $waktu_tambahan = strtotime($jam_kelas) + (6000); // detik (100 Menit)
                                        $jam_selesai = date(' H:i', $waktu_tambahan);
                                        echo $jam_selesai;
                                        ?>
                                    </td>
                                    <td class="text-center">
                                    <a class="btn btn-sm btn-outline-warning" onclick="showEditPopup(<?php echo $row['id_jadwal']; ?>)">Edit</a>

                                    <button class="btn btn-sm btn-outline-danger" onclick="showDelPopup(<?php echo $row['id_jadwal']; ?>)">Hapus</button>
                                    </td>
                                </tr>
                            <?php $no += 1;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
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

    <!-- Tambah Kelas Modal -->
    <div class="modal fade modal-add" id="tambahKelasModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="mb-3">
                            <label for="id_jadwal" class="form-label">ID Jadwal:</label>
                            <input type="number" class="form-control" id="id_jadwal" name="id_jadwal" required>
                        </div>

                        <div class="mb-3">
                            <label for="nama_mentor" class="form-label">Mentor:</label>
                            <select name="nama_mentor" class="form-select" required>
                                <option value="">-- Pilih Mentor --</option>
                                <?php
                                if ($_ViewMentor) {
                                    while ($data_mentor = mysqli_fetch_array($_ViewMentor)) {
                                        echo '<option value="' . $data_mentor['id_mentor'] . '">' . $data_mentor['nama_mentor'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama_kelas" class="form-label">Nama Kelas:</label>
                            <select name="nama_kelas" class="form-select" required>
                                <option value="">-- Pilih Kelas --</option>
                                <?php
                                if ($_ViewKelas) {
                                    while ($data_kelas = mysqli_fetch_array($_ViewKelas)) {
                                        echo '<option value="' . $data_kelas['id_kelas'] . '">' . $data_kelas['nama_kelas'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="no_ruangan" class="form-label">Ruangan:</label>
                            <input type="number" class="form-control" id="no_ruangan" name="no_ruangan" required>
                        </div>

                        <div class="mb-3">
                            <label for="hari" class="form-label">Hari:</label>
                            <select name="hari" class="form-select" required>
                                <option value="">-- Pilih Hari --</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jam_kelas" class="form-label">Jam Kelas:</label>
                            <input type="time" class="form-control" id="jam_kelas" name="jam_kelas" required>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4 mt-3">Submit</button>
                            <button type="button" class="btn btn-secondary px-4 mt-3 ms-2" onclick="togglePopup()">Tutup Popup</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap 5 JS and Popper.js -->
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

        function showEditPopup(id_jadwal) {
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

            // Kirim permintaan untuk member_edit.php dengan id_jadwal yang dipilih
            xhr.open('GET', 'edit.php?id_jadwal=' + id_jadwal, true);
            xhr.send();
        }

        function showDelPopup(id_jadwal) {
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

            // Kirim permintaan untuk member_edit.php dengan id_jadwal yang dipilih
            xhr.open('GET', 'delete.php?id_jadwal=' + id_jadwal, true);
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>