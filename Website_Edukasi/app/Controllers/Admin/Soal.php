<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SoalModel;
use App\Models\MapelModel; // Jika ada model untuk mapel

class Soal extends BaseController
{
    protected $soalModel;

    public function __construct()
    {
        $this->soalModel = new SoalModel();
    }

    public function index()
    {
        // Cek cookie login untuk admin
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/admin/login')->with('error', 'Please login first!');
        }

        // Ambil semua soal dengan join ke tabel mapel jika perlu
        $soal = $this->soalModel->findAll();
        
        $data = [
            'title' => 'Kelola Soal Quiz',
            'profile' => $this->getProfile($tutor_id),
            'soal' => $soal
        ];

        return view('admin/soal/index', $data);
    }

    public function create()
    {
        // Cek cookie login untuk admin
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/admin/login')->with('error', 'Please login first!');
        }

        // Ambil data mapel untuk dropdown
        $mapelModel = new MapelModel();
        $mapel = $mapelModel->findAll();

        $data = [
            'title' => 'Tambah Soal Baru',
            'profile' => $this->getProfile($tutor_id),
            'mapel' => $mapel
        ];

        return view('admin/soal/create', $data);
    }

    public function store()
    {
        // Cek cookie login untuk admin
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/admin/login')->with('error', 'Please login first!');
        }

        // Validasi
        if (!$this->validate($this->soalModel->validationRules, $this->soalModel->validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Data untuk disimpan
        $data = [
            'mapel_id' => $this->request->getPost('mapel_id'),
            'pertanyaan' => $this->request->getPost('pertanyaan'),
            'pilihan_a' => $this->request->getPost('pilihan_a'),
            'pilihan_b' => $this->request->getPost('pilihan_b'),
            'pilihan_c' => $this->request->getPost('pilihan_c'),
            'pilihan_d' => $this->request->getPost('pilihan_d'),
            'jawaban_benar' => $this->request->getPost('jawaban_benar'),
            'dibuat_pada' => date('Y-m-d H:i:s')
        ];

        // Simpan ke database
        if ($this->soalModel->insert($data)) {
            return redirect()->to('/admin/materi')->with('success', 'Soal berhasil ditambahkan!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan soal!');
        }
    }

    public function edit($id)
    {
        // Cek cookie login untuk admin
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/admin/login')->with('error', 'Please login first!');
        }

        // Cari soal berdasarkan ID
        $soal = $this->soalModel->find($id);
        if (!$soal) {
            return redirect()->to('/admin/soal')->with('error', 'Soal tidak ditemukan!');
        }

        // Ambil data mapel untuk dropdown
        $mapelModel = new MapelModel();
        $mapel = $mapelModel->findAll();

        $data = [
            'title' => 'Edit Soal',
            'profile' => $this->getProfile($tutor_id),
            'soal' => $soal,
            'mapel' => $mapel
        ];

        return view('admin/soal/edit', $data);
    }

    public function update($id)
    {
        // Cek cookie login untuk admin
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/admin/login')->with('error', 'Please login first!');
        }

        // Validasi
        if (!$this->validate($this->soalModel->validationRules, $this->soalModel->validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Data untuk diupdate
        $data = [
            'mapel_id' => $this->request->getPost('mapel_id'),
            'pertanyaan' => $this->request->getPost('pertanyaan'),
            'pilihan_a' => $this->request->getPost('pilihan_a'),
            'pilihan_b' => $this->request->getPost('pilihan_b'),
            'pilihan_c' => $this->request->getPost('pilihan_c'),
            'pilihan_d' => $this->request->getPost('pilihan_d'),
            'jawaban_benar' => $this->request->getPost('jawaban_benar'),
            'diubah_pada' => date('Y-m-d H:i:s')
        ];

        // Update ke database
        if ($this->soalModel->update($id, $data)) {
            return redirect()->to('/admin/materi')->with('success', 'Soal berhasil diupdate!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate soal!');
        }
    }

    public function delete($id)
    {
        // Cek cookie login untuk admin
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/admin/login')->with('error', 'Please login first!');
        }

        // Hapus soal
        if ($this->soalModel->delete($id)) {
            return redirect()->to('/admin/materi')->with('success', 'Soal berhasil dihapus!');
        } else {
            return redirect()->to('/admin/materi')->with('error', 'Gagal menghapus soal!');
        }
    }

    private function getProfile($tutor_id)
    {
        $tutorModel = new \App\Models\TutorModel();
        return $tutorModel->find($tutor_id);
    }
}