<?php

session_start();

// Cek apakah pengguna sudah login, jika tidak, redirect ke halaman login
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true) {
    header("location: ./OOP/login.php");
    exit;
}

if($_SESSION["role"]!=="admin"){
    header("location: ./OOP/login.php");
    exit;
}



require_once './OOP/koneksi.php';
require_once './OOP/controller.php';

$obj = new controller();

$_ViewMentor = $obj->ViewMentor();
$_ViewChart = $obj->CountRegistrationsByMonth();
$_ViewJadwal = $obj->ViewRelasiJadwal();

$jumlahMentor = $obj->JumlahMentor();
$jumlahKelas = $obj->JumlahKelas();
$jumlahSiswa = $obj->JumlahSiswa();

$dataSummary = $obj->SummaryAttendanceByDate();

$no = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Dashboard</title>
</head>

<body>
    <div class="container-fluid">
        <!-- Sidebar -->
        <div class="row">
            <nav class="col-md-2 col-lg-2 d-md-block sidebar">
                <div class="sidebar-menu position-sticky pt-3">
                    <div class="text-center mb-4">
                        <img src="./assets/ikon/Logo-MEC.png" alt="Logo" class="img-fluid" style="max-width: 120px; padding-top: 30px">
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="../../index.php">
                                <img src="./assets/ikon/Dashboard.svg" alt="">Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="./indexAbsenAdmin.php">
                                <img src="./assets/ikon/list-check.svg" alt="">Absensi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./OOP/pembayaran/index.php">
                                <img src="./assets/ikon/payment.svg" alt="">Pembayaran
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./OOP/member/member.php">
                                <img src="./assets/ikon/Siswa.svg" alt="">Siswa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./OOP/peket_kelas/index.php">
                                <img src="./assets/ikon/active-pkt-kls.svg" alt="">Paket Kelas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./OOP/mentor/index.php">
                                <img src="./assets/ikon/Mentor.svg" alt="">Mentor
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./OOP/jadwal/index_jadwal.php">
                                <img src="./assets/ikon/Jadwal.svg" alt="">Jadwal
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./OOP/fasilitas/index.php">
                                <img src="./assets/ikon/fasilitas.svg" alt="">Fasilitas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link log-out-btn">
                                <img src="./assets/ikon/logout.svg" alt="">Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <section class="col-md-10 ms-sm-auto">
                <div class="dashboard">
                    <div class="top mt-1">
                        <h1 class="mt-5 pb-3">Dashboard</h1>
                    </div>
                    <div class="bottom">
                        <div class="content content-left">
                            <div class="left-top">
                                <div class="col-left-top">
                                    <p>Jumlah Siswa</p>
                                    <h1><?php echo $jumlahSiswa ?></h1>
                                </div>
                                <div class="col-left-top">
                                    <p>Paket Kelas</p>
                                    <h1><?php echo $jumlahKelas ?></h1>
                                </div>
                                <div class="col-left-top">
                                    <p>Jumlah Mentor</p>
                                    <h1><?php echo $jumlahMentor ?></h1>
                                </div>
                            </div>
                            <div class="left-bottom">
                                <h5 class="mb-4">Jumlah Kehadiran</h5>
                                <div class="scroll-mentor">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="no">No</th>
                                                <th>Tanggal</th>
                                                <th class="text-center">Hadir</th>
                                                <th class="text-center">Tidak Hadir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Iterasi data dari fungsi SummaryAttendanceByDate
                                            if (!empty($dataSummary)) {
                                                foreach ($dataSummary as $row) {
                                                    // Filter data: hanya tampilkan jika 'tanggal' tidak kosong
                                                    if (!empty($row['tanggal'])) {
                                            ?>
                                                        <tr>
                                                            <td class="no"><?php echo $no; ?></td>
                                                            <td><?php echo date('d / m / Y', strtotime($row['tanggal'])); ?></td>
                                                            <td class="text-center"><?php echo $row['jumlah_hadir']; ?></td>
                                                            <td class="text-center"><?php echo $row['jumlah_tidak_hadir']; ?></td>
                                                        </tr>
                                            <?php
                                                        $no++;
                                                    }
                                                }
                                            } else {
                                                echo "<tr><td colspan='4'>No data available</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="content content-right">
                            <div class="col-right-bottom">
                                <p class="jadwal-p text-center pt-2">Jadwal Kelas</p>
                                <div class="col-hari-jadwal">
                                    <a href="#Senin" class="col-jadwal">
                                        <p>Sen</p>
                                    </a>
                                    <a href="#Selasa" class="col-jadwal">
                                        <p>Sel</p>
                                    </a>
                                    <a href="#Rabu" class="col-jadwal">
                                        <p>Rab</p>
                                    </a>
                                    <a href="#Kamis" class="col-jadwal">
                                        <p>Kam</p>
                                    </a>
                                    <a href="#Jumat" class="col-jadwal">
                                        <p>Jum</p>
                                    </a>
                                    <a href="#Sabtu" class="col-jadwal">
                                        <p>Sab</p>
                                    </a>
                                    <a href="#Minggu" class="col-jadwal">
                                        <p>Min</p>
                                    </a>
                                </div>
                                <div class="col-isi-jadwal hidden-section" id="Senin"> <!-- Hapus kelas hidden-section -->
                                    <?php
                                    foreach ($_ViewJadwal as $item) {
                                        if ($item['hari'] == 'Senin') {
                                    ?>
                                            <div class="jadwal-bimbel">
                                                <div class="col-jadwal-left">
                                                    <p class="jadwal-pri">Ruang <?php echo $item['no_ruang']; ?></p>
                                                    <p class="jadwal-sec">
                                                        <?php
                                                        $jam_kelas = $item['jam_kelas'];
                                                        $jam_mulai = date('H:i -', strtotime($jam_kelas));
                                                        echo $jam_mulai;

                                                        $waktu_tambahan = strtotime($jam_kelas) + (6000); // detik (100 Menit)
                                                        $jam_selesai = date(' H:i', $waktu_tambahan);
                                                        echo $jam_selesai;
                                                        ?>
                                                    </p>
                                                </div>
                                                <!-- <hr> -->
                                                <div class="col-jadwal-right">
                                                    <p class="jadwal-pri"><?php echo $item['nama_kelas']; ?></p>
                                                    <p class="jadwal-sec"><?php echo $item['nama_mentor']; ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="col-isi-jadwal hidden-section" id="Selasa">
                                    <?php
                                    foreach ($_ViewJadwal as $item) {
                                        if ($item['hari'] == 'Selasa') {
                                    ?>
                                            <div class="jadwal-bimbel">
                                                <div class="col-jadwal-left">
                                                    <p class="jadwal-pri">Ruang <?php echo $item['no_ruang']; ?></p>
                                                    <p class="jadwal-sec">
                                                        <?php
                                                        $jam_kelas = $item['jam_kelas'];
                                                        $jam_mulai = date('H:i -', strtotime($jam_kelas));
                                                        echo $jam_mulai;

                                                        $waktu_tambahan = strtotime($jam_kelas) + (6000); // detik (100 Menit)
                                                        $jam_selesai = date(' H:i', $waktu_tambahan);
                                                        echo $jam_selesai;
                                                        ?>
                                                    </p>
                                                </div>
                                                <!-- <hr> -->
                                                <div class="col-jadwal-right">
                                                    <p class="jadwal-pri"><?php echo $item['nama_kelas']; ?></p>
                                                    <p class="jadwal-sec"><?php echo $item['nama_mentor']; ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="col-isi-jadwal hidden-section" id="Rabu">
                                    <?php
                                    foreach ($_ViewJadwal as $item) {
                                        if ($item['hari'] == 'Rabu') {
                                    ?>
                                            <div class="jadwal-bimbel">
                                                <div class="col-jadwal-left">
                                                    <p class="jadwal-pri">Ruang <?php echo $item['no_ruang']; ?></p>
                                                    <p class="jadwal-sec">
                                                        <?php
                                                        $jam_kelas = $item['jam_kelas'];
                                                        $jam_mulai = date('H:i -', strtotime($jam_kelas));
                                                        echo $jam_mulai;

                                                        $waktu_tambahan = strtotime($jam_kelas) + (6000); // detik (100 Menit)
                                                        $jam_selesai = date(' H:i', $waktu_tambahan);
                                                        echo $jam_selesai;
                                                        ?>
                                                    </p>
                                                </div>
                                                <!-- <hr> -->
                                                <div class="col-jadwal-right">
                                                    <p class="jadwal-pri"><?php echo $item['nama_kelas']; ?></p>
                                                    <p class="jadwal-sec"><?php echo $item['nama_mentor']; ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="col-isi-jadwal hidden-section" id="Kamis">
                                    <?php
                                    foreach ($_ViewJadwal as $item) {
                                        if ($item['hari'] == 'Kamis') {
                                    ?>
                                            <div class="jadwal-bimbel">
                                                <div class="col-jadwal-left">
                                                    <p class="jadwal-pri">Ruang <?php echo $item['no_ruang']; ?></p>
                                                    <p class="jadwal-sec">
                                                        <?php
                                                        $jam_kelas = $item['jam_kelas'];
                                                        $jam_mulai = date('H:i -', strtotime($jam_kelas));
                                                        echo $jam_mulai;

                                                        $waktu_tambahan = strtotime($jam_kelas) + (6000); // detik (100 Menit)
                                                        $jam_selesai = date(' H:i', $waktu_tambahan);
                                                        echo $jam_selesai;
                                                        ?>
                                                    </p>
                                                </div>
                                                <!-- <hr> -->
                                                <div class="col-jadwal-right">
                                                    <p class="jadwal-pri"><?php echo $item['nama_kelas']; ?></p>
                                                    <p class="jadwal-sec"><?php echo $item['nama_mentor']; ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="col-isi-jadwal hidden-section" id="Jumat">
                                    <?php
                                    foreach ($_ViewJadwal as $item) {
                                        if ($item['hari'] == 'Jumat') {
                                    ?>
                                            <div class="jadwal-bimbel">
                                                <div class="col-jadwal-left">
                                                    <p class="jadwal-pri">Ruang <?php echo $item['no_ruang']; ?></p>
                                                    <p class="jadwal-sec">
                                                        <?php
                                                        $jam_kelas = $item['jam_kelas'];
                                                        $jam_mulai = date('H:i -', strtotime($jam_kelas));
                                                        echo $jam_mulai;

                                                        $waktu_tambahan = strtotime($jam_kelas) + (6000); // detik (100 Menit)
                                                        $jam_selesai = date(' H:i', $waktu_tambahan);
                                                        echo $jam_selesai;
                                                        ?>
                                                    </p>
                                                </div>
                                                <!-- <hr> -->
                                                <div class="col-jadwal-right">
                                                    <p class="jadwal-pri"><?php echo $item['nama_kelas']; ?></p>
                                                    <p class="jadwal-sec"><?php echo $item['nama_mentor']; ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="col-isi-jadwal hidden-section" id="Sabtu">
                                    <?php
                                    foreach ($_ViewJadwal as $item) {
                                        if ($item['hari'] == 'Sabtu') {
                                    ?>
                                            <div class="jadwal-bimbel">
                                                <div class="col-jadwal-left">
                                                    <p class="jadwal-pri">Ruang <?php echo $item['no_ruang']; ?></p>
                                                    <p class="jadwal-sec">
                                                        <?php
                                                        $jam_kelas = $item['jam_kelas'];
                                                        $jam_mulai = date('H:i -', strtotime($jam_kelas));
                                                        echo $jam_mulai;

                                                        $waktu_tambahan = strtotime($jam_kelas) + (6000); // detik (100 Menit)
                                                        $jam_selesai = date(' H:i', $waktu_tambahan);
                                                        echo $jam_selesai;
                                                        ?>
                                                    </p>
                                                </div>
                                                <!-- <hr> -->
                                                <div class="col-jadwal-right">
                                                    <p class="jadwal-pri"><?php echo $item['nama_kelas']; ?></p>
                                                    <p class="jadwal-sec"><?php echo $item['nama_mentor']; ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="col-isi-jadwal hidden-section" id="Minggu">
                                    <?php
                                    foreach ($_ViewJadwal as $item) {
                                        if ($item['hari'] == 'Minggu') {
                                    ?>
                                            <div class="jadwal-bimbel">
                                                <div class="col-jadwal-left">
                                                    <p class="jadwal-pri">Ruang <?php echo $item['no_ruang']; ?></p>
                                                    <p class="jadwal-sec">
                                                        <?php
                                                        $jam_kelas = $item['jam_kelas'];
                                                        $jam_mulai = date('H:i -', strtotime($jam_kelas));
                                                        echo $jam_mulai;

                                                        $waktu_tambahan = strtotime($jam_kelas) + (6000); // detik (100 Menit)
                                                        $jam_selesai = date(' H:i', $waktu_tambahan);
                                                        echo $jam_selesai;
                                                        ?>
                                                    </p>
                                                </div>
                                                <!-- <hr> -->
                                                <div class="col-jadwal-right">
                                                    <p class="jadwal-pri"><?php echo $item['nama_kelas']; ?></p>
                                                    <p class="jadwal-sec"><?php echo $item['nama_mentor']; ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector('#Senin').style.display = 'block';
            document.querySelector('.col-jadwal[href="#Senin"]').classList.add('active');

            var links = document.getElementsByClassName("col-jadwal");
            for (var i = 0; i < links.length; i++) {
                links[i].addEventListener("click", function(e) {
                    e.preventDefault();

                    var allSections = document.getElementsByClassName("hidden-section");
                    for (var j = 0; j < allSections.length; j++) {
                        allSections[j].style.display = "none";
                    }

                    var allLinks = document.getElementsByClassName("col-jadwal");
                    for (var k = 0; k < allLinks.length; k++) {
                        allLinks[k].classList.remove('active');
                    }

                    this.classList.add('active');

                    var targetId = this.getAttribute("href");
                    document.querySelector(targetId).style.display = "block";
                });
            }
        });


        //KONFIRMASI LOGOUT
        const logoutButton = document.querySelector('.log-out-btn');

        logoutButton.addEventListener('click', function(event) {
            event.preventDefault();
            const confirmation = confirm('Apakah Anda yakin untuk keluar?');
            if (confirmation) {
                window.location.href = './OOP/logout.php';
            }
        });
    </script>
    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>