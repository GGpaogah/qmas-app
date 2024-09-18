<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
  
class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
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
                'email_verified_at' => now(),
            ],

            [
               'name'=>'Admin',
               'email'=>'admin@gmail.com',
               'telepon'=>'',
               'alamat'=>'',
               'usertype'=>'admin',
               'password'=> Hash::make('123456'),
               'remember_token' => Str::random(10),
               'email_verified_at' => now(),
            ],
            
            [
               'name'=>'Superadmin',
               'email'=>'superadmin@gmail.com',
               'telepon'=>'',
               'alamat'=>'',
               'usertype'=>'superadmin',
               'password'=> Hash::make('123456'),
               'remember_token' => Str::random(10),
               'email_verified_at' => now(),
            ],

        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}