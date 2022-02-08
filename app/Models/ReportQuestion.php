<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportQuestion extends Model
{
    use HasFactory;
    protected $table = 'report_questions';
    protected $fillable = ['question_category'];
    protected $hidden = ['created_at', 'updated_at'];
}
