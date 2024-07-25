<?php

namespace App\Http\Controllers;
use App\Models\Tugas;
use Illuminate\Http\Request;
use App\Models\PenyelesaianTugas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $tugas = Tugas::with('creator')->get(); // Mengambil tugas beserta admin yang memberikan tugas
        return view('user.tasks.index', compact('tugas'));
        
    }
    public function show($id)
    {
        $tugas = Tugas::findOrFail($id);
        $penyelesaianTugas = PenyelesaianTugas::where('tugas_id', $id)
            ->where('user_id', auth()->id())
            ->first();

        return view('user.tasks.show', compact('tugas', 'penyelesaianTugas'));
    }
    
    public function complete(Request $request, $id)
    {
        $request->validate([
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file')->store('uploads', 'public');
        }

        PenyelesaianTugas::create([
            'user_id' => auth()->id(),
            'tugas_id' => $id,
            'file' => $file,
        ]);

        return redirect()->route('user.tasks.show', $id)->with('success', 'Tugas telah diselesaikan.');
    }

    public function downloadPdf($id)
    {
        $tugas = Tugas::findOrFail($id);
        $user = auth()->user();

        if ($tugas->file) {
            $filePath = storage_path('app/public/' . $tugas->file);

            if (file_exists($filePath)) {
                if (!$tugas->penyelesaianTugas()->where('user_id', $user->id)->exists()) {
                    $tugas->penyelesaianTugas()->create([
                        'user_id' => $user->id,
                        'file' => $tugas->file,
                    ]);
                }

                return response()->download($filePath);
            }
        }

        return redirect()->route('admin.tasks.index')->with('error', 'File PDF tidak ditemukan.');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('/login')->with('success', 'Anda telah berhasil logout.');
    }
}



