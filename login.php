<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli("localhost", "root", "", "arsgarage");

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM kullanici WHERE userName = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
            session_start();
            $_SESSION['user'] = $username;
            header("Location: /admin/main/");
    } else {
        header("Location: login.php?error=1");
    }

    $stmt->close();
    $conn->close();
    exit();

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>ARAÇ SATIŞ SİTESİ</title>
    <link rel="stylesheet" href="css\login.css">
    <style>
        .fade-out {
            animation: fadeOut 1s ease-in-out forwards;
        }
        @keyframes fadeOut {
            to { opacity: 0; transform: translateY(-20px); }
        }
    </style>
</head>
<body>
    <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
        <div id="alertBox" class="bg-red-500 text-white px-6 py-4 rounded shadow-md absolute top-5">
            Kullanıcı adı veya şifre hatalı!
        </div>
        <script>
            setTimeout(() => {
                const alert = document.getElementById('alertBox');
                alert.classList.add('fade-out');
                setTimeout(() => alert.remove(), 1000);
            }, 3000);
        </script>
    <?php endif; ?>
    <div class="container">
        <div class="navbar">
            <a href="index.html">
                <img  class="logo1" src="images\ARSLANHAN GARAGE-Photoroom.png" alt="logo">
            </a>
            <nav>
                <ul>
                    <li><a href="about.html">Hakkımızda</a></li>
                    <li><a href="contact.html">İletişim</a></li>
                    <li><a href="index.html">Anasayfa</a></li>  
                    <li><a href="#"><i class="fa-solid fa-bars"></i></a></li>   
                </ul>
            </nav>
        </div>
        <div class="row">
            <div class="col">
                <h1>ARSLANHAN
                    <hr>
                    GARAGE
                </h1>
                <div class="card-buttom">
                    <a href="about.html" class="btn">Hakkımızda</a>
                </div>
            </div>
            <div class="col">
                <div class="cards">
                    <div class="card card-1">
                        <div class="card-head">
                            <h3>Giriş Yap</h3>
                            <form method="POST" action="login.php">
                                <h2>Kullanıcı Adı</h2>
                                <input type="text" id="username" name="username" placeholder="Kullanıcı Adı" required>
                                <h2>Şifre</h2>
                                <input type="password" id="password" name="password" placeholder="Şifre" required>
                                <div class="card-buttom">
                                    <button type="submit" class="btn">Giriş Yap</button>
                                </div>
                            </form>
                        </div>
                    </div>                   
                </div>
            </div>
        </div>
    </div>
</body>
</html>
