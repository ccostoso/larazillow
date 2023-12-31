<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['beds', 'baths', 'area', 'city', 'code', 'street', 'street_nr', 'price'];

    protected $sortable = ['price', 'created_at'];

    public function owner(): BelongsTo
    {
        // Using full namespace name and ::class constant to avoid importing every model that User model is related to
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function scopeMostRecent(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when(
                $filters['priceMin'] ?? false,
                fn ($query, $value) => $query->where('price', '>=', $value)
            )
            ->when(
                $filters['priceMax'] ?? false,
                fn ($query, $value) => $query->where('price', '<=', $value)
            )
            ->when(
                $filters['beds'] ?? false,
                fn ($query, $value) => $query->where('beds', (int) $value < 6 ? '=' : '>=', $value)
            )
            ->when(
                $filters['baths'] ?? false,
                fn ($query, $value) => $query->where('baths', (int) $value < 6 ? '=' : '>=', $value)
            )
            ->when(
                $filters['areaMin'] ?? false,
                fn ($query, $value) => $query->where('area', '>=', $value)
            )
            ->when(
                $filters['areaMax'] ?? false,
                fn ($query, $value) => $query->where('area', '<=', $value)
            )->when(
                $filters['deleted'] ?? false,
                fn ($query, $value) => $query->withTrashed()
            )->when(
                $filters['by'] ?? false,
                fn ($query, $value) => 
                !in_array($value, $this->sortable) 
                    ? $query 
                    : $query->orderBy($value, $filters['order'] ?? 'desc')
            );
    }
}
