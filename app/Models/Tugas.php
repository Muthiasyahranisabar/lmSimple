<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PenyelesaianTugas;
use Illuminate\Support\Facades\Storage;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'type',
        'file',
        'admin_id',
        'gambar',
        'created_by'
    ];

    // Tambahkan relasi creator
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
    
    public function penyelesaianTugas()
    {
        return $this->hasMany(PenyelesaianTugas::class);
    }

    public function getGambarUrlAttribute()
    {
        return $this->gambar ? Storage::url($this->gambar) : null;
    }
    
}
