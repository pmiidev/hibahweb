<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSliderTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'slider_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'slider_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'slider_caption' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'slider_image' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'slider_order' => [
                'type'       => 'INT',
                'constraint' => 4,
                'null'       => true,
                'default'    => 0,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);
        $this->forge->addKey('slider_id', true);
        $this->forge->createTable('tbl_sliders');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_sliders');
    }
}
