<?php

namespace App\Models;

use App\Models\Jobapp;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone'
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

    /**
     * Interact with the user's name.
     *
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(get: fn ($value) => ucfirst($value), set: fn ($value) => strtolower($value));
    }
    /**
     * Interact with the user's email.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function email(): Attribute
    {
        return Attribute::make(get: fn ($value) => ucfirst($value), set: fn ($value) => strtolower($value));
    }
    /**
     * Interact with the user's password.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function password(): Attribute
    {
        return Attribute::make(get: fn ($value) => ucfirst($value), set: fn ($value) => $value);
    }
    /**
     * Interact with the user's phonse.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function phone(): Attribute
    {
        return Attribute::make(get: fn ($value) => ucfirst($value), set: fn ($value) => strtolower($value));
    }
    /**
     * Get the jobapp for user.
     */
    public function jobApps()
    {
        return $this->hasMany(Jobapp::class);
    }
    /**
     * Get the company for user.
     */
    public function comany()
    {
        return $this->hasOne(Company::class);
    }
}
