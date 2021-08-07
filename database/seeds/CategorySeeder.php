<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Category::all()->count() > 0) return;
        $data = [
            ['name'=>'Web Designing'],
            ['name'=>'Web Development'],
            ['name'=>'Andriod Development'],
            ['name'=>'IOS Development'],
            ['name'=>'Graphic Designing'],
            ['name'=>'3D Animation'],
            ['name'=>'Project Management'],
        ];
        Category::insert(
            $data
        );
    }
}
