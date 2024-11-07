<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Presensi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_pegawai' => [
                'type'       => 'INT',
                'constraint' => '100',
                'unsigned'       => true,
            ],
            'tanggal_masuk' => [
                'type' => 'DATE',

            ],
            'jam_masuk' => [
                'type' => 'TIME',
            ],
            'foto_masuk' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
            ],
            'tanggal_keluar' => [
                'type' => 'DATE',

            ],
            'jam_keluar' => [
                'type' => 'TIME',

            ],
            'foto_keluar' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_pegawai', 'pegawai', 'id');
        $this->forge->createTable('presensi');
    }

    public function down()
    {
        $this->forge->dropTable('presensi');
    }
}
