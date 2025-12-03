<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detail Kerajaan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }

    .title-font {
      font-family: 'Playfair Display', serif;
    }
  </style>
</head>

<body class="bg-gradient-to-br from-indigo-50 via-white to-purple-100 min-h-screen">

  <!-- Header -->
  <header class="backdrop-blur-md bg-white/70 shadow-md fixed top-0 left-0 right-0 z-50 border-b border-indigo-100">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-3xl title-font font-bold text-indigo-700">Nusantara Heritage</h1>
      <nav class="space-x-6 text-lg font-semibold text-gray-700">
        <a href="/" class="hover:text-indigo-600 transition">Home</a>
        <a href="<?= base_url('peta') ?>" class="hover:text-indigo-600 transition">Peta</a>
        <a href="/kerajaan" class="hover:text-indigo-600 transition">Daftar Kerajaan</a>
        <a href="/tentang" class="hover:text-indigo-600 transition">Tentang</a>
      </nav>
    </div>
  </header>

  <!-- Hero Foto Kerajaan -->
  <section class="mt-20 relative w-full h-[380px]">
    <img src="/uploaded_files/<?= $kerajaan['foto_raja'] ?>" class="w-full h-full object-cover brightness-75" />
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
    <h1 class="absolute bottom-6 left-10 text-white title-font text-5xl font-bold drop-shadow-xl">
      <?= $kerajaan['nama_kerajaan'] ?>
    </h1>
  </section>

  <!-- Content Wrapper -->
  <section class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-3 gap-10">

    <!-- Info Card -->
    <div class="lg:col-span-1">
      <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-200">
        <h2 class="title-font text-2xl font-bold mb-4 text-indigo-700">Informasi Kerajaan</h2>

        <div class="space-y-4 text-gray-700">
          <p><strong class="text-indigo-600">Tahun Berdiri:</strong> <?= $kerajaan['tahun_berdiri'] ?></p>
          <p><strong class="text-indigo-600">Lokasi:</strong> <?= $kerajaan['lokasi'] ?></p>
          <p><strong class="text-indigo-600">Tanggal Tambah:</strong> <?= $kerajaan['date'] ?></p>

          <p class="flex items-center gap-2">
            <strong class="text-indigo-600">Status:</strong>
            <span class="px-3 py-1 text-sm font-semibold rounded-full <?= $kerajaan['status'] === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
              <?= ucfirst($kerajaan['status']) ?>
            </span>
          </p>
        </div>
      </div>
    </div>

    <!-- Detail Deskripsi + Raja -->
    <div class="lg:col-span-2 space-y-10">

      <!-- Deskripsi -->
      <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-200">
        <h3 class="title-font text-3xl font-bold text-indigo-700 mb-4">Deskripsi</h3>
        <p class="text-gray-700 leading-relaxed text-lg">
          <?= nl2br($kerajaan['deskripsi']) ?>
        </p>
      </div>

      <!-- Daftar Raja -->
      <?php if (!empty($kerajaan['daftar_raja'])): ?>
        <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-200">
          <h3 class="title-font text-3xl font-bold text-indigo-700 mb-4">Daftar Raja</h3>
          <ul class="list-disc ml-6 space-y-2 text-gray-700 text-lg">
            <?php foreach (explode("\n", $kerajaan['daftar_raja']) as $raja): ?>
              <li><?= trim($raja) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <a href="/kerajaan" class="inline-block px-6 py-3 bg-indigo-600 text-white text-lg rounded-xl shadow-md hover:bg-indigo-700 transition font-semibold">
        ← Kembali ke Daftar
      </a>

    </div>

  </section>

  <!-- PETA KERAJAAN -->
  <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-200">
    <h3 class="title-font text-3xl font-bold text-indigo-700 mb-4">Lokasi Kerajaan</h3>

    <!-- Map Container -->
    <div id="map" class="w-full h-96 rounded-xl border border-gray-300 shadow"></div>

    <!-- Info koordinat -->
    <p class="mt-3 text-gray-600 text-sm">
      Latitude: <strong><?= $kerajaan['latitude'] ?></strong>,
      Longitude: <strong><?= $kerajaan['longitude'] ?></strong>
    </p>
  </div>


  <!-- Footer -->
  <footer class="bg-indigo-900 text-gray-200 py-10 mt-20">
    <div class="max-w-7xl mx-auto px-6 text-center">
      <h3 class="title-font text-2xl font-bold mb-3">Nusantara Heritage</h3>
      <p class="mb-6">Eksplorasi sejarah kerajaan yang membentuk Indonesia.</p>

      <div class="flex justify-center space-x-6 mb-6 font-semibold">
        <a href="/" class="hover:text-white">Home</a>
        <a href="/kerajaan" class="hover:text-white">Daftar Kerajaan</a>
        <a href="/tentang" class="hover:text-white">Tentang</a>
      </div>

      <p class="text-sm opacity-70">© <?= date('Y') ?> Nusantara Heritage • All Rights Reserved</p>
    </div>
  </footer>

  <!-- LEAFLET CSS & JS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <script>
    const lat = <?= $kerajaan['latitude'] ?>;
    const lng = <?= $kerajaan['longitude'] ?>;

    // Pastikan koordinat valid
    if (!isNaN(lat) && !isNaN(lng)) {
      // Buat map
      var map = L.map('map').setView([lat, lng], 10);

      // Tambahkan tile map gratis dari OpenStreetMap
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
      }).addTo(map);

      // Tambahkan marker
      L.marker([lat, lng]).addTo(map)
        .bindPopup("Lokasi Kerajaan: <?= $kerajaan['nama_kerajaan'] ?>")
        .openPopup();
    } else {
      document.getElementById('map').innerHTML =
        "<p class='text-center text-red-600 font-semibold mt-10'>Lokasi belum tersedia.</p>";
    }
  </script>


</body>

</html>