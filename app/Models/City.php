<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'province_id',
        'city_name',
        'postal_code',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }
}
