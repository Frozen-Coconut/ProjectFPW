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

        // admin
        User::create([
            'name' => "Administrator",
            'email' => "administrator@example.com",
            'email_verified_at' => now(),
            'password' => bcrypt("rotartsinimda"),
            'occupational_status' => 3,
            'role' => 1
        ]);

        // how many?
        $n = 10;

        // users
        for ($i = 1; $i <= $n; $i++) {
            User::create([
                'name' => "User $i",
                'email' => "user$i@example.com",
                'email_verified_at' => now(),
                'password' => bcrypt("user$i"),
                'occupational_status' => random_int(0, 3),
                'role' => 0
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

        for ($i = 1; $i <= $n; $i++) {
            for ($j = 1; $j <= 5; $j++) {
                ToDo::create([
                    'name' => "To Do $j",
                    'project_id' => $i,
                    'deadline' => date_add(now(), date_interval_create_from_date_string("7 days"))
                ]);
            }
        }

        // posts
        for ($i = 1; $i <= $n; $i++) {
            Post::create([
                'project_id' => $i,
                'user_id' => $i,
                'contents' => "Ini post dari User $i"
            ]);
            Post::create([
                'project_id' => $i,
                'user_id' => $n + 1 - $i,
                'contents' => 'Ini post dari User ' . ($n + 1 - $i)
            ]);
        }
    }
}
