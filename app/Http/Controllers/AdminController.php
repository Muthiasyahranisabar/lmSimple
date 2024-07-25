<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tugas;
use App\Models\PenyelesaianTugas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // $tugas = Tugas::all();
        // return view('admin.tasks.index', compact('tugas'));
        $tugas = Tugas::with('penyelesaianTugas.user')->get();
        return view('admin.tasks.index', compact('tugas'));
    }
    public function complete(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('file')->store('uploads', 'public');

        PenyelesaianTugas::create([
            'user_id' => auth()->id(),
            'tugas_id' => $id,
            'file' => $file,
        ]);

        return redirect()->route('user.tasks.show', $id)->with('success', 'Tugas telah diselesaikan.');
    }

    public function show($id)
    {
        $tugas = Tugas::findOrFail($id);
        $penyelesaianTugas = PenyelesaianTugas::where('tugas_id', $id)
            ->where('user_id', auth()->id())
            ->first();

        return view('user.tasks.show', compact('tugas', 'penyelesaianTugas'));
    }

    public function create()
    {
        // return view('admin.master-pasien.form-pasien');
        return view('admin.tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'type' => 'required|in:upload,file',
            'file' => 'nullable|file|mimes:pdf,doc,docx,zip'
        ]);

        $tugas = new Tugas();
        $tugas->judul = $request->judul;
        $tugas->deskripsi = $request->deskripsi;
        $tugas->type = $request->type;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('tugas_files', 'public');
            $tugas->file = $filePath;
        }

        $tugas->created_by = auth()->id(); // Menyimpan ID admin yang membuat tugas

        $tugas->save();

        return redirect()->route('admin.tasks.index')->with('success', 'Tugas berhasil dibuat');
    }



    // TugasController.php

    public function edit($id)
    {
        $tugas = Tugas::findOrFail($id);
        return view('admin.tasks.edit', compact('tugas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'type' => 'required|string|in:upload,file',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,doc,docx,pdf|max:2048',
        ]);

        $tugas = Tugas::findOrFail($id);

        if ($request->hasFile('file')) {
            if ($tugas->file) {
                Storage::disk('public')->delete($tugas->file);
            }
            $file = $request->file('file')->store('uploads', 'public');
            $tugas->file = $file;
        }

        $tugas->judul = $request->input('judul');
        $tugas->deskripsi = $request->input('deskripsi');
        $tugas->type = $request->input('type');
        $tugas->save();

        return redirect()->route('admin.tasks.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);
        if ($tugas->file) {
            Storage::disk('public')->delete($tugas->file);
        }
        $tugas->delete();
        return redirect()->route('admin.tasks.index')->with('success', 'Tugas berhasil dihapus.');
    }

    public function downloadPdf($id)
{
    $tugas = Tugas::findOrFail($id);

    // Asumsikan ada model User dan sudah login
    $user = auth()->user(); // Mendapatkan user yang sedang login

    // Periksa apakah tugas memiliki file
    if ($tugas->file) {
        $filePath = storage_path('app/public/' . $tugas->file);

        if (file_exists($filePath)) {
            // Simpan penyelesaian tugas jika belum ada
            if (!$tugas->penyelesaianTugas()->where('user_id', $user->id)->exists()) {
                $tugas->penyelesaianTugas()->create([
                    'user_id' => $user->id,
                    'file' => $tugas->file,
                ]);
            }

            // Kembalikan file untuk diunduh
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
