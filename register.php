<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "e_learning";

$conn = mysqli_connect($host, $user, $pass, $db);

$message = "";

if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek apakah username atau email sudah ada
    $cek = mysqli_query(
        $conn,
        "SELECT * FROM Register WHERE Username='$username' OR Email='$email'"
    );

    if (mysqli_num_rows($cek) > 0) {
        $message = "Username atau Email sudah digunakan!";
    } else {

        // Insert data
        $q = mysqli_query(
            $conn,
            "INSERT INTO Register (Username, Email, Password)
             VALUES ('$username', '$email', '$password')"
        );

        // Jika berhasil insert → simpan notifikasi ke login
        if ($q) {
            $_SESSION['register_success'] = true;
            header("Location: login.php");
            exit;
        } else {
            $message = "Gagal melakukan registrasi!";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registrasi</title>
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
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .btn {
            width: 100%;
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
    </style>
</head>

<body>

    <div class="card">
        <h2>REGISTRASI</h2>

        <p style="color:red;"><?php echo $message; ?></p>

        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>

            <input type="text" name="username" placeholder="Username" required>

            <input type="password" name="password" placeholder="Password" required>

            <button class="btn" name="register">Register</button>
        </form>

        <p style="margin-top:10px;">
            Sudah Punya Akun?
            <a href="login.php">Login di sini</a>
        </p>
    </div>

</body>

</html>