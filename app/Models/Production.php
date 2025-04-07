<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Production extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_approval_id',
        'date_production',
        'ip',
        'target',
        'time',
        'standart',
        'ok',
        'percent_of_ok',
        'ng',
        'percent_of_ng',
        'total',
        'achievement',
        'description',
        'created_at',
        'created_by',
        'created_byId',
        'updated_at',
        'updated_by',
        'updated_byId',
    ];

    public function reportApproval()
    {
        return $this->belongsTo(ReportApproval::class, 'report_approval_id');
    }

    public function dailyAchievement()
    {
        return $this->hasMany(DailyAchievement::class, 'production_id');
    }
}
