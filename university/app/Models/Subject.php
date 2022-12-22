<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExamRegistration;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function examregistrations(){
        return $this->hasMany(ExamRegistration::class);
    }

   

}
