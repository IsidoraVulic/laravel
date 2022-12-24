<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExamRegistration;
use App\Models\SubjectCategory;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject_id'
    ];

    public function examregistrations(){
        return $this->hasMany(ExamRegistration::class);
    }

    public function category(){
        return $this->belongsTo(SubjectCategory::class);
    }
   

}
