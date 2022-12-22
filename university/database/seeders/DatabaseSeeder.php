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
        User::truncate();
        Subject::truncate();
        ExamRegistration::truncate();

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
            'subject_id'=>$sub2->id
        ]);

        $examreg2 = ExamRegistration::create([
            'user_id'=>$user->id,
            'subject_id'=>$sub1->id
        ]);

        $examreg3 = ExamRegistration::create([
            'user_id'=>$user->id,
            'subject_id'=>$sub3->id
        ]);
    }
}
