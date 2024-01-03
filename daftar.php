<?php
    $gambar = "gambar/digi.png";
    $css = "css/daftar.css";
    $net = "gambar/netflix.jpeg";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <link rel="stylesheet" href="<?php echo $css; ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body style="background-image: url('<?php echo $net;?>');">
    <div id="container">
        <div id="gambar">
            <img src="<?php echo $gambar?>" alt="logo">
        </div>
    
        <div id="daftar">
            <h2>Register</h2>
            <?php
                error_reporting(E_ALL);
                include_once 'koneksi.php';

                // Ambil dan bersihkan data dari formulir
                $nama = isset($_POST['nama']) ? mysqli_real_escape_string($koneksi, $_POST['nama']) : "";
                $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : "";
                $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : "";

                // Validasi data
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    #echo "Format email tidak valid";
                } else {
                    // Query untuk menyimpan data ke database
                    $query = "INSERT INTO costumer (nama, email, password) VALUES ('$nama', '$email', '$password')";

                    // Jalankan query
                    if (mysqli_query($koneksi, $query)) {
                        echo"<script>
                                alert('Paendaftaran berhasil') 
                            </script>";
                    } else {
                        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
                    }
                }
            ?>
            <form action="daftar.php" method="post">
                <label for="nama">Nama</label><br>
                <br>
                    <input type="text" name="nama" required><br>
                <br>
                    <label for="email">Email</label><br>
                <br>
                    <input type="email" name="email" required><br>
                <br>
                    <label for="password">Password</label><br>
                <br>
                    <input type="password" name="password" required><br>
                <br><br>
                    <input type="submit" value="Daftar"><br>
                </form>
                <p>
                    Sudah punya akun? <a href="login.php">Log in</a>
                </p>
        </div>
        <br><br><br><br>
        <?php require('footer/footer.php')?>
    </div>
</body>
</html>