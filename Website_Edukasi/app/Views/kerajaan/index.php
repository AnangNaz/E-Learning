<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Nusantara Heritage</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet" />

  <style>
    body {
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

  <!-- HERO SECTION -->
  <section class="relative h-[520px] pt-20">
    <img
      src="https://images.unsplash.com/photo-1549880338-65ddcdfd017b"
      class="w-full h-full object-cover brightness-50">
    <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-6">
      <h2 class="text-6xl font-bold drop-shadow-xl tracking-wide">Warisan Kerajaan Nusantara</h2>
      <p class="mt-5 text-xl opacity-90 max-w-3xl">
        Mengungkap kejayaan peradaban yang membentuk sejarah Indonesia.
      </p>
      <a href="#kerajaan"
        class="mt-8 px-8 py-3 bg-indigo-700 hover:bg-indigo-800 rounded-full text-white text-lg shadow-xl transition">
        Jelajahi Sekarang ↓
      </a>
    </div>
  </section>

  <!-- LIST KERAJAAN -->
  <div id="kerajaan" class="container mx-auto px-6 mt-24 mb-20 max-w-6xl">

    <h2 class="text-4xl font-bold text-indigo-800 text-center mb-14">
      Kerajaan yang pernah ada diindonesia
    </h2>

    <?php if (!empty($kerajaan)): ?>

      <!-- Batasi hanya 2 data -->
      <?php $kerajaan_terbatas = array_slice($kerajaan, 0, 2); ?>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

        <?php foreach ($kerajaan_terbatas as $k): ?>
          <div class="bg-white rounded-3xl shadow-xl hover:shadow-2xl border border-indigo-100 overflow-hidden transform hover:-translate-y-2 transition">

            <!-- FOTO -->
            <div class="h-64 w-full overflow-hidden">
              <img
                src="<?= !empty($k['foto_raja'])
                        ? base_url('uploaded_files/' . $k['foto_raja'])
                        : 'https://via.placeholder.com/600x400?text=Tidak+Ada+Foto' ?>"
                class="w-full h-full object-cover hover:scale-110 transition duration-700">
            </div>

            <!-- CONTENT -->
            <div class="p-8">
              <h3 class="text-3xl font-bold text-indigo-700 mb-2">
                <?= $k['nama_kerajaan'] ?>
              </h3>

              <p class="text-sm text-gray-600 italic mb-4">
                Berdiri: <?= $k['tahun_berdiri'] ?> • Lokasi: <?= $k['lokasi'] ?>
              </p>

              <p class="text-gray-700 leading-relaxed mb-6">
                <?= substr(strip_tags($k['deskripsi']), 0, 150) ?>...
              </p>

              <a href="/kerajaan/detail/<?= $k['id'] ?>"
                class="inline-block px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl 
                   font-semibold transition shadow-md w-full text-center">
                Lihat Detail →
              </a>
            </div>

          </div>
        <?php endforeach; ?>

      </div>

    <?php else: ?>

      <p class="text-center text-gray-600 text-lg mt-10">Belum ada data kerajaan.</p>

    <?php endif; ?>

  </div>

  <section class="container mx-auto px-6 max-w-5xl py-20">

    <h2 class="text-4xl font-bold text-indigo-800 text-center mb-16">
      Timeline Sejarah Kerajaan Nusantara
    </h2>

    <div class="relative border-l-4 border-indigo-400 ml-6">

      <!-- ITEMS TIMELINE -->

      <div class="timeline-item mb-12 ml-14 opacity-0 translate-y-16 rotate-y-12">
        <div class="absolute -left-6 mt-1 w-7 h-7 bg-indigo-600 rounded-full shadow-md"></div>
        <h3 class="text-2xl font-bold text-indigo-700">Abad ke-4 — Kerajaan Kutai</h3>
        <p class="text-gray-700 mt-3 leading-relaxed">
          Kerajaan Hindu tertua di Nusantara, terkenal dengan prasasti Yupa.
        </p>
      </div>

      <div class="timeline-item mb-12 ml-14 opacity-0 translate-y-16 rotate-y-12">
        <div class="absolute -left-6 mt-1 w-7 h-7 bg-indigo-600 rounded-full shadow-md"></div>
        <h3 class="text-2xl font-bold text-indigo-700">Abad ke-7 — Kerajaan Sriwijaya</h3>
        <p class="text-gray-700 mt-3 leading-relaxed">
          Kekaisaran maritim besar yang menguasai jalur perdagangan Asia Tenggara.
        </p>
      </div>

      <div class="timeline-item mb-12 ml-14 opacity-0 translate-y-16 rotate-y-12">
        <div class="absolute -left-6 mt-1 w-7 h-7 bg-indigo-600 rounded-full shadow-md"></div>
        <h3 class="text-2xl font-bold text-indigo-700">Abad ke-8 — Kerajaan Mataram Kuno</h3>
        <p class="text-gray-700 mt-3 leading-relaxed">
          Dikenal dengan warisan budaya berupa Candi Borobudur & Prambanan.
        </p>
      </div>

      <div class="timeline-item mb-12 ml-14 opacity-0 translate-y-16 rotate-y-12">
        <div class="absolute -left-6 mt-1 w-7 h-7 bg-indigo-600 rounded-full shadow-md"></div>
        <h3 class="text-2xl font-bold text-indigo-700">Abad ke-13 — Kerajaan Singhasari</h3>
        <p class="text-gray-700 mt-3 leading-relaxed">
          Didirikan oleh Ken Arok, berjaya pada masa Kertanegara.
        </p>
      </div>

      <div class="timeline-item mb-12 ml-14 opacity-0 translate-y-16 rotate-y-12">
        <div class="absolute -left-6 mt-1 w-7 h-7 bg-indigo-600 rounded-full shadow-md"></div>
        <h3 class="text-2xl font-bold text-indigo-700">1293 – 1527 — Kerajaan Majapahit</h3>
        <p class="text-gray-700 mt-3 leading-relaxed">
          Puncak kejayaan Nusantara pada masa Gajah Mada & Hayam Wuruk.
        </p>
      </div>

      <div class="timeline-item mb-12 ml-14 opacity-0 translate-y-16 rotate-y-12">
        <div class="absolute -left-6 mt-1 w-7 h-7 bg-indigo-600 rounded-full shadow-md"></div>
        <h3 class="text-2xl font-bold text-indigo-700">1600-an — Kesultanan Ternate & Tidore</h3>
        <p class="text-gray-700 mt-3 leading-relaxed">
          Penguasa rempah terbesar dan pusat geopolitik Asia Tenggara.
        </p>
      </div>

      <div class="timeline-item mb-12 ml-14 opacity-0 translate-y-16 rotate-y-12">
        <div class="absolute -left-6 mt-1 w-7 h-7 bg-indigo-600 rounded-full shadow-md"></div>
        <h3 class="text-2xl font-bold text-indigo-700">1755 — Kesultanan Yogyakarta</h3>
        <p class="text-gray-700 mt-3 leading-relaxed">
          Berdiri setelah Perjanjian Giyanti. Masih eksis hingga sekarang.
        </p>
      </div>

      <div class="timeline-item mb-12 ml-14 opacity-0 translate-y-16 rotate-y-12">
        <div class="absolute -left-6 mt-1 w-7 h-7 bg-indigo-600 rounded-full shadow-md"></div>
        <h3 class="text-2xl font-bold text-indigo-700">1960-an — Kesultanan Kutai Kartanegara</h3>
        <p class="text-gray-700 mt-3 leading-relaxed">
          Salah satu kerajaan terakhir sebelum melebur ke Republik Indonesia.
        </p>
      </div>

    </div>


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
        <a href="/" class="hover:text-white">Home</a>
        <a href="/kerajaan" class="hover:text-white">Daftar Kerajaan</a>
        <a href="/tentang" class="hover:text-white">Tentang</a>
      </div>

      <p class="text-sm opacity-70">
        © <?= date('Y') ?> Nusantara Heritage — All Rights Reserved
      </p>
    </div>
  </footer>

  <!-- GSAP ANIMATION -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

  <script>
    gsap.registerPlugin(ScrollTrigger);

    gsap.utils.toArray(".timeline-item").forEach((item) => {
      gsap.to(item, {
        scrollTrigger: {
          trigger: item,
          start: "top 80%",
          end: "top 30%",
          scrub: true,
        },
        opacity: 1,
        y: 0,
        rotateY: 0,
        duration: 1.3,
        ease: "expo.out"
      });
    });
  </script>


</body>

</html>