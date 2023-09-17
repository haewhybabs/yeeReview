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
            'role_id'=>env("ADMIN_ROLE"),
            
        ]);
        DB::table('users')->insert([
            'first_name'=>'Employee',
            'last_name'=>'User',
            'email'=>'employee@gmail.com',
            'password'=>bcrypt('password'),
            'role_id'=>env("EMPLOYEE_ROLE"),
        ]);
        DB::table('users')->insert([
            'first_name'=>'Employee2',
            'last_name'=>'User2',
            'email'=>'employee2@gmail.com',
            'password'=>bcrypt('password'),
            'role_id'=>env("EMPLOYEE_ROLE"),
        ]);
        DB::table('users')->insert([
            'first_name'=>'Organisation',
            'last_name'=>'User4',
            'email'=>'organisation@gmail.com',
            'password'=>bcrypt('password'),
            'role_id'=>env("ORGANISATION_ROLE"),
        ]);
        DB::table('users')->insert([
            'first_name'=>'Organisation2',
            'last_name'=>'User5',
            'email'=>'organisation2@gmail.com',
            'password'=>bcrypt('password'),
            'role_id'=>env("ORGANISATION_ROLE"),
        ]);
        DB::table('users')->insert([
            'first_name'=>'Hiring',
            'last_name'=>'Manager',
            'email'=>'hiring@gmail.com',
            'password'=>bcrypt('password'),
            'role_id'=>env("HIRING_MANAGER_ROLE"),
        ]);
    }
}
