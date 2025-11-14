<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    public function run()
    {
        $user = $this->db->table('users')->where('username', 'admin')->get()->getRowArray();
        $userId = $user['id'] ?? 1;

        $articles = [
            [
                'user_id' => $userId,
                'title' => 'Membangun UI Neo‑Brutalism',
                'slug' => 'membangun-ui-neo-brutalism',
                'body' => 'Ringkasan artikel tentang prinsip desain Neo‑Brutalism dan implementasinya.',
                'is_published' => 1,
                'published_at' => date('Y-m-d H:i:s', strtotime('-10 days')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => $userId,
                'title' => 'HTMX untuk interaksi sederhana',
                'slug' => 'htmx-untuk-interaksi-sederhana',
                'body' => 'HTMX memudahkan interaksi tanpa aplikasi JavaScript berat.',
                'is_published' => 1,
                'published_at' => date('Y-m-d H:i:s', strtotime('-20 days')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => $userId,
                'title' => 'Mengelola upload gambar di CI4',
                'slug' => 'mengelola-upload-gambar-ci4',
                'body' => 'Tips singkat untuk upload multiple images di CodeIgniter 4.',
                'is_published' => 1,
                'published_at' => date('Y-m-d H:i:s', strtotime('-30 days')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($articles as $a) {
            $this->db->table('articles')->insert($a);
        }
    }
}
