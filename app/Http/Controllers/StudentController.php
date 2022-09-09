<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Mail\AlertMail;
use App\Mail\RegisterMail;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use App\Repositories\Students\StudentRepositoryInterface;
use App\Repositories\Faculties\FacultyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Laravel\Ui\Presets\React;
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
    public function index(Request $request)
    {
        $student = new Student();
        $subject = new Subject();
        // $students = $this->studentRepo->search($request->all());
        $students = User::where('id', '!=', 1)->with('subjects')->get();
        $faculties = Faculty::pluck('name', 'id');
        return view('admin.students.index', compact('students', 'faculties', 'student', 'subject'));
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
        Mail::to($request->email)->queue($mailable);

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

    public function updateAvatar(Request $request)
    {
        // dd($request->all());
        $user = User::find($request->id);
        if ($request->data) {
            $destination_path = 'public/img/profiles';
            $image = $request->data;
            $image_name = $image->getClientOriginalName();
            $path = $request->data->storeAs($destination_path, $image_name);
        }
        $user->avatar = $image_name;
        $user->save();

        return response()->json($user);
    }
    public function alertSubject(Request $request)
    {
        $subs = Subject::all();
        // $subjects = $;
        $students = Student::all();
        foreach ($request->listIds as $id) {
            $listIds[] = $id;
        }
        foreach ($listIds as $value) {
            $listSubject = [];
            $user = User::find($value);
            $subject_point = $user->subjects;
            if ($subject_point->count() == 0) {
                $listSubject = $subs;
            } else {
                foreach ($subs as $sub) {
                    for ($i = 0; $i < $subject_point->count(); $i++) {
                        if ($sub->id == $subject_point[$i]->id) {
                            break;
                        } elseif ($i == $subject_point->count() - 1) {
                            $listSubject[] =  $sub;
                        }
                    }
                }
            }
            $mailable = new AlertMail($listSubject);
            Mail::to($user->email)->queue($mailable);
        }
        return redirect()->route('students.index');
    }
}
