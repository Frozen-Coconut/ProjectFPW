<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\Project;
use App\Models\ToDo;
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

        // how many?
        $n = 10;

        // users
        for ($i = 1; $i <= $n; $i++) {
            User::create([
                'name' => "User $i",
                'email' => "user$i@example.com",
                'password' => bcrypt("user$i"),
                'occupational_status' => random_int(0, 3)
            ]);
        }

        // projects
        for ($i = 1; $i <= $n; $i++) {
            Project::create([
                'name_project' => "Project $i",
                'invitation_code' => "project$i",
                'project_manager_id' => $i
            ]);
        }

        // users_projects
        for ($i = 1; $i <= $n; $i++) {
            User::find($i)->projects()->attach(0, [
                'user_id' => $i,
                'project_id' => $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            User::find($i)->projects()->attach(0, [
                'user_id' => $i,
                'project_id' => $n + 1 - $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
