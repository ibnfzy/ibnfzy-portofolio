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
        // Return form fragment for HTMX modal
        return view('admin/users/form', ['user' => null]);
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

        // If HTMX request, return updated list fragment + clear modal + OOB flash
        if ($this->request->getHeaderLine('HX-Request') === 'true') {
            $data = ['users' => $this->userModel->findAll()];
            $list = view('admin/users/list_fragment', $data);
            $modalClear = '<div id="modal" hx-swap-oob="true"></div>';
            $flash = view('partials/flash_oob');
            return $this->response->setBody($list . $modalClear . $flash);
        }

        return redirect()->to('/admin/users');
    }
}
