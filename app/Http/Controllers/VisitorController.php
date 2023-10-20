<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVisitorRequest;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public function index()
    {
        $visitors = Visitor::latest()->paginate(10);
        return view('visitors.index', compact('visitors'));
    }

    public function create()
    {
        $entities = Visitor::$entities;
        return view('visitors.create', compact('entities'));
    }

    public function store(StoreVisitorRequest $request)
    {
        if ($request->ajax()) {
            $visitor = Visitor::create($request->validated());
            return response()->json([
                'message' => "New visitor with name: \"{$visitor->name}\" added",
                'id' => $visitor->id,
                'name' => $visitor->name
            ], 200);
        }

        $visitor = Visitor::create($request->validated());
        return redirect()
            ->route('visitors.index')
            ->with([
                'status' => "¡El visitante \"$visitor->name\" fue añadido exitosamente!"
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit(Visitor $visitor)
    {
        return view('visitors.edit', compact('visitor'));
    }

    public function update(StoreVisitorRequest $request, Visitor $visitor)
    {
        $visitor->update($request->validated());
        return redirect()
            ->route('visitors.index')
            ->with([
                'status' => "¡Los datos del visitante \"$visitor->name\" fueron editados exitosamente!"
            ]);
    }

    public function destroy(Visitor $visitor)
    {
        $visitor->delete();
        return redirect()
            ->route('visitors.index')
            ->with([
                'status' => "¡El visitante \"$visitor->name\" fue eliminado exitosamente!"
            ]);
    }
}
