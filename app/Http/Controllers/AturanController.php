<?php
   namespace App\Http\Controllers;
   use App\Models\Aturan;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\DB;

   class AturanController extends Controller
   {
       public function index()
       {
           $aturan = Aturan::all();
           return view('dashboard.aturan.index', compact('aturan'));
       }

       public function create()
       {
           return view('dashboard.aturan.create');
       }

       public function store(Request $request)
       {
           $request->validate([
               'kondisi' => 'required|string|max:100',
               'kategori' => 'required|string|max:50',
               'rekomendasi' => 'required|string|max:100',
           ]);

           try {
               Aturan::create($request->only(['kondisi', 'kategori', 'rekomendasi']));
               return redirect()->route('aturan.index')->with('success', 'Aturan berhasil ditambahkan!');
           } catch (\Exception $e) {
               return back()->withErrors(['error' => 'Gagal menambahkan aturan: ' . $e->getMessage()]);
           }
       }

       public function edit($id)
       {
           $aturan = Aturan::findOrFail($id);
           return view('dashboard.aturan.edit', compact('aturan'));
       }

       public function update(Request $request, $id)
       {
           $request->validate([
               'kondisi' => 'required|string|max:100',
               'kategori' => 'required|string|max:50',
               'rekomendasi' => 'required|string|max:100',
           ]);

           try {
               $aturan = Aturan::findOrFail($id);
               $aturan->update($request->only(['kondisi', 'kategori', 'rekomendasi']));
               return redirect()->route('aturan.index')->with('success', 'Aturan berhasil diperbarui!');
           } catch (\Exception $e) {
               return back()->withErrors(['error' => 'Gagal memperbarui aturan: ' . $e->getMessage()]);
           }
       }

       public function destroy($id)
       {
           try {
               $aturan = Aturan::findOrFail($id);
               $aturan->delete();
               return redirect()->route('aturan.index')->with('success', 'Aturan berhasil dihapus!');
           } catch (\Exception $e) {
               return back()->withErrors(['error' => 'Gagal menghapus aturan: ' . $e->getMessage()]);
           }
       }
   }
   ?>