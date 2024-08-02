<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForgotPassword extends Model
{
    use HasFactory;
    protected $table = 'password_reset_tokens';
    protected $guarded = [''];

    static function password_reset() {
        return ForgotPassword::all();
    }

    static function users($email) {
        return User::where('email', $email)->first();
    }
}
