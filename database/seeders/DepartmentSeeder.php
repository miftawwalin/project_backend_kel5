<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        // Department sesuai dengan data Excel (gunakan updateOrCreate untuk menghindari duplikasi)
        Department::updateOrCreate(['name' => 'PPIC'], ['name' => 'PPIC']);
        Department::updateOrCreate(['name' => 'QC'], ['name' => 'QC']);
        Department::updateOrCreate(['name' => 'DIES SHOP'], ['name' => 'DIES SHOP']);
        Department::updateOrCreate(['name' => 'PRODUCTION'], ['name' => 'PRODUCTION']);
        Department::updateOrCreate(['name' => 'QA'], ['name' => 'QA']);
        Department::updateOrCreate(['name' => 'Maintenance'], ['name' => 'Maintenance']);
    }
}
