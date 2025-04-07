<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    public $table = 'divisions';

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
    
    public function report_production()
    {
        return $this->hasOne(ReportProduction::class, 'division_id', 'id');
    }

    public function report_approval()
    {
        return $this->hasOne(ReportApproval::class, 'divisi_id', 'id');
    }

    public function dailyAchievement()
    {
        return $this->hasMany(DailyAchievement::class, 'divisi_id');
    }
}
