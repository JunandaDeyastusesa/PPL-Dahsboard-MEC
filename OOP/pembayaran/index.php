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
                                <a class="nav-link active" href="../pembayaran/index.php">
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
                        <h1>Data Pembayaran</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKelasModal">
                                Tambah
                            </button>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="py-2">No</th>
                                    <th class="py-2">ID Bayar</th>
                                    <th class="py-2">Tanggal</th>
                                    <th class="py-2">Nama Siswa</th>
                                    <th class="py-2">Nama Kelas</th>
                                    <th class="py-2">No Telp</th>
                                    <th class="py-2">Nominal</th>
                                    <th class="py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td class="text-center">001</td>
                                    <td class="text-center">12 Jan 2023</td>
                                    <td class="">Jhon Doe</td>
                                    <td class="">CPNS Offline</td>
                                    <td class="">082132781254</td>
                                    <td class="">Rp. 500.000</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-warning me-2" data-bs-toggle="modal" data-bs-target="#editKelasModal">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteKelasModal">Hapus</button>
                                    </td>
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
                        <h5 class="modal-title">Tambah Data Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form>
                            <div class="mb-3">
                                <label for="id_bayar" class="form-label">ID Bayar:</label>
                                <input type="number" class="form-control" id="id_bayar" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal:</label>
                                <input type="date" class="form-control" id="tanggal" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama_siswa" class="form-label">Siswa:</label>
                                <select class="form-select" id="inputGroupSelect01">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama_kelas" class="form-label">Kelas:</label>
                                <select class="form-select" id="inputGroupSelect01">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
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
        <div class="modal fade" id="editKelasModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="id_bayar" class="form-label">ID Bayar:</label>
                                <input type="number" class="form-control" id="id_bayar" placeholder="0221" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal:</label>
                                <input type="date" class="form-control" id="tanggal" placeholder="12 Jan 2023" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama_siswa" class="form-label">Siswa:</label>
                                <select class="form-select" id="inputGroupSelect01">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama_kelas" class="form-label">Kelas:</label>
                                <select class="form-select" id="inputGroupSelect01">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4 mt-3">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Kelas Modal -->
        <div class="modal fade" id="deleteKelasModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus kelas ini?</p>
                        <button class="btn btn-danger">Hapus</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap 5 JS and Popper.js -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    </body>

    </html>

</body>

</html>