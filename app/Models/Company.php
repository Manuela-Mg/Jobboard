<?php

namespace App\Models;

use App\Models\Advertisement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string, float>
     */
    protected $fillable = [
        'name',
        'intro',
        'address',
        'phone',
        'email',
        'webSite'
    ];

    /**
     * Interact with the company's name.
     *
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(get: fn ($value) => ucfirst($value), set: fn ($value) => strtolower($value));
    }
    /**
     * Interact with the company's intro.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function intro(): Attribute
    {
        return Attribute::make(get: fn ($value) => ucfirst($value), set: fn ($value) => strtolower($value));
    }
    /**
     * Interact with the company's email.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function email(): Attribute
    {
        return Attribute::make(get: fn ($value) => ucfirst($value), set: fn ($value) => strtolower($value));
    }
    /**
     * Interact with the company's phonse.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function phone(): Attribute
    {
        return Attribute::make(get: fn ($value) => ucfirst($value), set: fn ($value) => strtolower($value));
    }
    /**
     * Interact with the company's adress.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function adress(): Attribute
    {
        return Attribute::make(get: fn ($value) => ucfirst($value), set: fn ($value) => strtolower($value));
    }
    /**
     * Interact with the company's webSite.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function webSite(): Attribute
    {
        return Attribute::make(get: fn ($value) => ucfirst($value), set: fn ($value) => strtolower($value));
    }
    /**
     * Get the advertisement for company.
     */
    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }
    /**
     * Get the owner for company.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
