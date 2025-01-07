<?php
session_start();

require_once 'koneksi.php';
require_once 'controller.php';

// Cek apakah pengguna sudah login, jika ya, redirect ke halaman dashboard
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: ./index.php");
    exit;
}

// Proses login saat formulir dikirim
$objekController = new Controller(); // Ubah "controller()" menjadi "Controller()"

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $pass = $_POST['pass'];

    $user = $objekController->login($username, $pass); // Panggil fungsi login()

    if ($user !== null) {
        // session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        if($_SESSION['role']=="mentor"){
            header("location: ../indexmentor.php");
            exit;
        }else{
            echo "<script>
                alert('Anda tidak memiliki akses sebagai mentor!');
                window.location.href = './logout.php'; // Arahkan kembali ke halaman login
            </script>";
        exit;

        }
    } else {
        $error = "*username atau password salah";
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../assets/style-login.css">
    <title>Form Login Mentor</title>
</head>

<body>
    <section class="login">
        <img class="cover-bg" src="../assets/ikon/bg-patern_Patern2-02.png" alt="">
        <div class="left">
            <!-- <h3>Millenials Education Center</h3> -->
            <img src="../assets/ikon/Logo-MEC.png" alt="">
        </div>
        <div class="right">
            <div class="login-content-out">
                <div class="login-content">
                    <h2>Form Login <span style="color:yell">Mentor</span></h2>


                    <form method="post" action="">
                        <label for="username">email:</label><br>
                        <input type="text" id="username" name="username" required><br>

                        <label for="pass">Password:</label><br>
                        <input type="password" id="pass" name="pass" required>

                        <div class="bottom-login">
                            <?php if (isset($error)) { ?>
                                <a class="error-login"><?php echo $error; ?></a>
                            <?php } ?>
                        </div>

                        <input type="submit" value="Login">
                        <br>
                        <a href="login.php" class="" style="margin-top: 20%;">Login sebagai <span style="">admin ?</span></a>
                    </form>


                </div>
            </div>
        </div>
    </section>
</body>

</html>