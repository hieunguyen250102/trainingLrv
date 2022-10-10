<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacultyRequest;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use App\Repositories\Faculties\FacultyRepositoryInterface;
use App\Repositories\Students\StudentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class FacultyController extends Controller
{

    protected $facultyRepo;

    public function __construct(FacultyRepositoryInterface $facultyRepo, StudentRepositoryInterface $studentRepo)
    {
        $this->facultyRepo = $facultyRepo;
        $this->studentRepo = $studentRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $subject = new Subject();
        $userNow = Student::where('user_id', Auth::id())->get();
        $faculties = $this->facultyRepo->getFaculty();
        return view('admin.faculties.index', compact('faculties', 'userNow'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculty = new Faculty();
        return view('admin.faculties.form', compact('faculty'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacultyRequest $request)
    {
        $faculty = $this->facultyRepo->create($request->all());
        session()->flash('success', __('lang.faculties.alert-success-create'));
        return redirect()->route('faculties.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faculty = $this->facultyRepo->find($id);
        return view('admin.faculties.form', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FacultyRequest $request, $id)
    {
        $faculty = $this->facultyRepo->update($id, $request->all());
        session()->flash('success', __('lang.faculties.alert-success-update'));
        return redirect()->route('faculties.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->studentRepo->findByFaculty($id);
        foreach ($data as $key => $value) {
            $this->studentRepo->find($value->id)->update([
                'faculty_id' => null
            ]);
        }
        $this->facultyRepo->delete($id);
        session()->flash('success', 'Delete successfully!');
        return redirect()->route('faculties.index');
    }
}
