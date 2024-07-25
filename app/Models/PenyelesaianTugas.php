<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyelesaianTugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'tugas_id',
        'user_id',
        'file',
        'completed_at'
    ];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
