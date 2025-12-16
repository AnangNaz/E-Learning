<?php
helper('url');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    
    <!-- custom css file link  -->
    <link rel="stylesheet" href="<?= base_url('css/styleadmin.css'); ?>">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    
    <style>
        .soal-container {
            background: var(--white);
            border-radius: .5rem;
            padding: 2rem;
            margin-top: 2rem;
        }
        
        .btn-soal {
            margin-bottom: 1rem;
        }
        
        .jawaban-correct {
            color: green;
            font-weight: bold;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
    </style>
</head>
<body>
    
    <?= view('admin/components/admin_header', ['profile' => $profile]); ?>
    
    <section class="soal-container">
        <h1 class="heading">Kelola Soal Quiz</h1>
        
        <?php if (session()->has('success')): ?>
            <div class="message form success">
                <span><?= session('success') ?></span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
        <?php endif; ?>
        
        <?php if (session()->has('error')): ?>
            <div class="message form error">
                <span><?= session('error') ?></span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
        <?php endif; ?>
        
        <a href="<?= base_url('admin/soal/create') ?>" class="btn btn-soal">
            <i class="fas fa-plus"></i> Tambah Soal Baru
        </a>
        
        <div class="table-responsive">
            <table id="soalTable" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pertanyaan</th>
                        <th>Mapel ID</th>
                        <th>Pilihan A</th>
                        <th>Pilihan B</th>
                        <th>Pilihan C</th>
                        <th>Pilihan D</th>
                        <th>Jawaban Benar</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($soal as $item): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc(substr($item['pertanyaan'], 0, 100)) ?>...</td>
                        <td><?= esc($item['mapel_id']) ?></td>
                        <td><?= esc($item['pilihan_a']) ?></td>
                        <td><?= esc($item['pilihan_b']) ?></td>
                        <td><?= esc($item['pilihan_c']) ?></td>
                        <td><?= esc($item['pilihan_d']) ?></td>
                        <td class="jawaban-correct">
                            <?= strtoupper($item['jawaban_benar']) ?>
                        </td>
                        <td><?= date('d/m/Y H:i', strtotime($item['dibuat_pada'])) ?></td>
                        <td>
                            <a href="<?= base_url('admin/soal/edit/' . $item['id']) ?>" class="btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('admin/soal/delete/' . $item['id']) ?>" 
                               class="delete-btn" 
                               title="Hapus"
                               onclick="return confirm('Yakin ingin menghapus soal ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    
<?= view('admin/components/footer'); ?>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#soalTable').DataTable({
                "pageLength": 10,
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ soal per halaman",
                    "zeroRecords": "Tidak ada soal ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(disaring dari _MAX_ total soal)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        });
    </script>
</body>
</html>