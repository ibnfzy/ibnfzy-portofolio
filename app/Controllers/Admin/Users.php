<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;

class Users extends BaseAdmin
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        return view('admin/users/index', $data);
    }

    public function create()
    {
        $view = view('admin/users/form', ['user' => null]);

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
            'username' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role') ?: 'editor',
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->userModel->insert($data);
        $this->session->setFlashdata('success', 'User created');

        if ($this->isAjaxRequest()) {
            $data = ['users' => $this->userModel->findAll()];

            return $this->respondWithFragments([
                '#admin-users-list' => view('admin/users/list_fragment', $data),
                '#flash-container' => view('partials/flash'),
                '#modal-content' => '',
            ]);
        }

        return redirect()->to('/admin/users');
    }
}
