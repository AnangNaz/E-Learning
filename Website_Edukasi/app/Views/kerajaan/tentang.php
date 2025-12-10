<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tentang | Nusantara Heritage</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />

  <script>
    // Custom Tailwind config for premium look (consistent with Detail page)
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
    }

    .title-font {
      font-family: 'Cinzel', serif;
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

<body class="text-gray-800">

  <header class="bg-white/95 backdrop-blur-md shadow-lg fixed top-0 left-0 right-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-3xl title-font font-bold text-primary-dark tracking-wide">Nusantara Heritage</h1>
      <nav class="space-x-6 text-lg font-semibold text-gray-700">
        <a href="<?= base_url('/') ?>" class="hover:text-secondary-indigo transition">Home</a>
        <a href="<?= base_url('peta') ?>" class="hover:text-secondary-indigo transition">Peta</a>
        <a href="<?= base_url('daftar') ?>" class="hover:text-secondary-indigo transition">Daftar Kerajaan</a>
        <a href="<?= base_url('tentang') ?>" class="font-bold text-secondary-indigo border-b-2 border-secondary-indigo">Tentang</a>
      </nav>
    </div>
  </header>

  <section class="bg-primary-dark pt-32 pb-20 fade-in">
    <div class="max-w-4xl mx-auto px-6 text-center">
      <h2 class="title-font text-6xl font-extrabold text-secondary-gold mb-4">
        Tentang Kami
      </h2>
      <p class="text-gray-300 text-xl font-light max-w-2xl mx-auto">
        Misi kami adalah mendigitalisasi dan melestarikan warisan sejarah kerajaan Nusantara untuk generasi modern.
      </p>
    </div>
  </section>

  <section class="max-w-7xl mx-auto px-6 py-20 fade-in">
    <div class="grid md:grid-cols-2 gap-12">

      <div class="bg-white p-8 rounded-2xl shadow-xl border border-secondary-indigo/20 transition duration-300 hover:shadow-2xl hover:border-secondary-indigo/40">
        <div class="text-6xl text-secondary-indigo mb-4">📜</div>
        <h3 class="title-font text-3xl font-bold text-primary-dark mb-4 border-b pb-2">Visi Kami</h3>
        <p class="text-gray-600 leading-relaxed text-lg">
          Menjadi platform digital terdepan dan terpercaya dalam penyajian informasi sejarah kerajaan Indonesia,
          menginspirasi rasa bangga dan kecintaan terhadap warisan budaya bangsa.
        </p>
      </div>

      <div class="bg-white p-8 rounded-2xl shadow-xl border border-secondary-gold/20 transition duration-300 hover:shadow-2xl hover:border-secondary-gold/40">
        <div class="text-6xl text-secondary-gold mb-4">🧭</div>
        <h3 class="title-font text-3xl font-bold text-primary-dark mb-4 border-b pb-2">Misi Kami</h3>
        <ul class="list-none space-y-3 text-gray-600 text-lg">
          <li class="flex items-start"><span class="text-secondary-indigo mr-3 mt-1">✓</span> Menyajikan data sejarah yang **akurat dan kredibel**.</li>
          <li class="flex items-start"><span class="text-secondary-indigo mr-3 mt-1">✓</span> Menggunakan teknologi modern untuk tampilan yang **interaktif dan menarik**.</li>
          <li class="flex items-start"><span class="text-secondary-indigo mr-3 mt-1">✓</span> Menyediakan peta lokasi dan garis waktu untuk **konteks historis**.</li>
        </ul>
      </div>
    </div>
  </section>

  <section class="bg-gray-50 py-20 fade-in">
    <div class="max-w-7xl mx-auto px-6">
      <h3 class="title-font text-4xl font-extrabold text-center text-primary-dark mb-12">
        Teknologi di Balik Platform
      </h3>

      <div class="grid md:grid-cols-3 gap-8">

        <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-secondary-indigo transition duration-300 transform hover:-translate-y-1">
          <h4 class="font-bold text-xl text-secondary-indigo mb-3">Front-end Modern</h4>
          <p class="text-gray-600 text-base">
            Menggunakan **Tailwind CSS** untuk desain *mobile-first* dan antarmuka premium yang cepat dan responsif.
          </p>
          <div class="text-3xl mt-4">🎨</div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-secondary-indigo transition duration-300 transform hover:-translate-y-1">
          <h4 class="font-bold text-xl text-secondary-indigo mb-3">Visualisasi Geografis</h4>
          <p class="text-gray-600 text-base">
            Didukung oleh **Leaflet JS** dan data koordinat akurat untuk menampilkan lokasi pusat kerajaan di peta interaktif.
          </p>
          <div class="text-3xl mt-4">🗺️</div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-secondary-indigo transition duration-300 transform hover:-translate-y-1">
          <h4 class="font-bold text-xl text-secondary-indigo mb-3">Struktur Data</h4>
          <p class="text-gray-600 text-base">
            Dibuat menggunakan arsitektur PHP/CodeIgniter (asumsi) untuk pengelolaan data kerajaan dan peristiwa yang efisien.
          </p>
          <div class="text-3xl mt-4">⚙️</div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-20 fade-in">
    <div class="max-w-5xl mx-auto px-6">
      <div class="bg-secondary-gold/10 p-10 rounded-3xl text-center shadow-xl border border-secondary-gold/50">
        <h3 class="title-font text-4xl font-bold text-primary-dark mb-4">
          Mulai Jelajahi Sejarah!
        </h3>
        <p class="text-gray-700 text-xl mb-8">
          Ribuan tahun kisah kerajaan menunggu Anda. Pilih kerajaan pertama Anda sekarang.
        </p>
        <a href="<?= base_url('daftar') ?>"
          class="inline-block px-10 py-4 bg-secondary-indigo text-white font-bold text-xl rounded-full 
                    shadow-xl hover:bg-secondary-indigo/90 transition duration-300 transform hover:scale-105">
          Lihat Daftar Kerajaan →
        </a>
      </div>
    </div>
  </section>

  <footer class="bg-primary-dark text-gray-200 py-12 mt-16 border-t-6 border-secondary-gold">
    <div class="max-w-7xl mx-auto px-6 text-center">
      <h3 class="title-font text-3xl font-bold mb-3 text-secondary-gold">Nusantara Heritage</h3>
      <p class="mb-6 opacity-80 max-w-xl mx-auto">
        Platform yang menghadirkan sejarah kerajaan Nusantara dengan tampilan modern dan informatif.
      </p>

      <div class="flex justify-center space-x-6 mb-6 font-semibold">
        <a href="<?= base_url('/') ?>" class="hover:text-white transition">Home</a>
        <a href="<?= base_url('daftar') ?>" class="hover:text-white transition">Daftar Kerajaan</a>
        <a href="<?= base_url('tentang') ?>" class="hover:text-white transition">Tentang</a>
      </div>

      <p class="text-sm opacity-70">
        © <?= date('Y') ?> Nusantara Heritage • All Rights Reserved
      </p>
    </div>
  </footer>

</body>

</html>