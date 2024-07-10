<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 20) as $key => $value) {
            # code...
            Employee::create([
                'name'  => 'raja'.$key,
                'email'  => 'raja'.$key.'@gmail.com',
                'phone'  => '0171904163'.$key,
            ]);
        }
    }
}
