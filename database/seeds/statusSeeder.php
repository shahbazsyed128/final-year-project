<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class statusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->truncate();
        DB::table('statuses')->insert([[
            'id' => 0,
            'title' => 'Inactive',
        ], [
            'id' => 1,
            'title' => 'Active'
        ]]);
    }
}
