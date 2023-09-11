<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $types = Type::paginate(5);
        return view('admin.types.index', compact("types"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $type = new Type;
        return view("admin.types.create", compact("type"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'label' => 'required|unique:types|string',
            "color" => "nullable|regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/",

        ], [
            "label.required" => "Il Nome è mancante",
            "label.unique" => "Il Nome esiste già",
            "color.regex" => "Il colore non esiste"
        ]);

        $new_type = new Type();
        $new_type->label = $request->label;
        $new_type->color = $request->color;
        $new_type->save();
        return to_route("admin.types.index")->with('type', 'create')->with('message', 'Tipo creato con successo')->with('alert', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
        return view("admin.types.show", compact("type"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        //
        return view("admin.types.edit", compact("type"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        //
        $request->validate([
            'label' =>  ["required", "string", Rule::unique("types")->ignore($type->id)],
            "color" => "nullable|regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/",

        ], [
            "label.required" => "Il Nome è mancante",
            "label.unique" => "Il Nome esiste già",
            "color.regex" => "Il colore non esiste"
        ]);

        $type->label = $request->label;
        $type->color = $request->color;
        $type->save();
        return to_route('admin.types.index')->with('type', 'update')->with('message', 'Tipo modificato con successo')->with('alert', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        //
        $type->delete();
        return to_route("admin.types.index")->with('type', 'delete')->with('message', 'Tipo cancellato con successo')->with('alert', 'success');
    }

    // Trash
    public function trash()
    {
        //
        $types = Type::onlyTrashed()->get();
        return view('admin.types.trash', compact('types'));
    }

    // Restore
    public function restore(String $id)
    {
        $type = Type::onlyTrashed()->findOrFail($id);
        $type->restore();
        return to_route('admin.types.trash')->with('type', 'update')->with('alert', 'success')->with('message', 'Il tipo è stato ripristinato!');
    }

    // Drop
    public function drop(String $id)
    {
        $type = Type::onlyTrashed()->findOrFail($id);

        $type->forceDelete();
        return to_route('admin.types.trash')->with('type', 'delete')->with('alert', 'success')->with('message', 'Il tipo è stato eliminato definitivamente!');
    }

    // Drop All
    public function dropAll()
    {
        Type::onlyTrashed()->forceDelete();
        return to_route('admin.types.trash')->with('type', 'delete')->with('alert', 'success')->with('message', 'Il tuo cestino è stato svuotato correttamente!');
    }
}
