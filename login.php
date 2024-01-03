<?php
    $cscUser= "css/loginUser.css";
    $gambar = "gambar/digi.png";
    $net = "gambar/netflix.jpeg";
?>
<?php
session_start(); // Mulai sesi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_reporting(E_ALL);
    include_once 'koneksi.php';
    

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mengambil data pengguna dari basis data berdasarkan alamat email
    $query = "SELECT nama, email, password FROM costumer WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        if ($row = mysqli_fetch_assoc($result)) {
            // Verifikasi kata sandi
            if (password_verify($password, $row['password'])) {
                // Kata sandi benar, simpan informasi pengguna ke dalam sesi
                $_SESSION['user_nama'] = $row['nama'];

                // Redirect ke halaman lain setelah login berhasil
                header("Location: beranda.php?welcome=true");
                exit();
            } else {
                echo "Kata sandi salah.";
            }
        } else {
            echo "Akun dengan email tersebut tidak ditemukan.";
        }
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <link rel="stylesheet" href="<?php echo $cscUser; ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body style="background-image: url('<?php echo $net;?>');">
    <div id="container">
        <div id="gambar">
            <img src="<?php echo $gambar; ?>" alt="">
        </div>

        <div id="login">
            <h2>Masuk</h2>
            <form action="#" method="post">
                <label for="email">Email</label><br>
                <br>
                <input type="email" name="email" placeholder="Email" required ><br>
                <br>
                <label for="password">Password</label><br>
                <br>
                <input type="password" name="password"  placeholder="Password"><br>
                <br><br><br>
                <input type="submit" value="Login">
            </form>
            <p>Baru di Digi? <a href="daftar.php">Daftar Sekarang</a></p><br>
            <p>Masuk ke <a href="admin/loginAdmin.php">Seller Account</a></p>
        </div>
        <br><br><br><br>
        <?php require('footer/footer.php')?>
    </div>

</body>
</html>
</html>