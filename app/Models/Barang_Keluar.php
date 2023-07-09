<?php

namespace App\Models;

use CodeIgniter\Model;

class Barang_Keluar extends Model{
    protected $table            = 'barang_keluar';
    protected $primaryKey       = 'transactionID';
    protected $returnType       = 'object';
    protected $protectFields    = false;
    protected $allowedFields    = [];
}
?>