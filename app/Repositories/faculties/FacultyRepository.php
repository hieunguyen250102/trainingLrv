<?php

namespace App\Repositories\Faculties;

use App\Repositories\BaseRepository;
use App\Repositories\Faculties\FacultyRepositoryInterface;

class FacultyRepository extends BaseRepository implements FacultyRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Faculty::class;
    }

    public function getFaculty()
    {
        return $this->model->select('id', 'name')->orderBy('updated_at', 'DESC')->paginate(0);
    }
}
