<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = 'reports';
    protected $fillable = ['user_id','question_type', 'title', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reporttype()
    {
        return $this->belongsTo(ReportQuestionType::class, 'question_type');
    }
}
