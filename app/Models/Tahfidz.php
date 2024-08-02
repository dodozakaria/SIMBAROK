<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahfidz extends Model
{
    use HasFactory;
    protected $table = 'tahfidz';
    protected $guarded = [''];

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'tahfidz_id');
    }
}
