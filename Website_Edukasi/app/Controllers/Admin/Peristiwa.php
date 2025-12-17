<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PeristiwaModel;
use App\Models\MapelModel;
use App\Models\TutorModel;

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

        // SIMPAN ASAL HALAMAN DI SESSION
        $referer = $this->request->getServer('HTTP_REFERER') ?? '';
        
        if (strpos($referer, '/admin/materi') !== false) {
            session()->set('peristiwa_redirect', 'materi');
        } elseif (strpos($referer, '/admin/mapel/view/') !== false) {
            // Simpan juga kerajaan_id dari referer
            preg_match('/\/admin\/mapel\/view\/(\d+)/', $referer, $matches);
            if (!empty($matches[1])) {
                session()->set('peristiwa_kerajaan_id', $matches[1]);
            }
            session()->set('peristiwa_redirect', 'mapel_view');
        }

        $tutorModel = new TutorModel();
        $mapelModel = new MapelModel();
        
        $profile = $tutorModel->find($tutor_id);
        $mapelList = $mapelModel->findAll();

        if (empty($mapelList)) {
            return redirect()->to('/admin/mapel/create')->with('error', 'Buat kerajaan terlebih dahulu!');
        }

        return view('admin/peristiwa/create', [
            'title' => 'Tambah Peristiwa',
            'mapelList' => $mapelList,
            'profile' => $profile
        ]);
    }

    public function store()
    {
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

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

        $fotoName = null;
        $foto = $this->request->getFile('foto_peristiwa');
        
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $foto->getRandomName();
            $foto->move('uploaded_files/peristiwa/', $fotoName);
        }

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

        // TENTUKAN REDIRECT BERDASARKAN SESSION
        $redirect_to = session()->get('peristiwa_redirect');
        session()->remove('peristiwa_redirect');
        
        $kerajaan_id = $data['kerajaan_id'];

        if ($redirect_to === 'materi') {
            return redirect()->to('/admin/materi')
                             ->with('success', 'Peristiwa berhasil ditambahkan!');
        } else {
            // Default: kembali ke view mapel
            return redirect()->to('/admin/mapel/view/' . $kerajaan_id)
                             ->with('success', 'Peristiwa berhasil ditambahkan!');
        }
    }

    public function edit($id = null)
    {
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        // SIMPAN ASAL HALAMAN DI SESSION
        $referer = $this->request->getServer('HTTP_REFERER') ?? '';
        
        if (strpos($referer, '/admin/materi') !== false) {
            session()->set('peristiwa_redirect', 'materi');
        } elseif (strpos($referer, '/admin/mapel/view/') !== false) {
            session()->set('peristiwa_redirect', 'mapel_view');
            // Simpan kerajaan_id dari referer
            preg_match('/\/admin\/mapel\/view\/(\d+)/', $referer, $matches);
            if (!empty($matches[1])) {
                session()->set('peristiwa_kerajaan_id', $matches[1]);
            }
        }

        $tutorModel = new TutorModel();
        $peristiwaModel = new PeristiwaModel();
        $mapelModel = new MapelModel();

        $profile = $tutorModel->find($tutor_id);
        $peristiwa = $peristiwaModel->find($id);
        
        if (!$peristiwa) {
            return redirect()->back()->with('error', 'Peristiwa tidak ditemukan!');
        }

        $mapelList = $mapelModel->findAll();

        return view('admin/peristiwa/edit', [
            'title' => 'Edit Peristiwa - ' . $peristiwa['nama_peristiwa'],
            'peristiwa' => $peristiwa,
            'mapelList' => $mapelList,
            'profile' => $profile
        ]);
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
            'deskripsi' => 'required',
            'fakta_menarik' => 'permit_empty',
            'lokasi' => 'permit_empty|max_length[255]',
            'foto_peristiwa' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fotoName = $peristiwa['foto_peristiwa'];
        $foto = $this->request->getFile('foto_peristiwa');
        
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $foto->getRandomName();
            $foto->move('uploaded_files/peristiwa/', $fotoName);
            
            if ($peristiwa['foto_peristiwa'] && file_exists('uploaded_files/peristiwa/' . $peristiwa['foto_peristiwa'])) {
                unlink('uploaded_files/peristiwa/' . $peristiwa['foto_peristiwa']);
            }
        }

        $data = [
            'kerajaan_id' => $this->request->getVar('kerajaan_id'),
            'nama_peristiwa' => $this->request->getVar('nama_peristiwa'),
            'tahun' => $this->request->getVar('tahun') ?: null,
            'deskripsi' => $this->request->getVar('deskripsi'),
            'fakta_menarik' => $this->request->getVar('fakta_menarik') ?: null,
            'lokasi' => $this->request->getVar('lokasi') ?: null,
            'foto_peristiwa' => $fotoName
        ];

        $peristiwaModel->update($id, $data);

        // TENTUKAN REDIRECT BERDASARKAN SESSION
        $redirect_to = session()->get('peristiwa_redirect');
        session()->remove('peristiwa_redirect');
        
        $kerajaan_id = $data['kerajaan_id'];

        if ($redirect_to === 'materi') {
            return redirect()->to('/admin/materi')
                             ->with('success', 'Peristiwa berhasil diperbarui!');
        } else {
            // Default: kembali ke view mapel
            return redirect()->to('/admin/mapel/view/' . $kerajaan_id)
                             ->with('success', 'Peristiwa berhasil diperbarui!');
        }
    }

    public function delete($id = null)
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

        $kerajaan_id = $peristiwa['kerajaan_id'];
        
        // Hapus foto jika ada
        if ($peristiwa['foto_peristiwa'] && file_exists('uploaded_files/peristiwa/' . $peristiwa['foto_peristiwa'])) {
            unlink('uploaded_files/peristiwa/' . $peristiwa['foto_peristiwa']);
        }

        $peristiwaModel->delete($id);

        // TENTUKAN REDIRECT BERDASARKAN REFERER (untuk delete)
        $referer = $this->request->getServer('HTTP_REFERER') ?? '';
        
        if (strpos($referer, '/admin/materi') !== false) {
            return redirect()->to('/admin/materi')
                             ->with('success', 'Peristiwa berhasil dihapus!');
        } else {
            return redirect()->to('/admin/mapel/view/' . $kerajaan_id)
                             ->with('success', 'Peristiwa berhasil dihapus!');
        }
    }
    
    /**
     * Method untuk menampilkan list peristiwa berdasarkan kerajaan
     * Redirect ke view mapel karena peristiwa sudah ditampilkan di sana
     */
    public function index($kerajaan_id = null)
    {
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        if ($kerajaan_id) {
            return redirect()->to('/admin/mapel/view/' . $kerajaan_id);
        }
        
        return redirect()->to('/admin/materi');
    }
}