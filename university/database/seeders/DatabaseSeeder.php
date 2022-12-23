<?php

namespace Database\Seeders;

use App\Models\ExamRegistration;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        
        ExamRegistration::truncate();



        $time1 = date("Y-m-d", rand( time(), strtotime("Dec 31 2023") ));
        $time2 = date("Y-m-d", rand( time(), strtotime("Dec 31 2023") ));
        $time3 = date("Y-m-d", rand( time(), strtotime("Dec 31 2023") ));
        

        $user = User::factory()->create();
        
        $sub1 = Subject::create([
            'name' => "Mathematics",
        ]);

        $sub2 = Subject::create([
            'name' => "Geography",
        ]);

        $sub3 = Subject::create([
            'name' => "English Language",
        ]);

        $examreg1 = ExamRegistration::create([
            'user_id'=>$user->id,
            'subject_id'=>$sub2->id,
            'date_of_exam'=>$time1,
        ]);

        $examreg2 = ExamRegistration::create([
            'user_id'=>$user->id,
            'subject_id'=>$sub1->id,
            'date_of_exam'=>$time2,
        ]);

        $examreg3 = ExamRegistration::create([
            'user_id'=>$user->id,
            'subject_id'=>$sub3->id,
            'date_of_exam'=>$time3,
        ]);
    }
}
