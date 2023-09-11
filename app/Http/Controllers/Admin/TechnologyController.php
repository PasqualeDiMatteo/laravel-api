<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $technologies = Technology::paginate(5);
        return view('admin.technologies.index', compact("technologies"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $technology = new Technology;
        $colors = config('technology');
        return view("admin.technologies.create", compact("technology", "colors"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'label' => 'required|unique:types|string',
            "color" => "nullable",

        ], [
            "label.required" => "Il Nome è mancante",
            "label.unique" => "Il Nome esiste già",
        ]);

        $new_technology = new Technology();
        $new_technology->label = $request->label;
        $new_technology->color = $request->color;

        $new_technology->save();
        return to_route("admin.technologies.index")->with('type', 'create')->with('message', 'Tecnologia creata con successo')->with('alert', 'success');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        //
        return view("admin.technologies.show", compact("technology"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        //
        $colors = config('technology');
        return view("admin.technologies.edit", compact("technology", "colors"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        //
        $request->validate([
            'label' =>  ["required", "string", Rule::unique("technologies")->ignore($technology->id)],
            "color" => "nullable",

        ], [
            "label.required" => "Il Nome è mancante",
            "label.unique" => "Il Nome esiste già",
        ]);

        $technology->label = $request->label;
        $technology->color = $request->color;
        $technology->save();
        return to_route('admin.technologies.index')->with('type', 'update')->with('message', 'Tecnologia modificata con successo')->with('alert', 'success');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        //
        $technology->delete();
        return to_route("admin.technologies.index")->with('type', 'delete')->with('message', 'Tecnologia cancellata con successo')->with('alert', 'success');
    }

    // Trash
    public function trash()
    {
        //
        $technologies = Technology::onlyTrashed()->get();
        return view('admin.technologies.trash', compact('technologies'));
    }

    // Restore
    public function restore(String $id)
    {
        $technology = Technology::onlyTrashed()->findOrFail($id);
        $technology->restore();
        return to_route('admin.technologies.trash')->with('type', 'update')->with('alert', 'success')->with('message', 'La tecnologia è stata ripristinato!');
    }

    // Drop
    public function drop(String $id)
    {
        $technology = Technology::onlyTrashed()->findOrFail($id);

        $technology->forceDelete();
        return to_route('admin.technologies.trash')->with('type', 'delete')->with('alert', 'success')->with('message', 'La tecnologia è stata eliminata definitivamente!');
    }

    // Drop All
    public function dropAll()
    {
        Technology::onlyTrashed()->forceDelete();
        return to_route('admin.technologies.trash')->with('type', 'delete')->with('alert', 'success')->with('message', 'Il tuo cestino è stato svuotato correttamente!');
    }
}
