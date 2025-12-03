<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Peta Kerajaan Nusantara</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <style>
        body {
            font-family: 'Cinzel', serif;
        }

        #map {
            height: 600px;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 0 35px rgba(99, 102, 241, 0.25);
        }

        .leaflet-popup-content-wrapper {
            border-radius: 16px !important;
            font-family: 'Cinzel', serif;
        }
    </style>

</head>

<body class="bg-gradient-to-b from-indigo-50 to-white text-gray-800">

    <!-- NAVBAR -->
    <header class="bg-white/80 backdrop-blur-md shadow-md fixed top-0 left-0 right-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-indigo-700 tracking-wide">Nusantara Heritage</h1>
            <nav class="space-x-6 text-lg">
                <a href="/" class="hover:text-indigo-600 transition">Home</a>
                <a href="<?= base_url('peta') ?>" class="hover:text-indigo-600 transition">Peta</a>
                <a href="/kerajaan" class="hover:text-indigo-600 transition">Daftar Kerajaan</a>
                <a href="/tentang" class="hover:text-indigo-600 transition">Tentang</a>
            </nav>
        </div>
    </header>

    <!-- HERO -->
    <section class="pt-32 pb-10 text-center">
        <h2 class="text-5xl font-bold text-indigo-800 tracking-wide">
            Peta Persebaran Kerajaan Nusantara
        </h2>

        <p class="mt-6 text-lg text-gray-700 max-w-3xl mx-auto">
            Menampilkan lokasi kerajaan-kerajaan bersejarah di seluruh Nusantara
            berdasarkan titik koordinat latitude dan longitude.
        </p>

        <img
            src="https://images.unsplash.com/photo-1526481280695-3c720685208b"
            class="w-40 mx-auto mt-8 rounded-xl opacity-80 shadow-lg">
    </section>

    <!-- MAP SECTION -->
    <div class="container mx-auto px-6 pb-24">

        <div class="mb-5 text-center">
            <p class="text-indigo-700 font-bold text-xl">• Peta Interaktif •</p>
        </div>

        <div id="map"></div>
    </div>

    <script>
        // INISIALISASI MAP
        var map = L.map('map', {
            zoomControl: false
        }).setView([-2.5, 117.5], 5);

        L.control.zoom({
            position: 'bottomright'
        }).addTo(map);

        // TILE MAP
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(map);

        // DATA KERAJAAN
        var kerajaanData = <?= json_encode($kerajaan) ?>;

        // ICON GOLD 
        var goldIcon = L.icon({
            iconUrl: "https://cdn-icons-png.flaticon.com/512/684/684908.png",
            iconSize: [35, 35],
            iconAnchor: [17, 34],
            popupAnchor: [0, -25]
        });

        kerajaanData.forEach(k => {
            if (k.latitude && k.longitude) {
                var marker = L.marker([k.latitude, k.longitude], {
                    icon: goldIcon
                }).addTo(map);

                marker.bindPopup(`
                    <div class="text-center">
                        <h3 class="font-bold text-indigo-700 text-lg">${k.nama_kerajaan}</h3>
                        <p class="text-sm text-gray-600 mt-2">
                            <strong>Berdiri:</strong> ${k.tahun_berdiri}<br>
                            <strong>Lokasi:</strong> ${k.lokasi}
                        </p>
<a href="/kerajaan/detail/${k.id}"
   class="mt-3 inline-block 
          bg-indigo-600 hover:bg-indigo-700
          text-white font-bold tracking-wide 
          px-5 py-3 rounded-xl shadow-lg 
          transition text-base">
   Lihat Detail →
</a>

                    </div>
                `);
            }
        });
    </script>

    <!-- FOOTER -->
    <footer class="bg-indigo-900 text-gray-200 py-12 mt-16">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-2xl font-bold mb-3">Nusantara Heritage</h3>
            <p class="mb-6 max-w-xl mx-auto">
                Platform yang menghadirkan sejarah kerajaan Nusantara dengan tampilan modern dan informatif.
            </p>

            <div class="flex justify-center space-x-6 mb-6">
                <a href="/" class="hover:text-white">Home</a>
                <a href="/kerajaan" class="hover:text-white">Daftar Kerajaan</a>
                <a href="/tentang" class="hover:text-white">Tentang</a>
            </div>

            <p class="text-sm opacity-70">
                © <?= date('Y') ?> Nusantara Heritage — All Rights Reserved
            </p>
        </div>
    </footer>

</body>

</html>