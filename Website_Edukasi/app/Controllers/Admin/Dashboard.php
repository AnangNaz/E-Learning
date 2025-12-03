<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TutorModel;
use App\Models\MateriModel;
use App\Models\MapelModel;
use App\Models\CommentModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // ambil cookie dengan cara CI4 yang benar
        $tutor_id = $this->request->getCookie('tutor_id');

        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        $tutors  = new TutorModel();
        $materi  = new MateriModel();
        $mapel   = new MapelModel();
        $comment = new CommentModel();

        $profile = $tutors->find($tutor_id);

        return view('admin/dashboard', [
            'profile'        => $profile,
            'total_contents' => $materi->where('tutor_id', $tutor_id)->countAllResults(),
            'total_mapel'    => $mapel->where('tutor_id', $tutor_id)->countAllResults(),
            'total_comments' => $comment->where('tutor_id', $tutor_id)->countAllResults(),
        ]);
    }
}
