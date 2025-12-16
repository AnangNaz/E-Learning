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
    
    <style>
        .form-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background: var(--white);
            border-radius: .5rem;
            box-shadow: var(--box-shadow);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: .5rem;
            font-weight: bold;
            color: var(--black);
        }
        
        .form-control {
            width: 100%;
            padding: .8rem;
            border: 1px solid #ddd;
            border-radius: .3rem;
            font-size: 1rem;
        }
        
        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }
        
        .radio-group {
            display: flex;
            gap: 2rem;
            margin-top: .5rem;
        }
        
        .radio-option {
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        
        .radio-option input[type="radio"] {
            width: auto;
        }
    </style>
</head>
<body>
    
    <?= view('admin/components/admin_header', ['profile' => $profile]); ?>
    
<section class="playlist-form">
        <h1 class="heading">Edit Soal</h1>
        
        <?php if (session()->has('errors')): ?>
            <div class="message form error">
                <?php foreach (session('errors') as $error): ?>
                    <span><?= esc($error) ?></span><br>
                <?php endforeach; ?>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
        <?php endif; ?>
        
        <form action="<?= base_url('admin/soal/update/' . $soal['id']) ?>" method="post">
            <div class="form-group">
                <label for="mapel_id">Mata Pelajaran ID *</label>
                <select name="mapel_id" id="mapel_id" class="form-control" required>
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    <?php if (isset($mapel) && !empty($mapel)): ?>
                        <?php foreach ($mapel as $m): ?>
                            <option value="<?= esc($m['id']) ?>" 
                                <?= old('mapel_id', $soal['mapel_id']) == $m['id'] ? 'selected' : '' ?>>
                                <?= esc($m['nama_kerajaan']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">Tidak ada mapel tersedia</option>
                    <?php endif; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="pertanyaan">Pertanyaan *</label>
                <textarea name="pertanyaan" id="pertanyaan" class="form-control" 
                          placeholder="Masukkan pertanyaan..." required><?= old('pertanyaan', $soal['pertanyaan']) ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="pilihan_a">Pilihan A *</label>
                <input type="text" name="pilihan_a" id="pilihan_a" class="form-control" 
                       placeholder="Masukkan pilihan A" 
                       value="<?= old('pilihan_a', $soal['pilihan_a']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="pilihan_b">Pilihan B *</label>
                <input type="text" name="pilihan_b" id="pilihan_b" class="form-control" 
                       placeholder="Masukkan pilihan B" 
                       value="<?= old('pilihan_b', $soal['pilihan_b']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="pilihan_c">Pilihan C *</label>
                <input type="text" name="pilihan_c" id="pilihan_c" class="form-control" 
                       placeholder="Masukkan pilihan C" 
                       value="<?= old('pilihan_c', $soal['pilihan_c']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="pilihan_d">Pilihan D *</label>
                <input type="text" name="pilihan_d" id="pilihan_d" class="form-control" 
                       placeholder="Masukkan pilihan D" 
                       value="<?= old('pilihan_d', $soal['pilihan_d']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Jawaban Benar *</label>
                <div class="radio-group">
                    <div class="radio-option">
                        <input type="radio" name="jawaban_benar" id="jawaban_a" value="a" 
                               <?= old('jawaban_benar', $soal['jawaban_benar']) == 'a' ? 'checked' : '' ?> required>
                        <label for="jawaban_a">A</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" name="jawaban_benar" id="jawaban_b" value="b"
                               <?= old('jawaban_benar', $soal['jawaban_benar']) == 'b' ? 'checked' : '' ?>>
                        <label for="jawaban_b">B</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" name="jawaban_benar" id="jawaban_c" value="c"
                               <?= old('jawaban_benar', $soal['jawaban_benar']) == 'c' ? 'checked' : '' ?>>
                        <label for="jawaban_c">C</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" name="jawaban_benar" id="jawaban_d" value="d"
                               <?= old('jawaban_benar', $soal['jawaban_benar']) == 'd' ? 'checked' : '' ?>>
                        <label for="jawaban_d">D</label>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn">
                    <i class="fas fa-save"></i> Update Soal
                </button>
                <a href="<?= base_url('admin/materi') ?>" class="delete-btn">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </section>
    
<?= view('admin/components/footer'); ?>
</body>
</html>