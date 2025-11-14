<?php

namespace App\Controllers\Admin;

use App\Models\ProfileModel;

class Profile extends BaseAdmin
{
    protected $profileModel;

    public function __construct()
    {
        $this->profileModel = new ProfileModel();
        $this->session = service('session');
    }

    public function index()
    {
        $userId = $this->session->get('admin_user_id') ?: 1;
        $profile = $this->profileModel->where('user_id', $userId)->first();
        return view('admin/profile/index', ['profile' => $profile]);
    }

    public function form()
    {
        $userId = $this->session->get('admin_user_id') ?: 1;
        $profile = $this->profileModel->where('user_id', $userId)->first();
        return view('admin/profile/form', ['profile' => $profile]);
    }

    public function update()
    {
        $userId = $this->session->get('admin_user_id') ?: 1;
        $profile = $this->profileModel->where('user_id', $userId)->first();

        $rules = [
            'full_name' => 'required|min_length[3]|max_length[255]'
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'user_id' => $userId,
            'full_name' => $this->request->getPost('full_name'),
            'bio' => $this->request->getPost('bio'),
            'location' => $this->request->getPost('location'),
            'website' => $this->request->getPost('website'),
            'github_url' => $this->request->getPost('github_url'),
            'linkedin_url' => $this->request->getPost('linkedin_url'),
        ];

        // handle uploads (avatar + cv)
        $uploadDir = FCPATH . 'uploads/profile/';
        if (! is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        $avatar = $this->request->getFile('avatar');
        if ($avatar && $avatar->isValid() && ! $avatar->hasMoved()) {
            $name = $avatar->getRandomName();
            $avatar->move($uploadDir, $name);
            $data['avatar_path'] = '/uploads/profile/' . $name;
        }

        $cv = $this->request->getFile('cv');
        if ($cv && $cv->isValid() && ! $cv->hasMoved()) {
            // accept PDF only for CV
            if ($cv->getClientMimeType() === 'application/pdf') {
                $cname = $cv->getRandomName();
                $cv->move($uploadDir, $cname);
                $data['cv_path'] = '/uploads/profile/' . $cname;
            }
        }

        if ($profile) {
            $this->profileModel->update($profile['id'], $data);
            $this->session->setFlashdata('success', 'Profile updated');
        } else {
            $this->profileModel->insert($data);
            $this->session->setFlashdata('success', 'Profile created');
        }

        // If HTMX request, return the form fragment and OOB flash so the page can update without full reload
        if ($this->request->getHeaderLine('HX-Request') === 'true') {
            $fresh = $this->profileModel->where('user_id', $userId)->first();
            $form = view('admin/profile/form', ['profile' => $fresh]);
            $flash = view('partials/flash_oob');
            return $this->response->setBody($form . $flash);
        }

        return redirect()->to('/admin/profile');
    }
}
