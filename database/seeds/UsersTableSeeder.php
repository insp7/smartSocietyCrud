<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin=User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'created_at' => '2019-05-23 07:35:39',
            'updated_at' => '2019-05-23 07:35:39'
        ]);

        $admin->assignRole('Admin');
    }
}
