<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        $user = $this->db->table('users')->where('username', 'admin')->get()->getRowArray();
        $userId = $user['id'] ?? 1;

        $data = [
            'user_id' => $userId,
            'full_name' => 'Ibnu Fauzi',
            'bio' => 'Pengembang web yang membuat portofolio sederhana dengan gaya Neo-Brutalism.',
            'location' => 'Jakarta, Indonesia',
            'website' => 'https://example.com',
            'github_url' => 'https://github.com/ibnfzy',
            'linkedin_url' => 'https://www.linkedin.com/in/ibnfzy',
            'whatsapp_number' => '6281234567890',
            'avatar_path' => '/public_site_assets/images/profile.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('profile_info')->insert($data);
    }
}
