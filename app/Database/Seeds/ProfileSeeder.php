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
            'skills' => json_encode([
                'availability_badge' => 'Available for freelance',
                'style_badge' => 'Neo brutal minimal',
                'cta_chip' => 'Clean motion',
                'headline' => 'Web Developer • UI/UX • Open Source',
                'workflow_intro' => 'Saya membuat website dan produk digital dengan struktur tajam, kontras tinggi, dan hierarki visual yang jelas.',
                'focus_areas' => [
                    ['label' => 'Frontend', 'items' => 'React, HTMX, Tailwind'],
                    ['label' => 'Backend', 'items' => 'PHP, CodeIgniter, REST'],
                    ['label' => 'Desain', 'items' => 'UI/UX, Prototyping'],
                ],
                'workflow' => [
                    ['order' => '01', 'title' => 'Discovery', 'description' => 'Memahami kebutuhan, menyusun scope, dan menyiapkan gaya visual yang relevan.'],
                    ['order' => '02', 'title' => 'Design', 'description' => 'Menyusun layout lugas, tipografi tegas, dan interaksi mikro yang ringan.'],
                    ['order' => '03', 'title' => 'Build', 'description' => 'Mengembangkan komponen cepat, responsif, dan mudah dirawat untuk produksi.'],
                ],
            ]),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('profile_info')->insert($data);
    }
}
