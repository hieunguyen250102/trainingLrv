<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MarkStudentImport implements ToModel, WithStartRow
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Student([
            //
        ]);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
