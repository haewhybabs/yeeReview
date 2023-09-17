<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'user_id' => 2, // Assuming user with ID 1 is the employee
            'current_organisation_id' => 1, // Assuming organisation with ID 1
            'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'address' => '789 Oak St, Town',
            'dob' => '1990-05-15',
            'phone_number' => '555-123-4567',
            'marital_status' => 'Single',
            'national_id' => '123456789',
            'position' => 'Software Engineer',
            'department_id' => 1, // Assuming department with ID 1
        ]);

        Employee::create([
            'user_id' => 3, // Assuming user with ID 2 is the employee
            'current_organisation_id' => 2, // Assuming organisation with ID 2
            'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'address' => '456 Maple St, City',
            'dob' => '1985-12-20',
            'phone_number' => '555-987-6543',
            'marital_status' => 'Married',
            'national_id' => '987654321',
            'position' => 'HR Manager',
            'department_id' => 2,
        ]);
    }
}
