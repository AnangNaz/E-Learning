<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TutorModel;
use App\Models\ContentModel;
use App\Models\MapelModel;

class UpdateVideo extends BaseController
{
    public function index($id)
    {
        // CEK LOGIN
        if (!isset($_COOKIE['tutor_id'])) {
            return redirect()->to('/login');
        }

        $tutor_id = $_COOKIE['tutor_id'];

        // LOAD MODELS
        $tutorModel   = new TutorModel();
        $contentModel = new ContentModel();
        $mapelModel   = new MapelModel();

        // PROFILE
        $profile = $tutorModel->find($tutor_id);

        // DATA VIDEO BERDASARKAN TUTOR
        $video = $contentModel
            ->where('tutor_id', $tutor_id)
            ->find($id);

        if (!$video) {
            return redirect()->to('/admin/video')->with('error', 'Video tidak ditemukan!');
        }

        // DATA MAPEL
        $mapel = $mapelModel
            ->where('tutor_id', $tutor_id)
            ->findAll();

        return view('admin/update_video', [
            'profile' => $profile,
            'video'   => $video,
            'mapel'   => $mapel
        ]);
    }

    public function update($id)
    {
        if (!isset($_COOKIE['tutor_id'])) {
            return redirect()->to('/login');
        }

        $contentModel = new ContentModel();

        // CEK DATA LAMA
        $old = $contentModel->find($id);
        if (!$old) {
            return redirect()->to('/admin/video')->with('error', 'Data video tidak ditemukan!');
        }

        // AMBIL FILE
        $thumb = $this->request->getFile('thumb');
        $video = $this->request->getFile('video');

        // NILAI DEFAULT
        $thumbName = $old['thumb'];
        $videoName = $old['video'];

        // UPDATE THUMB
        if ($thumb && $thumb->isValid() && !$thumb->hasMoved()) {
            $thumbName = $thumb->getRandomName();
            $thumb->move('uploaded_files/', $thumbName);

            // HAPUS FILE LAMA
            if (is_file('uploaded_files/' . $old['thumb'])) {
                unlink('uploaded_files/' . $old['thumb']);
            }
        }

        // UPDATE VIDEO
        if ($video && $video->isValid() && !$video->hasMoved()) {
            $videoName = $video->getRandomName();
            $video->move('uploaded_files/', $videoName);

            // HAPUS FILE LAMA
            if (is_file('uploaded_files/' . $old['video'])) {
                unlink('uploaded_files/' . $old['video']);
            }
        }

        // SIMPAN KE DATABASE
        $contentModel->update($id, [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status'),
            'playlist_id' => $this->request->getPost('playlist'),
            'thumb'       => $thumbName,
            'video'       => $videoName
        ]);

        return redirect()->back()->with('success', 'Video berhasil diperbarui!');
    }
}
