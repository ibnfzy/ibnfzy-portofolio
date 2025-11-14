<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Seed extends Seeder
{
    public function run()
    {
        // Order matters due to FK constraints
        $this->call('App\\Database\\Seeds\\UsersSeeder');
        $this->call('App\\Database\\Seeds\\ProfileSeeder');
        $this->call('App\\Database\\Seeds\\ProjectsSeeder');
        $this->call('App\\Database\\Seeds\\ProjectImagesSeeder');
        $this->call('App\\Database\\Seeds\\ArticlesSeeder');
        $this->call('App\\Database\\Seeds\\ArticleImagesSeeder');
    }
}
