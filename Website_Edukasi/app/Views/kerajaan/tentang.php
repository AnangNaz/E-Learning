<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tentang | Sejarah Kerajaan Nusantara</title>

<!-- Font -->
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">

<style>
/* =======================
   GLOBAL STYLE (SAMA DENGAN HOME)
   ======================= */
body {
    font-family: 'Georgia', serif;
    background: #f9f5f0;
    color: #3b2f2f;
    margin: 0;
    padding: 0;
}

/* Header */
header {
    background: #8b5e3c;
    color: #f4e1c1;
    padding: 20px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
}
header nav a {
    color: #f4e1c1;
    text-decoration: none;
    margin: 0 15px;
    font-weight: bold;
}
header nav a:hover {
    color: #d4af37;
}

/* Tentang Layout */
.tentang-container {
    max-width: 900px;
    margin: 40px auto;
    background: #f4e1c1;
    padding: 30px;
    border-radius: 12px;
    border: 2px solid #8b5e3c;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.tentang-container h2 {
    font-family: 'Cinzel', serif;
    font-size: 2.2em;
    color: #8b5e3c;
    margin-bottom: 15px;
    text-align: center;
}

.tentang-container p {
    font-size: 1.1em;
    line-height: 1.7em;
    margin-bottom: 18px;
}

/* Highlight box */
.highlight-box {
    background: #fff3d6;
    border-left: 5px solid #d4af37;
    padding: 15px;
    margin: 25px 0;
    border-radius: 8px;
}

/* Footer */
footer {
    background: #8b5e3c;
    color: #f4e1c1;
    text-align: center;
    padding: 15px;
    margin-top: 40px;
}
</style>
</head>

<body>

<header>
    <h1>Sejarah Kerajaan Nusantara</h1>
    <nav>
        <a href="<?= base_url('/') ?>">Home</a>
        <a href="<?= base_url('peta') ?>">Peta</a>
        <a href="<?= base_url('daftar') ?>">Daftar Kerajaan</a>
        <a href="<?= base_url('tentang') ?>">Tentang</a>
    </nav>
</header>

<div class="tentang-container">
    <h2>Tentang Website Ini</h2>

    <p>
        Website <strong>Sejarah Kerajaan Nusantara</strong> dibuat untuk memberikan pengalaman belajar 
        sejarah yang lebih menarik, interaktif, dan mudah dipahami. 
        Situs ini menjelaskan perjalanan panjang kerajaan-kerajaan besar yang pernah berdiri di Indonesia,
        mulai dari kerajaan awal pada abad ke-4 hingga kerajaan terakhir pada abad ke-20.
    </p>

    <div class="highlight-box">
        <p><strong>Misi kami:</strong> menghadirkan informasi sejarah yang akurat, lengkap, dan dapat 
        dinikmati dengan tampilan modern namun tetap mempertahankan estetika klasik bernuansa kerajaan.</p>
    </div>

    <p>
        Data kerajaan yang disajikan mencakup:
        <ul>
            <li>Nama dan masa berdirinya kerajaan</li>
            <li>Lokasi pusat pemerintahan</li>
            <li>Tokoh raja terkenal</li>
            <li>Perkembangan budaya, politik, dan ekonomi</li>
        </ul>
    </p>

    <p>
        Kami berharap website ini dapat menjadi media edukasi untuk pelajar, mahasiswa, peneliti,
        hingga semua orang yang tertarik dengan sejarah Nusantara.
    </p>
</div>

<footer>
    <p>&copy; <?= date('Y') ?> Sejarah Kerajaan Nusantara. All rights reserved.</p>
</footer>

</body>
</html>
