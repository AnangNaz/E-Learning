<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TutorModel;
use App\Models\MateriModel;
use App\Models\ContentModel;
use App\Models\SoalModel;
use CodeIgniter\Files\File;

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

        $profile = $tutorModel->find($tutor_id);

        $data = [
            'profile' => $profile,

            // LIST VIDEO
            'videos' => $contentModel->where('tutor_id', $tutor_id)
                                     ->orderBy('date', 'DESC')
                                     ->findAll(),

            // LIST MATERI
            'materi' => $materiModel->where('tutor_id', $tutor_id)
                                    ->orderBy('date', 'DESC')
                                    ->findAll(),

            // LIST SOAL + JOIN video title
            'soal' => $soalModel->select('soal.*, content.title AS video_title')
                                ->join('content', 'content.id = soal.content_id', 'left')
                                ->where('soal.tutor_id', $tutor_id)
                                ->orderBy('soal.date', 'DESC')
                                ->findAll(),
        ];

        return view('admin/materi', $data);
    }

    /* ============================================================
       DELETE VIDEO
    ============================================================ */
    public function deleteVideo($id)
    {
        $contentModel = new ContentModel();
        $video = $contentModel->find($id);

        if ($video) {

            // Hapus thumbnail
            if (!empty($video['thumb'])) {
                $path = FCPATH . 'uploaded_files/' . $video['thumb'];
                if (file_exists($path)) unlink($path);
            }

            // Hapus file video
            if (!empty($video['video'])) {
                $path = FCPATH . 'uploaded_files/' . $video['video'];
                if (file_exists($path)) unlink($path);
            }

            // Hapus content
            $contentModel->delete($id);
        }

        return redirect()->back()->with('success', 'Video berhasil dihapus!');
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
    public function deleteSoal($id)
    {
        $soalModel = new SoalModel();
        $soalModel->delete($id);

        return redirect()->back()->with('success', 'Soal berhasil dihapus!');
    }
}
