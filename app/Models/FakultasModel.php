<?php

namespace App\Models;

use CodeIgniter\Model;

class FakultasModel extends Model
{
    protected $table = "fakultas";
    protected $useTimestamps = true;

    protected $allowedFields = ['fakultas', 'exp_date', 'ldt', 'kuota', 'cost', 'fakultas_status', 'kuota_status'];
}
