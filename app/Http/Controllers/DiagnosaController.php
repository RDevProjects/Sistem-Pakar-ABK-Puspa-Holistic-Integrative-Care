<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\JenisAbk;
use App\Models\Keputusan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            $dataDiagnosis = Diagnosa::all();
        } else {
            $id_user = Auth::id();
            $dataDiagnosis = Diagnosa::where('user_id', $id_user)->get();
        }

        return view('dashboard.diagnosis.index', compact('dataDiagnosis'));
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
        // Ambil data kondisi dari input pengguna
        $filteredArray = $request->post('kondisi');
        $kondisi = array_filter($filteredArray, function ($value) {
            return $value !== null && $value !== "0"; // Hanya ambil gejala yang dipilih (nilai bukan 0)
        });

        // Jika tidak ada gejala yang dipilih, kembalikan error
        if (empty($kondisi)) {
            return redirect()->back()->withErrors(['msg' => 'Pilih setidaknya satu gejala untuk diagnosis.']);
        }

        // Simpan kode gejala dan bobot pengguna
        $kodeGejala = array_keys($kondisi);
        $bobotPilihan = [];
        foreach ($kondisi as $key => $val) {
            $bobotPilihan[$key] = floatval($val); // Konversi bobot ke float
        }

        // Ambil semua jenis ABK
        $jenisAbkList = JenisAbk::all();
        $arrGejala = [];

        // Proses perhitungan CF untuk setiap jenis ABK
        foreach ($jenisAbkList as $jenisAbk) {
            $cfArr = [];

            // Ambil aturan yang sesuai dengan gejala yang dipilih dan jenis ABK
            $ruleSetiapAbk = Keputusan::whereIn("kode_gejala", $kodeGejala)
                ->where("kode_abk", $jenisAbk->kode_abk)
                ->get();

            if ($ruleSetiapAbk->isNotEmpty()) {
                foreach ($ruleSetiapAbk as $rule) {
                    // Hitung CF per aturan: CF_pakar * CF_user
                    $cf_pakar = $rule->mb - $rule->md;
                    $cf_user = $bobotPilihan[$rule->kode_gejala] ?? 0; // Fallback jika bobot tidak ada
                    $cf_kombinasi = $cf_pakar * $cf_user;
                    $cfArr[] = $cf_kombinasi;
                }

                // Gabungkan semua CF untuk jenis ABK ini
                $cf_gabungan = $this->gabungkanCf($cfArr);
                $arrGejala[] = [
                    "value" => $cf_gabungan,
                    "kode_abk" => $jenisAbk->kode_abk
                ];
            }
        }

        // Jika tidak ada hasil diagnosis, kembalikan error
        if (empty($arrGejala)) {
            return redirect()->back()->withErrors(['msg' => 'Tidak ada diagnosis yang sesuai dengan gejala yang dipilih.']);
        }

        // Pilih diagnosis dengan CF tertinggi
        $diagnosa_dipilih = collect($arrGejala)->sortByDesc('value')->first();

        // Simpan ke database
        $diagnosa_id = uniqid();
        $ins = Diagnosa::create([
            'diagnosa_id' => $diagnosa_id,
            'data_diagnosa' => json_encode($arrGejala),
            'kondisi' => json_encode($bobotPilihan),
            'user_id' => Auth::id(),
            'diagnosa_dipilih' => json_encode($diagnosa_dipilih)
        ]);

        return redirect()->route('spk.result', ["diagnosa_id" => $diagnosa_id]);
    }

    private function gabungkanCf($cfArr)
    {
        if (empty($cfArr)) {
            return 0;
        }

        $cf_gabungan = $cfArr[0];
        for ($i = 1; $i < count($cfArr); $i++) {
            if ($cf_gabungan >= 0 && $cfArr[$i] >= 0) {
                $cf_gabungan = $cf_gabungan + $cfArr[$i] * (1 - $cf_gabungan);
            } elseif ($cf_gabungan < 0 && $cfArr[$i] < 0) {
                $cf_gabungan = $cf_gabungan + $cfArr[$i] * (1 + $cf_gabungan);
            } else {
                $cf_gabungan = ($cf_gabungan + $cfArr[$i]) / (1 - min(abs($cf_gabungan), abs($cfArr[$i])));
            }
        }
        return $cf_gabungan;
    }

    public function diagnosaResult($diagnosa_id)
    {
        // Ambil data diagnosis dari database
        $diagnosa = Diagnosa::where('diagnosa_id', $diagnosa_id)->first();
        // return response()->json($diagnosa);
        // Jika diagnosis tidak ditemukan, kembalikan error
        if (!$diagnosa) {
            return redirect()->route('dashboard')->withErrors(['msg' => 'Diagnosis tidak ditemukan.']);
        }

        $gejala = json_decode($diagnosa->kondisi, true) ?? [];
        $data_diagnosa = json_decode($diagnosa->data_diagnosa, true) ?? [];
        $diagnosa_dipilih = json_decode($diagnosa->diagnosa_dipilih, true);

        // Jika tidak ada diagnosis yang dipilih, tampilkan pesan di view
        if (empty($diagnosa_dipilih)) {
            return view('dashboard.form.diagnosa_result', [
                'diagnosa' => $diagnosa,
                'diagnosa_dipilih' => null,
                'gejala' => $gejala,
                'data_diagnosa' => $data_diagnosa,
                'pakar' => [],
                'gejala_by_user' => [],
                'artikel' => null,
                'error_message' => 'Tidak ada diagnosis yang sesuai dengan gejala yang dimasukkan.'
            ]);
        }

        // Ambil detail jenis ABK yang dipilih
        $diagnosa_dipilih['kode_abk'] = JenisAbk::where('kode_abk', $diagnosa_dipilih['kode_abk'])->first();

        // Ambil data pakar untuk gejala yang dipilih
        $kodeGejala = array_keys($gejala);
        $pakar = Keputusan::whereIn('kode_gejala', $kodeGejala)
            ->where('kode_abk', $diagnosa_dipilih['kode_abk']->kode_abk)
            ->get();

        // Filter gejala yang dimasukkan pengguna
        $gejala_by_user = [];
        foreach ($pakar as $pakarItem) {
            if (isset($gejala[$pakarItem->kode_gejala])) {
                $gejala_by_user[] = [$pakarItem->kode_gejala, $gejala[$pakarItem->kode_gejala]];
            }
        }

        // Artikel (opsional, sesuaikan jika ada modelnya)
        $artikel = null;

        return view('dashboard.form.diagnosa_result', [
            'diagnosa' => $diagnosa,
            'diagnosa_dipilih' => $diagnosa_dipilih,
            'gejala' => $gejala,
            'data_diagnosa' => $data_diagnosa,
            'pakar' => $pakar,
            'gejala_by_user' => $gejala_by_user,
            'artikel' => $artikel,
            'error_message' => null
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Diagnosa $diagnosa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diagnosa $diagnosa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diagnosa $diagnosa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diagnosa $diagnosa)
    {
        //
    }
}
