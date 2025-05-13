<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataGejala = Gejala::select('id', 'kode_gejala', 'nama_gejala')->get();
        // return response()->json($dataGejala);
        return view('dashboard.gejala.index', compact('dataGejala'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_gejala' => 'required|unique:gejala_abk,kode_gejala',
            'nama_gejala' => 'required',
        ]);

        Gejala::create($request->all());

        return redirect()->route('gejala.index')->with('success', 'Data gejala berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $gejala = Gejala::findOrFail($id);
        return response()->json($gejala);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gejala $gejala)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_gejala' => 'required|unique:gejala_abk,kode_gejala,' . $id,
            'nama_gejala' => 'required',
        ]);

        $gejala = Gejala::findOrFail($id);
        $gejala->update($request->all());

        return redirect()->route('gejala.index')->with('success', 'Data gejala berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gejala = Gejala::findOrFail($id);
        $gejala->delete();

        return redirect()->route('gejala.index')->with('success', 'Data gejala berhasil dihapus.');
    }
}
