<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Soal;
use App\Models\JawabanSiswa;
use App\Models\HasilKognitif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TesKognitifController extends Controller
{
    public function index()
    {
        $daftar_soal = Soal::all();
        return view('pages.siswa.tes_kognitif', compact('daftar_soal'));
    }

    public function simpanJawaban(Request $request)
    {
        $request->validate([
            'jawaban' => 'required|array',
        ]);

        $jumlah_benar = 0;
        $total_soal = Soal::count();

        foreach ($request->jawaban as $id_soal => $jawaban_dipilih) {
            $soal = Soal::find($id_soal);
            $is_benar = $soal && $soal->kunci_jawaban === $jawaban_dipilih;

            if ($is_benar) $jumlah_benar++;

            JawabanSiswa::updateOrCreate(
                [
                    'id_user' => Auth::id(),
                    'id_soal' => $id_soal
                ],
                [
                    'jawaban_dipilih' => $jawaban_dipilih,
                    'is_benar' => $is_benar
                ]
            );
        }

        $nilai = round(($jumlah_benar / $total_soal) * 100);

        // Tentukan Label (High Cognitive jika minimal 10 soal benar)
        $label = $jumlah_benar >= 10 ? 'High Cognitive' : 'Low Cognitive';

        // Simpan ke tabel hasil_kognitif
        HasilKognitif::updateOrCreate(
            ['id_user' => Auth::id()],
            [
                'jumlah_benar' => $jumlah_benar,
                'total_soal' => $total_soal,
                'nilai' => $nilai,
                'label' => $label
            ]
        );

        session(['skor_kognitif' => $jumlah_benar]);

        return response()->json([
            'status' => 'success',
            'jumlah_benar' => $jumlah_benar,
            'total_soal' => $total_soal,
            'nilai' => $nilai,
            'label' => $label
        ]);
    }
}
