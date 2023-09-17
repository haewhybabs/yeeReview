<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            '1st Quarter',
            '2nd Quarter',
            '3rd Quarter',
            
        ];
        foreach($data as $d){
            DB::table('quarters')->insert([
                'name'=>$d
            ]);
        }
    }
}
