<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "e_learning";

$conn = mysqli_connect($host, $user, $pass, $db);

$message = "";
$login_success = false;

// ================== LOGIN ==================
if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $q = mysqli_query($conn, "SELECT * FROM register WHERE Username='$username'");

    if (!$q) {
        die("Query error: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($q) === 1) {
        $row = mysqli_fetch_assoc($q);

        if ($password === $row['Password']) {
            $_SESSION['username'] = $username;
            $_SESSION['login_popup'] = true;

            header("Location: index.php");
            exit;
        } else {
            $message = "Password salah!";
        }

    } else {
        $message = "Username tidak ditemukan!";
    }
}

// ================== NOTIFIKASI REGISTER ==================
$show_register_popup = false;
if (isset($_SESSION['register_success']) && $_SESSION['register_success'] === true) {
    $show_register_popup = true;
    unset($_SESSION['register_success']); // agar popup hanya muncul sekali
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>LOGIN</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #ffffffff;
            font-family: Arial, sans-serif;
        }

        .card {
            width: 350px;
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 8px 0px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .btn {
            width: 90%;
            padding: 10px;
            background: #4C6EF5;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn:hover {
            background: #183093ff;
        }

        a {
            color: #4C6EF5;
            text-decoration: none;
        }

        /* ================= POPUP =================== */
        .popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .popup-content {
            background: white;
            padding: 25px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .popup-content button {
            margin-top: 15px;
            padding: 8px 20px;
            background: #4C6EF5;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <?php if ($show_register_popup): ?>
        <div id="notif" class="notif-success">
            Registrasi berhasil! Silakan login 🎉
        </div>

        <script>
            setTimeout(() => {
                const notif = document.getElementById("notif");
                notif.style.opacity = "0";
                setTimeout(() => notif.remove(), 500);
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

    <?php if ($login_success): ?>
        <script>
            document.getElementById("popup").style.display = "flex";
        </script>
    <?php endif; ?>

    <div class="card">
        <h2>LOGIN</h2>

        <p style="color:red;"><?php echo $message; ?></p>

        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>

            <input type="password" name="password" placeholder="Password" required>

            <button class="btn" name="login">Login</button>
        </form>

        <p style="margin-top:10px;">Belum Punya Akun?
            <a href="register.php">Registrasi di sini</a>
        </p>
    </div>

    <script>
        function closePopup() {
            window.location.href = "index.php";
        }
    </script>

</body>

</html>