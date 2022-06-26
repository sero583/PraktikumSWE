<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Lesson extends Model {
    use HasFactory;
    public $timestamps = false;

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function finished_lessons(){
        return $this->hasMany(FinishedLesson::class);
    }
}
