<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentAppliedModel extends Model
{
    protected $table = "student_applied";
    protected $useTimestamps = true;
    protected $allowedFields = ['id_fakultas', 'id_departement', 'id_user', 'status', 'file', 'loa', 'visa'];


    public function getStudentApplied()
    {
        $this->join('fakultas', 'fakultas.id = student_applied.id_fakultas');
        $this->join('departement', 'departement.id = student_applied.id_departement');
        $this->join('status', 'status.id = student_applied.status');
        $this->join('users', 'users.id = student_applied.id_user');
        $this->select('student_applied.*');
        $this->select('fakultas.fakultas, fakultas.cost');
        $this->select('departement.departement');
        $this->select('status.status, status.id as id_status');
        $this->select('users.fullname, users.prodi');
        return $this->findAll();
    }

    public function getStudentAppliedById($id)
    {
        $this->join('fakultas', 'fakultas.id = student_applied.id_fakultas');
        $this->join('departement', 'departement.id = student_applied.id_departement');
        $this->join('status', 'status.id = student_applied.status');
        $this->join('users', 'users.id = student_applied.id_user');
        $this->where('users.id', $id);
        $this->select('student_applied.*');
        $this->select('fakultas.fakultas, fakultas.cost, fakultas.ldt');
        $this->select('departement.departement');
        $this->select('status.status, status.id as id_status');
        $this->select('users.fullname, users.prodi');
        return $this->first();
    }
}
