<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

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

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates = ['created_at'];

    

    public function getFirstNameAttribute() {
        $name = explode(" ", $this->name);
        return array_shift($name);
    }

    public function getFirstAndLastAttribute() {
        $name = explode(" ", $this->name);
        return array_shift($name) .' ' . end($name);
    }

    public function getImageAttribute() {
        $avatarPath = 'images/avatar';

        $image = $avatarPath . '/no-photo.png';


        
        if(!empty($this->avatar) && file_exists(public_path($avatarPath .'/' . $this->avatar))) {
            $image = $avatarPath .'/' . $this->avatar;
        }

        return $image;
    }
}
