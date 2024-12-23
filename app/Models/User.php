<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;
    public $timestamps = false;
    protected $fillable = ['user_name', 'password', 'created'];
    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    { return ['email_verified_at' => 'datetime', 'password' => 'hashed'];}
}
