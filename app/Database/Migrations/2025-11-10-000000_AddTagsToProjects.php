<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTagsToProjects extends Migration
{
    public function up()
    {
        $fields = [
            'tags' => [
                'type' => 'JSON',
                'null' => true,
                'after' => 'tech_stack',
            ],
        ];

        $this->forge->addColumn('projects', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('projects', 'tags');
    }
}
