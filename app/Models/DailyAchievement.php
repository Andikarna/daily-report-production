<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyAchievement extends Model
{


    use HasFactory;

    public $table = 'daily_achievements';

    protected $fillable = [
        'production_id',
        'divisi_id',
        'operator_id',
        'date_production',
        'achievement',
        'created_at',
        'updated_at'
    ];

    public function production()
    {
        return $this->belongsTo(Production::class, 'production_id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'divisi_id');
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }
}
