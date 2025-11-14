<?php

namespace App\Controllers;

class PublicController extends BaseController
{
    public function index(): string
    {
        $projectModel = new \App\Models\ProjectModel();
        $articleModel = new \App\Models\ArticleModel();
        $profileModel = new \App\Models\ProfileModel();

        $data = [];
        // Latest 3 projects
        $data['projects'] = $projectModel->where('is_public',1)->orderBy('created_at','DESC')->findAll(3);
        // Latest 3 articles
        $data['articles'] = $articleModel->where('is_published',1)->orderBy('published_at','DESC')->findAll(3);
        // Profile (first)
        $data['profile'] = $profileModel->orderBy('id','ASC')->first();

        return view('public/home', $data);
    }

    public function projects(): string
    {
        $projectModel = new \App\Models\ProjectModel();
        $data['projects'] = $projectModel->where('is_public',1)->orderBy('created_at','DESC')->findAll();
        return view('public/projects', $data);
    }

    public function project($slug = null): string
    {
        $projectModel = new \App\Models\ProjectModel();
        $imageModel = new \App\Models\ProjectImageModel();

        $project = $projectModel->where('slug', $slug)->first();
        if (! $project) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Project not found');
        }

        $project['images'] = $imageModel->where('project_id', $project['id'])->orderBy('order_index','ASC')->findAll();
        $data['project'] = $project;
        return view('public/project_detail', $data);
    }

    // HTMX endpoint to return a specific project image fragment
    public function projectImage($projectId = null, $index = 0)
    {
        $imageModel = new \App\Models\ProjectImageModel();
        $images = $imageModel->where('project_id', $projectId)->orderBy('order_index','ASC')->findAll();
        if (! isset($images[$index])) {
            return '';
        }
        $data['image'] = $images[$index];
        return view('partials/image_fragment', $data);
    }

    public function articles(): string
    {
        $articleModel = new \App\Models\ArticleModel();
        $data['articles'] = $articleModel->where('is_published',1)->orderBy('published_at','DESC')->findAll();
        return view('public/articles', $data);
    }

    public function article($slug = null): string
    {
        $articleModel = new \App\Models\ArticleModel();
        $imageModel = new \App\Models\ArticleImageModel();

        $article = $articleModel->where('slug', $slug)->first();
        if (! $article) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Article not found');
        }
        $article['images'] = $imageModel->where('article_id', $article['id'])->orderBy('order_index','ASC')->findAll();
        $data['article'] = $article;
        return view('public/article_detail', $data);
    }
}
