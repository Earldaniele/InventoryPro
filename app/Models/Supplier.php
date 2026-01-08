<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'address',
        'lead_time_days', 'reliability_score', 'minimum_order_value'
    ];

    protected $casts = [
        'lead_time_days' => 'integer',
        'reliability_score' => 'decimal:2',
        'minimum_order_value' => 'decimal:2'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // convert 0.95 -> 95%
    public function getReliabilityPercentAttribute()
    {
        return round(($this->reliability_score ?? 0.90) * 100);
    }

    // badge color based on reliability
    public function getReliabilityBadgeClass(): string
    {
        $score = $this->reliability_score ?? 0.90;
        if ($score >= 0.95) return 'bg-success';
        if ($score >= 0.85) return 'bg-info';
        if ($score >= 0.70) return 'bg-warning';
        return 'bg-danger';
    }
}