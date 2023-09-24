<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HiringManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role_id',env("HIRING_MANAGER_ROLE"))->get();
        $count =1;
        foreach($users as $user){
            DB::table('hiring_managers')->insert([
                'user_id'=>$user->id,
                'organisation_id'=>$count,
                'status'=>'approved'
            ]);
            $count++;
        }
        
    }
}
