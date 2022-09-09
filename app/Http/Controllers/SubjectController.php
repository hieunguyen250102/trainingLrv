<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use App\Models\User;
use App\Repositories\Subjects\SubjectRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

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
        $subjects = Subject::with('users')->get();
        $user = User::find(Auth::id());
        $results = $user->subjects;
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
        dd($subject->users()->count());
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
        // return response()->json([
        //     'Subject' => $Subject,
        //     'id' => $Subject->id
        // ]);
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
        // return response()->json($Subject);
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
        $user = User::find(Auth::id());
        $listSubjects = array();
        foreach ($request->data as $id) {
            $subject = Subject::find($id);
            $user->subjects()->attach(Auth::id(), ['subject_id' => $id]);
            $listSubjects[] = $subject;
        }
        
        return response()->json(['listSubjects' => $listSubjects]);
    }
}
