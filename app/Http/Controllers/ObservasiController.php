<?php

namespace App\Http\Controllers;

use App\Models\Observasi;
use App\Models\PoinObservasi;
use App\Models\JawabanObservasi;
use App\Models\Aturan;
use App\Models\HasilObservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObservasiController extends Controller
{
    // Display form with observation points
    public function create()
    {
        $poin = PoinObservasi::all()->groupBy('aspek');
        return view('dashboard.observasi.create', compact('poin'));
    }

    // Store observation and process forward chaining
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'nama_anak' => 'required|string|max:100',
            'usia' => 'required|integer|between:2,5',
            'tanggal' => 'required|date',
            'koordinator' => 'required|string|max:100',
            'observer' => 'required|string|max:100',
            'jawaban' => 'required|array',
            'jawaban.*' => 'in:YA,TIDAK',
            'keyakinan' => 'required|array',
            'keyakinan.*' => 'numeric|between:0,100',
            'keterangan' => 'array',
            'keterangan.*' => 'nullable|string',
            'kesimpulan' => 'nullable|string',
        ]);

        // Start transaction
        DB::beginTransaction();
        try {
            // 1. Save observation
            $observasi = Observasi::create([
                'nama_anak' => $request->nama_anak,
                'usia' => $request->usia,
                'tanggal' => $request->tanggal,
                'koordinator' => $request->koordinator,
                'observer' => $request->observer,
            ]);

            // 2. Process answers and calculate CF
            $totalSkor = 0;
            $poinObservasi = PoinObservasi::all();
            foreach ($poinObservasi as $poin) {
                $idPoin = $poin->id_poin;
                $jawaban = $request->jawaban[$idPoin] ?? 'TIDAK';
                $keyakinan = $request->keyakinan[$idPoin] ?? 0;
                
                // Calculate MB and MD from keyakinan (0-100%)
                if ($jawaban == 'YA') {
                    $mb = $keyakinan / 100;
                    $md = (100 - $keyakinan) / 100;
                } else {
                    $mb = (100 - $keyakinan) / 100;
                    $md = $keyakinan / 100;
                }
                $cf = $mb - $md;
                $skorHasil = ($cf > 0) ? $poin->skor * $cf : 0; // Only add positive CF

                // Save answer
                JawabanObservasi::create([
                    'id_observasi' => $observasi->id_observasi,
                    'id_poin' => $idPoin,
                    'jawaban' => $jawaban,
                    'mb' => $mb,
                    'md' => $md,
                    'cf' => $cf,
                    'skor_hasil' => $skorHasil,
                    'keterangan' => $request->keterangan[$idPoin] ?? null,
                ]);

                $totalSkor += $skorHasil;
            }

            // 3. Apply forward chaining rules
            $aturan = Aturan::all();
            $kategori = 'Belum Signifikan';
            $rekomendasi = 'Observasi Lebih Lanjut';
            foreach ($aturan as $rule) {
                // Safely evaluate condition
                $condition = str_replace('total_skor', $totalSkor, $rule->kondisi);
                if (eval("return $condition;")) {
                    $kategori = $rule->kategori;
                    $rekomendasi = $rule->rekomendasi;
                    break;
                }
            }

            // 4. Save result
            HasilObservasi::create([
                'id_observasi' => $observasi->id_observasi,
                'total_skor' => $totalSkor,
                'kategori' => $kategori,
                'rekomendasi' => $rekomendasi,
                'kesimpulan' => $request->kesimpulan,
            ]);

            DB::commit();
            return redirect()->route('observasi.result', $observasi->id_observasi)
                ->with('success', 'Observasi berhasil diproses!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal memproses: ' . $e->getMessage()]);
        }
    }

    // Display result
    public function result($id)
    {
        $observasi = Observasi::with('jawaban.poin', 'hasil')->findOrFail($id);
        return view('dashboard.observasi.result', compact('observasi'));
    }
}
