<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ArticleImagesSeeder extends Seeder
{
    public function run()
    {
        $articles = $this->db->table('articles')->orderBy('id','ASC')->get()->getResultArray();
        $images = [];
        foreach ($articles as $article) {
            $images[] = [
                'article_id' => $article['id'],
                'path' => '/public_site_assets/images/article-' . $article['id'] . '-1.jpg',
                'alt' => $article['title'] . ' image 1',
                'order_index' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }

        foreach ($images as $img) {
            $this->db->table('article_images')->insert($img);
        }
    }
}
