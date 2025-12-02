<?php
include '../components/connect.php';

if (!isset($_COOKIE['tutor_id'])) {
    header('location:login.php');
}

$tutor_id = $_COOKIE['tutor_id'];

if (!isset($_GET['id']) && !isset($_GET['get_id'])) {
    echo "ID soal tidak ditemukan!";
    exit;
}

$soal_id = $_GET['id'] ?? $_GET['get_id'];



$query = $conn->prepare("
    SELECT soal.*, materi.title AS materi_title 
    FROM soal
    LEFT JOIN materi ON soal.content_id = materi.id
    WHERE soal.id = ? AND soal.tutor_id = ?
    LIMIT 1
");
$query->execute([$soal_id, $tutor_id]);

if ($query->rowCount() == 0) {
    echo "Soal tidak ditemukan!";
    exit;
}

$data = $query->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Soal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="view-container">

<h1 class="heading">Detail Soal</h1>

<div class="box">
    <h3><?= $data['question']; ?></h3>

    <p><b>Materi terkait:</b> <?= $data['materi_title']; ?></p>

    <div class="options">
        <p>A. <?= $data['option_a']; ?></p>
        <p>B. <?= $data['option_b']; ?></p>
        <p>C. <?= $data['option_c']; ?></p>
        <p>D. <?= $data['option_d']; ?></p>
    </div>

    <p><b>Jawaban Benar:</b> <?= strtoupper($data['correct_option']); ?></p>

    <br>
    <a href="materi.php" class="btn">kembali</a>
</div>

</section>

<?php include '../components/footer.php'; ?>
<script src="../js/admin_script.js"></script>
</body>
</html>
