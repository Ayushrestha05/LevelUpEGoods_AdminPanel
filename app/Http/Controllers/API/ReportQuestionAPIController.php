<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ReportQuestionType;
use Illuminate\Http\Request;

class ReportQuestionAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ReportQuestionType::orderBy('created_at', 'desc')->get();
    }
}
