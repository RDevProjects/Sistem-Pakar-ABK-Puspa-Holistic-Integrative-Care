<?php
   namespace App\Http\Controllers;
   use App\Models\PoinObservasi;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\DB;

   class PoinObservasiController extends Controller
   {
       public function index()
       {
           $poin = PoinObservasi::all();
           return view('dashboard.poin_observasi.index', compact('poin'));
       }

       public function create()
       {
           return view('dashboard.poin_observasi.create');
       }

       public function store(Request $request)
       {
           $request->validate([
               'aspek' => 'required|string|max:50',
               'deskripsi' => 'required|string|max:255',
               'skor' => 'required|integer|in:1,2,3',
           ]);

           try {
               PoinObservasi::create($request->only(['aspek', 'deskripsi', 'skor']));
               return redirect()->route('poin_observasi.index')->with('success', 'Poin observasi berhasil ditambahkan!');
           } catch (\Exception $e) {
               return back()->withErrors(['error' => 'Gagal menambahkan poin observasi: ' . $e->getMessage()]);
           }
       }

       public function edit($id)
       {
           $poin = PoinObservasi::findOrFail($id);
           return view('dashboard.poin_observasi.edit', compact('poin'));
       }

       public function update(Request $request, $id)
       {
           $request->validate([
               'aspek' => 'required|string|max:50',
               'deskripsi' => 'required|string|max:255',
               'skor' => 'required|integer|in:1,2,3',
           ]);

           try {
               $poin = PoinObservasi::findOrFail($id);
               $poin->update($request->only(['aspek', 'deskripsi', 'skor']));
               return redirect()->route('poin_observasi.index')->with('success', 'Poin observasi berhasil diperbarui!');
           } catch (\Exception $e) {
               return back()->withErrors(['error' => 'Gagal memperbarui poin observasi: ' . $e->getMessage()]);
           }
       }

       public function destroy($id)
       {
           try {
               $poin = PoinObservasi::findOrFail($id);
               $poin->delete();
               return redirect()->route('poin_observasi.index')->with('success', 'Poin observasi berhasil dihapus!');
           } catch (\Exception $e) {
               return back()->withErrors(['error' => 'Gagal menghapus poin observasi: ' . $e->getMessage()]);
           }
       }
   }
?>