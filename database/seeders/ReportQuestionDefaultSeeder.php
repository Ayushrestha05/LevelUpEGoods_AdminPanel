<?php

namespace Database\Seeders;

use App\Models\ReportQuestion;
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

        ReportQuestion::create([
            'question_category' => 'Others',
        ]);
    }
}
