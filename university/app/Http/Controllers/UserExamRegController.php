<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamRegistration;

class UserExamRegController extends Controller
{
   public function index($user_id)
   {
    $examregs = ExamRegistration::get()->where('user_id', $user_id);
        if(is_null($examregs)){
            return response()->json('Data not found', 404);
        }
        return response()->json($examregs);
   }
}
