<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Interaktif Kerajaan Nusantara</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .title-font {
            font-family: 'Cinzel', serif;
        }

        /* Tinggi elemen peta harus ditentukan secara eksplisit */
        #map {
            height: 700px;
            /* Lebih tinggi untuk pengalaman yang lebih baik */
            width: 100%;
            border-radius: 1.5rem;
            /* Lebih membulat */
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        /* Styling Custom Marker */
        .kerajaan-icon {
            background-color: #A78BFA;
            /* Ungu (Indigo/Violet) */
            border: 3px solid #6D28D9;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 24px;
            color: white;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        /* Styling Leaflet Pop-up (Opsional, untuk menyesuaikan) */
        .leaflet-popup-content-wrapper {
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        /* Sidebar Styling */
        #sidebar {
            transition: transform 0.3s ease-in-out;
            width: 300px;
            min-height: 700px;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen">

    <header class="backdrop-blur-md bg-white/90 shadow-lg fixed top-0 left-0 right-0 z-50 border-b border-indigo-200">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-3xl title-font font-bold text-indigo-800">Nusantara Heritage</h1>
            <nav class="space-x-6 text-lg font-medium text-gray-700">
                <a href="/" class="hover:text-indigo-600 transition">Home</a>
                <a href="/peta" class="text-indigo-700 font-extrabold transition border-b-2 border-amber-500 pb-1">Peta</a>
                <a href="/kerajaan" class="hover:text-indigo-600 transition">Daftar Kerajaan</a>
                <a href="/quiz" class="px-3 py-1 bg-amber-500 text-white rounded-full hover:bg-amber-600 transition font-semibold">Quiz</a>
                <a href="/tentang" class="hover:text-indigo-600 transition">Tentang</a>
            </nav>
        </div>
    </header>

    <section class="pt-28 pb-10 max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-8">

            <div id="sidebar" class="lg:w-1/4 bg-white p-6 rounded-2xl shadow-xl sticky top-28 h-fit">
                <h3 class="title-font text-2xl font-bold text-indigo-800 mb-4 border-b pb-2">
                    Informasi Kerajaan
                </h3>

                <div id="info-content" class="text-gray-700">
                    <p class="text-center italic mt-10">
                        Klik pada penanda (<span class="inline-block w-3 h-3 bg-indigo-500 rounded-full"></span>) di peta untuk melihat detail kerajaan.
                    </p>

                    <h4 class="title-font text-xl font-bold text-indigo-800 mt-8 mb-3 border-t pt-4">Filter Peta</h4>

                    <label class="block mb-2 text-sm font-medium text-gray-900">Periode Waktu:</label>
                    <select id="filter-periode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5">
                        <option value="all" selected>Semua Periode</option>
                        <option value="Hindu-Buddha">Hindu-Buddha (s/d Abad ke-15)</option>
                        <option value="Islam">Islam (Abad ke-13 s/d 18)</option>
                    </select>

                </div>

            </div>

            <div class="lg:w-3/4">
                <h2 class="title-font text-4xl font-bold text-indigo-800 tracking-wide mb-6">
                    Visualisasi Lokasi
                </h2>
                <div id="map"></div>
            </div>
        </div>
    </section>

    <footer class="bg-indigo-900 text-gray-200 py-12 mt-10">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h3 class="title-font text-2xl font-bold mb-3 text-amber-500">Nusantara Heritage</h3>
            <p class="mb-6 max-w-xl mx-auto">
                Menghadirkan sejarah kerajaan Nusantara dengan tampilan modern dan informatif.
            </p>

            <div class="flex justify-center space-x-6 mb-6 font-semibold">
                <a href="/" class="hover:text-white">Home</a>
                <a href="/kerajaan" class="hover:text-white">Daftar Kerajaan</a>
                <a href="/tentang" class="hover:text-white">Tentang</a>
            </div>

            <p class="text-sm opacity-70">
                © <?= date('Y') ?> Nusantara Heritage — Dibuat dengan cinta untuk sejarah Indonesia
            </p>
        </div>
    </footer>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // 3. Data Kerajaan dari PHP
        // Catatan: Saya menambahkan field 'periode' secara dummy, Anda perlu memastikan data Anda di Controller/Model memilikinya.
        const kerajaanData = <?= json_encode($kerajaan) ?>.map(k => ({
            ...k,
            latitude: parseFloat(k.latitude) || 0, // Pastikan ada di Controller!
            longitude: parseFloat(k.longitude) || 0, // Pastikan ada di Controller!
            // *** DUMMY PERIODE *** (Ganti dengan data nyata dari database Anda)
            periode: k.nama_kerajaan.includes('Sriwijaya') || k.nama_kerajaan.includes('Majapahit') ? 'Hindu-Buddha' : 'Islam'
        }));

        // 1. Inisialisasi Peta
        var map = L.map('map', {
            zoomControl: false // Kita akan menambahkan custom control
        }).setView([-2.5, 118.0], 5);

        // Tambahkan Zoom Control yang lebih modern
        L.control.zoom({
            position: 'topright'
        }).addTo(map);

        // Custom Icon
        var CustomIcon = L.DivIcon.extend({
            options: {
                iconSize: [30, 30],
                className: 'kerajaan-icon'
            }
        });

        let markerLayerGroup = L.layerGroup().addTo(map);

        // 2. Tambahkan Layer Peta (Menggunakan CartoDB Positron untuk tampilan yang lebih modern/premium)
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);

        // Fungsi untuk memperbarui Sidebar
        function updateSidebar(kerajaan) {
            const foto = kerajaan.foto_raja ? `<?= base_url('uploaded_files/') ?>${kerajaan.foto_raja}` : 'https://via.placeholder.com/300x200?text=Foto+Tidak+Tersedia';

            document.getElementById('info-content').innerHTML = `
                <div class="text-center mb-4">
                    <img src="${foto}" class="w-full h-40 object-cover rounded-xl shadow-lg mb-4 mx-auto border-2 border-indigo-300">
                    <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full text-white ${kerajaan.periode === 'Hindu-Buddha' ? 'bg-amber-600' : 'bg-green-600'}">
                        Periode ${kerajaan.periode}
                    </span>
                </div>
                <h4 class="title-font text-3xl font-bold text-indigo-700 mb-2">${kerajaan.nama_kerajaan}</h4>
                <p class="text-md text-gray-600 mb-3"><strong class="font-semibold">Lokasi:</strong> ${kerajaan.lokasi}</p>
                <p class="text-md text-gray-600 mb-4"><strong class="font-semibold">Berdiri:</strong> ${kerajaan.tahun_berdiri}</p>
                <p class="text-sm text-gray-700 leading-relaxed max-h-32 overflow-hidden mb-4">
                    ${kerajaan.deskripsi.substring(0, 150).replace(/<[^>]*>?/gm, '')}...
                </p>
                <a href="/kerajaan/detail/${kerajaan.id}" class="inline-block w-full text-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition shadow-md">
                    Lihat Selengkapnya
                </a>
                
                <h4 class="title-font text-xl font-bold text-indigo-800 mt-8 mb-3 border-t pt-4">Filter Peta</h4>
                <select id="filter-periode-sidebar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5">
                    <option value="all">Semua Periode</option>
                    <option value="Hindu-Buddha">Hindu-Buddha (s/d Abad ke-15)</option>
                    <option value="Islam">Islam (Abad ke-13 s/d 18)</option>
                </select>
            `;
            // Sinkronkan nilai filter
            document.getElementById('filter-periode-sidebar').value = document.getElementById('filter-periode').value;
            document.getElementById('filter-periode-sidebar').addEventListener('change', (e) => {
                document.getElementById('filter-periode').value = e.target.value;
                filterMarkers(e.target.value);
            });
        }

        // Fungsi untuk membuat dan menambahkan Marker
        function createMarker(kerajaan) {
            const marker = L.marker([kerajaan.latitude, kerajaan.longitude], {
                icon: new CustomIcon({
                    html: kerajaan.nama_kerajaan.substring(0, 1)
                })
            }).on('click', function(e) {
                updateSidebar(kerajaan);
                map.flyTo(e.latlng, map.getZoom() < 7 ? 7 : map.getZoom()); // Zoom in sedikit
            });

            return marker;
        }

        // Fungsi Filter
        function filterMarkers(periode) {
            markerLayerGroup.clearLayers(); // Hapus semua marker

            kerajaanData.forEach(kerajaan => {
                const isMatch = periode === 'all' || kerajaan.periode === periode;

                if (isMatch && kerajaan.latitude !== 0 && kerajaan.longitude !== 0) {
                    createMarker(kerajaan).addTo(markerLayerGroup);
                }
            });
        }

        // Event listener untuk Filter dropdown
        document.getElementById('filter-periode').addEventListener('change', (e) => {
            filterMarkers(e.target.value);
        });

        // 4. Inisialisasi Peta dengan semua Marker
        filterMarkers('all');
    </script>
</body>

</html>