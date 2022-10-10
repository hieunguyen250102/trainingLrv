<?php

namespace App\Repositories\Students;

use App\Repositories\RepositoryInterface;

interface StudentRepositoryInterface extends RepositoryInterface
{
    public function getStudent();

    public function search($data);

    public function getSubjectWithId($id);

    public function getByUser($id);

    public function findByFaculty($id);
}
