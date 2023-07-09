<?php

namespace App\Models;

use CodeIgniter\Model;

class Barang extends Model{
    protected $table            = 'barang';
    protected $primaryKey       = 'productID';
    protected $returnType       = 'object';
    protected $protectFields    = false;
    protected $allowedFields    = [];
}
?>