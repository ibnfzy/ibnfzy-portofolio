<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProjectImagesSeeder extends Seeder
{
    public function run()
    {
        $projects = $this->db->table('projects')->orderBy('id','ASC')->get()->getResultArray();
        $images = [];
        foreach ($projects as $project) {
            $images[] = [
                'project_id' => $project['id'],
                'path' => '/public_site_assets/images/project-' . $project['id'] . '-1.jpg',
                'alt' => $project['title'] . ' image 1',
                'order_index' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $images[] = [
                'project_id' => $project['id'],
                'path' => '/public_site_assets/images/project-' . $project['id'] . '-2.jpg',
                'alt' => $project['title'] . ' image 2',
                'order_index' => 2,
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }

        foreach ($images as $img) {
            $this->db->table('project_images')->insert($img);
        }
    }
}
