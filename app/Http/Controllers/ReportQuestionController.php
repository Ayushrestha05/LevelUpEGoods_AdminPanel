<?php

namespace App\Http\Controllers;

use App\Models\ReportQuestion;
use Illuminate\Http\Request;

class ReportQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $report_questions = ReportQuestion::all();
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
            'question' => 'required'
        ]);

        ReportQuestion::create($request->all());
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
        $question = ReportQuestion::all()->where('id', $id)->first();
        return view('admin.Report-Questions.edit-question', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportQuestion $report_question)
    {

        $request->validate([
            'question' => 'required|string'
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
    public function destroy(ReportQuestion $report_question)
    {
        $report_question->delete();  
        return redirect()->route('admin.report-question.index')->with('success', 'Question Deleted Successfully');      
    }
}
