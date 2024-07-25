<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tugas;

class EditorController extends Controller
{
    public function index()
    {
        // Ambil tugas yang dibuat oleh admin
        $tugas = Tugas::all(); // Pastikan query ini sesuai dengan kebutuhan Anda

        return view('editor.tasks.index', compact('tugas'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('/login')->with('success', 'Anda telah berhasil logout.');
    }
    public function edit($id)
    {
        $tugas = Tugas::findOrFail($id);
        return view('editor.task.edit', compact('tugas'));
    }

    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);
        $tugas->delete();
        return redirect()->route('editor.tasks.index')->with('success', 'Tugas berhasil dihapus.');
    }

}
