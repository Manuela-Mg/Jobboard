<?php

namespace App\Models;

use App\Models\Jobapp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advertisement extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string, float, time>
     */
    protected $fillable = [
        'title',
        'description',
        'wages',
        'location',
        'workTime'
    ];
    /**
     * Interact with the advertisement's title.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function title(): Attribute
    {
        return Attribute::make(get: fn ($value) => ucfirst($value), set: fn ($value) => strtolower($value));
    }
    /**
     * Interact with the advertisement's description.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function description(): Attribute
    {
        return Attribute::make(get: fn ($value) => ucfirst($value), set: fn ($value) => strtolower($value));
    }
    /**
     * Interact with the advertisement's location.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function location(): Attribute
    {
        return Attribute::make(get: fn ($value) => ucfirst($value), set: fn ($value) => strtolower($value));
    }
    /**
     * Interact with the advertisement's wages.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function wages(): Attribute
    {
        return Attribute::make(get: fn ($value) => ucfirst($value), set: fn ($value) => strtolower($value));
    }
    /**
     * Interact with the advertisement's workTime.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function workTime(): Attribute
    {
        return Attribute::make(get: fn ($value) => ucfirst($value), set: fn ($value) => strtolower($value));
    }
    /**
     * Get the company for advertisement.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    /**
     * Get the jobapp for advertisement.
     */
    public function jobApps()
    {
        return $this->hasMany(Jobapp::class);
    }
}
