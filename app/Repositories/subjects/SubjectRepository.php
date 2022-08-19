<?php

namespace App\Repositories\Subjects;

use App\Repositories\BaseRepository;
use App\Repositories\Subjects\SubjectRepositoryInterface;

class SubjectRepository extends BaseRepository implements SubjectRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Subject::class;
    }

    public function getSubject()
    {
        return $this->model->select('id', 'name')->orderBy('updated_at', 'DESC')->paginate(0);
    }
}
