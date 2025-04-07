<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportDetailLot extends Model
{
    use HasFactory;

    
    use HasFactory;

    public $table = 'report_detail_lot';

    public $timestamps = false;

    protected $fillable = [
        'report_id',
        'report_detail_id',
        'no_lot',
        'ok',
        'ng',
        'time',
        'total',
        'description',
        'created_at',
        'updated_at'
    ];

    public function report_detail_production()
    {
        return $this->hasOne(ReportDetailProduction::class, 'id', 'id');
    }
}
