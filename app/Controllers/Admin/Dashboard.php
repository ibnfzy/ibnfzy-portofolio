<?php

namespace App\Controllers\Admin;

class Dashboard extends BaseAdmin
{
    public function index(): string
    {
        $projectModel = new \App\Models\ProjectModel();
        $articleModel = new \App\Models\ArticleModel();
        $userModel = new \App\Models\UserModel();

        $data = [];
        $data['project_count'] = $projectModel->countAllResults(false);
        $data['article_count'] = $articleModel->countAllResults(false);
        $data['user_count'] = $userModel->countAllResults(false);

        return view('admin/dashboard', $data);
    }
}
