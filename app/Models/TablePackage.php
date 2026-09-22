<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TablePackage extends Model
{
    public const CURRENCY = 'GHC';

    protected $fillable = [
        'name', 'seats', 'price', 'features', 'sort_order', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price'      => 'decimal:2',
            'features'   => 'array',
            'sort_order' => 'integer',
            'is_active'  => 'boolean',
        ];
    }

    public function getFormattedPriceAttribute(): string
    {
        return self::CURRENCY . ' ' . number_format((float) $this->price, 2);
    }
}
