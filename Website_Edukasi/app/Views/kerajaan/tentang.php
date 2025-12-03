<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tentang | Nusantara Heritage</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Cinzel', serif; }
  </style>
</head>

<body class="bg-gradient-to-b from-indigo-50 to-white text-gray-800">

<!-- NAVBAR -->
<header class="bg-white/80 backdrop-blur-md shadow-md fixed top-0 left-0 right-0 z-50">
  <div class="container mx-auto px-6 py-4 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-indigo-700 tracking-wide">Nusantara Heritage</h1>
    <nav class="space-x-6 text-lg">
      <a href="<?= base_url('/') ?>" class="hover:text-indigo-600 transition">Home</a>
      <a href="<?= base_url('peta') ?>" class="hover:text-indigo-600 transition">Peta</a>
      <a href="<?= base_url('daftar') ?>" class="hover:text-indigo-600 transition">Daftar Kerajaan</a>
      <a href="<?= base_url('tentang') ?>" class="hover:text-indigo-600 transition font-semibold text-indigo-700">Tentang</a>
    </nav>
  </div>
</header>

<!-- CONTENT -->
<section class="container mx-auto px-6 max-w-5xl pt-32 pb-20">

  <div class="bg-white shadow-xl rounded-3xl border border-indigo-100 p-10">

    <h2 class="text-4xl font-bold text-indigo-800 text-center mb-8">
      Tentang Website Ini
    </h2>

    <p class="text-gray-700 text-lg leading-relaxed mb-6">
      Website <strong>Nusantara Heritage</strong> dibuat untuk memberikan pengalaman belajar sejarah
      kerajaan Nusantara dengan cara yang lebih modern, menarik, dan mudah dipahami. 
      Kami menghadirkan perjalanan panjang peradaban kerajaan-kerajaan yang pernah berdiri di Indonesia,
      mulai dari abad ke-4 hingga abad ke-20.
    </p>

    <!-- Box Highlight -->
    <div class="bg-indigo-50 border-l-4 border-indigo-400 p-5 rounded-xl shadow-sm mb-8">
      <p class="text-gray-800 text-lg">
        <strong class="text-indigo-700">Misi Kami:</strong> menyajikan informasi sejarah yang akurat, lengkap,
        dan disajikan dalam tampilan modern namun tetap membawa suasana klasik kerajaan Nusantara.
      </p>
    </div>

    <p class="text-gray-700 text-lg leading-relaxed mb-4">
      Informasi kerajaan yang disajikan meliputi:
    </p>

    <ul class="list-disc list-inside text-gray-700 text-lg space-y-2 mb-8">
      <li>Nama dan masa berdirinya kerajaan</li>
      <li>Lokasi pusat pemerintahan</li>
      <li>Tokoh raja terkenal</li>
      <li>Perkembangan budaya, ekonomi, dan politik</li>
    </ul>

    <p class="text-gray-700 text-lg leading-relaxed">
      Kami berharap website ini dapat menjadi media edukasi bagi pelajar, mahasiswa, peneliti,
      hingga seluruh masyarakat yang tertarik dengan sejarah Nusantara.
    </p>

  </div>

</section>

<!-- FOOTER -->
<footer class="bg-indigo-900 text-gray-200 py-12 mt-16">
  <div class="container mx-auto px-6 text-center">
    <h3 class="text-2xl font-bold mb-3">Nusantara Heritage</h3>
    <p class="mb-6 max-w-xl mx-auto">
      Platform yang menghadirkan sejarah kerajaan Nusantara dengan tampilan modern dan informatif.
    </p>

    <div class="flex justify-center space-x-6 mb-6">
      <a href="<?= base_url('/') ?>" class="hover:text-white">Home</a>
      <a href="<?= base_url('daftar') ?>" class="hover:text-white">Daftar Kerajaan</a>
      <a href="<?= base_url('tentang') ?>" class="hover:text-white">Tentang</a>
    </div>

    <p class="text-sm opacity-70">
      © <?= date('Y') ?> Nusantara Heritage — All Rights Reserved
    </p>
  </div>
</footer>

</body>
</html>
