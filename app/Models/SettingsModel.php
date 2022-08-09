<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table = "settings";

    protected $allowedFields = ['value'];

    public function getSetting($key)
    {
        return $this->where('key', $key)->select('value')->first();
    }
}
