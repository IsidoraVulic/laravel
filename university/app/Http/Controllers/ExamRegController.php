<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExamRegCollection;
use App\Http\Resources\ExamRegResource;
use App\Models\ExamRegistration;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamRegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examRegistrations = ExamRegistration::all();

        return new ExamRegCollection($examRegistrations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'subject_id' => 'required',
            'date_of_exam' => 'required|after:now()|before:12/31/2023'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $examRegistration = ExamRegistration::create([
            'user_id' => Auth::user()->id,
            'subject_id' =>$request->subject_id,
            'date_of_exam' => $request->date_of_exam
        ]);

        return response()->json(['Exam registered successfully.', new ExamRegResource($examRegistration)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExamRegistration  $examRegistration
     * @return \Illuminate\Http\Response
     */
    public function show(ExamRegistration $examRegistration)
    {

        return new ExamRegResource($examRegistration);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamRegistration  $examRegistration
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamRegistration $examRegistration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExamRegistration  $examRegistration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $examregID)
    {
        $validator = Validator::make($request->all(), [
            
            'subject_id' => 'required',
            'date_of_exam' => 'required|after:now()|before:12/31/2023'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $examRegistration = ExamRegistration::find($examregID);
        $examRegistration->subject_id = $request->subject_id;
        $examRegistration->date_of_exam = $request->date_of_exam;

        $examRegistration->save();

        return response()->json(['Exam registration updated successfully.', new ExamRegResource(ExamRegistration::find($examregID))]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamRegistration  $examRegistration
     * @return \Illuminate\Http\Response
     */
    public function destroy($examregID)
    {
        $examRegistration = ExamRegistration::find($examregID);
        $examRegistration->delete();
        return response()->json('Exam registration deleted successfully.');
    }
}
