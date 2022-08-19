<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use App\Repositories\Subjects\SubjectRepositoryInterface;
use Illuminate\Http\Request;

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
        $subjects = $this->SubjectRepo->getSubject();
        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subject = new Subject();
        return view('admin.subjects.create', compact('subject'));
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
        return view('admin.subjects.create', compact('subject'));
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
    public function update(Request $request, $id)
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
        $this->SubjectRepo->delete($id);
        session()->flash('success', 'Delete successfully!');
        return redirect()->route('subjects.index');
    }
}
