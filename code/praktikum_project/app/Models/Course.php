<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Lesson;
use App\Models\RecentCourse;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = false;

    public function lessons(){
        return $this->hasMany(Lesson::class);
    }
    public function recent_courses(){
        return $this->hasMany(RecentCourse::class);
    }
}
