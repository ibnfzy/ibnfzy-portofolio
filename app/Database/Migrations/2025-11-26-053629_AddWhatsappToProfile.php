<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddWhatsappToProfile extends Migration
{
    public function up()
    {
        $this->forge->addColumn('profile_info', [
            'whatsapp_number' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true,
                'after' => 'linkedin_url',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('profile_info', 'whatsapp_number');
    }
}
