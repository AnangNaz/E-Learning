<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TutorModel;
use App\Models\MateriModel;
use App\Models\MapelModel;
use App\Models\LikesModel;
use App\Models\CommentModel;

class Profile extends BaseController
{
    public function index()
    {
$tutorId = $_COOKIE['tutor_id'] ?? null;

if (!$tutorId) {
    return redirect()->to('login');
}


        $tutorModel   = new TutorModel();
        $materiModel  = new MateriModel();
        $mapelModel   = new MapelModel();
        $likeModel    = new LikesModel();
        $commentModel = new CommentModel();

        $profile = $tutorModel->find($tutorId);

        $data = [
            'profile'        => $profile,
            'total_mapel'    => $mapelModel->where('tutor_id', $tutorId)->countAllResults(),
            'total_materi'   => $materiModel->where('tutor_id', $tutorId)->countAllResults(),
            'total_likes'    => $likeModel->where('tutor_id', $tutorId)->countAllResults(),
            'total_comments' => $commentModel->where('tutor_id', $tutorId)->countAllResults(),
        ];

        return view('admin/profile', $data);
    }
}
