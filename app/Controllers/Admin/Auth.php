<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;

class Auth extends BaseAdmin
{
    // Allow access without session check by overriding initController
    public function initController($request, $response, $logger)
    {
        // Do not call parent to avoid redirect loop
        parent::initController($request, $response, $logger);
    }

    public function login()
    {
        // if already logged in, go to dashboard
        if ($this->session->get('is_admin')) {
            return redirect()->to('/admin');
        }

        $data = [];
        return view('admin/login', $data);
    }

    public function attempt()
    {
        $userModel = new UserModel();

        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->where('is_active',1)->first();
        if (! $user || ! password_verify($password, $user['password_hash'] ?? '')) {
            $this->session->setFlashdata('error', 'Invalid credentials');
            return redirect()->to('/admin/auth/login');
        }

        // check role
        if (($user['role'] ?? '') !== 'admin') {
            $this->session->setFlashdata('error', 'Not authorized');
            return redirect()->to('/admin/auth/login');
        }

        // Successful login
        $this->session->set(['is_admin' => true, 'admin_user_id' => $user['id'], 'admin_username' => $user['username']]);
        $this->session->setFlashdata('success', 'Welcome back, ' . $user['username']);
        return redirect()->to('/admin');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/admin/auth/login');
    }
}
