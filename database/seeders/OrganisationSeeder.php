<?php

namespace Database\Seeders;

use App\Models\Organisation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Seed sample organisations
        Organisation::create([
            'name' => 'Company A',
            'description' => 'Sample description for Company A',
            'address' => '123 Main St, City',
            'phone_number' => '123-456-7890',
            'industry' => 'Technology',
            'website' => 'https://www.companya.com',
            'user_id' => 4,
            'email' => 'info@companya.com',
            'status' => 'active',
        ]);

        Organisation::create([
            'name' => 'Company B',
            'description' => 'Sample description for Company B',
            'address' => '456 Elm St, Town',
            'phone_number' => '987-654-3210',
            'industry' => 'Finance',
            'website' => 'https://www.companyb.com',
            'user_id' => 5,
            'email' => 'info@companyb.com',
            'status' => 'active',
        ]);
    }
}
