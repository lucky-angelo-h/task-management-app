<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TaskStatuses;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('task_statuses')->insert([
            ['status_name' => 'NEW'],
            ['status_name' => 'IN PROGRESS'],
            ['status_name' => 'UNDER REVIEW'],
            ['status_name' => 'COMPLETED'],
        ]);

        DB::table('task_category')->insert([
            ['category_name' => 'Backend'],
            ['category_name' => 'Frontend'],
            ['category_name' => 'DevOps'],
        ]);
    }
}
