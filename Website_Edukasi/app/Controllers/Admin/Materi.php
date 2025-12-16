<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TutorModel;
use App\Models\MateriModel;
use App\Models\ContentModel;
use App\Models\SoalModel;
use App\Models\MapelModel;
use App\Models\RajaModel; // <-- TAMBAHKAN INI SAJA
use CodeIgniter\Files\File;
use App\Models\PeristiwaModel; 

class Materi extends BaseController
{
public function index()
{
    $tutor_id = $this->request->getCookie('tutor_id');

    if (!$tutor_id) {
        return redirect()->to('/login');
    }

    $tutorModel   = new TutorModel();
    $materiModel  = new MateriModel();
    $contentModel = new ContentModel();
    $soalModel    = new SoalModel();
    $mapelModel   = new MapelModel();
    $rajaModel    = new RajaModel();
    $peristiwaModel = new PeristiwaModel(); // <-- TAMBAHKAN INI

    $profile = $tutorModel->find($tutor_id);

    // Ambil semua soal dari database
    $soal = $soalModel->findAll();

    // Ambil data mapel berdasarkan tutor_id - AMBIL YANG PERTAMA SAJA
    $mapel = $mapelModel->where('tutor_id', $tutor_id)->first();

    // AMBIL SEMUA DATA RAJA dengan nama kerajaan
    $allRaja = $rajaModel->orderBy('created_at', 'DESC')->findAll();
    $allMapel = $mapelModel->findAll();
    
    $raja = [];
    foreach ($allRaja as $rajaItem) {
        $mapelNama = 'Tidak diketahui';
        foreach ($allMapel as $mapelItem) {
            if ($mapelItem['id'] == $rajaItem['mapel_id']) {
                $mapelNama = $mapelItem['nama_kerajaan'];
                break;
            }
        }
        $rajaItem['mapel_nama'] = $mapelNama;
        $raja[] = $rajaItem;
    }

    // AMBIL SEMUA DATA PERISTIWA dengan nama kerajaan - TAMBAHKAN INI
    $allPeristiwa = $peristiwaModel->orderBy('tahun', 'ASC')->findAll();
    
    $peristiwa = [];
    foreach ($allPeristiwa as $peristiwaItem) {
        $mapelNama = 'Tidak diketahui';
        foreach ($allMapel as $mapelItem) {
            if ($mapelItem['id'] == $peristiwaItem['kerajaan_id']) {
                $mapelNama = $mapelItem['nama_kerajaan'];
                break;
            }
        }
        $peristiwaItem['mapel_nama'] = $mapelNama;
        $peristiwa[] = $peristiwaItem;
    }

    $data = [
        'profile' => $profile,
        'videos' => $contentModel->where('tutor_id', $tutor_id)
                                 ->orderBy('date', 'DESC')
                                 ->findAll(),
        'materi' => $materiModel->where('tutor_id', $tutor_id)
                                ->orderBy('date', 'DESC')
                                ->findAll(),
        'soal' => $soal,
        'mapel' => $mapel,
        'raja' => $raja,
        'peristiwa' => $peristiwa // <-- TAMBAHKAN INI
    ];

    return view('admin/materi', $data);
}

    /* ============================================================
       DELETE VIDEO
    ============================================================ */
    public function deleteVideo()
    {
        $id = $this->request->getPost('video_id');

        $contentModel = new ContentModel();
        $video = $contentModel->find($id);

        if ($video) {

            if (!empty($video['thumb'])) {
                $path = FCPATH . 'uploaded_files/' . $video['thumb'];
                if (file_exists($path)) unlink($path);
            }

            if (!empty($video['video'])) {
                $path = FCPATH . 'uploaded_files/' . $video['video'];
                if (file_exists($path)) unlink($path);
            }

            $contentModel->delete($id);
        }

        return redirect()->to('/admin/materi')->with('success', 'Video berhasil dihapus!');
    }

    /* ============================================================
       DELETE MATERI
    ============================================================ */
    public function deleteMateri()
    {
        $materiModel = new MateriModel();
        $id = $this->request->getPost('materi_id');  // Ambil ID dari form hidden input

        $row = $materiModel->find($id);

        if ($row) {

            if (!empty($row['materi'])) {
                $path = FCPATH . 'uploaded_files/' . $row['materi'];
                if (file_exists($path)) unlink($path);
            }

            $materiModel->delete($id);
        }

        return redirect()->back()->with('success', 'Materi berhasil dihapus!');
    }

/* ============================================================
   DELETE SOAL
============================================================ */
public function deleteSoal()
{
    $soalModel = new SoalModel();
    $id = $this->request->getPost('id'); // gunakan 'id', sesuai input hidden

    if ($id) {
        $soalModel->delete($id);
        
        // Perbaiki di sini: gunakan redirect()->to() bukan redirect()->back()
        // Tambahkan referrer untuk redirect ke halaman yang benar
        $referrer = $this->request->getServer('HTTP_REFERER');
        
        if ($referrer) {
            return redirect()->to($referrer)->with('success', 'Soal berhasil dihapus!');
        } else {
            return redirect()->to('/admin/materi')->with('success', 'Soal berhasil dihapus!');
        }
    }

    return redirect()->back()->with('error', 'Soal tidak ditemukan!');
}
/* ============================================================
   DELETE RAJA (POST METHOD)
============================================================ */
public function deleteRaja()
{
    $tutor_id = $this->request->getCookie('tutor_id');
    if (!$tutor_id) {
        return redirect()->to('/login');
    }

    $rajaModel = new RajaModel();
    $id = $this->request->getPost('id'); // ambil dari input hidden

    if (!$id) {
        return redirect()->back()->with('error', 'ID raja tidak valid!');
    }

    $raja = $rajaModel->find($id);
    
    if (!$raja) {
        return redirect()->back()->with('error', 'Raja tidak ditemukan!');
    }

    // Hapus foto
    if (!empty($raja['foto']) && $raja['foto'] !== 'default.jpg') {
        $path = FCPATH . 'uploaded_files/raja/' . $raja['foto'];
        if (file_exists($path)) {
            unlink($path);
        }
    }

    $rajaModel->delete($id);
    
    return redirect()->back()->with('success', 'Raja berhasil dihapus!');
}
}