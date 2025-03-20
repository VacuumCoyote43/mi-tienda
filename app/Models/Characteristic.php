<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Characteristic extends Model
{
    use HasFactory;

    const TYPES = [
        'Talla',
        'Color',
        'Material',
        'Estilo'
    ];

    protected $fillable = ['name', 'type', 'value'];

    /**
     * Get the products that have this characteristic.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
                    ->withTimestamps();
    }
}
