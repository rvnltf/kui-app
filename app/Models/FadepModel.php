<?php

namespace App\Models;

use CodeIgniter\Model;

class FadepModel extends Model
{
    protected $table = "fadep";

    protected $allowedFields = ['id_fakultas', 'id_departement'];

    public function getStudentExchange($id)
    {
        $id_user = $id;
        $this->join('fakultas', 'fakultas.id = fadep.id_fakultas');
        $this->join('departement', 'departement.id = fadep.id_departement');
        $this->where('fakultas.for_exchange', $id_user);
        return $this->findAll();
    }
}
