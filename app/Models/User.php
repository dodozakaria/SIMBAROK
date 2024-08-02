<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable, CanResetPassword;
    protected $table = 'users';
    protected $guarded = [''];

    static function get($email)
    {
        return static::where('email', $email)->first();
    }

    public function isDefaultPassword()
    {
        $defaultPassword = 'Mubarok2024'; // Your default password
        return Hash::check($defaultPassword, $this->password);
    }
}
