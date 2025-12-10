<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Nusantara Heritage | Warisan Kerajaan Indonesia</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss-animate/1.0.6/tailwind-animate.min.css" integrity="sha512-YmB4xXf6fJzQ0tB7E4fM/A/jX6o5u4M0qW4L02q8C4/p1h4o5A70G7p1j7u7J1L3B4P1Z3Q4C8v9Q0t/Q9Z7Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    /* Menggunakan Poppins sebagai default, Cinzel untuk heading utama */
    body {
      font-family: 'Poppins', sans-serif;
    }

    .header-font {
      font-family: 'Cinzel', serif;
    }

    /* Kelas untuk item timeline yang akan dianimasikan */
    .timeline-item {
      transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }
  </style>
</head>

<body class="bg-gray-50 text-gray-800">

  <header id="navbar" class="bg-white/80 backdrop-blur-md shadow-md fixed top-0 left-0 right-0 z-50 transition-all duration-300 ease-in-out py-4">
    <div class="container mx-auto px-6 flex justify-between items-center">
      <h1 class="text-3xl font-extrabold header-font text-indigo-700 tracking-wider">Nusantara Heritage</h1>
      <nav class="space-x-6 text-lg font-medium">
        <a href="<?= site_url('/') ?>" class="text-indigo-700 font-semibold transition">Home</a>
        <a href="<?= site_url('peta') ?>" class="hover:text-indigo-600 transition">Peta</a>
        <a href="<?= site_url('kerajaan') ?>" class="hover:text-indigo-600 transition">Daftar Kerajaan</a>

        <a href="<?= site_url('quiz') ?>"
          class="px-4 py-2 bg-amber-600 text-white rounded-full hover:bg-amber-700 transition font-bold shadow-md hover:shadow-lg">
          Coba Quiz
        </a>
        <a href="<?= site_url('tentang') ?>" class="hover:text-indigo-600 transition">Tentang</a>
      </nav>
    </div>
  </header>

  <section class="relative h-[700px] flex items-center justify-center overflow-hidden">
    <img src="https://images.unsplash.com/photo-1549880338-65ddcdfd017b?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0MTMyMzkzfDB8MXxzZWFyY2h8Mnx8Qm9yb2J1ZHVyJTIwSGVyaXRhZ2V8ZW58MHx8fHwxNzAzMDIwMDAzfDA&ixlib=rb-4.0.3&q=80&w=1080"
      class="absolute inset-0 w-full h-full object-cover brightness-[.35] blur-[1px] transform scale-105"
      alt="Candi Borobudur dengan kabut"
      id="hero-img">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="container mx-auto px-6 relative z-10 text-center text-white">
      <h2 class="text-7xl font-extrabold header-font drop-shadow-lg tracking-wider animate-in fade-in slide-in-from-top-4 duration-1000">
        Warisan Agung Nusantara
      </h2>
      <p class="mt-6 text-xl opacity-90 max-w-4xl mx-auto font-light animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-300">
        Jelajahi kisah kejayaan, peradaban, dan peninggalan megah yang membentuk identitas bangsa Indonesia dari masa ke masa.
      </p>
      <a href="#kerajaan" class="mt-10 inline-block px-10 py-4 bg-amber-600 hover:bg-amber-700 rounded-lg text-white text-lg font-bold shadow-2xl transition duration-300 transform hover:scale-105 animate-in fade-in duration-1000 delay-500">
        Mulai Eksplorasi →
      </a>
    </div>
  </section>


  <section class="bg-indigo-800 text-white py-12 relative z-20 shadow-xl border-t-4 border-amber-500">
    <div class="container mx-auto px-6 lg:px-12">
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 text-center">
        <div class="p-4 border-r border-indigo-700 sm:border-r-0">
          <p class="text-6xl font-extrabold header-font text-amber-500">20+</p>
          <p class="mt-2 text-xl font-medium opacity-90">Kerajaan Utama</p>
          <p class="text-sm opacity-70">Tersebar di seluruh kepulauan</p>
        </div>
        <div class="p-4 border-r border-indigo-700">
          <p class="text-6xl font-extrabold header-font text-amber-500">~1500</p>
          <p class="mt-2 text-xl font-medium opacity-90">Tahun Sejarah</p>
          <p class="text-sm opacity-70">Mulai abad ke-4 Masehi</p>
        </div>
        <div class="p-4">
          <p class="text-6xl font-extrabold header-font text-amber-500">40+</p>
          <p class="mt-2 text-xl font-medium opacity-90">Situs Warisan</p>
          <p class="text-sm opacity-70">Candi, Istana, dan Benteng</p>
        </div>
      </div>
    </div>
  </section>

  <section class="container mx-auto px-6 lg:px-12 mt-24 mb-20 max-w-7xl">
    <h2 class="text-5xl font-bold text-indigo-800 header-font text-center mb-16">
      <span class="border-b-4 border-amber-500 pb-1">Temukan Sejarah</span> Lebih Dalam
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

      <div class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 border-t-4 border-indigo-600">
        <svg class="w-12 h-12 text-indigo-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
        </svg>
        <h3 class="text-2xl font-bold text-indigo-800 mb-3">Daftar Penuh Kerajaan</h3>
        <p class="text-gray-700 mb-6">Telusuri semua profil kerajaan, dari Kutai hingga Kesultanan terakhir, lengkap dengan deskripsi, raja, dan peninggalan.</p>
        <a href="<?= site_url('kerajaan') ?>" class="text-amber-600 font-semibold hover:text-amber-700 flex items-center">
          Lihat Semua Kerajaan <span class="ml-2">→</span>
        </a>
      </div>

      <div class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 border-t-4 border-indigo-600">
        <svg class="w-12 h-12 text-indigo-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
        </svg>
        <h3 class="text-2xl font-bold text-indigo-800 mb-3">Peta Sejarah Interaktif</h3>
        <p class="text-gray-700 mb-6">Visualisasikan letak geografis dan perkiraan wilayah kekuasaan kerajaan di seluruh peta kepulauan Indonesia.</p>
        <a href="<?= site_url('peta') ?>" class="text-amber-600 font-semibold hover:text-amber-700 flex items-center">
          Eksplorasi Peta <span class="ml-2">→</span>
        </a>
      </div>

      <div class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 border-t-4 border-indigo-600">
        <svg class="w-12 h-12 text-indigo-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.618a8.88 8.88 0 010 12.536m-12.536 0a8.88 8.88 0 010-12.536m12.536 0L12 9l-5.618 5.618"></path>
        </svg>
        <h3 class="text-2xl font-bold text-indigo-800 mb-3">Uji Pengetahuan (Quiz)</h3>
        <p class="text-gray-700 mb-6">Seberapa dalam pengetahuan Anda tentang sejarah Nusantara? Uji diri Anda dengan kuis acak atau berdasarkan kategori kerajaan.</p>
        <a href="<?= site_url('quiz') ?>" class="text-amber-600 font-semibold hover:text-amber-700 flex items-center">
          Mulai Quiz <span class="ml-2">→</span>
        </a>
      </div>
    </div>

  </section>

  <div id="kerajaan" class="container mx-auto px-6 lg:px-12 mt-20 mb-20 max-w-7xl">

    <h2 class="text-5xl font-bold text-indigo-800 header-font text-center mb-16">
      <span class="border-b-4 border-amber-500 pb-1">Jelajahi Kerajaan</span> Pilihan
    </h2>

    <?php if (!empty($kerajaan)): ?>

      <?php $kerajaan_terbatas = array_slice($kerajaan, 0, 2); ?>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

        <?php foreach ($kerajaan_terbatas as $k): ?>
          <div class="bg-white rounded-3xl shadow-2xl overflow-hidden group border border-gray-100 transform transition duration-500 hover:scale-[1.02] hover:shadow-3xl">

            <div class="lg:flex">
              <div class="h-64 lg:h-auto lg:w-2/5 overflow-hidden">
                <img
                  src="<?= !empty($k['foto_raja'])
                          ? base_url('uploaded_files/' . $k['foto_raja'])
                          : 'https://via.placeholder.com/800x600?text=Tidak+Ada+Foto' ?>"
                  class="w-full h-full object-cover transition duration-700 group-hover:scale-110"
                  alt="Raja <?= $k['nama_kerajaan'] ?>">
              </div>

              <div class="p-8 lg:p-10 lg:w-3/5 flex flex-col justify-center">
                <h3 class="text-4xl font-extrabold header-font text-indigo-700 mb-2">
                  <?= $k['nama_kerajaan'] ?>
                </h3>

                <div class="flex items-center space-x-4 text-base text-gray-600 italic mb-4">
                  <span><strong class="font-semibold text-indigo-600">Berdiri:</strong> <?= $k['tahun_berdiri'] ?></span>
                  <span class="text-xl">•</span>
                  <span><strong class="font-semibold text-indigo-600">Lokasi:</strong> <?= $k['lokasi'] ?></span>
                </div>

                <p class="text-gray-700 leading-relaxed mb-6 line-clamp-3">
                  <?= substr(strip_tags($k['deskripsi']), 0, 180) ?>...
                </p>

                <a href="/kerajaan/detail/<?= $k['id'] ?>"
                  class="inline-block px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full 
                                            font-bold transition duration-300 shadow-lg text-center self-start">
                  Baca Selengkapnya
                </a>
              </div>
            </div>

          </div>
        <?php endforeach; ?>

      </div>

      <div class="text-center mt-12">
        <a href="<?= site_url('kerajaan') ?>" class="inline-block text-xl font-bold text-indigo-700 hover:text-amber-600 transition border-b-2 border-transparent hover:border-amber-600 pb-1">
          Lihat Semua Daftar Kerajaan →
        </a>
      </div>

    <?php else: ?>

      <p class="text-center text-gray-600 text-lg mt-10">Belum ada data kerajaan yang dapat ditampilkan.</p>

    <?php endif; ?>

  </div>

  <section class="bg-indigo-50 py-20 mt-16 shadow-inner">
    <div class="container mx-auto px-6 lg:px-12 text-center max-w-4xl">
      <h2 class="text-4xl font-bold header-font text-indigo-800 mb-6">
        Visualisasikan Lokasi Kerajaan
      </h2>
      <p class="text-lg text-gray-700 mb-8">
        Lihat persebaran dan batas-batas wilayah kekuasaan kerajaan-kerajaan Nusantara dalam tampilan peta interaktif.
      </p>


      <a href="<?= site_url('peta') ?>" class="mt-6 inline-block px-10 py-4 bg-amber-600 hover:bg-amber-700 rounded-lg text-white text-lg font-bold shadow-xl transition duration-300 transform hover:scale-105">
        Kunjungi Peta Sejarah
      </a>
    </div>
  </section>

  <section class="container mx-auto px-6 lg:px-12 max-w-5xl py-24">

    <h2 class="text-5xl font-bold header-font text-indigo-800 text-center mb-16">
      <span class="border-b-4 border-amber-500 pb-1">Garis Waktu</span> Kejayaan Nusantara
    </h2>

    <div class="relative border-l-4 border-indigo-400 ml-6">

      <div class="timeline-item mb-16 ml-14">
        <div class="absolute -left-6 mt-1 w-7 h-7 bg-indigo-600 rounded-full shadow-lg border-4 border-white flex items-center justify-center text-white font-bold text-xs">
          4
        </div>
        <h3 class="text-2xl font-bold text-indigo-700">Abad ke-4 — Kerajaan Kutai</h3>
        <p class="text-gray-700 mt-3 leading-relaxed bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition">
          Kerajaan Hindu tertua di Nusantara, terletak di Kalimantan Timur, terkenal dengan <strong class="text-amber-600">prasasti Yupa</strong>.
        </p>
      </div>


      <div class="timeline-item mb-16 ml-14">
        <div class="absolute -left-6 mt-1 w-7 h-7 bg-indigo-600 rounded-full shadow-lg border-4 border-white flex items-center justify-center text-white font-bold text-xs">
          7
        </div>
        <h3 class="text-2xl font-bold text-indigo-700">Abad ke-7 — Kerajaan Sriwijaya</h3>
        <p class="text-gray-700 mt-3 leading-relaxed bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition">
          Kekaisaran maritim besar di Sumatera, pusat <strong class="text-amber-600">perdagangan dan penyebaran agama Buddha</strong> di Asia Tenggara.
        </p>
      </div>

      <div class="timeline-item mb-16 ml-14">
        <div class="absolute -left-6 mt-1 w-7 h-7 bg-indigo-600 rounded-full shadow-lg border-4 border-white flex items-center justify-center text-white font-bold text-xs">
          8
        </div>
        <h3 class="text-2xl font-bold text-indigo-700">Abad ke-8 — Kerajaan Mataram Kuno</h3>
        <p class="text-gray-700 mt-3 leading-relaxed bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition">
          Dikenal dengan warisan budaya berupa <strong class="text-amber-600">Candi Borobudur & Prambanan</strong> yang megah di Jawa Tengah.
        </p>
      </div>

      <div class="timeline-item mb-16 ml-14">
        <div class="absolute -left-6 mt-1 w-7 h-7 bg-indigo-600 rounded-full shadow-lg border-4 border-white flex items-center justify-center text-white font-bold text-xs">
          13
        </div>
        <h3 class="text-2xl font-bold text-indigo-700">Abad ke-13 — Kerajaan Singhasari</h3>
        <p class="text-gray-700 mt-3 leading-relaxed bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition">
          Didirikan oleh Ken Arok, mencapai puncak pada masa <strong class="text-amber-600">Raja Kertanegara</strong> sebelum digantikan Majapahit.
        </p>
      </div>

      <div class="timeline-item mb-16 ml-14">
        <div class="absolute -left-6 mt-1 w-7 h-7 bg-indigo-600 rounded-full shadow-lg border-4 border-white flex items-center justify-center text-white font-bold text-xs">
          1293
        </div>
        <h3 class="text-2xl font-bold text-indigo-700">1293 – 1527 — Kerajaan Majapahit</h3>
        <p class="text-gray-700 mt-3 leading-relaxed bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition">
          Masa keemasan Nusantara. Dipimpin oleh <strong class="text-amber-600">Hayam Wuruk dan Patih Gajah Mada</strong> yang menyatukan hampir seluruh Nusantara.
        </p>
      </div>

      <div class="timeline-item mb-16 ml-14">
        <div class="absolute -left-6 mt-1 w-7 h-7 bg-indigo-600 rounded-full shadow-lg border-4 border-white flex items-center justify-center text-white font-bold text-xs">
          16
        </div>
        <h3 class="text-2xl font-bold text-indigo-700">Abad ke-16 — Kesultanan Ternate & Tidore</h3>
        <p class="text-gray-700 mt-3 leading-relaxed bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition">
          Penguasa <strong class="text-amber-600">rempah-rempah</strong> (cengkeh dan pala) yang sangat berpengaruh di Maluku dan pusat geopolitik.
        </p>
      </div>

      <div class="timeline-item mb-16 ml-14">
        <div class="absolute -left-6 mt-1 w-7 h-7 bg-indigo-600 rounded-full shadow-lg border-4 border-white flex items-center justify-center text-white font-bold text-xs">
          1755
        </div>
        <h3 class="text-2xl font-bold text-indigo-700">1755 — Kesultanan Yogyakarta</h3>
        <p class="text-gray-700 mt-3 leading-relaxed bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition">
          Berdiri setelah Perjanjian Giyanti. <strong class="text-amber-600">Satu-satunya yang masih eksis</strong> dengan hak otonomi khusus.
        </p>
      </div>

      <div class="absolute -left-6 bottom-0 w-7 h-7 bg-amber-500 rounded-full shadow-lg border-4 border-white"></div>
    </div>
  </section>


  <footer class="bg-indigo-950 text-gray-300 py-12 mt-16 border-t-4 border-amber-600">
    <div class="container mx-auto px-6 lg:px-12 text-center">
      <h3 class="text-3xl font-extrabold header-font mb-3 text-amber-500">Nusantara Heritage</h3>
      <p class="mb-6 max-w-xl mx-auto font-light">
        Menjaga dan menghadirkan kembali memori kejayaan masa lalu Nusantara untuk generasi kini.
      </p>

      <div class="flex justify-center space-x-8 mb-6 text-sm">
        <a href="/" class="hover:text-white transition font-medium">Home</a>
        <a href="/peta" class="hover:text-white transition font-medium">Peta Sejarah</a>
        <a href="/kerajaan" class="hover:text-white transition font-medium">Daftar Kerajaan</a>
        <a href="/tentang" class="hover:text-white transition font-medium">Tentang Kami</a>
      </div>

      <p class="text-xs opacity-60 mt-8">
        © <?= date('Y') ?> Nusantara Heritage — Dibuat dengan cinta untuk sejarah Indonesia
      </p>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

  <script>
    gsap.registerPlugin(ScrollTrigger);

    // 1. Animasi Timeline (Lebih lembut dan modern)
    gsap.utils.toArray(".timeline-item").forEach((item) => {
      gsap.fromTo(item, {
        opacity: 0,
        y: 50,
      }, {
        scrollTrigger: {
          trigger: item,
          start: "top 85%",
          end: "bottom top",
          toggleActions: "play none none reverse",
        },
        opacity: 1,
        y: 0,
        duration: 0.8,
        ease: "power1.out"
      });
    });

    // 2. Efek Scroll pada Navbar (Memperkecil saat scroll)
    ScrollTrigger.create({
      trigger: "body",
      start: "top -50", // Mulai saat scroll 50px ke bawah
      end: "bottom top",
      toggleClass: {
        className: "py-2 shadow-xl",
        targets: "#navbar" // Mengubah padding (py-4 default menjadi py-2)
      },
    });

    // 3. Efek Parallax Ringan pada Hero Image
    gsap.to("#hero-img", {
      y: 100, // Geser gambar ke bawah 100px saat scroll
      ease: "none",
      scrollTrigger: {
        trigger: "body",
        start: "top top",
        end: "bottom top",
        scrub: 0.5, // Parallax halus
      }
    });
  </script>


</body>

</html>