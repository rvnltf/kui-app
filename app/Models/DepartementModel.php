<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartementModel extends Model
{
    protected $table = "departement";
    protected $useTimestamps = true;
    protected $allowedFields = ['departement', 'ldt', 'desc'];
}
