<?php

namespace App\Http\Controllers;
use App\Models\Tugas;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    // Di UserController atau controller yang sesuai
    public function index()
    {
        // Menghitung total tugas
        $tugasCount = Tugas::count();

        // Menghitung jumlah tugas yang telah diselesaikan
        $tugasCompletedCount = Tugas::whereHas('penyelesaianTugas', function($query) {
            $query->whereNotNull('file'); // Menganggap tugas selesai jika ada file penyelesaian
        })->count();

        // Mengambil semua tugas beserta creator (admin yang memberikan tugas)
        $tugas = Tugas::with('creator')->get();

        return view('user.dashboard', compact('tugasCount', 'tugasCompletedCount', 'tugas'));
    }

}
