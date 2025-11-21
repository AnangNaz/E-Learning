<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sejarah Kerajaan Nusantara</title>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/style.css">
</head>
<body>

<!-- Header -->
<header>
    <h1>Sejarah Kerajaan Nusantara</h1>
    <nav>
        <a href="#">Home</a>
        <a href="#">Peta</a>
        <a href="#">Daftar Kerajaan</a>
        <a href="#">Tentang</a>
    </nav>
</header>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-text">
        <h2>Jelajahi Kerajaan Nusantara</h2>
        <p>Temukan sejarah kerajaan besar di Indonesia dari masa lampau.</p>
        <a href="#kerajaan" class="button">Jelajahi Kerajaan</a>
    </div>
</section>

<!-- Kerajaan Section -->
<section id="kerajaan" class="container">
<?php foreach($kerajaan as $k): ?>
    <div class="card fade-in">
        <img src="/uploaded_files/<?= $k['foto_raja'] ?>" alt="<?= $k['nama_kerajaan'] ?>">
        <div class="card-content">
            <h3><?= $k['nama_kerajaan'] ?> (<?= $k['tahun_berdiri'] ?>)</h3>
            <p><strong>Lokasi:</strong> <?= $k['lokasi'] ?></p>
            <p><?= substr($k['deskripsi'],0,120) ?>...</p>
            <a href="#" class="button">Detail</a>
        </div>
    </div>
<?php endforeach; ?>
</section>

<!-- Footer -->
<footer>
    <p>&copy; <?= date('Y') ?> Sejarah Kerajaan Nusantara. All rights reserved.</p>
</footer>

<!-- JS Inline -->
<script>
// Fade-in on scroll
function fadeInOnScroll() {
    const elements = document.querySelectorAll('.fade-in');
    const windowBottom = window.innerHeight;

    elements.forEach(el => {
        const elementTop = el.getBoundingClientRect().top;
        if(elementTop < windowBottom - 50) {
            el.classList.add('visible');
        }
    });
}

window.addEventListener('scroll', fadeInOnScroll);
window.addEventListener('load', fadeInOnScroll);
</script>

</body>
</html>
