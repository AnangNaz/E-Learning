-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2025 at 01:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `user_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`user_id`, `playlist_id`) VALUES
('XyoxlzlLQFbNuWI9xjWA', 'asnorvkZRlqiTEHhystz'),
('iMkMVwycXbMAwZYKhFNK', 'asnorvkZRlqiTEHhystz');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` varchar(20) NOT NULL,
  `content_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` int(10) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `video` varchar(100) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `user_id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `content_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `nama_kerajaan` varchar(255) NOT NULL,
  `tahun_berdiri` varchar(50) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `deskripsi` text NOT NULL,
  `daftar_raja` text DEFAULT NULL,
  `foto_raja` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id`, `tutor_id`, `nama_kerajaan`, `tahun_berdiri`, `lokasi`, `deskripsi`, `daftar_raja`, `foto_raja`, `date`, `status`) VALUES
('Ba0w9QsokUse0PsITHth', 'MTk3EpvEUfQlXeCopxXK', 'Kutai', '±399 M', 'Muara Kaman, Kalimantan Timur', 'Kerajaan Hindu tertua di Indonesia, bukti prasasti Yupa.', 'Raja Kudungga, Aswawarman, Mulawarman', 'EhItZpkQW0wkQTrJNqQE.jpg', '2025-11-20', 'active'),
('ibBag6OfORCFZxOWkAbr', 'MTk3EpvEUfQlXeCopxXK', 'Tarumanegara', '358–669 M', 'Jawa Barat (Sunda)', 'Kerajaan Hindu, terkenal dengan Prasasti Ciaruteun.', 'Raja Purnawarman ', 'SxzSrveyS7VT43bzwVBb.jpeg', '2025-11-20', 'active'),
('tgwwpr4c0yCKYQrDKrqG', 'MTk3EpvEUfQlXeCopxXK', 'Kalingga', '594–695 M', 'Jepara, Jawa Tengah', 'Kerajaan bercorak Hindu-Buddha, dipimpin oleh Ratu Shima yang terkenal tegas.', 'Ratu Shima', 'qRxYCHfly0YCPsmy3QWh.jpg', '2025-11-20', 'active'),
('CZsJx0RxxG4mdq3LT7TK', 'MTk3EpvEUfQlXeCopxXK', 'Sriwijaya', '682–1178 M', 'Palembang, Sumatra Selatan', 'Kerajaan maritim Buddha, pusat perdagangan dan pendidikan agama Buddha.', 'Balaputradewa, Sri Jayanasa', 'xhwRw1v1tHYD5kwRskM0.jpg', '2025-11-20', 'active'),
('Q8JBmEc4j1hStggA5GBq', 'MTk3EpvEUfQlXeCopxXK', 'Mataram Kuno', '732–1007 M', 'Jawa Tengah', 'Kerajaan Hindu-Buddha, membangun Candi Prambanan dan Borobudur.', 'Rakai Pikatan, Balitung', 'mltUQTbUH4yvO0rSXK3S.jpg', '2025-11-20', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` int(11) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'active',
  `materi` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id`, `tutor_id`, `playlist_id`, `title`, `description`, `date`, `status`, `materi`) VALUES
(4, 'MTk3EpvEUfQlXeCopxXK', 'Ba0w9QsokUse0PsITHth', 'Sejarah Kerajaan kutai', 'Kerajaan kutai', '2025-11-20 18:10:54', 'active', 'Kerajaan-kerajaan di Indonesia memiliki peran penting dalam membentuk sejarah dan kebudayaan Nusantara. Dimulai dari Kutai di Kalimantan Timur pada abad ke-4 M sebagai kerajaan Hindu tertua, kemudian Tarumanegara di Jawa Barat yang terkenal dengan Prasasti Ciaruteun. Di Jawa Tengah, Kalingga dipimpin oleh Ratu Shima yang dikenal tegas, sementara di Sumatra berdiri Sriwijaya sebagai kerajaan maritim Buddha yang menguasai jalur perdagangan Asia Tenggara. Mataram Kuno di Jawa Tengah dan Medang di Jawa Timur meninggalkan warisan berupa candi megah seperti Borobudur dan Prambanan. Setelah itu muncul Kediri dengan karya sastra Jawa Kuno, lalu Singasari yang didirikan Ken Arok, dan Majapahit yang mencapai puncak kejayaan di bawah Hayam Wuruk serta Gajah Mada dengan Sumpah Palapa-nya. Di Jawa Barat, Pajajaran dipimpin Prabu Siliwangi, sedangkan di Jawa Tengah lahir Kesultanan Demak sebagai kerajaan Islam pertama yang menjadi pusat dakwah Wali Songo. Semua kerajaan ini tidak hanya meninggalkan jejak politik dan ekonomi, tetapi juga warisan budaya, agama, dan seni yang membentuk identitas bangsa Indonesia hingga kini.'),
(5, 'MTk3EpvEUfQlXeCopxXK', 'ibBag6OfORCFZxOWkAbr', 'Sejarah Kerajaan Tarumanegara', 'Kerajaan Tarumanegara', '2025-11-20 18:22:47', 'active', 'Kerajaan Tarumanegara merupakan salah satu kerajaan Hindu tertua di Nusantara yang berdiri sekitar abad ke-4 M di Jawa Barat, tepatnya di sekitar Sungai Citarum. Kerajaan ini didirikan oleh Rajadirajaguru Jayasingawarman, seorang maharesi dari India, dan mencapai puncak kejayaan di bawah kepemimpinan Raja Purnawarman. Pada masa pemerintahannya, Tarumanegara dikenal sebagai kerajaan yang makmur dengan pembangunan saluran irigasi seperti yang tercatat dalam Prasasti Tugu, serta bukti kekuasaan berupa cap telapak kaki Raja Purnawarman pada Prasasti Ciaruteun. Kerajaan ini bercorak Hindu dengan pengaruh budaya India yang kuat, namun tetap berakar pada tradisi lokal. Wilayah kekuasaan Tarumanegara meliputi hampir seluruh Jawa Barat dan menjalin hubungan dagang dengan India serta kerajaan lain di Nusantara. Sekitar abad ke-7 M, Tarumanegara mulai melemah akibat tekanan dari Kerajaan Sriwijaya, hingga akhirnya sebagian wilayahnya berintegrasi menjadi Kerajaan Sunda.'),
(6, 'MTk3EpvEUfQlXeCopxXK', 'tgwwpr4c0yCKYQrDKrqG', 'Sejarah Kerajaan Kalingga', 'Kerajaan Kalingga', '2025-11-20 18:25:54', 'active', 'Kerajaan Kalingga adalah kerajaan bercorak Hindu-Buddha yang berdiri sekitar abad ke-6 hingga ke-7 M di pesisir utara Jawa Tengah, tepatnya di daerah Jepara. Kerajaan ini dikenal sebagai salah satu pusat pemerintahan awal di Jawa yang memiliki hubungan dagang dengan India dan Tiongkok. Catatan tentang Kalingga banyak ditemukan dalam sumber sejarah Tiongkok, terutama dari Dinasti Tang.\r\n\r\nPada masa kejayaannya, Kalingga dipimpin oleh Ratu Shima, seorang penguasa perempuan yang terkenal sangat tegas dan menjunjung tinggi hukum. Ia dikenal sebagai ratu yang menegakkan kejujuran dan keadilan, bahkan ada kisah bahwa ketika seorang utusan dari negeri lain meletakkan kantong emas di jalan, tidak ada rakyat yang berani menyentuhnya. Ketika seorang pangeran kerajaan sendiri melanggar aturan dengan mengambil emas tersebut, Ratu Shima menjatuhkan hukuman berat sebagai bukti ketegasan hukum di Kalingga.'),
(7, 'MTk3EpvEUfQlXeCopxXK', 'CZsJx0RxxG4mdq3LT7TK', 'Sejarah Kerajaan Sriwijaya', 'Kerajaan Sriwijaya', '2025-11-20 18:27:45', 'active', 'Kerajaan Sriwijaya adalah kerajaan maritim bercorak Buddha yang berdiri sekitar abad ke-7 M di Palembang, Sumatra Selatan. Kerajaan ini dikenal sebagai salah satu kerajaan terbesar di Nusantara yang menguasai jalur perdagangan internasional di Asia Tenggara.\r\n\r\nPada masa kejayaannya, Sriwijaya menjadi pusat perdagangan dan pendidikan agama Buddha. Letaknya yang strategis di tepi Sungai Musi menjadikan Sriwijaya sebagai penghubung antara India, Tiongkok, dan dunia Arab. Catatan perjalanan biksu Tiongkok I-Tsing menyebutkan bahwa Sriwijaya memiliki ribuan biksu dan menjadi pusat studi agama Buddha Mahayana.\r\n\r\nRaja pertama yang terkenal adalah Sri Jayanasa, yang disebut dalam prasasti Kedukan Bukit (683 M) sebagai pendiri kerajaan. Kemudian, Sriwijaya mencapai puncak kejayaan di bawah Balaputradewa pada abad ke-9 M, yang menjalin hubungan diplomatik dengan Dinasti Syailendra di Jawa dan kerajaan-kerajaan di India.'),
(8, 'MTk3EpvEUfQlXeCopxXK', 'Q8JBmEc4j1hStggA5GBq', 'Sejarah Kerajaan Maataram Kuno', 'Kerajaan Maataram Kuno', '2025-11-20 18:31:27', 'active', 'Kerajaan Mataram Kuno adalah kerajaan bercorak Hindu-Buddha yang berdiri sekitar abad ke-8 M di Jawa Tengah. Pusat pemerintahannya berada di daerah Medang (sekitar Kedu dan Mataram), dengan wilayah kekuasaan meliputi sebagian besar Jawa Tengah dan Jawa Timur. Kerajaan ini dikenal sebagai salah satu kerajaan besar Nusantara yang meninggalkan warisan budaya berupa candi-candi megah.\r\n\r\nPada masa awal, Mataram Kuno dipimpin oleh Rakai Mataram Sang Ratu Sanjaya, pendiri Dinasti Sanjaya yang bercorak Hindu Siwa. Dinasti ini kemudian berdampingan dengan Dinasti Syailendra yang bercorak Buddha Mahayana. Dari sinilah lahir karya monumental berupa Candi Borobudur (Buddha) dan Candi Prambanan (Hindu), yang menjadi bukti kejayaan Mataram Kuno dalam bidang arsitektur dan seni.');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id` int(11) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `content_id` varchar(20) NOT NULL,
  `question` text NOT NULL,
  `option_a` varchar(255) DEFAULT NULL,
  `option_b` varchar(255) DEFAULT NULL,
  `option_c` varchar(255) DEFAULT NULL,
  `option_d` varchar(255) DEFAULT NULL,
  `correct_option` char(1) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tutors`
--

CREATE TABLE `tutors` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `profession` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutors`
--

INSERT INTO `tutors` (`id`, `name`, `profession`, `email`, `password`, `image`) VALUES
('MTk3EpvEUfQlXeCopxXK', 'KAZE', 'developer', 'nizar0513@gmail.com', '4af02a5592a60995f8fe187ac31a5ef55f00ac76', 'YK2kSt5JHVwMitu6HUKx.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`) VALUES
('XyoxlzlLQFbNuWI9xjWA', 'Nizar Zaidan Syafruddin', 'nizar0512@gmail.com', '4af02a5592a60995f8fe187ac31a5ef55f00ac76', 'fcNN1zR5TgNwjp2z90ci.jpg'),
('iMkMVwycXbMAwZYKhFNK', 'Nizar Zaidan Syafruddin', 'nizar0513@gmail.com', '4af02a5592a60995f8fe187ac31a5ef55f00ac76', '6YUTghLuTzo6ie7BYCdb.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
