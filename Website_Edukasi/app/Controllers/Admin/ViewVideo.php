<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContentModel;
use App\Models\TutorModel;
use App\Models\LikesModel;
use App\Models\CommentModel;

class ViewVideo extends BaseController
{
    public function index($id = null)
    {
        // Cek login
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        // Jika tidak ada ID
        if (!$id) {
            return redirect()->to('/admin/contents');
        }

        $contentModel = new ContentModel();
        $tutorModel = new TutorModel();
        $likesModel = new LikesModel();
        $commentsModel = new CommentModel();
        $db = \Config\Database::connect(); // Tambahkan ini

        // Ambil data video berdasarkan ID dan tutor_id
        $video = $contentModel
            ->where('id', $id)
            ->where('tutor_id', $tutor_id)
            ->first();

        if (!$video) {
            return redirect()->to('/admin/contents')->with('error', 'Video tidak ditemukan!');
        }

        // Ambil profile tutor
        $profile = $tutorModel->find($tutor_id);

        // Hitung total likes untuk video ini oleh tutor ini
        $total_likes = $likesModel
            ->where('tutor_id', $tutor_id)
            ->where('content_id', $id)
            ->countAllResults();

        // Hitung total comments untuk video ini oleh tutor ini
        $total_comments = $commentsModel
            ->where('tutor_id', $tutor_id)
            ->where('content_id', $id)
            ->countAllResults();

        // Ambil semua komentar untuk video ini dengan JOIN ke tabel users
        $builder = $db->table('comments');
        $builder->select('comments.*, users.name, users.image');
        $builder->join('users', 'users.id = comments.user_id');
        $builder->where('comments.content_id', $id);
        $comments = $builder->get()->getResultArray();

        $data = [
            'profile' => $profile,
            'video' => $video,
            'total_likes' => $total_likes,
            'total_comments' => $total_comments,
            'comments' => $comments, // Langsung berisi data user
        ];

        return view('admin/view_video', $data);
    }

    public function deleteVideo()
    {
        // Cek login
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        $id = $this->request->getPost('video_id');
        
        if (!$id) {
            return redirect()->back()->with('error', 'ID video tidak valid!');
        }

        $contentModel = new ContentModel();
        $likesModel = new LikesModel();
        $commentsModel = new CommentModel();

        // Ambil data video untuk hapus file
        $video = $contentModel
            ->where('id', $id)
            ->where('tutor_id', $tutor_id)
            ->first();

        if (!$video) {
            return redirect()->back()->with('error', 'Video tidak ditemukan!');
        }

        // Hapus file thumb
        if (!empty($video['thumb']) && file_exists('uploaded_files/' . $video['thumb'])) {
            unlink('uploaded_files/' . $video['thumb']);
        }

        // Hapus file video
        if (!empty($video['video']) && file_exists('uploaded_files/' . $video['video'])) {
            unlink('uploaded_files/' . $video['video']);
        }

        // Hapus likes
        $likesModel->where('content_id', $id)->delete();

        // Hapus comments
        $commentsModel->where('content_id', $id)->delete();

        // Hapus video dari database
        $contentModel->delete($id);

        return redirect()->to('/admin/contents')->with('success', 'Video berhasil dihapus!');
    }

    public function deleteComment()
    {
        // Cek login
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        $id = $this->request->getPost('comment_id');
        
        if (!$id) {
            return redirect()->back()->with('error', 'ID komentar tidak valid!');
        }

        $commentsModel = new CommentModel();

        // Verifikasi komentar ada
        $comment = $commentsModel->find($id);
        
        if (!$comment) {
            return redirect()->back()->with('error', 'Komentar sudah dihapus!');
        }

        // Hapus komentar
        $commentsModel->delete($id);

        return redirect()->back()->with('success', 'Komentar berhasil dihapus!');
    }
}