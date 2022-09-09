<?php

namespace App\Repositories\Students;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Students\StudentRepositoryInterface;
use Carbon\Carbon;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Student::class;
    }

    public function User()
    {
        return \App\Models\User::class;
    }

    public function getStudent()
    {
        return $this->model->select('id', 'name', 'email', 'avatar', 'phone', 'birthday', 'gender', 'address', 'status', 'faculty_id')->where('deleted_at', null)->orderBy('updated_at', 'DESC')->paginate(0);
    }

    public function search($data)
    {
        $student = $this->model->newQuery();

        if (isset($data['age_from'])) {
            $student->whereYear('birthday', '<=', Carbon::now()->subYear($data['age_from'])->format('Y'));
        }

        if (isset($data['age_to'])) {
            $student->whereYear('birthday', '>=', Carbon::now()->subYear($data['age_to'])->format('Y'));
        }

        return $student->paginate(3);
    }
}
