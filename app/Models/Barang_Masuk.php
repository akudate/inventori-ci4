<?php

namespace App\Models;

use CodeIgniter\Model;

class Barang_Masuk extends Model{
    protected $table            = 'barang_masuk';
    protected $primaryKey       = 'transactionID';
    protected $returnType       = 'object';
    protected $protectFields    = false;
    protected $allowedFields    = [];
}
?>