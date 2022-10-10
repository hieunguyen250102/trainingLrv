<?php

namespace App\Http\Controllers;

use App\Exports\MarkStudentExport;
use App\Http\Requests\SubjectRequest;
use App\Imports\MarkStudentImport;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use App\Repositories\Subjects\SubjectRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class SubjectController extends Controller
{

    protected $SubjectRepo;

    public function __construct(SubjectRepositoryInterface $SubjectRepo)
    {
        $this->SubjectRepo = $SubjectRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $subjects = Subject::with('students')->get();
        $user = Auth::user();
        if (Auth::check()) {
            if ($user->roles[0]['name'] === 'student') {
                $student = Student::where('user_id', $user->id)->first();
                $results = $student->subjects;
            } else {
                $results = null;
            }
        }
        return view('admin.subjects.index', compact('subjects', 'results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subject = new Subject();
        return view('admin.subjects.form', compact('subject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        $Subject = $this->SubjectRepo->create($request->all());
        session()->flash('success', 'Create successfully!');
        return redirect()->route('subjects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = $this->SubjectRepo->find($id);
        return view('admin.subjects.form', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectRequest $request, $id)
    {
        $Subject = $this->SubjectRepo->update($id, $request->all());
        session()->flash('success', 'Update successfully!');
        return redirect()->route('subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = $this->SubjectRepo->find($id);
        if ($subject->students()->count('*')) {
            return response()->json(['error' => 'Unsuccessful'], 404);
        }
        $this->SubjectRepo->delete($id);
        return response()->json(['subject' => $subject], 200);
    }

    public function registerSubject(Request $request)
    {
        $total = new Subject();
        $student = Student::where('user_id', Auth::id())->with('subjects')->first();
        $result = $student->subjects;

        if ($total->count() === $result->count()) {
            return response()->json(['error' => 'Error msg'], 404);
        }

        if (isset($result[0])) {
            foreach ($request->data as $id) {
                for ($i = 0; $i < $result->count(); $i++) {
                    if ($id == $result[$i]->id) {
                        break;
                    } elseif ($i == $result->count() - 1) {
                        $subject = Subject::find($id);
                        $student->subjects()->attach($id, ['student_id' => $student->id],);
                        $listSubjects[] = $subject;
                    }
                }
            }

            return response()->json(['listSubjects' => $listSubjects]);
        } else {
            foreach ($request->data as $id) {
                $student->subjects()->attach($id, ['student_id' => $student->id],);
            }
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function importExportView(Request $request)
    {
        $subject = Subject::find($request->id);
        return view('admin.students.add-mark', compact('subject'));
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export($id)
    {
        return Excel::download(new MarkStudentExport($id), 'mark.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import(Request $request, $id)
    {
        $subject = Subject::with('students')->find($id);
        $dataExcel = Excel::toCollection(new MarkStudentImport($id), $request->file('file'));
        foreach ($dataExcel[0] as $data) {
            foreach ($subject->students as $student) {
                if ($data[0] == $student['id']) {
                    $student->pivot->where('student_id', '=', $student['id'])->where('subject_id', $subject->id)->update([
                        'mark' => $data[3],
                    ]);
                }
            }
        }
        session()->flash('success', 'Import successfully!');
        return redirect()->back();
    }
}
