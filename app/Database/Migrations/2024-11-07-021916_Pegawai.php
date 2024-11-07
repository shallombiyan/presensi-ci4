<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pegawai extends Migration
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
            'nip' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'nama' => [
                'type' => 'TEXT',
                'constraint' => '225',
            ],
            'jenis_kelamin' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => '225',
            ],
            'no_handphone' => [
                'type' => 'VARCHAR',
                'constraint' => '22',
            ],
            'jabatan' => [
                'type' => 'VARCHAR',
                'constraint' => '225',
            ],
            'lokasi_presensi' => [
                'type' => 'VARCHAR',
                'constraint' => '225',
            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => '225',
            ],
            'created_ad' => [
                'type' => 'DATE',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pegawai');
    }

    public function down()
    {
        $this->forge->dropTable('pegawai');
    }
}
