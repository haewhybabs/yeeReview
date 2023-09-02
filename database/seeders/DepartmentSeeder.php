<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Human Resources',
            'Finance and Accounting',
            'Marketing',
            'Sales',
            'Operations',
            'Information Technology',
            'Research and Development',
            'Customer Service',
            'Legal',
            'Public Relations',
            'Quality Assurance',
            'Supply Chain and Logistics',
            'Project Management',
            'Business Development',
            'Strategy and Planning',
            'Corporate Communications',
            'Training and Development',
            'Environmental, Health, and Safety',
            'Facilities Management',
            'Internal Audit',
            'Risk Management',
            'Employee Engagement',
            'Diversity and Inclusion',
            'Analytics and Business Intelligence',
            'Product Management',
            'Corporate Social Responsibility',
            'Legal and Regulatory Affairs',
            'Investor Relations',
            'Mergers and Acquisitions',
            'Corporate Strategy'
        ];
        foreach($data as $d){
            DB::table('departments')->insert([
                'name'=>$d
            ]);
        }
    }
}
