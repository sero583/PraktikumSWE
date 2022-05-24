<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RecentCourse;

class RecentCourseSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RecentCourse::truncate();
        RecentCourse::create([
            'course_id'=>1,
            'user_id'=>1
        ]);
    }
}
