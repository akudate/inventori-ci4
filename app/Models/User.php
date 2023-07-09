<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model{
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $protectFields    = false;
    protected $allowedFields    = [];
}
?>