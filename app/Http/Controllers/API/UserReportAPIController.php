<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class UserReportAPIController extends Controller
{
    public function submitReport(Request $request)
    {
        $fields = $request->validate([
            'question_type' => 'required|integer',
            'title' => 'required|string',
            'description' => 'required',
        ]);

        Report::create([
            'user_id' => auth()->user()->id,
            'question_type' => $fields['question_type'],
            'title' => $fields['title'],
            'description' => $fields['description'],
        ]);

        return response(['message' => 'Report submitted'], 201);
    }
}
