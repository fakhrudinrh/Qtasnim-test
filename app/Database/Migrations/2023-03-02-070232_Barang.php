<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Barang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'stok' => [
                'type'          => 'INT',
                'constraint'    => 5,
            ],
            'jumlah_terjual' => [
                'type'          => 'INT',
                'constraint'    => 5,
            ],
            'tanggal_transaksi' => [
                'type'          => 'DATE',
            ],
            'jenis' => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('barang');
    }

    public function down()
    {
        $this->forge->dropTable('barang');
    }
}
