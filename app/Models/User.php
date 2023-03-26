<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = "user_id";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'phone',
        'address',
        'gender',
        'email',
        'level',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function register($request)
    {
        return User::create($request);
    }
    public function checkAccount($login, $password)
    {
        $user = User::where("username", $login)->orWhere("email", $login)->first();
        if ($user != null) {
            if (Auth::attempt(["username" => $login, "password" => $password])) {
                return $user;
            }
            if (Auth::attempt(["email" => $login, "password" => $password])) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
