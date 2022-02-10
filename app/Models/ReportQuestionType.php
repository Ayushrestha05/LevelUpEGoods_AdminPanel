<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportQuestionType extends Model
{
    use HasFactory;
    protected $table = 'report_question_type';
    protected $fillable = ['question_type'];
    protected $hidden = ['created_at', 'updated_at'];

    public function reports(){
        return $this->hasMany(Report::class);
    }
    
}
