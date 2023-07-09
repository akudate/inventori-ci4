<?php

namespace App\Models;

use CodeIgniter\Model;

class Supplier extends Model{
    protected $table            = 'supplier';
    protected $primaryKey       = 'supplierID';
    protected $returnType       = 'object';
    protected $protectFields    = false;
    protected $allowedFields    = [];
}
?>