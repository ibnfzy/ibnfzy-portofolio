<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    public function run()
    {
        $user = $this->db->table('users')->where('username', 'admin')->get()->getRowArray();
        $userId = $user['id'] ?? 1;

        $projects = [
            [
                'user_id' => $userId,
                'title' => 'Portfolio Website',
                'slug' => 'portfolio-website',
                'description' => 'Situs portofolio pribadi dengan desain Neo‑Brutalism.',
                'tech_stack' => 'TailwindCSS, Alpine.js, CodeIgniter 4',
                'tags' => json_encode(['portfolio', 'personal', 'design-system']),
                'visibility' => 'public',
                'github_url' => 'https://github.com/example/portfolio-website',
                'is_public' => 1,
                'published_at' => date('Y-m-d H:i:s', strtotime('-30 days')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => $userId,
                'title' => 'Task Manager',
                'slug' => 'task-manager',
                'description' => 'Aplikasi manajemen tugas ringkas.',
                'tech_stack' => 'HTMX, Alpine.js, REST API',
                'tags' => json_encode(['productivity', 'tasks', 'sse']),
                'visibility' => 'public',
                'github_url' => 'https://github.com/example/task-manager',
                'is_public' => 1,
                'published_at' => date('Y-m-d H:i:s', strtotime('-60 days')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => $userId,
                'title' => 'Blog Engine',
                'slug' => 'blog-engine',
                'description' => 'Sistem blogging sederhana dengan fokus performa.',
                'tech_stack' => 'PHP, MySQL, TailwindCSS',
                'tags' => json_encode(['blog', 'content', 'cms']),
                'visibility' => 'public',
                'github_url' => 'https://github.com/example/blog-engine',
                'is_public' => 1,
                'published_at' => date('Y-m-d H:i:s', strtotime('-90 days')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($projects as $p) {
            $this->db->table('projects')->insert($p);
        }
    }
}
