<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['beds', 'baths', 'area', 'city', 'code', 'street', 'street_nr', 'price'];

    public function owner(): BelongsTo {
        // Using full namespace name and ::class constant to avoid importing every model that User model is related to
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
