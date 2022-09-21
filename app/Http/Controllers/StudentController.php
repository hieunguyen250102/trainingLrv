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
use Illuminate\Support\Str;

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
        $students = Student::where('user_id', '!=', 1)->with('subjects')->get();
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
        return view('admin.students.form', compact('student'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(1),
        ]);
        $student = new Student();
        $user->assignRole('student');

        $student->user_id =  $user->id;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->avatar = 'avatar.png';
        $student->phone = $request->phone;
        $student->birthday = $request->birthday;
        $student->address = $request->address;
        $student->gender = $request->gender;
        $student->status = 0;
        $student->code = Str::uuid(6)->toString();
        $student->save();

        $mailable = new RegisterMail($user);
        Mail::to($request->email)->queue($mailable);

        return response()->json([
            'user' => $user,
            'student' => $student,
        ]);
        // session()->flash('success', 'Create successfully!');
        // return redirect()->route('students.index');
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
    }

    public function updateAvatar(Request $request)
    {
        $user = Student::where('user_id', $request->id)->first();
        if ($request->hasFile('avatar')) {
            $destination_path = '/img/profiles';
            $avatar = $request->avatar;
            $avatar_name = $avatar->getClientOriginalName();
            $avatar->move(public_path('/img/profiles/'), $avatar_name);
            $user->avatar = $avatar_name;
            $user->save();
        }

        session()->flash('success', 'Create successfully!');
        return redirect()->route('/');
    }

    public function alertSubject(Request $request)
    {
        $subs = Subject::all();
        $students = Student::all();
        if ($request->id) {
            $listIds[] = $request->id;
        } else {
            foreach ($students as $student) {
                if ($student->subjects->count() !== $subs->count()) {
                    $listIds[] = $student->id;
                }
            }
        }
        foreach ($listIds as $value) {
            $listSubject = [];
            $student = Student::find($value);
            $subject_point = $student->subjects;
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
            Mail::to($student->email)->queue($mailable);
        }
        return redirect()->route('students.index');
    }

    public function addMark(Request $request)
    {
        $subjects = Student::find($request->id)->subjects;
        $childrenTag = '';
        foreach ($subjects as $subject) {
            $childrenTag .= '<option value="' . $subject->id . '">' . $subject->name . '</option>';
        }
        return view('admin.students.add-mark', compact('childrenTag', 'subjects'));
    }

    public function registerFaculty(Request $request)
    {
        $subject = new Subject();
        $student = Student::where('user_id', Auth::id())->first();
        if ($student->subjects->count() == $subject->count()) {
            for ($i = 0; $i < $subject->count(); $i++) {
                foreach ($student->subjects as $value) {
                    if ($value->pivot->mark == null) {
                        session()->flash('error', 'You have not mark enough!');
                        return redirect()->route('faculties.index');
                    }
                }
            }
        } else {
            session()->flash('error', 'You have not learned subjects enough!');
            return redirect()->route('faculties.index');
        }

        $student->update(['faculty_id' => $request->id]);
        session()->flash('success', 'Register successfully!');
        return redirect()->route('faculties.index');
    }
}
