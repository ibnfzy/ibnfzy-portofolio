<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTechStackToProjects extends Migration
{
    public function up()
    {
        $fields = [
            'tech_stack' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'description',
            ],
        ];

        $this->forge->addColumn('projects', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('projects', 'tech_stack');
    }
}
