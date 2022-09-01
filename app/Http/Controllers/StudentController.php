<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Mail\RegisterMail;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\User;
use App\Repositories\Students\StudentRepositoryInterface;
use App\Repositories\Faculties\FacultyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Contracts\Role;

class StudentController extends Controller
{
    protected $studentRepo;
    protected $facultyRepo;

    public function __construct(StudentRepositoryInterface $studentRepo, FacultyRepositoryInterface $facultyRepo)
    {
        $this->studentRepo = $studentRepo;
        $this->facultyRepo = $facultyRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = new Student();
        $students = $this->studentRepo->getStudent();
        $faculties = Faculty::pluck('name', 'id');
        return view('admin.students.index', compact('students', 'faculties', 'student'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $student = new User();
        $faculties = Faculty::pluck('name', 'id');
        return view('admin.students.form', compact('student', 'faculties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        // dd($request->all());
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $student = new Student();
        $user->assignRole('student');
        $student->user_id =  $user->id;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->avatar = $request->avatar;
        $student->phone = $request->phone;
        $student->birthday = $request->birthday;
        $student->address = $request->address;
        $student->gender = $request->gender;
        $student->status = $request->status;
        $student->faculty_id = $request->faculty_id;
        $student->save();

        $mailable = new RegisterMail($user);
        Mail::to($request->email)->send($mailable);

        session()->flash('success', 'Create successfully!');
        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = $this->studentRepo->find($id);
        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->studentRepo->find($id)->update($request->all());
        $student = $this->studentRepo->find($id);
        $faculty_name = $student->faculty->name;
        return response()->json(['student' => $request->all(), 'faculty_name' => $faculty_name]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::join('students', 'students.user_id', 'users.id')->where('students.id', $id)->delete();
        $student =  Student::find($id);
        Student::find($id)->delete();
        return response()->json(['student' => $student]);
        // session()->flash('success', 'Delete successfully!');
        // return redirect()->route('students.index');
    }
}
