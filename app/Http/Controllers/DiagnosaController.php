<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\JenisAbk;
use App\Models\Keputusan;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $filteredArray = $request->post('kondisi');
        $kondisi = array_filter($filteredArray, function ($value) {
            return $value !== null;
        });

        $kodeGejala = [];
        $bobotPilihan = [];
        foreach ($kondisi as $key => $val) {
            if ($val != "#") {
                array_push($kodeGejala, $key);
                array_push($bobotPilihan, [$key, $val]);
            }
        }

        $jenisAbkList = JenisAbk::all(); // Ambil semua jenis ABK
        $arrGejala = [];

        foreach ($jenisAbkList as $jenisAbk) {
            $cfArr = [
                "cf" => [],
                "kode_abk" => []
            ];

            $ruleSetiapAbk = Keputusan::whereIn("kode_gejala", $kodeGejala)
                ->where("kode_abk", $jenisAbk->kode_abk)
                ->get();

            if ($ruleSetiapAbk->isNotEmpty()) {
                foreach ($ruleSetiapAbk as $rule) {
                    $cf = $rule->mb - $rule->md;
                    array_push($cfArr["cf"], $cf);
                    array_push($cfArr["kode_abk"], $rule->kode_abk);
                }

                $res = $this->getGabunganCf($cfArr);
                array_push($arrGejala, $res);
            }
        }

        $diagnosa_id = uniqid();
        $ins = Diagnosa::create([
            'diagnosa_id' => $diagnosa_id,
            'data_diagnosa' => json_encode($arrGejala),
            'kondisi' => json_encode($bobotPilihan)
        ]);

        return redirect()->route('spk.result', ["diagnosa_id" => $diagnosa_id]);
    }


    public function getGabunganCf($cfArr)
    {
        if (empty($cfArr["cf"])) {
            return 0;
        }

        if (count($cfArr["cf"]) == 1) {
            return [
                "value" => strval($cfArr["cf"][0]),
                "kode_abk" => $cfArr["kode_abk"][0]
            ];
        }

        $cfoldGabungan = $cfArr["cf"][0];

        for ($i = 1; $i < count($cfArr["cf"]); $i++) {
            $cfoldGabungan = $cfoldGabungan + ($cfArr["cf"][$i] * (1 - $cfoldGabungan));
        }

        return [
            "value" => "$cfoldGabungan",
            "kode_abk" => $cfArr["kode_abk"][0]
        ];
    }


    public function diagnosaResult($diagnosa_id)
    {
        $diagnosa = Diagnosa::where('diagnosa_id', $diagnosa_id)->first();
        $gejala = json_decode($diagnosa->kondisi, true);
        $data_diagnosa = json_decode($diagnosa->data_diagnosa, true);

        $nilaiTertinggi = 0.0;
        $diagnosa_dipilih = [];

        foreach ($data_diagnosa as $val) {
            if (floatval($val["value"]) > $nilaiTertinggi) {
                $diagnosa_dipilih["value"] = floatval($val["value"]);
                $diagnosa_dipilih["kode_abk"] = JenisAbk::where("kode_abk", $val["kode_abk"])->first();
                $nilaiTertinggi = floatval($val["value"]);
            }
        }

        $kodeGejala = array_column($gejala, 0);
        $kode_abk = $diagnosa_dipilih["kode_abk"]->kode_abk;

        $pakar = Keputusan::whereIn("kode_gejala", $kodeGejala)
            ->where("kode_abk", $kode_abk)
            ->get();

        $gejala_by_user = [];
        foreach ($pakar as $pakarItem) {
            foreach ($gejala as $userInput) {
                if ($userInput[0] == $pakarItem->kode_gejala) {
                    $gejala_by_user[] = $userInput;
                    break;
                }
            }
        }

        $nilaiPakar = [];
        foreach ($pakar as $key) {
            $nilaiPakar[] = ($key->mb - $key->md);
        }

        $nilaiUser = [];
        foreach ($gejala_by_user as $key) {
            $nilaiUser[] = $key[1];
        }

        $cfKombinasi = $this->getCfCombinasi($nilaiPakar, $nilaiUser);
        $hasil = $this->getGabunganCf($cfKombinasi);

        // Artikel bisa disesuaikan jika ada modelnya
        $artikel = null;

        return view('clients.cl_diagnosa_result', [
            "diagnosa" => $diagnosa,
            "diagnosa_dipilih" => $diagnosa_dipilih,
            "gejala" => $gejala,
            "data_diagnosa" => $data_diagnosa,
            "pakar" => $pakar,
            "gejala_by_user" => $gejala_by_user,
            "cf_kombinasi" => $cfKombinasi,
            "hasil" => $hasil,
            "artikel" => $artikel
        ]);
    }


    public function getCfCombinasi($pakar, $user)
    {
        $cfComb = [];

        if (count($pakar) === count($user)) {
            for ($i = 0; $i < count($pakar); $i++) {
                $res = $pakar[$i] * $user[$i];
                $cfComb[] = floatval($res);
            }

            return [
                "cf" => $cfComb,
                "kode_abk" => ["0"] // ini nanti akan diganti saat diproses kembali di getGabunganCf
            ];
        }

        return "Data tidak valid";
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
