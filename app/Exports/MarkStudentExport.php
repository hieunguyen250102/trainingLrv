<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MarkStudentExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Subject::with('students')->whereHas('students', function ($q) {
            $q->where('subject_id', $this->id);
        })->get();
    }

    public function map($subject): array
    {
        $data = [];
        foreach ($subject->students as $student) {
            $data[] = [
                $student->id,
                $student->name,
                $student->email,
                $student->pivot->mark
            ];
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Email',
            'Mark'
        ];
    }
}
