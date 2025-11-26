<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddVisibilityToProjects extends Migration
{
    public function up()
    {
        $fields = [
            'visibility' => [
                'type' => 'ENUM',
                'constraint' => ['public', 'private'],
                'default' => 'public',
                'after' => 'published_at',
            ],
            'github_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'visibility',
            ],
        ];

        $this->forge->addColumn('projects', $fields);

        // Backfill existing records
        $builder = $this->db->table('projects');
        $builder->update(['visibility' => 'public']);
    }

    public function down()
    {
        $this->forge->dropColumn('projects', 'github_url');
        $this->forge->dropColumn('projects', 'visibility');
    }
}
