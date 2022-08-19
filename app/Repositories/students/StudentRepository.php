<?php

namespace App\Repositories\Students;

use App\Repositories\BaseRepository;
use App\Repositories\Students\StudentRepositoryInterface;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Student::class;
    }

    public function getStudent()
    {
        return $this->model->select('id', 'name', 'email', 'avatar', 'phone', 'birthday', 'gender', 'address', 'status', 'faculty_id')->orderBy('updated_at', 'DESC')->paginate(0);
    }
}
