<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'start_date',
        'end_date',
        'status',
        'visitor_id',
        'user_id'
    ];

    public function status()
    {
        return self::$statusColors;
    }

    public static $statusColors = [
        'Pendiente' => 'primary',
        'Confirmado' => 'success',
        'Cancelado' => 'danger'
    ];

    public static $statuses = [
        'Pendiente',
        'Confirmado',
        'Cancelado'
    ];

    private function capitalizeValue($value)
    {
        return ucwords(strtolower($value));
    }

    public function getStatusColorAttribute(): string
    {
        return self::$statusColors[$this->status];
    }

    public function setSubjectAttribute($value)
    {
        $this->attributes['subject'] = $this->capitalizeValue($value);
    }

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
