<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $kerajaan['nama_kerajaan'] ?> - Detail Kerajaan</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet" />

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }

    .title-font {
      font-family: 'Playfair Display', serif;
    }

    .fade-in {
      animation: fadeIn 1.2s ease-in-out both;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>

<body class="bg-gradient-to-br from-indigo-50 via-white to-purple-100 min-h-screen">

  <!-- HEADER -->
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

  <!-- HERO SECTION -->
  <section class="mt-20 relative w-full h-[430px] fade-in">
    <img src="/uploaded_files/<?= $kerajaan['foto_raja'] ?>"
      class="w-full h-full object-cover brightness-75">
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>

    <div class="absolute bottom-10 left-10">
      <h1 class="text-white title-font text-6xl font-bold drop-shadow-xl mb-3">
        <?= $kerajaan['nama_kerajaan'] ?>
      </h1>
      <p class="text-indigo-200 text-xl drop-shadow-lg">
        <?= $kerajaan['lokasi'] ?> • Berdiri tahun <?= $kerajaan['tahun_berdiri'] ?>
      </p>
    </div>
  </section>

  <!-- MAIN CONTENT -->
  <section class="max-w-7xl mx-auto px-6 py-14 grid grid-cols-1 lg:grid-cols-3 gap-10 fade-in">

    <!-- INFO SIDEBAR -->
    <div class="lg:col-span-1">
      <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-200 sticky top-28">
        <h2 class="title-font text-2xl font-bold mb-6 text-indigo-700">Informasi Kerajaan</h2>

        <div class="space-y-4 text-gray-700 text-lg">
          <p><strong class="text-indigo-600">Tahun Berdiri:</strong> <?= $kerajaan['tahun_berdiri'] ?></p>
          <p><strong class="text-indigo-600">Lokasi:</strong> <?= $kerajaan['lokasi'] ?></p>
          <p><strong class="text-indigo-600">Tanggal Tambah:</strong> <?= $kerajaan['date'] ?></p>

          <p class="flex items-center gap-2">
            <strong class="text-indigo-600">Status:</strong>
            <span class="px-3 py-1 text-sm font-semibold rounded-full 
            <?= $kerajaan['status'] === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
              <?= ucfirst($kerajaan['status']) ?>
            </span>
          </p>
        </div>

        <hr class="my-6 border-gray-300">

        <a href="/kerajaan"
          class="block text-center bg-indigo-600 text-white px-4 py-3 rounded-xl shadow-md 
                 hover:bg-indigo-700 transition font-semibold text-lg">
          ← Kembali ke Daftar
        </a>

      </div>
    </div>

    <!-- MAIN CONTENT RIGHT -->
    <div class="lg:col-span-2 space-y-10">

      <!-- DESKRIPSI -->
      <div class="bg-white p-10 rounded-2xl shadow-xl border border-gray-200">
        <h3 class="title-font text-4xl font-bold text-indigo-700 mb-4">Sejarah & Deskripsi</h3>
        <p class="text-gray-700 leading-relaxed text-lg">
          <?= nl2br($kerajaan['deskripsi']) ?>
        </p>
      </div>

      <!-- RAJA SECTION -->
      <?php if (!empty($kerajaan['daftar_raja'])): ?>
        <div class="bg-white p-10 rounded-2xl shadow-xl border border-gray-200">
          <h3 class="title-font text-4xl font-bold text-indigo-700 mb-5">Tokoh & Raja Penting</h3>
          <ul class="list-disc ml-6 space-y-2 text-gray-700 text-lg">
            <?php foreach (explode("\n", $kerajaan['daftar_raja']) as $raja): ?>
              <li><?= trim($raja) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <!-- TIMELINE PERISTIWA -->
      <h2 class="text-2xl font-bold mt-10 mb-4">Peristiwa Penting</h2>

      <?php if (!empty($peristiwa)) : ?>
        <div class="relative border-l border-gray-300 ml-4">

          <?php foreach ($peristiwa as $item) : ?>
            <div class="mb-10 ml-6">
              <!-- Bulatan -->
              <div class="absolute w-3 h-3 bg-blue-600 rounded-full -left-1.5 border border-white"></div>

              <!-- Tahun -->
              <p class="text-sm text-gray-500"><?= esc($item['tahun']) ?></p>

              <!-- Judul -->
              <h3 class="text-lg font-semibold text-gray-900">
                <?= esc($item['nama_peristiwa']) ?>
              </h3>

              <!-- Deskripsi -->
              <p class="text-gray-700 mt-2">
                <?= esc($item['deskripsi']) ?>
              </p>
            </div>
          <?php endforeach; ?>

        </div>

      <?php else : ?>
        <p class="text-gray-600">Belum ada peristiwa yang dicatat untuk kerajaan ini.</p>
      <?php endif; ?>



      <!-- FAKTA MENARIK – PREMIUM STYLE -->
      <div class="bg-gradient-to-br from-indigo-50 to-purple-50 p-10 rounded-2xl border border-indigo-200 shadow-xl">
        <h3 class="title-font text-4xl font-bold text-indigo-800 mb-8">Fakta Menarik</h3>

        <?php
        // kumpulkan semua fakta dari peristiwa
        $listFakta = [];
        foreach ($peristiwa as $p) {
          if (!empty($p['fakta_menarik'])) {
            foreach (explode("\n", $p['fakta_menarik']) as $f) {
              if (trim($f) !== '') {
                $listFakta[] = trim($f);
              }
            }
          }
        }

        // icon random aesthetic
        $icons = ["⭐", "🏺", "📜", "🛕", "⚔️", "👑", "🌏", "🔥"];

        // warna card
        $colors = [
          "bg-white border-blue-200",
          "bg-white border-purple-200",
          "bg-white border-indigo-200",
          "bg-white border-teal-200"
        ];
        ?>

        <?php if (!empty($listFakta)) : ?>

          <div class="grid md:grid-cols-2 gap-6">
            <?php foreach ($listFakta as $index => $f): ?>
              <?php
              $icon = $icons[$index % count($icons)];
              $color = $colors[$index % count($colors)];
              ?>

              <div class="p-5 <?= $color ?> rounded-xl shadow hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <div class="flex items-start gap-4">
                  <div class="text-3xl"><?= $icon ?></div>
                  <p class="text-gray-700 text-lg leading-relaxed">
                    <?= esc($f) ?>
                  </p>
                </div>
              </div>

            <?php endforeach; ?>
          </div>

        <?php else: ?>

          <p class="text-gray-600 italic">Belum ada fakta menarik yang tersedia.</p>

        <?php endif; ?>
      </div>


      <!-- TIMELINE SEDERHANA -->
      <div class="bg-white p-10 rounded-2xl shadow-xl border border-gray-200">
        <h3 class="title-font text-4xl font-bold text-indigo-700 mb-8">Timeline Singkat</h3>

        <div class="space-y-8">
          <div class="flex gap-4 items-start">
            <div class="w-4 h-4 bg-indigo-600 rounded-full mt-1"></div>
            <p class="text-gray-700 text-lg"><strong><?= $kerajaan['tahun_berdiri'] ?>:</strong> Kerajaan mulai berdiri dan berkembang.</p>
          </div>

          <div class="flex gap-4 items-start">
            <div class="w-4 h-4 bg-indigo-600 rounded-full mt-1"></div>
            <p class="text-gray-700 text-lg">Masa keemasan kerajaan dengan kekuatan politik & ekonomi besar.</p>
          </div>

          <div class="flex gap-4 items-start">
            <div class="w-4 h-4 bg-indigo-600 rounded-full mt-1"></div>
            <p class="text-gray-700 text-lg">Perluasan wilayah dan hubungan dengan kerajaan lain.</p>
          </div>
        </div>
      </div>

    </div>

  </section>

  <!-- MAP -->
  <div class="max-w-7xl mx-auto px-6 fade-in">
    <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-200">
      <h3 class="title-font text-4xl font-bold text-indigo-700 mb-4">Lokasi Kerajaan</h3>

      <div id="map" class="w-full h-96 rounded-xl border border-gray-300 shadow"></div>

      <p class="mt-3 text-gray-600 text-sm">
        Latitude: <strong><?= $kerajaan['latitude'] ?></strong>,
        Longitude: <strong><?= $kerajaan['longitude'] ?></strong>
      </p>
    </div>
  </div>

  <!-- FOOTER -->
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

  <!-- LEAFLET MAP -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <script>
    const lat = <?= $kerajaan['latitude'] ?>;
    const lng = <?= $kerajaan['longitude'] ?>;

    if (!isNaN(lat) && !isNaN(lng)) {
      var map = L.map('map').setView([lat, lng], 10);

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
      }).addTo(map);

      L.marker([lat, lng]).addTo(map)
        .bindPopup("Lokasi Kerajaan: <?= $kerajaan['nama_kerajaan'] ?>")
        .openPopup();
    }
  </script>

</body>

</html>