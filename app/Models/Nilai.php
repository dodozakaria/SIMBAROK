<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai';
    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function tahfidz()
    {
        return $this->belongsTo(Tahfidz::class, 'tahfidz_id', 'id');
    }
}
