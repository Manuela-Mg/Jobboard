<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jobapp extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'message'
    ];
    /**
     * Interact with the jobapp's message.
     *
     * @return Attribute
     */
    protected function message(): Attribute
    {
        return Attribute::make(get: fn ($value) => ucfirst($value), set: fn ($value) => strtolower($value));
    }

    /**
     * Get the advertisement for Jopapp.
     */
    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }
    /**
     * Get the user for Jopapp.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
