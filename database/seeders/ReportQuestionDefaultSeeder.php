<?php

namespace Database\Seeders;

use App\Models\ReportQuestionType;
use Facade\FlareClient\Report;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportQuestionDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ReportQuestionType::create([
            'question_type' => 'Others',
        ]);
    }
}
