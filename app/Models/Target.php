<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'created_by'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function dailyFoundtarget()
    {
        return $this->hasMany(DailyFoundTarget::class);
    }

    public function scopeNotFoundToday($query)
    {
        $query->whereDoesntHave('dailyFoundTarget', function ($q) {
            $q->whereDate('created_at', Carbon::today());
        });
    }
}
