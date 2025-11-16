<?php
session_start();

$show_popup = false;

if (isset($_SESSION['login_popup']) && $_SESSION['login_popup'] === true) {
    $show_popup = true;
    unset($_SESSION['login_popup']);
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Ruang Belajar</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f8f8f8;
        }

        /* NAVBAR */
        .navbar {
            width: 100%;
            background: #ffffff;
            padding: 8px 0;
            border-bottom: 1px solid #e5e5e5;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #13A8E1;
        }

        .nav-menu {
            display: flex;
            gap: 25px;
        }

        .nav-menu a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }

        .nav-right {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        /* RUANG BELAJAR SECTION */
        .ruangbelajar-section {
            padding: 40px 30px;
        }

        .rb-title {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .subject-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 20px;
        }

        .subject-item {
            background: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 12px;
            border: 1px solid #e6e6e6;
            cursor: pointer;
            transition: 0.2s;
        }

        .subject-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .subject-icon {
            font-size: 35px;
            margin-bottom: 10px;
        }

        .subject-name {
            font-size: 14px;
            font-weight: bold;
            color: #444;
        }

        <style>.nav-right .btn-logout {
            padding: 8px 15px;
            background: #4C6EF5;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            transition: 0.2s;
        }

        .nav-right .btn-logout:hover {
            background: #183093ff;
        }
    </style>

    </style>
</head>

<body>

    <!-- Custom Notification -->
    <?php if ($show_popup): ?>
        <div id="notif" class="notif-success">
            Login berhasil! Selamat belajar 🎉
        </div>

        <script>
            setTimeout(() => {
                document.getElementById("notif").style.opacity = "0";
                setTimeout(() => {
                    document.getElementById("notif").remove();
                }, 500);
            }, 3000);
        </script>
    <?php endif; ?>

    <style>
        .notif-success {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #4CAF50;
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            font-size: 15px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            transition: opacity .5s ease;
        }
    </style>


    <!-- ================= NAVBAR ================= -->
    <div class="nav-container">
        <div class="logo">ruang<b>belajar</b></div>

        <div class="nav-menu">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">FAQ</a>
        </div>

        <div class="nav-right">
            <a href="login.php" class="btn-logout">Logout</a>
        </div>
    </div>


    <!-- ================= RUANG MATERI ================= -->
    <div class="ruangbelajar-section">
        <div class="rb-title">ruang<b>materi</b></div>

        <div class="subject-grid">

            <div class="subject-item">
                <div class="subject-icon">📘</div>
                <div class="subject-name">Matematika</div>
            </div>

            <div class="subject-item">
                <div class="subject-icon">🧲</div>
                <div class="subject-name">Fisika</div>
            </div>

            <div class="subject-item">
                <div class="subject-icon">💰</div>
                <div class="subject-name">Ekonomi</div>
            </div>

            <div class="subject-item">
                <div class="subject-icon">📚</div>
                <div class="subject-name">Bahasa Indonesia</div>
            </div>

            <div class="subject-item">
                <div class="subject-icon">🇬🇧</div>
                <div class="subject-name">Bahasa Inggris</div>
            </div>

            <div class="subject-item">
                <div class="subject-icon">🔬</div>
                <div class="subject-name">Biologi</div>
            </div>

            <div class="subject-item">
                <div class="subject-icon">⚗️</div>
                <div class="subject-name">Kimia</div>
            </div>

        </div>
    </div>

</body>

</html>