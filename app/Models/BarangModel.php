<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nama', 'stok', 'jumlah_terjual', 'tanggal_transaksi', 'jenis'];

    public function search($keyword)
    {
        return $this->table('orang')->like('nama', $keyword);
    }
}
