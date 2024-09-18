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
                'remember_token' => Str::random(100),
                'email_verified_at' => now(),
            ],

            [
               'name'=>'AdminBabat',
               'email'=>'adminbabat@gmail.com',
               'telepon'=>'',
               'alamat'=>'Gudang Babat',
               'usertype'=>'admin',
               'gudang'=>'babat', //default dari admin adalah gudang babat
               'password'=> Hash::make('123456'),
               'remember_token' => Str::random(100),
               'email_verified_at' => now(),
            ],

            [
                'name'=>'AdminCenggerAyam',
                'email'=>'admincengger@gmail.com',
                'telepon'=>'',
                'alamat'=>'Gudang Cenger Ayam',
                'usertype'=>'admin',
                'gudang'=>'cengger', //default dari admin adalah gudang cengger ayam
                'password'=> Hash::make('123456'),
                'remember_token' => Str::random(100),
                'email_verified_at' => now(),
             ],

             [
                'name'=>'AdminKalimetro',
                'email'=>'adminkalimetro@gmail.com',
                'telepon'=>'',
                'alamat'=>'Gudang Kalimetro',
                'usertype'=>'admin',
                'gudang'=>'kalimetro', //default dari admin adalah gudang kalimetro
                'password'=> Hash::make('123456'),
                'remember_token' => Str::random(100),
                'email_verified_at' => now(),
             ],

             [
                'name'=>'AdminNganjuk',
                'email'=>'adminnganjuk@gmail.com',
                'telepon'=>'',
                'alamat'=>'Gudang Nganjuk',
                'usertype'=>'admin',
                'gudang'=>'nganjuk', //default dari admin adalah gudang nganjuk
                'password'=> Hash::make('123456'),
                'remember_token' => Str::random(100),
                'email_verified_at' => now(),
             ],

             [
                'name'=>'AdminTuren',
                'email'=>'adminturen@gmail.com',
                'telepon'=>'',
                'alamat'=>'Gudang Turen',
                'usertype'=>'admin',
                'gudang'=>'turen', //default dari admin adalah gudang turen
                'password'=> Hash::make('123456'),
                'remember_token' => Str::random(100),
                'email_verified_at' => now(),
             ],
            
            [
               'name'=>'Superadmin',
               'email'=>'superadmin@gmail.com',
               'telepon'=>'',
               'alamat'=>'',
               'usertype'=>'superadmin',
               'password'=> Hash::make('123456'),
               'remember_token' => Str::random(100),
               'email_verified_at' => now(),
            ],

        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}