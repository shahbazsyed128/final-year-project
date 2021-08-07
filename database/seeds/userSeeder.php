<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if(User::all()->count() > 0) return;

        User::create([
            'name'      => 'Admin',
            'email'     => "admin@gmail.com",
            'role'      => "admin",
            'password'  => Hash::make('12345678'),
            'status'    => 1
        ]);

        dump('User Table Seeded');
        dump([
            [
                'email'     => 'admin@gmail.com',
                'password'  =>  "12345678",

            ],
        ]);
    }
}
