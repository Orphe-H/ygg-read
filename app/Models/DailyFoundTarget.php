<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyFoundTarget extends Model
{
    use HasFactory;

    protected $fillable = [
        'target_id',
        'data',
    ];

    protected $casts = [
        'data' => 'json',
    ];

    public function target()
    {
        return $this->belongsTo(Target::class);
    }
}
