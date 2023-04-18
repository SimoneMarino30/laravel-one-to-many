<?php

namespace Database\Seeders;

use App\Models\Project;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 50; $i++) {
            $project = new Project;
            
            $project->title = $faker->catchPhrase();
            // $project->link = 'https://picsum.photos/300/500';
            $project->date = $faker->date('d/m/Y');
            $project->description = $faker->paragraph(2);
            $project->save();

        }
    }
}