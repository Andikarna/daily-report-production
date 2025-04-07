<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportDetailProduction extends Model
{
    use HasFactory;

    public $table = 'report_detail_productions';

    public $timestamps = false;

    protected $fillable = [
        'report_id',
        'ip',
        'created_at',
        'updated_at'
    ];

    public function lotDetails()
    {
        return $this->hasMany(ReportDetailLot::class, 'report_detail_id');
    }
}
