<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Organisation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            DepartmentSeeder::class,
            QuarterSeeder::class,
            OrganisationSeeder::class,
            EmployeeSeeder::class
        ]);
    }
}
