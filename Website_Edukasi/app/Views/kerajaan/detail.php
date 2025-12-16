<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $kerajaan['nama_kerajaan'] ?> - Detail Kerajaan</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

  <script>
    // Custom Tailwind config for premium look
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'primary-dark': '#1F2937', // Darker base color
            'secondary-gold': '#F59E0B', // Gold accent
            'secondary-indigo': '#4F46E5', // Indigo accent
          },
        }
      }
    }
  </script>

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f9fafb;
      /* Latar belakang lebih netral */
    }

    .title-font {
      font-family: 'Cinzel', serif;
      /* Font header yang lebih elegan */
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

    #map {
      height: 450px;
      border-radius: 1rem;
    }

    .timeline-item::before {
      content: '';
      position: absolute;
      left: -18px;
      top: 0.25rem;
      width: 12px;
      height: 12px;
      background-color: #4F46E5;
      border-radius: 50%;
      border: 3px solid #E0E7FF;
    }
  </style>
</head>

<body class="text-gray-800">

  <header class="bg-white/95 backdrop-blur-md shadow-lg fixed top-0 left-0 right-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-3xl title-font font-bold text-primary-dark tracking-wide">Nusantara Heritage</h1>
      <nav class="space-x-6 text-lg font-semibold text-gray-700">
        <a href="<?= base_url('/') ?>" class="hover:text-secondary-indigo transition">Home</a>
        <a href="<?= base_url('peta') ?>" class="hover:text-secondary-indigo transition">Peta</a>
        <a href="<?= base_url('kerajaan') ?>" class="hover:text-secondary-indigo transition">Daftar Kerajaan</a>
        <a href="<?= base_url('quiz') ?>" class="px-3 py-1 bg-secondary-gold text-white rounded-full hover:bg-amber-600 transition font-semibold">Quiz</a>
        <a href="<?= base_url('tentang') ?>" class="hover:text-secondary-indigo transition">Tentang</a>
      </nav>
    </div>
  </header>

  <section class="mt-[68px] relative w-full h-[480px] fade-in">
    <img src="/uploaded_files/<?= $kerajaan['foto_raja'] ?>"
      class="w-full h-full object-cover brightness-75">
    <div class="absolute inset-0 bg-gradient-to-t from-primary-dark/90 to-transparent"></div>

    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 w-full max-w-7xl px-6 text-center">
      <a href="<?= base_url('kerajaan') ?>" class="inline-flex items-center text-sm font-semibold text-secondary-gold hover:text-white transition mb-3">
        ← Kembali ke Daftar Kerajaan
      </a>
      <h1 class="text-white title-font text-6xl font-extrabold drop-shadow-2xl mb-4 tracking-wider">
        <?= $kerajaan['nama_kerajaan'] ?>
      </h1>
      <div class="inline-flex items-center space-x-4 text-xl text-gray-200 drop-shadow-lg">
        <p><span class="font-bold">Lokasi:</span> <?= $kerajaan['lokasi'] ?></p>
        <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
        <p><span class="font-bold">Berdiri:</span> <?= $kerajaan['tahun_berdiri'] ?></p>
        <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
        <span class="px-3 py-1 text-sm font-bold rounded-full <?= ($kerajaan['periode'] ?? '') === 'Hindu-Buddha' ? 'bg-amber-500' : 'bg-green-500' ?> text-white">
          <?= $kerajaan['periode'] ?? 'Periode Lain' ?>
        </span>
      </div>
    </div>
  </section>

  <section class="max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 lg:grid-cols-3 gap-12">

    <div class="lg:col-span-1">
      <div class="bg-white shadow-2xl rounded-2xl p-8 border border-gray-100 sticky top-28">
        <h2 class="title-font text-3xl font-bold mb-6 text-primary-dark border-b pb-3">Fakta Cepat</h2>

        <div class="space-y-4 text-gray-700 text-lg">
          <p class="flex justify-between items-center"><strong class="text-secondary-indigo">Tahun Berdiri:</strong> <span class="font-semibold"><?= $kerajaan['tahun_berdiri'] ?></span></p>
          <p class="flex justify-between items-center"><strong class="text-secondary-indigo">Ibukota:</strong> <span class="font-semibold"><?= $kerajaan['lokasi'] ?></span></p>
          <p class="flex justify-between items-center"><strong class="text-secondary-indigo">Status Data:</strong>
            <span class="px-3 py-1 text-xs font-bold rounded-full 
                        <?= $kerajaan['status'] === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
              <?= ucfirst($kerajaan['status']) ?>
            </span>
          </p>
          <p class="pt-4 border-t border-gray-200 flex justify-between items-center">
            <strong class="text-secondary-indigo">Tanggal Ditambahkan:</strong> <span class="text-sm"><?= $kerajaan['date'] ?></span>
          </p>
        </div>

        <hr class="my-6 border-gray-200">

        <a href="#map-section"
          class="block text-center bg-secondary-gold text-primary-dark px-4 py-3 rounded-xl shadow-lg 
                    hover:bg-amber-600 transition font-bold text-lg border-b-4 border-amber-700/80">
          Lihat Lokasi di Peta ↓
        </a>
      </div>
    </div>

    <div class="lg:col-span-2 space-y-12">

      <div class="bg-white p-10 rounded-2xl shadow-xl border border-gray-100">
        <h3 class="title-font text-4xl font-bold text-primary-dark mb-6">Sejarah & Deskripsi</h3>
        <div class="text-gray-700 leading-relaxed text-lg prose max-w-none">
          <?= nl2br($kerajaan['deskripsi']) ?>
        </div>
      </div>

      <?php if (!empty($peristiwa)) : ?>
        <div class="bg-white p-10 rounded-2xl shadow-xl border border-gray-100">
          <h3 class="title-font text-4xl font-bold text-primary-dark mb-8">Garis Waktu Peristiwa Penting</h3>

          <div class="relative border-l-4 border-secondary-indigo ml-4">
            <?php foreach ($peristiwa as $item) : ?>
              <div class="mb-10 ml-8 relative timeline-item">
                <p class="text-sm text-secondary-indigo font-bold mb-1"><?= esc($item['tahun']) ?></p>

                <h3 class="text-2xl font-semibold text-primary-dark">
                  <?= esc($item['nama_peristiwa']) ?>
                </h3>

                <p class="text-gray-700 mt-2">
                  <?= esc($item['deskripsi']) ?>
                </p>
              </div>
            <?php endforeach; ?>

            <div class="mb-10 ml-8 relative timeline-item">
              <div class="absolute w-4 h-4 bg-gray-500 rounded-full -left-18px top-0.25rem border border-white"></div>
              <p class="text-sm text-gray-500 font-bold mb-1">Masa Kini</p>
              <h3 class="text-lg font-semibold text-gray-900">Peninggalan Terawat</h3>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <?php if (!empty($kerajaan['daftar_raja'])): ?>
        <div class="bg-white p-10 rounded-2xl shadow-xl border border-gray-100">
          <h3 class="title-font text-4xl font-bold text-primary-dark mb-8">Tokoh & Raja Penting</h3>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php
            $raja_list = array_filter(explode("\n", $kerajaan['daftar_raja']));
            $icon_raja = ["👑", "🤴", "👸", "🛡️", "📜"];
            foreach ($raja_list as $index => $raja):
            ?>
              <div class="flex items-start bg-indigo-50/50 p-4 rounded-xl border border-indigo-200 shadow-sm">
                <span class="text-2xl mr-4 flex-shrink-0"><?= $icon_raja[$index % count($icon_raja)] ?></span>
                <p class="text-gray-700 text-lg font-medium"><?= trim($raja) ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>

      <div class="bg-white p-10 rounded-2xl shadow-xl border border-gray-100">
        <h3 class="title-font text-4xl font-bold text-primary-dark mb-8">Trivia & Fakta Menarik</h3>

        <?php
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
        $icons = ["⭐", "🏺", "📜", "🛕", "⚔️", "👑", "🌏", "🔥"];
        ?>

        <?php if (!empty($listFakta)) : ?>
          <div class="grid md:grid-cols-2 gap-6">
            <?php foreach ($listFakta as $index => $f): ?>
              <?php $icon = $icons[$index % count($icons)]; ?>
              <div class="p-5 bg-secondary-gold/10 border-l-4 border-secondary-gold rounded-xl shadow-md transition duration-300 hover:shadow-lg">
                <div class="flex items-start gap-4">
                  <div class="text-2xl mt-0.5"><?= $icon ?></div>
                  <p class="text-gray-700 text-base leading-relaxed">
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



    </div>

  </section>

  <div class="max-w-7xl mx-auto px-6 fade-in" id="map-section">
    <div class="bg-white p-8 rounded-2xl shadow-2xl border border-gray-100">
      <h3 class="title-font text-4xl font-bold text-primary-dark mb-6">Lokasi Geografis</h3>

      <div id="map" class="w-full h-96 rounded-xl border-4 border-secondary-indigo/50 shadow-inner"></div>

      <div class="mt-4 flex justify-between items-center text-sm text-gray-600">
        <p>
          Koordinat: Lat: <strong><?= $kerajaan['latitude'] ?></strong>, Long: <strong><?= $kerajaan['longitude'] ?></strong>
        </p>
        <a href="https://maps.google.com/?q=<?= $kerajaan['latitude'] ?>,<?= $kerajaan['longitude'] ?>" target="_blank" class="text-secondary-indigo font-semibold hover:underline">
          Lihat di Google Maps →
        </a>
      </div>
    </div>
  </div>

  <footer class="bg-primary-dark text-gray-200 py-12 mt-20 border-t-6 border-secondary-gold">
    <div class="max-w-7xl mx-auto px-6 text-center">
      <h3 class="title-font text-3xl font-bold mb-3 text-secondary-gold">Nusantara Heritage</h3>
      <p class="mb-6 opacity-80">Eksplorasi sejarah kerajaan yang membentuk Indonesia.</p>

      <div class="flex justify-center space-x-6 mb-6 font-semibold">
        <a href="/" class="hover:text-white transition">Home</a>
        <a href="/kerajaan" class="hover:text-white transition">Daftar Kerajaan</a>
        <a href="/tentang" class="hover:text-white transition">Tentang</a>
      </div>

      <p class="text-sm opacity-70">© <?= date('Y') ?> Nusantara Heritage • All Rights Reserved</p>
    </div>
  </footer>

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

  <script>
    const lat = <?= $kerajaan['latitude'] ?>;
    const lng = <?= $kerajaan['longitude'] ?>;
    const namaKerajaan = "<?= $kerajaan['nama_kerajaan'] ?>";

    if (!isNaN(lat) && !isNaN(lng) && lat !== 0 && lng !== 0) {
      var map = L.map('map').setView([lat, lng], 8);

      // Layer Peta Premium (CartoDB Positron - Kontras rendah, elegan)
      L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: 'abcd',
        maxZoom: 19
      }).addTo(map);

      // Custom Icon untuk Marker (Jika Anda memiliki logo atau ingin custom)
      var KerajaanIcon = L.divIcon({
        className: 'custom-div-icon',
        html: '<div style="background-color: #F59E0B; width: 15px; height: 15px; border-radius: 50%; border: 3px solid #4F46E5; box-shadow: 0 0 5px rgba(0,0,0,0.5);"></div>',
        iconSize: [15, 15],
        iconAnchor: [7, 7]
      });

      L.marker([lat, lng], {
          icon: KerajaanIcon
        }).addTo(map)
        .bindPopup(`<strong>${namaKerajaan}</strong><br>Lokasi Ibu Kota.`)
        .openPopup();

      // Opsional: Tambahkan kontrol skala
      L.control.scale().addTo(map);

    } else {
      document.getElementById('map').innerHTML = '<div class="h-full flex items-center justify-center text-xl text-red-500 font-semibold">Koordinat lokasi tidak valid atau tidak tersedia.</div>';
    }
  </script>
</body>

</html>