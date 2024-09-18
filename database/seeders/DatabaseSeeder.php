<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [

            [
                'name'=>'User',
                'email'=>'user@gmail.com',
                'telepon'=>'',
                'alamat'=>'',
                'usertype'=>'user',
                'password'=> Hash::make('123456'),
                'remember_token' => Str::random(10),
            ],

            [
               'name'=>'Admin',
               'email'=>'admin@gmail.com',
               'telepon'=>'',
               'alamat'=>'',
               'usertype'=>'admin',
               'password'=> Hash::make('123456'),
               'remember_token' => Str::random(10),
            ],
            
            [
               'name'=>'Superadmin',
               'email'=>'superadmin@gmail.com',
               'telepon'=>'',
               'alamat'=>'',
               'usertype'=>'superadmin',
               'password'=> Hash::make('123456'),
               'remember_token' => Str::random(10),
            ],

        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
