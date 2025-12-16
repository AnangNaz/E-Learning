<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MapelModel;
use App\Models\MateriModel;
use App\Models\RajaModel;
use \App\Models\TutorModel;

class SearchMapel extends BaseController
{
public function index()
{
    // Cek login
    $tutor_id = $this->request->getCookie('tutor_id');
    if (!$tutor_id) {
        return redirect()->to('/login');
    }

    $mapelModel = new MapelModel();
    $materiModel = new MateriModel();
    $rajaModel = new RajaModel();
    $tutorModel = new TutorModel(); // Tambahkan ini

    $search = $this->request->getGet('search');
    
    // AMBIL DARI GET (karena form method="get")
    $search = $this->request->getGet('search');

    // Ambil profile tutor
    $profile = $tutorModel->find($tutor_id);
    
    $data = [
        'search' => $search,
        'tutor_id' => $tutor_id,
        'profile' => $profile // TAMBAHKAN INI
    ];

    if (!empty($search)) {
        $data['mapels'] = $mapelModel->select('mapel.*')
            ->where('tutor_id', $tutor_id)
            ->groupStart()
                ->like('nama_kerajaan', $search)
                ->orLike('lokasi', $search)
                ->orLike('tahun_berdiri', $search)
                ->orLike('deskripsi', $search)
            ->groupEnd()
            ->orderBy('id', 'DESC')
            ->findAll();

        // Hitung untuk setiap mapel
        foreach ($data['mapels'] as &$mapel) {
            // 1. Hitung raja (karena ada mapel_id di raja)
            $mapel['total_raja'] = $rajaModel->where('mapel_id', $mapel['id'])->countAllResults();
            
            // 2. Untuk materi, cek apakah ada hubungan dengan mapel
            $db = \Config\Database::connect();
            
            // Cek apakah ada kolom yang menghubungkan materi dengan mapel
            $materiFields = $db->getFieldNames('materi');
            
            if (in_array('mapel_id', $materiFields)) {
                // Jika ada kolom mapel_id di materi
                $mapel['total_materi'] = $materiModel->where('mapel_id', $mapel['id'])->countAllResults();
            } 
            elseif (in_array('playlist_id', $materiFields)) {
                // Jika materi terhubung via playlist (sistem lama)
                // Mungkin perlu relasi tidak langsung
                $mapel['total_materi'] = 0; // Default
            }
            else {
                // Jika materi tidak terhubung dengan mapel
                // Hitung total materi tutor saja (semua mapel digabung)
                $mapel['total_materi'] = $materiModel->where('tutor_id', $tutor_id)->countAllResults();
            }
        }
    }

    return view('admin/search_mapel', $data);
}

    public function delete($id)
    {
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        $mapelModel = new MapelModel();
        $materiModel = new MateriModel();
        $rajaModel = new RajaModel();

        // Cek kepemilikan
        $mapel = $mapelModel->where('id', $id)
                           ->where('tutor_id', $tutor_id)
                           ->first();

        if (!$mapel) {
            session()->setFlashdata('error', 'Kerajaan tidak ditemukan atau tidak memiliki akses!');
            return redirect()->to('/admin/search-mapel');
        }

        // Hapus foto raja jika ada
        if (!empty($mapel['foto_raja']) && $mapel['foto_raja'] != 'default.jpg') {
            $filePath = 'uploaded_files/' . $mapel['foto_raja'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Hapus semua materi dari mapel ini
        $materiModel->where('mapel_id', $id)->delete();

        // Hapus semua raja dari mapel ini
        $rajaModel->where('mapel_id', $id)->delete();

        // Hapus mapel
        $mapelModel->delete($id);

        session()->setFlashdata('success', 'Kerajaan berhasil dihapus!');
        return redirect()->to('/admin/search-mapel');
    }
}