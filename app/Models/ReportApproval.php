<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class ReportApproval extends Model
{
    use HasFactory;

    public $table = 'report_approval';

    public $timestamps = false;

    protected $fillable = [
        'divisi_id',
        'report_id',
        'report_detail_id',
        'approval_id',
        'status',
        'created_at',
        'created_by',
        'updated_at',
    ];
    public function division()
    {
        return $this->belongsTo(Division::class, 'divisi_id');
    }

    public function report()
    {
        return $this->belongsTo(ReportProduction::class, 'report_id');
    }

    public function approval()
    {
        return $this->belongsTo(User::class, 'approval_id');
    }

    public function reportDetails()
    {
        return $this->hasMany(Production::class, 'report_approval_id');
    }
}
