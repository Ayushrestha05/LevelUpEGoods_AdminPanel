<?php

namespace Database\Seeders;

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
        ##TODO: Update Admin Seeder
        DB::table('report_questions')->insert([
            'id'=> 1,
            'question_category' => 'Others',
        ]);
    }
}
