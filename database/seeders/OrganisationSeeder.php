<?php

namespace Database\Seeders;

use App\Models\Organisation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = User::where('role_id',env("ORGANISATION_ROLE"))->get();
        foreach($users as $user){
            $name = mt_rand(1,2);
            $randomString = bin2hex(random_bytes(1));
            Organisation::create([
                'name' => 'Company '. $randomString,
                'description' => 'Sample description for Company '.$name,
                'address' => '123 Main St, City',
                'phone_number' => '123-456-7890',
                'industry' => 'Technology',
                'website' => 'https://www.companya.com',
                'user_id' => $user->id,
                'email' => $randomString.'info@companya.com',
                'status' => 'pending',
            ]);
        }
    }
}
