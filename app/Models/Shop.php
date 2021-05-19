<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'province_id',
        'city_id',
        'subdistrict',
        'postal_code',
        'logo',
    ];

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function provinces()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }
}
