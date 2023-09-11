<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $projects = Project::paginate(5);
        return view('admin.projects.index', compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $project = new Project();
        $types = Type::all();
        $technologies = Technology::all();
        return view("admin.projects.create", compact("project", "types", "technologies"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|unique:projects|string',
            "type_id" => "nullable|exists:types,id",
            'url' => 'required|unique:projects|url:http,https',
            'image' => 'image|nullable',
            'description' => 'string|nullable',
            "technology" => "nullable|exists:technologies,id"
        ], [
            "title.required" => "Il titolo è mancante",
            "title.unique" => "Il titolo esiste già",
            "url.required" => "Il link è mancante",
            "url.unique" => "Il link esiste già",
            "url.url" => "Il link è sbagliato",
            "image.image" => "Il file non è un immagine",
            "type_id.exists" => "Il tipo inserito non esiste",
            "technology.exists" => "La tecnologia selezionata non è valida"
        ]);
        $new_project = new Project();

        if (Arr::exists($request, "image")) {
            $img_path = Storage::putFile("project_image", $request->image);
            $new_project->image = $img_path;
        }
        $new_project->title = $request->title;
        $new_project->url = $request->url;
        $new_project->type_id = $request->type_id;
        $new_project->description = $request->description;
        $new_project->save();

        if ($request->technology) $new_project->technologies()->attach($request->technology);

        return to_route("admin.projects.index")->with('type', 'create')->with('message', 'Progetto creato con successo')->with('alert', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
        return view("admin.projects.show", compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
        $types = Type::all();
        $technologies = Technology::all();
        $project_technology_ids = $project->technologies->pluck("id")->toArray();
        return view("admin.projects.edit", compact("project", "types", "technologies", "project_technology_ids"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
        $request->validate([
            'title' => ["required", "string", Rule::unique("projects")->ignore($project->id)],
            'url' =>  ["required", "url:http,https", Rule::unique("projects")->ignore($project->id)],
            'image' => 'image|nullable',
            'description' => 'string|nullable',
            "type_id" => "nullable|exists:types,id",
            "technology" => "nullable|exists:technologies,id"
        ], [
            "title.required" => "Il titolo è mancante",
            "title.unique" => "Il titolo esiste già",
            "url.required" => "Il link è mancante",
            "url.unique" => "Il link esiste già",
            "url.url" => "Il link è sbagliato",
            "image.image" => "Il file non è un immagine",
            "type_id.exists" => "Il tipo inserito non esiste",
            "technology.exists" => "La tecnologia selezionata non è valida"
        ]);

        if (Arr::exists($request, "image")) {
            if ($project->image) Storage::delete($project->image);
            $img_path = Storage::putFile("project_image", $request->image);
            $project->image = $img_path;
        }

        $project->title = $request->title;
        $project->type_id = $request->type_id;
        $project->url = $request->url;
        $project->description = $request->description;
        $project->save();
        if (!$request->technology && count($project->technologies)) $project->technologies()->detach();
        elseif ($request->technology) $project->technologies()->sync($request->technology);
        return to_route('admin.projects.index')->with('type', 'update')->with('message', 'Progetto modificato con successo')->with('alert', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
        $project->delete();
        return to_route("admin.projects.index")->with('type', 'delete')->with('message', 'Progetto cancellato con successo')->with('alert', 'success');
    }

    // Trash
    public function trash()
    {
        //
        $projects = Project::onlyTrashed()->get();
        return view('admin.projects.trash', compact('projects'));
    }
    // Restore
    public function restore(String $id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->restore();
        return to_route('admin.projects.trash')->with('type', 'update')->with('alert', 'success')->with('message', 'Il progetto è stato ripristinato!');
    }

    // Drop
    public function drop(String $id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        if ($project->image) Storage::delete($project->image);
        if (count($project->technologies)) $project->technologies()->detach();
        $project->forceDelete();
        return to_route('admin.projects.trash')->with('type', 'delete')->with('alert', 'success')->with('message', 'Il progetto è stato eliminato definitivamente!');
    }

    //DropAll
    public function dropAll()
    {
        Project::onlyTrashed()->forceDelete();
        return to_route('admin.projects.trash')->with('type', 'delete')->with('alert', 'success')->with('message', 'Il tuo cestino è stato svuotato correttamente!');
    }
}
