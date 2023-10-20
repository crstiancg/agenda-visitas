<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSecretaryRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SecretaryController extends Controller
{
    public function index()
    {
        $secretaries = User::latest()->paginate(5);
        return view('secretaries.index', compact('secretaries'));
    }

    public function create()
    {
        return view('secretaries.create');
    }

    public function store(StoreSecretaryRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $secretary = User::create($data);
        return redirect()
            ->route('secretaries.index')
            ->with([
                'status' => "¡La secretaria \"$secretary->name\" fue añadida exitosamente!"
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

    public function edit(User $secretary)
    {
        return view('secretaries.edit', compact('secretary'));
    }

    public function update(StoreSecretaryRequest $request, User $secretary)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $secretary->update($data);
        return redirect()
            ->route('secretaries.index')
            ->with([
                'status' => "¡Los datos de la secretaria \"$secretary->name\" fueron editados exitosamente!"
            ]);
    }

    public function destroy(User $secretary)
    {
        $secretary->delete();
        return redirect()->route('secretaries.index')
            ->with([
                'status' => "¡Los datos de la secretaria \"$secretary->name\" fueron eliminados exitosamente!"
            ]);
    }
}
