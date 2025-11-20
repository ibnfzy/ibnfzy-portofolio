<?php

namespace App\Controllers\Admin;

use App\Models\ProjectModel;
use App\Models\ProjectImageModel;

class Projects extends BaseAdmin
{
    protected $projectModel;
    protected $imageModel;

    public function __construct()
    {
        $this->projectModel = new ProjectModel();
        $this->imageModel = new ProjectImageModel();
    }

    public function index()
    {
        $data['projects'] = $this->projectModel->orderBy('created_at','DESC')->findAll();
        return view('admin/projects/index', $data);
    }

    public function create()
    {
        $view = view('admin/projects/form', ['project' => null]);

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
            if ($this->isAjaxRequest()) {
                $view = view('admin/projects/form', [
                    'project' => null,
                    'errors' => $this->validator->getErrors(),
                    'formData' => $this->request->getPost(),
                ]);

                return $this->respondWithFragments([
                    '#modal-content' => $view,
                    '#flash-container' => view('partials/flash'),
                ]);
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'description' => $this->request->getPost('description'),
            'is_public' => $this->request->getPost('is_public') ? 1 : 0,
            'published_at' => $this->request->getPost('published_at') ?: null,
        ];

        $id = $this->projectModel->insert($data);
        $this->session->setFlashdata('success', 'Project created');

        // If images were uploaded in same request, handle them
        if ($this->request->getFileMultiple('images')) {
            $this->handleUploadImages($id, $this->request->getFileMultiple('images'));
        }

        if ($this->isAjaxRequest()) {
            $data = ['projects' => $this->projectModel->orderBy('created_at','DESC')->findAll()];

            return $this->respondWithFragments([
                '#admin-projects-list' => view('admin/projects/list_fragment', $data),
                '#flash-container' => view('partials/flash'),
                '#modal-content' => '',
            ]);
        }

        return redirect()->to('/admin/projects');
    }

    public function edit($id)
    {
        $project = $this->projectModel->find($id);
        if (! $project) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Project not found');
        }

        $project['images'] = $this->imageModel->where('project_id', $id)->orderBy('order_index','ASC')->findAll();
        $view = view('admin/projects/form', ['project' => $project]);

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
        $project = $this->projectModel->find($id);
        if (! $project) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Project not found');
        }

        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'slug' => 'required|alpha_dash|min_length[3]|max_length[255]'
        ];
        if (! $this->validate($rules)) {
            if ($this->isAjaxRequest()) {
                $project['images'] = $this->imageModel->where('project_id', $id)->orderBy('order_index','ASC')->findAll();

                $view = view('admin/projects/form', [
                    'project' => array_merge($project, $this->request->getPost()),
                    'errors' => $this->validator->getErrors(),
                ]);

                return $this->respondWithFragments([
                    '#modal-content' => $view,
                    '#flash-container' => view('partials/flash'),
                ]);
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'description' => $this->request->getPost('description'),
            'is_public' => $this->request->getPost('is_public') ? 1 : 0,
            'published_at' => $this->request->getPost('published_at') ?: null,
        ];

        $this->projectModel->update($id, $data);
        $this->session->setFlashdata('success', 'Project updated');

        // handle uploaded images
        if ($this->request->getFileMultiple('images')) {
            $this->handleUploadImages($id, $this->request->getFileMultiple('images'));
        }

        if ($this->isAjaxRequest()) {
            $data = ['projects' => $this->projectModel->orderBy('created_at','DESC')->findAll()];

            return $this->respondWithFragments([
                '#admin-projects-list' => view('admin/projects/list_fragment', $data),
                '#flash-container' => view('partials/flash'),
                '#modal-content' => '',
            ]);
        }

        return redirect()->to('/admin/projects');
    }

    public function delete($id)
    {
        $project = $this->projectModel->find($id);
        if (! $project) {
            return redirect()->to('/admin/projects');
        }

        // delete images files
        $images = $this->imageModel->where('project_id', $id)->findAll();
        foreach ($images as $img) {
            $path = FCPATH . ltrim($img['path'], '/');
            if (is_file($path)) @unlink($path);
        }

        $this->imageModel->where('project_id', $id)->delete();
        $this->projectModel->delete($id);
        $this->session->setFlashdata('success', 'Project deleted');

        if ($this->isAjaxRequest()) {
            $data = ['projects' => $this->projectModel->orderBy('created_at','DESC')->findAll()];

            return $this->respondWithFragments([
                '#admin-projects-list' => view('admin/projects/list_fragment', $data),
                '#flash-container' => view('partials/flash'),
            ]);
        }

        return redirect()->to('/admin/projects');
    }

    protected function handleUploadImages($projectId, $files)
    {
        $uploadDir = FCPATH . 'uploads/projects/';
        if (! is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        foreach ($files as $file) {
            if (! $file->isValid()) continue;
            $name = $file->getRandomName();
            $file->move($uploadDir, $name);
            $path = '/uploads/projects/' . $name;

            // determine order index (last)
            $max = $this->imageModel->selectMax('order_index')->where('project_id', $projectId)->first();
            $order = ($max['order_index'] ?? 0) + 1;

            $this->imageModel->insert(['project_id' => $projectId, 'path' => $path, 'alt' => '', 'order_index' => $order]);
        }
    }

    // Delete image by id
    public function deleteImage($id)
    {
        $img = $this->imageModel->find($id);
        if (! $img) return redirect()->back();

        $path = FCPATH . ltrim($img['path'], '/');
        if (is_file($path)) @unlink($path);
        $this->imageModel->delete($id);
        $this->session->setFlashdata('success', 'Image deleted');

        if ($this->isAjaxRequest()) {
            $projectId = $img['project_id'];
            $project = $this->projectModel->find($projectId);
            if ($project) {
                $project['images'] = $this->imageModel->where('project_id', $projectId)->orderBy('order_index','ASC')->findAll();
                return $this->respondWithFragments([
                    '#project-images-' . $projectId => view('admin/projects/images_fragment', ['project' => $project]),
                    '#flash-container' => view('partials/flash'),
                ]);
            }

            return $this->respondWithFragments([
                '#flash-container' => view('partials/flash'),
            ]);
        }

        return redirect()->back();
    }

    // Reorder images via JSON body: { order: [id1, id2, ...] }
    public function reorderImages($projectId = null)
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
            $project = $this->projectModel->find($projectId);
            if ($project) {
                $project['images'] = $this->imageModel->where('project_id', $projectId)->orderBy('order_index','ASC')->findAll();

                return $this->respondWithFragments([
                    '#project-images-' . $projectId => view('admin/projects/images_fragment', ['project' => $project]),
                    '#flash-container' => view('partials/flash'),
                ]);
            }
        }

        return $this->response->setJSON(['success' => true]);
    }
}
