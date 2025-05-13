<?php

namespace App\Http\Controllers;

use App\Models\JenisAbk;
use Illuminate\Http\Request;

class JenisAbkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataJenisAbk = JenisAbk::select('id', 'kode_abk', 'nama_abk')->get();
        return view('dashboard.jenis_abk.index', compact('dataJenisAbk'));
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
            'kode_abk' => 'required|unique:jenis_abk,kode_abk',
            'nama_abk' => 'required',
        ]);

        JenisAbk::create($request->all());

        return redirect()->route('jenis-abk.index')->with('success', 'Data jenis abk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataJenisAbk = JenisAbk::findOrFail($id);
        return response()->json($dataJenisAbk);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisAbk $jenisAbk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_abk' => 'required|unique:jenis_abk,kode_abk,' . $id,
            'nama_abk' => 'required',
        ]);

        $dataJenisAbk = JenisAbk::findOrFail($id);
        $dataJenisAbk->update($request->all());

        return redirect()->route('jenis-abk.index')->with('success', 'Data jenis abk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataJenisAbk = JenisAbk::findOrFail($id);
        $dataJenisAbk->delete();

        return redirect()->route('jenis-abk.index')->with('success', 'Data jenis abk berhasil dihapus.');
    }
}
