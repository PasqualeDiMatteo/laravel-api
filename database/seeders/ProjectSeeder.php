<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $type_ids = Type::pluck("id")->toArray();
        //
        $new_project = new Project();
        $new_project->title = "Laravel Comics";
        $new_project->type_id = Arr::random($type_ids);
        $new_project->url = "https://github.com/PasqualeDiMatteo/laravel-dc-comics";
        $new_project->description = "Copia del sito DC";
        $new_project->save();
    }
}
