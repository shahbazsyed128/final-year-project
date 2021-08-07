<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Course;
use App\User;
use App\Lecture;


class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Course::all()->count() > 0) return;
        $course = Course::create([
            'author_id'     =>  User::where('role','admin')->first()->id,
            'name'          =>  'HTML Crash Course',
            'summary'       =>  'HTML Basic Course for Bigginers',
            'description'   =>  'This Course is for Bigginers to Learn HTML Concepts',
            'category_id'   =>   Category::where('name','Web Designing')->first()->id,
            'subject'       =>  'Frontend Development',
            'price'         =>  '10',
            'status'        =>  '1'
        ]);

        Lecture::insert([
            [
                'video_path'    =>  'files/1628368032.mp4',
                'video_title'   =>  'Lecture 1',
                'course_id'     =>   $course->id,
            ],
            [
                'video_path'    =>  'files/1628368047.mp4',
                'video_title'   =>  'Lecture 2',
                'course_id'     =>   $course->id,
            ],
            
        ]);
    }
}
