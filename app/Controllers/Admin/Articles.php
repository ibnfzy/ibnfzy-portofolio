<?php

namespace App\Controllers\Admin;

use App\Models\ArticleModel;
use App\Models\ArticleImageModel;

class Articles extends BaseAdmin
{
    protected $articleModel;
    protected $imageModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
        $this->imageModel = new ArticleImageModel();
    }

    public function index()
    {
        $data['articles'] = $this->articleModel->orderBy('published_at','DESC')->findAll();
        return view('admin/articles/index', $data);
    }

    public function create()
    {
        $view = view('admin/articles/form', ['article' => null]);

        if ($this->isAjaxRequest()) {
            return $this->respondWithFragments([
                '#modal-content' => $view,
            ]);
        }

        return $view;
    }

    public function store()
    {
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'slug' => 'required|alpha_dash|min_length[3]|max_length[255]'
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'body' => $this->request->getPost('body'),
            'is_published' => $this->request->getPost('is_published') ? 1 : 0,
            'published_at' => $this->request->getPost('published_at') ?: null,
        ];

        $id = $this->articleModel->insert($data);
        $this->session->setFlashdata('success', 'Article created');

        if ($this->request->getFileMultiple('images')) {
            $this->handleUploadImages($id, $this->request->getFileMultiple('images'));
        }

        if ($this->isAjaxRequest()) {
            $data = ['articles' => $this->articleModel->orderBy('published_at','DESC')->findAll()];

            return $this->respondWithFragments([
                '#admin-articles-list' => view('admin/articles/list_fragment', $data),
                '#flash-container' => view('partials/flash'),
                '#modal-content' => '',
            ]);
        }

        return redirect()->to('/admin/articles');
    }

    public function edit($id)
    {
        $article = $this->articleModel->find($id);
        if (! $article) throw new \CodeIgniter\Exceptions\PageNotFoundException('Article not found');
        $article['images'] = $this->imageModel->where('article_id', $id)->orderBy('order_index','ASC')->findAll();
        $view = view('admin/articles/form', ['article' => $article]);

        if ($this->isAjaxRequest()) {
            return $this->respondWithFragments([
                '#modal-content' => $view,
                '#flash-container' => view('partials/flash'),
            ]);
        }

        return $view;
    }

    public function update($id)
    {
        $article = $this->articleModel->find($id);
        if (! $article) throw new \CodeIgniter\Exceptions\PageNotFoundException('Article not found');

        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'slug' => 'required|alpha_dash|min_length[3]|max_length[255]'
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'body' => $this->request->getPost('body'),
            'is_published' => $this->request->getPost('is_published') ? 1 : 0,
            'published_at' => $this->request->getPost('published_at') ?: null,
        ];

        $this->articleModel->update($id, $data);
        $this->session->setFlashdata('success', 'Article updated');

        if ($this->request->getFileMultiple('images')) {
            $this->handleUploadImages($id, $this->request->getFileMultiple('images'));
        }

        if ($this->isAjaxRequest()) {
            $data = ['articles' => $this->articleModel->orderBy('published_at','DESC')->findAll()];

            return $this->respondWithFragments([
                '#admin-articles-list' => view('admin/articles/list_fragment', $data),
                '#flash-container' => view('partials/flash'),
                '#modal-content' => '',
            ]);
        }

        return redirect()->to('/admin/articles');
    }

    public function delete($id)
    {
        $article = $this->articleModel->find($id);
        if (! $article) return redirect()->to('/admin/articles');

        $images = $this->imageModel->where('article_id', $id)->findAll();
        foreach ($images as $img) {
            $path = FCPATH . ltrim($img['path'], '/');
            if (is_file($path)) @unlink($path);
        }

        $this->imageModel->where('article_id', $id)->delete();
        $this->articleModel->delete($id);
        $this->session->setFlashdata('success', 'Article deleted');

        if ($this->isAjaxRequest()) {
            $articles = $this->articleModel->orderBy('created_at', 'DESC')->findAll();

            return $this->respondWithFragments([
                '#admin-articles-list' => view('admin/articles/list_fragment', ['articles' => $articles]),
                '#flash-container' => view('partials/flash'),
            ]);
        }

        return redirect()->to('/admin/articles');
    }

    protected function handleUploadImages($articleId, $files)
    {
        $uploadDir = FCPATH . 'uploads/articles/';
        if (! is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        foreach ($files as $file) {
            if (! $file->isValid()) continue;
            $name = $file->getRandomName();
            $file->move($uploadDir, $name);
            $path = '/uploads/articles/' . $name;

            $max = $this->imageModel->selectMax('order_index')->where('article_id', $articleId)->first();
            $order = ($max['order_index'] ?? 0) + 1;
            $this->imageModel->insert(['article_id' => $articleId, 'path' => $path, 'alt' => '', 'order_index' => $order]);
        }
    }

    public function deleteImage($id)
    {
        $img = $this->imageModel->find($id);
        if (! $img) return redirect()->back();
        $path = FCPATH . ltrim($img['path'], '/');
        if (is_file($path)) @unlink($path);
        $this->imageModel->delete($id);
        $this->session->setFlashdata('success', 'Image deleted');
        return redirect()->back();
    }

    // Return images fragment for an article
    public function images($articleId = null)
    {
        if (! $articleId) return '';
        $images = $this->imageModel->where('article_id', $articleId)->orderBy('order_index','ASC')->findAll();
        $article = $this->articleModel->find($articleId);
        $view = view('admin/articles/images_fragment', ['images' => $images, 'article' => $article]);

        if ($this->isAjaxRequest()) {
            return $this->respondWithFragments([
                '#article-images' => $view,
            ]);
        }

        return $view;
    }

    // Delete image by article/id route
    public function imageDelete($articleId = null, $imageId = null)
    {
        if (! $imageId) return $this->response->setStatusCode(400);
        $img = $this->imageModel->find($imageId);
        if (! $img) return $this->response->setStatusCode(404);
        $path = FCPATH . ltrim($img['path'], '/');
        if (is_file($path)) @unlink($path);
        $this->imageModel->delete($imageId);

        $this->session->setFlashdata('success', 'Image deleted');

        if ($this->isAjaxRequest()) {
            $images = $this->imageModel->where('article_id', $articleId)->orderBy('order_index','ASC')->findAll();
            $article = $this->articleModel->find($articleId);

            return $this->respondWithFragments([
                '#article-images' => view('admin/articles/images_fragment', ['images' => $images, 'article' => $article]),
                '#flash-container' => view('partials/flash'),
            ]);
        }

        return redirect()->back();
    }

    // Upload images for an article via dedicated endpoint
    public function upload($articleId = null)
    {
        if (! $articleId) return $this->response->setStatusCode(400);
        $files = $this->request->getFileMultiple('images');
        if ($files) {
            $this->handleUploadImages($articleId, $files);
        }

        if ($this->isAjaxRequest()) {
            $images = $this->imageModel->where('article_id', $articleId)->orderBy('order_index','ASC')->findAll();
            $article = $this->articleModel->find($articleId);

            return $this->respondWithFragments([
                '#article-images' => view('admin/articles/images_fragment', ['images' => $images, 'article' => $article]),
                '#flash-container' => view('partials/flash'),
            ]);
        }

        return redirect()->back();
    }

    public function reorderImages($articleId = null)
    {
        $body = $this->request->getJSON(true);
        if (! $body || ! isset($body['order']) || ! is_array($body['order'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid payload']);
        }
        $order = $body['order'];
        foreach ($order as $idx => $imgId) {
            $this->imageModel->update((int)$imgId, ['order_index' => (int)$idx]);
        }
        if ($this->isAjaxRequest()) {
            $images = $this->imageModel->where('article_id', $articleId)->orderBy('order_index','ASC')->findAll();
            $article = $this->articleModel->find($articleId);

            return $this->respondWithFragments([
                '#article-images' => view('admin/articles/images_fragment', ['images' => $images, 'article' => $article]),
                '#flash-container' => view('partials/flash'),
            ]);
        }

        return $this->response->setJSON(['success' => true]);
    }
}
