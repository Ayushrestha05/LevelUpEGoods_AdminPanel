<?php

namespace App\Http\Controllers;

use App\Models\ReportQuestionType;
use Illuminate\Http\Request;

class ReportQuestionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $report_questions = ReportQuestionType::all();
        return view('admin.Report-Questions.report-questions', compact('report_questions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Report-Questions.new-question');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question_type' => 'required'
        ]);

        ReportQuestionType::create($request->all());
        return redirect()->route('admin.report-question.index')->with('success', 'Question Added Successfully');
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
        $question = ReportQuestionType::all()->where('id', $id)->first();
        return view('admin.Report-Questions.edit-question', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportQuestionType $report_question)
    {

        $request->validate([
            'question_type' => 'required|string'
        ]);
        
        $report_question->update($request->all());
        return redirect()->route('admin.report-question.index')->with('success', 'Question Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportQuestionType $report_question)
    {
        $report_question->delete();  
        return redirect()->route('admin.report-question.index')->with('success', 'Question Deleted Successfully');      
    }
}
