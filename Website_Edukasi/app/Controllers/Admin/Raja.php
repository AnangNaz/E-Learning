<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RajaModel;
use App\Models\MapelModel;

class Raja extends BaseController
{
    public function index($mapel_id = null)
    {
        // Cek login
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        if (!$mapel_id) {
            return redirect()->to('/admin/mapel');
        }

        $mapelModel = new MapelModel();

        // Ambil data mapel
        $mapel = $mapelModel->where('id', $mapel_id)
                           ->where('tutor_id', $tutor_id)
                           ->first();

        if (!$mapel) {
            return redirect()->to('/admin/mapel')->with('error', 'Kerajaan tidak ditemukan!');
        }

        // Ambil daftar raja dengan Query Builder langsung
        $db = \Config\Database::connect();
        $raja = $db->table('raja')
                  ->where('mapel_id', $mapel_id)
                  ->orderBy('nama', 'ASC')
                  ->get()
                  ->getResultArray();

        $data = [
            'title' => 'Daftar Raja - ' . $mapel['nama_kerajaan'],
            'mapel' => $mapel,
            'raja' => $raja,
            'profile' => $this->getProfile($tutor_id)
        ];

        return view('admin/raja/index', $data);
    }

    public function create($mapel_id = null)
    {
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        $mapelModel = new MapelModel();
        $mapel = $mapelModel->where('id', $mapel_id)
                           ->where('tutor_id', $tutor_id)
                           ->first();

        if (!$mapel) {
            return redirect()->to('/admin/mapel')->with('error', 'Kerajaan tidak ditemukan!');
        }

        $data = [
            'title' => 'Tambah Raja Baru',
            'mapel' => $mapel,
            'profile' => $this->getProfile($tutor_id)
        ];

        return view('admin/raja/create', $data);
    }

    public function store($mapel_id = null)
    {
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        // Validasi
        if (empty($this->request->getPost('nama')) || empty($this->request->getPost('cerita'))) {
            return redirect()->back()->withInput()->with('error', 'Nama dan cerita harus diisi!');
        }

        // Handle file upload
        $foto = $this->request->getFile('foto');
        $fotoName = 'default.jpg';

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $foto->getRandomName();
            $foto->move('uploaded_files/raja/', $fotoName);
        }

        // Gunakan Query Builder langsung
        $db = \Config\Database::connect();
        
        $data = [
            'mapel_id' => $mapel_id,
            'nama' => $this->request->getPost('nama'),
            'cerita' => $this->request->getPost('cerita'),
            'foto' => $fotoName,
            'longitude' => $this->request->getPost('longitude') ?: null,
            'latitude' => $this->request->getPost('latitude') ?: null,
            'created_at' => date('Y-m-d H:i:s')
        ];

        try {
            $db->table('raja')->insert($data);
            
            return redirect()->to('/admin/mapel/' . $mapel_id . '/raja')
                             ->with('success', 'Raja berhasil ditambahkan!');
                             
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id = null)
    {
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        // Ambil data raja dengan Query Builder
        $db = \Config\Database::connect();
        $raja = $db->table('raja')->where('id', $id)->get()->getRowArray();

        if (!$raja) {
            return redirect()->back()->with('error', 'Raja tidak ditemukan!');
        }

        // Cek apakah raja ini milik mapel yang dimiliki tutor
        $mapelModel = new MapelModel();
        $mapel = $mapelModel->where('id', $raja['mapel_id'])
                           ->where('tutor_id', $tutor_id)
                           ->first();

        if (!$mapel) {
            return redirect()->to('/admin/mapel')->with('error', 'Akses ditolak!');
        }

        $data = [
            'title' => 'Edit Raja',
            'raja' => $raja,
            'mapel' => $mapel,
            'profile' => $this->getProfile($tutor_id)
        ];

        return view('admin/raja/edit', $data);
    }

    public function update($id = null)
    {
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        // Ambil data raja dulu
        $db = \Config\Database::connect();
        $raja = $db->table('raja')->where('id', $id)->get()->getRowArray();

        if (!$raja) {
            return redirect()->back()->with('error', 'Raja tidak ditemukan!');
        }

        // Cek kepemilikan
        $mapelModel = new MapelModel();
        $mapel = $mapelModel->where('id', $raja['mapel_id'])
                           ->where('tutor_id', $tutor_id)
                           ->first();

        if (!$mapel) {
            return redirect()->to('/admin/mapel')->with('error', 'Akses ditolak!');
        }

        // Handle file upload
        $foto = $this->request->getFile('foto');
        $fotoName = $raja['foto'];

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $foto->getRandomName();
            $foto->move('uploaded_files/raja/', $fotoName);

            // Hapus foto lama jika bukan default
            if ($raja['foto'] != 'default.jpg' && file_exists('uploaded_files/raja/' . $raja['foto'])) {
                unlink('uploaded_files/raja/' . $raja['foto']);
            }
        }

        // Update data dengan Query Builder
        $data = [
            'nama' => $this->request->getPost('nama'),
            'cerita' => $this->request->getPost('cerita'),
            'foto' => $fotoName,
            'longitude' => $this->request->getPost('longitude') ?: null,
            'latitude' => $this->request->getPost('latitude') ?: null
        ];

        try {
            $db->table('raja')->where('id', $id)->update($data);
            
            return redirect()->to('/admin/mapel/' . $raja['mapel_id'] . '/raja')
                             ->with('success', 'Raja berhasil diperbarui!');
                             
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }

    public function delete($id = null)
    {
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        // Ambil data raja dulu
        $db = \Config\Database::connect();
        $raja = $db->table('raja')->where('id', $id)->get()->getRowArray();

        if (!$raja) {
            return redirect()->back()->with('error', 'Raja tidak ditemukan!');
        }

        $mapel_id = $raja['mapel_id'];

        // Cek kepemilikan
        $mapelModel = new MapelModel();
        $mapel = $mapelModel->where('id', $mapel_id)
                           ->where('tutor_id', $tutor_id)
                           ->first();

        if (!$mapel) {
            return redirect()->to('/admin/mapel')->with('error', 'Akses ditolak!');
        }

        // Hapus foto jika bukan default
        if ($raja['foto'] != 'default.jpg' && file_exists('uploaded_files/raja/' . $raja['foto'])) {
            unlink('uploaded_files/raja/' . $raja['foto']);
        }

        // Hapus data
        try {
            $db->table('raja')->where('id', $id)->delete();
            
            return redirect()->to('/admin/mapel/' . $mapel_id . '/raja')
                             ->with('success', 'Raja berhasil dihapus!');
                             
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

    private function getProfile($tutor_id)
    {
        $db = \Config\Database::connect();
        return $db->table('tutors')->where('id', $tutor_id)->get()->getRowArray();
    }
}