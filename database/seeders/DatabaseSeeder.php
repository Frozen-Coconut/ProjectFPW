<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => "User $i",
                'email' => "user$i@example.com",
                'password' => bcrypt("user$i"),
                'occupational_status' => random_int(0, 3)
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            Project::create([
                'name_project' => "Project $i",
                'invitation_code' => "project$i",
                'project_manager_id' => $i
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            User::find($i)->projects()->attach(0, [
                'user_id' => $i,
                'project_id' => $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
