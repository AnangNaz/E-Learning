<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PeristiwaModel;
use App\Models\MapelModel;
use App\Models\TutorModel; // <-- TAMBAHKAN INI

class Peristiwa extends BaseController
{
    /**
     * Helper method untuk ambil profile
     */
    private function getProfile($tutor_id)
    {
        $tutorModel = new TutorModel();
        return $tutorModel->find($tutor_id);
    }
    
public function create()
{
    $tutor_id = $this->request->getCookie('tutor_id');
    if (!$tutor_id) {
        return redirect()->to('/login');
    }

    // Inisialisasi model
    $tutorModel = new TutorModel();
    $mapelModel = new MapelModel();
    
    // Ambil data
    $profile = $tutorModel->find($tutor_id);
    $mapelList = $mapelModel->where('tutor_id', $tutor_id)->findAll();

    if (empty($mapelList)) {
        return redirect()->to('/admin/mapel/create')->with('error', 'Buat kerajaan terlebih dahulu!');
    }

    $data = [
        'title' => 'Tambah Peristiwa',
        'mapelList' => $mapelList,
        'profile' => $profile
    ];

    return view('admin/peristiwa/create', $data);
}

public function store()
{
    $tutor_id = $this->request->getCookie('tutor_id');
    if (!$tutor_id) {
        return redirect()->to('/login');
    }

    // Validasi sesuai struktur tabel
    $rules = [
        'kerajaan_id' => 'required',
        'nama_peristiwa' => 'required|max_length[255]',
        'tahun' => 'permit_empty|max_length[50]',
        'deskripsi' => 'required',
        'fakta_menarik' => 'permit_empty',
        'lokasi' => 'permit_empty|max_length[255]',
        'foto_peristiwa' => 'permit_empty'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Handle file upload untuk foto_peristiwa
    $fotoName = null;
    $foto = $this->request->getFile('foto_peristiwa');
    
    if ($foto && $foto->isValid() && !$foto->hasMoved()) {
        $fotoName = $foto->getRandomName();
        $foto->move('uploaded_files/peristiwa/', $fotoName);
    }

    // Simpan data - SEMUA KOLOM SESUAI DATABASE
    $peristiwaModel = new PeristiwaModel();
    
    $data = [
        'kerajaan_id' => $this->request->getVar('kerajaan_id'),
        'nama_peristiwa' => $this->request->getVar('nama_peristiwa'),
        'tahun' => $this->request->getVar('tahun') ?: null,
        'deskripsi' => $this->request->getVar('deskripsi'),
        'fakta_menarik' => $this->request->getVar('fakta_menarik') ?: null,
        'lokasi' => $this->request->getVar('lokasi') ?: null,
        'foto_peristiwa' => $fotoName
    ];

    $peristiwaModel->insert($data);

    return redirect()->to('/admin/materi')
                     ->with('success', 'Peristiwa berhasil ditambahkan!');
}

public function edit($id = null)
{
    $tutor_id = $this->request->getCookie('tutor_id');
    if (!$tutor_id) {
        return redirect()->to('/login');
    }

    // Inisialisasi model
    $tutorModel = new TutorModel();
    $peristiwaModel = new PeristiwaModel();
    $mapelModel = new MapelModel();

    // Ambil data
    $profile = $tutorModel->find($tutor_id);
    $peristiwa = $peristiwaModel->find($id);
    
    if (!$peristiwa) {
        return redirect()->back()->with('error', 'Peristiwa tidak ditemukan!');
    }

    // Cek kepemilikan
    $mapel = $mapelModel->where('id', $peristiwa['kerajaan_id'])
                       ->where('tutor_id', $tutor_id)
                       ->first();

    if (!$mapel) {
        return redirect()->to('/admin/mapel')->with('error', 'Akses ditolak!');
    }

    // Ambil semua kerajaan milik tutor
    $mapelList = $mapelModel->where('tutor_id', $tutor_id)->findAll();

    $data = [
        'title' => 'Edit Peristiwa',
        'peristiwa' => $peristiwa,
        'mapelList' => $mapelList,
        'profile' => $profile
    ];

    return view('admin/peristiwa/edit', $data);
}

    public function update($id = null)
    {
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        $peristiwaModel = new PeristiwaModel();
        $peristiwa = $peristiwaModel->find($id);

        if (!$peristiwa) {
            return redirect()->back()->with('error', 'Peristiwa tidak ditemukan!');
        }

$rules = [
    'kerajaan_id' => 'required|numeric',
    'nama_peristiwa' => 'required|max_length[255]',
    'tahun' => 'permit_empty|max_length[50]',
    'deskripsi' => 'required'
];

$data = [
    'kerajaan_id' => $this->request->getVar('kerajaan_id'),
    'nama_peristiwa' => $this->request->getVar('nama_peristiwa'),
    'tahun' => $this->request->getVar('tahun') ?: null,
    'deskripsi' => $this->request->getVar('deskripsi')
];


        $peristiwaModel->update($id, $data);

        return redirect()->to('/admin/materi')
                         ->with('success', 'Peristiwa berhasil diperbarui!');
    }

    public function delete($id = null)
    {
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        $peristiwaModel = new PeristiwaModel();
        $mapelModel = new MapelModel();

        $peristiwa = $peristiwaModel->find($id);
        
        if (!$peristiwa) {
            return redirect()->back()->with('error', 'Peristiwa tidak ditemukan!');
        }

        // Cek kepemilikan
        $mapel = $mapelModel->where('id', $peristiwa['kerajaan_id'])
                           ->where('tutor_id', $tutor_id)
                           ->first();

        if (!$mapel) {
            return redirect()->to('/admin/mapel')->with('error', 'Akses ditolak!');
        }

        $peristiwaModel->delete($id);

         return redirect()->to('/admin/materi')->with('success', 'Peristiwa berhasil dihapus!');
    }
    
    /**
     * Method untuk menampilkan list peristiwa berdasarkan kerajaan
     */
    public function index($kerajaan_id = null)
    {
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        $peristiwaModel = new PeristiwaModel();
        $mapelModel = new MapelModel();

        // Cek kepemilikan kerajaan
        $mapel = $mapelModel->where('id', $kerajaan_id)
                           ->where('tutor_id', $tutor_id)
                           ->first();

        if (!$mapel) {
            return redirect()->to('/admin/mapel')->with('error', 'Akses ditolak!');
        }

        // Ambil peristiwa berdasarkan kerajaan
        $peristiwa = $peristiwaModel->where('kerajaan_id', $kerajaan_id)
                                   ->orderBy('tahun', 'ASC')
                                   ->findAll();

        $data = [
            'title' => 'Peristiwa Kerajaan ' . $mapel['nama_kerajaan'],
            'peristiwa' => $peristiwa,
            'mapel' => $mapel,
            'profile' => $this->getProfile($tutor_id)
        ];

        return view('admin/peristiwa/index', $data);
    }
}
