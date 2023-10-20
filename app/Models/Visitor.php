<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'entity',
        'dni',
        'phone_number',
        'email',
    ];

    public static $entities = [
        'Persona natural',
        'Persona jurídica'
    ];

    private function capitalizeValue($value)
    {
        return ucwords(strtolower($value));
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $this->capitalizeValue($value);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}
