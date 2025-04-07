<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportProduction extends Model
{

    use HasFactory;

    public $table = 'report_productions';

    public $timestamps = false;

    protected $fillable = [
        'divisi_id',
        'leader_id',
        'date_production',
        'operator_id',
        'name',
        'shift',
        'status',
        'created_at',
        'updated_at'
    ];

    public function division()
    {
        return $this->belongsTo(Division::class, 'divisi_id');
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function report_approval()
    {
        return $this->hasOne(ReportApproval::class, 'report_id', 'id');
    }
}
