<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'city', 'state', 'phone', 'link', 'image', 'start_hour', 'close_hour'];

    protected $appends = ['full_address'];

    public function getFullAddressAttribute()
    {
        return "{$this->address}, {$this->city}, {$this->state}";
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }
}
