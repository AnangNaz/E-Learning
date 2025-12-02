<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MapelModel;
use App\Models\ContentModel;
use App\Models\MateriModel;
use App\Models\SoalModel;
use App\Models\TutorModel;

class ViewMapel extends BaseController
{
    public function index($id)
    {
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        $mapelModel   = new MapelModel();
        $contentModel = new ContentModel();
        $materiModel  = new MateriModel();
        $soalModel    = new SoalModel();
        $tutorModel   = new TutorModel();

        // ambil profil tutor
        $profile = $tutorModel->find($tutor_id);

        // ambil data mapel
        $mapel = $mapelModel->where('id', $id)->where('tutor_id', $tutor_id)->first();
        if (!$mapel) {
            return redirect()->back()->with('error', 'Kerajaan tidak ditemukan!');
        }

        // ambil video
        $videos = $contentModel->where('playlist_id', $id)->where('tutor_id', $tutor_id)->findAll();

        // ambil materi
        $materi = $materiModel->where('playlist_id', $id)->where('tutor_id', $tutor_id)->findAll();

        // ambil soal
        $soal = $soalModel
            ->select('soal.*, content.title')
            ->join('content', 'content.id = soal.content_id')
            ->where('content.playlist_id', $id)
            ->where('soal.tutor_id', $tutor_id)
            ->findAll();

        $data = [
            'profile' => $profile,
            'mapel'   => $mapel,
            'videos'  => $videos,
            'materi'  => $materi,
            'soal'    => $soal,
        ];

        return view('admin/view_mapel', $data);
    }
}
