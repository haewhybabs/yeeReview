<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name'=>'admin',
            'last_name'=>'User',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('password'),
            'role_id'=>1,
            
        ]);
        DB::table('users')->insert([
            'first_name'=>'Employee',
            'last_name'=>'User',
            'email'=>'employee@gmail.com',
            'password'=>bcrypt('password'),
            'role_id'=>3,
        ]);
        DB::table('users')->insert([
            'first_name'=>'Organisation',
            'last_name'=>'User',
            'email'=>'organisation@gmail.com',
            'password'=>bcrypt('password'),
            'role_id'=>2,
        ]);
        DB::table('users')->insert([
            'first_name'=>'Hiring',
            'last_name'=>'Manager',
            'email'=>'hiring@gmail.com',
            'password'=>bcrypt('password'),
            'role_id'=>4,
        ]);
    }
}
